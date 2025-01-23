import clsx from 'clsx';
import React from 'react';
import { MessageType } from '../types/message';
import { formatMessage } from '@utils/parser';
import { sanitizeFormattedMessage } from '@utils/sanitizer';
import Exclamation from './icons/Exclamation';
import MessageLoader from './MessageLoader';
import Avatar from './Avatar';

const Message: React.FC<{ message: MessageType }> = ({ message }) => {
  if (!message.content) {
    return null;
  }

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
        <div
          className={clsx('message-content w-full', {
            'text-red-700': message?.error,
          })}
          dangerouslySetInnerHTML={{
            __html: sanitizeFormattedMessage(formatMessage(message.content)),
          }}
        />
        {message.role === 'assistant' && message.isLoading && <MessageLoader />}
      </div>
    </article>
  );
};

export default React.memo(Message);
