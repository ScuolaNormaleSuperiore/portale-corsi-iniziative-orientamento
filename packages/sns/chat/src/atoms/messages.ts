import { atom } from 'jotai';
import { v4 as uuidv4 } from 'uuid';
import { sanitize } from '../utils/sanitizer';
import { MessageType } from '../types/message';
import { UpdateMessageParams, UpdateMessageChunkParams } from '../types/atoms';
import { RoleType } from '../types/message';
import i18n from '../i18n/config';

export const messagesAtom = atom<MessageType[]>([]);
export const currentUserMessageAtom = atom<string>('');
export const isMessageLoadingAtom = atom<boolean>(false);

export const addMessageAtom = atom(
  null,
  (get, set, newMessage: MessageType) => {
    const currentMessages = get(messagesAtom);
    set(messagesAtom, [...currentMessages, newMessage]);
  },
);

export const updateMessageAtom = atom(
  null,
  (get, set, params: UpdateMessageParams) => {
    const { messageId, content, isLoading, error } = params;
    const messages = get(messagesAtom);
    const messageIndex = messages.findIndex((msg) => msg.id === messageId);

    if (messageIndex === -1) {
      console.error(`Message with id ${messageId} not found`);
      return;
    }

    const updatedMessages = [...messages];
    updatedMessages[messageIndex] = {
      ...updatedMessages[messageIndex],
      content: content ?? updatedMessages[messageIndex].content,
      isLoading: isLoading ?? updatedMessages[messageIndex].isLoading,
      error: error ?? updatedMessages[messageIndex].error,
    };
    set(messagesAtom, updatedMessages);
  },
);

export const updateMessageChunkAtom = atom(
  null,
  (get, set, params: UpdateMessageChunkParams) => {
    const { messageId, content, isLoading = true, error = false } = params;
    const messages = get(messagesAtom);
    const messageIndex = messages.findIndex((msg) => msg.id === messageId);

    if (messageIndex === -1) {
      console.error(`Message with id ${messageId} not found`);
      return;
    }

    const updatedMessages = [...messages];
    updatedMessages[messageIndex] = {
      ...updatedMessages[messageIndex],
      content: updatedMessages[messageIndex].content + content,
      isLoading: isLoading ?? updatedMessages[messageIndex].isLoading,
      error: error ?? updatedMessages[messageIndex].error,
    };
    set(messagesAtom, updatedMessages);
  },
);

const createMessage = (
  role: RoleType,
  content: string,
  isLoading: boolean = false,
  error: boolean = false,
): MessageType => ({
  id: uuidv4(),
  content,
  role,
  date: new Date().toISOString(),
  isLoading,
  error,
});

export const fetchMessageAtom = atom(
  null,
  async (get, set, message: string = '') => {
    const userMessage = message || get(currentUserMessageAtom);
    const newUserMessage = createMessage('user', sanitize(userMessage));
    if (!userMessage.trim()) {
      console.error('Empty message provided');
      return;
    }
    const newAssistantMessage = createMessage('assistant', '', true);
    try {
      set(isMessageLoadingAtom, true);
      set(currentUserMessageAtom, '');
      set(addMessageAtom, newUserMessage);
      set(addMessageAtom, newAssistantMessage);

      const response = await fetch('http://localhost:8081/chat', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          messages: get(messagesAtom)
            .filter((msg) => !msg.error && msg.content.length > 0)
            .map((msg) => ({
              role: msg.role,
              content: msg.content,
            })),
        }),
        signal: AbortSignal.timeout(30000),
      });

      if (!response.ok || !response.body) {
        throw new Error('Network response was not ok');
      }

      const reader = response.body.getReader();
      while (true) {
        const { done, value } = await reader.read();
        if (done) break;

        const content = new TextDecoder().decode(value);
        const currentChunk = content.replace(/\[CHUNK\](?: -> )?/g, '');

        if (currentChunk.includes('[ERROR]')) {
          set(updateMessageAtom, {
            messageId: newAssistantMessage.id,
            content: i18n.t('message.error'),
            error: true,
          });
          break;
        }

        if (currentChunk.includes('[DONE]')) {
          set(updateMessageChunkAtom, {
            messageId: newAssistantMessage.id,
            content: currentChunk.replace('[DONE]', ''),
            isLoading: false,
            error: false,
          });
          break;
        }

        if (currentChunk) {
          set(updateMessageChunkAtom, {
            messageId: newAssistantMessage.id,
            content: currentChunk,
          });
        }
      }
    } catch (error) {
      console.error('Error in fetchMessageAtom:', error);
      set(updateMessageAtom, {
        messageId: newAssistantMessage.id,
        content: i18n.t('message.error'),
        error: true,
      });
    } finally {
      set(updateMessageAtom, {
        messageId: newAssistantMessage.id,
        isLoading: false,
      });
      set(isMessageLoadingAtom, false);
    }
  },
);
