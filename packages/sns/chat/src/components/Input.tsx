import React, { useRef, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import { useSetAtom, useAtomValue } from 'jotai';
import {
  currentUserMessageAtom,
  fetchMessageAtom,
  isMessageLoadingAtom,
} from '@atoms/messages';

const Input: React.FC = () => {
  const inputRef = useRef<HTMLInputElement>(null);
  const setCurrentUserMessage = useSetAtom(currentUserMessageAtom);
  const currentUserMessage = useAtomValue(currentUserMessageAtom);
  const setFetchMessage = useSetAtom(fetchMessageAtom);
  const isMessageLoading = useAtomValue(isMessageLoadingAtom);
  const { t } = useTranslation();

  const handleSetCurrentMessage = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.value.length > 0) {
      setCurrentUserMessage(e.target.value);
    } else {
      setCurrentUserMessage('');
    }
  };

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
      onChange={handleSetCurrentMessage}
      onKeyDown={(e) => e.key === 'Enter' && handleSendMessage()}
      placeholder={t('chat.inputPlaceholder')}
      disabled={isMessageLoading}
    />
  );
};

export default React.memo(Input);
