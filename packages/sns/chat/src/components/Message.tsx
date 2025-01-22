import clsx from 'clsx';
import React from 'react';
import { MessageType } from '../types/message';
import { formatMessage } from '@utils/sanitizer';
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
      <div
        className="message-content w-full"
        dangerouslySetInnerHTML={{ __html: formatMessage(message.content) }}
      />
    </article>
  );
};

export default React.memo(Message);
