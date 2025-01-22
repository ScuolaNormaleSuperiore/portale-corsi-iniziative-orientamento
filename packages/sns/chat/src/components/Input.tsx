import React, { useRef, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import { useAtom, useSetAtom, useAtomValue } from 'jotai';
import {
  currentUserMessageAtom,
  fetchMessageAtom,
  isMessageLoadingAtom,
} from '@atoms/messages';

const Input: React.FC = () => {
  const inputRef = useRef<HTMLInputElement>(null);
  const [currentUserMessage, setCurrentUserMessage] = useAtom(
    currentUserMessageAtom,
  );
  const setFetchMessage = useSetAtom(fetchMessageAtom);
  const isMessageLoading = useAtomValue(isMessageLoadingAtom);
  const { t } = useTranslation();

  const handleSendMessage = () => {
    if (currentUserMessage?.trim()) {
      setFetchMessage();
    }
  };

  useEffect(() => {
    if (inputRef.current && !isMessageLoading) {
      inputRef.current.focus();
    }
  }, [isMessageLoading]);

  return (
    <input
      ref={inputRef}
      className="w-full min-h-10 px-4 py-2"
      type="text"
      value={currentUserMessage}
      onChange={(e) => setCurrentUserMessage(e.target.value)}
      onKeyDown={(e) => e.key === 'Enter' && handleSendMessage()}
      placeholder={t('chat.inputPlaceholder')}
      disabled={isMessageLoading}
    />
  );
};

export default React.memo(Input);
