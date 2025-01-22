import React from 'react';
import clsx from 'clsx';
import { AvatarProps } from '../types/avatar';
import { useAtomValue } from 'jotai';
import { rootAttributesAtom } from '@atoms/rootAttributes';

import DefaultUserAvatar from '@assets/images/user-avatar.svg';
import DefaultAssistantAvatar from '@assets/images/assistant-avatar.svg';

const Avatar: React.FC<AvatarProps> = ({ role = 'assistant' }) => {
  return (
    <div
      className={clsx(
        'overflow-hidden w-10 h-10 min-w-10 min-h-10 rounded-full bg-secondary-lighter self-start sticky top-0',
      )}
    >
      <div className="relative w-full h-full">
        {role === 'user' && <UserAvatar />}
        {role === 'assistant' && <AssistantAvatar />}
      </div>
    </div>
  );
};

const AssistantAvatar = () => {
  return (
    <img
      src={DefaultAssistantAvatar}
      alt="assistant avatar"
      role="presentation"
      className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
      loading="lazy"
      width={20}
      height={20}
      fetchPriority="high"
    />
  );
};

const UserAvatar = () => {
  const { userAvatar } = useAtomValue(rootAttributesAtom);

  if (userAvatar) {
    return (
      <div
        role="presentation"
        className="absolute w-full h-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
        style={{
          backgroundImage: `url(${userAvatar})`,
          backgroundPosition: 'center',
          backgroundSize: 'cover',
          backgroundRepeat: 'no-repeat',
        }}
      />
    );
  }

  return (
    <img
      src={DefaultUserAvatar}
      alt="user avatar"
      role="presentation"
      loading="lazy"
      fetchPriority="high"
      className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
      width={20}
      height={20}
    />
  );
};

export default React.memo(Avatar);
