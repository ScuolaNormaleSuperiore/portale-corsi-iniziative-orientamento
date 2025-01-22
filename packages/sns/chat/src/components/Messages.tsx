import React from 'react';
import { useAtomValue } from 'jotai';
import { MessageType } from '../types/message';
import Message from './Message';
import { messagesAtom } from '@atoms/messages';

const Messages = () => {
  const messages = useAtomValue(messagesAtom);
  return (
    <div className="flex flex-col gap-4">
      {messages.map((message: MessageType) => (
        <Message key={message.id} message={message} />
      ))}
    </div>
  );
};

export default React.memo(Messages);
