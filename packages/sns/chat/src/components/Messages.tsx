import React, { useEffect, useRef } from 'react';
import { useAtomValue } from 'jotai';
import { MessageType } from '../types/message';
import { useScrollToBottom } from '@hooks/useScrollToBottom';
import Message from './Message';
import { messagesAtom } from '@atoms/messages';

const Messages = () => {
  const messages = useAtomValue(messagesAtom);
  const { elementRef, scrollToBottom } = useScrollToBottom();
  const isFirstRender = useRef(true);
  useEffect(() => {
    if (elementRef.current && !isFirstRender.current) {
      scrollToBottom();
    }
    isFirstRender.current = false;
  }, [messages, elementRef, scrollToBottom]);
  return (
    <div
      className="flex flex-col gap-4 h-[520px] w-full min-h-96 overflow-y-auto"
      ref={elementRef}
    >
      {messages.map((message: MessageType) => (
        <Message key={message.id} message={message} />
      ))}
    </div>
  );
};

export default React.memo(Messages);
