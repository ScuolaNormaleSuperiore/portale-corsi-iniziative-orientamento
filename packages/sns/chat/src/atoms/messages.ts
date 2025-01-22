import { atom } from 'jotai';
import { v4 as uuidv4 } from 'uuid';
import { MessageType } from '../types/message';
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
  (
    get,
    set,
    {
      messageId,
      content,
      isLoading,
      error,
    }: {
      messageId: string;
      content?: string;
      isLoading?: boolean;
      error?: boolean;
    },
  ) => {
    const messages = get(messagesAtom);
    const messageIndex = messages.findIndex((msg) => msg.id === messageId);
    if (messageIndex !== -1) {
      const updatedMessages = [...messages];
      updatedMessages[messageIndex] = {
        ...updatedMessages[messageIndex],
        content: content || updatedMessages[messageIndex].content,
        isLoading: isLoading || updatedMessages[messageIndex].isLoading,
        error: error || updatedMessages[messageIndex].error,
      };
      set(messagesAtom, updatedMessages);
    }
  },
);
export const updateMessageChunkAtom = atom(
  null,
  (get, set, { messageId, content }) => {
    const messages = get(messagesAtom);
    const messageIndex = messages.findIndex((msg) => msg.id === messageId);
    if (messageIndex !== -1) {
      const updatedMessages = [...messages];
      updatedMessages[messageIndex] = {
        ...updatedMessages[messageIndex],
        content: updatedMessages[messageIndex].content + content,
      };
      set(messagesAtom, updatedMessages);
    }
  },
);
export const fetchMessageAtom = atom(
  null,
  async (get, set, message: string = '') => {
    const userMessage = message || get(currentUserMessageAtom);
    set(isMessageLoadingAtom, true);
    set(currentUserMessageAtom, '');
    const newUserMessage: MessageType = {
      id: uuidv4(),
      content: userMessage,
      role: 'user',
      date: new Date().toISOString(),
      isLoading: false,
      error: false,
    };
    set(addMessageAtom, newUserMessage);

    const newAssistantMessage: MessageType = {
      id: uuidv4(),
      content: '',
      role: 'assistant',
      date: new Date().toISOString(),
      isLoading: true,
      error: false,
    };
    try {
      const response = await fetch('http://localhost:8081/chat', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          messages: get(messagesAtom).map((msg) => ({
            role: msg.role,
            content: msg.content,
          })),
        }),
        signal: AbortSignal.timeout(30000),
      });
      set(addMessageAtom, newAssistantMessage);
      if (!response.body || !response.ok) {
        set(updateMessageAtom, {
          messageId: newAssistantMessage.id,
          content: i18n.t('errorMessage'),
          isLoading: false,
          error: true,
        });
      }
      const reader = response.body?.getReader();
      if (reader) {
        while (true) {
          const { done, value } = await reader.read();
          if (done) break;
          const content = new TextDecoder().decode(value);
          const currentChunk = content.replace(/\[CHUNK\] -> /g, '');
          switch (currentChunk) {
            case '[DONE]':
              set(updateMessageAtom, {
                messageId: newAssistantMessage.id,
                isLoading: false,
                error: false,
              });
              break;
            case '[ERROR]':
              set(updateMessageAtom, {
                messageId: newAssistantMessage.id,
                content: i18n.t('errorMessage'),
                isLoading: false,
                error: true,
              });
              break;
            default:
              if (currentChunk) {
                set(updateMessageChunkAtom, {
                  messageId: newAssistantMessage.id,
                  content: currentChunk,
                });
              }
          }
        }
      }
    } catch (_) {
      // eslint-disable-line @typescript-eslint/no-unused-vars
      set(updateMessageAtom, {
        messageId: newAssistantMessage.id,
        content: i18n.t('errorMessage'),
        isLoading: false,
        error: true,
      });
    } finally {
      set(isMessageLoadingAtom, false);
    }
  },
);
