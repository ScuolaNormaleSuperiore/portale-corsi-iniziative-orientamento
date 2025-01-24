import React from 'react';
import { useTranslation } from 'react-i18next';
import {
  isMessageLoadingAtom,
  currentUserMessageAtom,
  fetchMessageAtom,
} from '@atoms/messages';
import { useAtom, useSetAtom } from 'jotai';

const Send: React.FC = () => {
  const { t } = useTranslation();
  const [currentUserMessage] = useAtom(currentUserMessageAtom);
  const setFetchMessage = useSetAtom(fetchMessageAtom);
  const [isMessageLoading] = useAtom(isMessageLoadingAtom);

  const handleSendMessage = () => {
    if (currentUserMessage?.trim()) {
      setFetchMessage();
    }
  };

  return (
    <button
      onClick={handleSendMessage}
      disabled={!currentUserMessage?.trim() || isMessageLoading}
      className="bg-primary text-white text-sm disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 h-10 px-4 flex items-center justify-center hover:bg-primary-hover"
    >
      {t('chat.send')}
    </button>
  );
};

export default React.memo(Send);
