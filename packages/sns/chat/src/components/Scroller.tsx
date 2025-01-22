import React, { useEffect } from 'react';
import { useAtomValue } from 'jotai';
import { messagesAtom } from '@atoms/messages';
import { useScrollToBottom } from '@hooks/useScrollToBottom';

export const Scroller = () => {
  const messages = useAtomValue(messagesAtom);
  const { elementRef, scrollToBottom } = useScrollToBottom();

  useEffect(() => {
    if (messages.length > 0) {
      scrollToBottom();
    }
  }, [messages]); // eslint-disable-line react-hooks/exhaustive-deps

  return <div ref={elementRef}></div>;
};

export default React.memo(Scroller);
