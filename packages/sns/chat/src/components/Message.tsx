import clsx from 'clsx';
import React from 'react';
import { MessageType } from '../types/message';
import { formatMessage } from '@utils/sanitizer';

const Message: React.FC<{ message: MessageType }> = ({ message }) => {
  if (!message.content) {
    return null;
  }

  return (
    <div
      className={clsx('message', {
        'user-message': message.role === 'user',
        'assistant-message': message.role === 'assistant',
      })}
      dangerouslySetInnerHTML={{ __html: formatMessage(message.content) }}
    />
  );
};

export default React.memo(Message);
