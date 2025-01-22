import clsx from 'clsx';
import React from 'react';
import { MessageType } from '../types/message';
import { formatMessage } from '@utils/parser';
import Avatar from './Avatar';

const Message: React.FC<{ message: MessageType }> = ({ message }) => {
  if (!message.content) {
    return null;
  }

  return (
    <article
      className={clsx('pt-4 pb-4 pl-4 flex gap-4 items-center', {
        'bg-primary-lighter': message.role === 'user',
      })}
    >
      <Avatar role={message.role} />
      <div className="flex flex-col gap-2">
        <div
          className="message-content w-full"
          dangerouslySetInnerHTML={{
            __html: formatMessage(message.content),
          }}
        />
        {message.role === 'assistant' && message.isLoading && (
          <div className="flex gap-1 items-center">
            <div className="w-1.5 h-1.5 bg-primary rounded-full animate-[bounce_0.6s_infinite]" />
            <div className="w-1.5 h-1.5 bg-primary rounded-full animate-[bounce_0.6s_infinite_0.1s]" />
            <div className="w-1.5 h-1.5 bg-primary rounded-full animate-[bounce_0.6s_infinite_0.2s]" />
          </div>
        )}
      </div>
    </article>
  );
};

export default React.memo(Message);
