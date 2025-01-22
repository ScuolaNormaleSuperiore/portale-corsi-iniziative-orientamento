import React from 'react';
import clsx from 'clsx';
import { useTranslation } from 'react-i18next';
import { AvatarProps } from '../types/avatar';
import { useAtomValue } from 'jotai';
import { rootAttributesAtom } from '@atoms/rootAttributes';

import DefaultUserAvatar from '@assets/images/user-avatar.svg';
import DefaultAssistantAvatar from '@assets/images/assistant-avatar.svg';

const Avatar: React.FC<AvatarProps> = ({
  role = 'assistant',
  isLoading = false,
}) => {
  return (
    <div
      className={clsx(
        'overflow-hidden w-10 h-10 min-w-10 min-h-10 rounded-full bg-secondary-lighter self-start sticky top-0',
        {
          'animate-pulse': isLoading,
        },
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
  const { t } = useTranslation();

  return (
    <img
      src={DefaultAssistantAvatar}
      alt={t('avatar.assistant.alt')}
      role="presentation"
      className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-5 h-5"
      loading="lazy"
      width={20}
      height={20}
    />
  );
};

const UserAvatar = () => {
  const { t } = useTranslation();
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
      alt={t('avatar.user.alt')}
      role="presentation"
      loading="lazy"
      className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8"
      width={32}
      height={32}
    />
  );
};

export default React.memo(Avatar);
