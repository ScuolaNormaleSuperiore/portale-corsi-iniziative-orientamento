import clsx from 'clsx';
import React from 'react';
import Markdown from 'react-markdown';
import { MessageType } from '../types/message';
import Exclamation from './icons/Exclamation';
import MessageLoader from './MessageLoader';
import Avatar from './Avatar';

const Message: React.FC<{ message: MessageType }> = ({ message }) => {
  return (
    <article
      className={clsx(
        'pt-2 pl-2 pb-2 lg:pl-4 lg:pb-4 lg:pt-4 flex gap-4 items-center w-full',
        {
          'bg-primary-lighter': message.role === 'user',
        },
      )}
    >
      {!message?.error && <Avatar role={message.role} />}
      {message?.error && <Exclamation />}
      <div className="flex flex-col gap-2 w-full overflow-hidden">
        <Markdown
          className={clsx('message-content w-full', {
            'text-red-700': message?.error,
          })}
        >
          {message.content}
        </Markdown>
        {message.role === 'assistant' && message.isLoading && <MessageLoader />}
      </div>
    </article>
  );
};

export default React.memo(Message);
