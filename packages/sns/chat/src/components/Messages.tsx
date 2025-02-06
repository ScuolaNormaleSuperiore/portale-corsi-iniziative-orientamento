import React, { useEffect, useRef } from 'react';
import { useAtomValue } from 'jotai';
import { MessageType } from '../types/message';
import { motion, AnimatePresence } from 'framer-motion';
import { useScrollToBottom } from '@hooks/useScrollToBottom';
import Message from './Message';
import { messagesAtom } from '@atoms/messages';

const Messages: React.FC = () => {
  const messages = useAtomValue(messagesAtom);
  const { elementRef, scrollToBottom } = useScrollToBottom();
  const isFirstRender = useRef(true);
  useEffect(() => {
    if (elementRef.current && !isFirstRender.current) {
      scrollToBottom();
    }
    isFirstRender.current = false;
  }, [messages, elementRef, scrollToBottom]);

  if (messages.length === 0) {
    return null;
  }

  return (
    <div
      className="flex flex-col gap-2 lg:gap-4 w-full overflow-y-auto overflow-x-hidden messages-container md:pr-2"
      ref={elementRef}
    >
      <AnimatePresence initial={false}>
        {messages.map(
          (message: MessageType) =>
              (message?.content?.length > 0 || message.isLoading) && (
              <motion.div
                key={message.id}
                initial={
                  message.role === 'user'
                    ? { opacity: 0, x: -100 }
                    : { opacity: 0, x: 100 }
                }
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, transition: { duration: 0.3 } }}
              >
                <Message message={message} />
              </motion.div>
            ),
        )}
      </AnimatePresence>
    </div>
  );
};

export default React.memo(Messages);
