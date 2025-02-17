import React, { useEffect, useRef } from 'react';
import { animateScroll } from 'react-scroll';
import { useAtomValue } from 'jotai';
import { MessageType } from '../types/message';
import { motion, AnimatePresence } from 'framer-motion';
import { messagesAtom } from '@atoms/messages';
import Message from './Message';

const Messages: React.FC<{ visibleHeight: number | null }> = ({
  visibleHeight,
}) => {
  const messages = useAtomValue(messagesAtom);
  const messagesContainerRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (messages.length > 0 && messagesContainerRef.current) {
      animateScroll.scrollToBottom({
        containerId: messagesContainerRef.current.id,
        duration: 50,
        smooth: true,
      });
    }
  }, [messages]);

  if (messages.length === 0) {
    return null;
  }

  return (
    <div
      className="flex flex-col gap-2 lg:gap-4 w-full overflow-y-auto overflow-x-hidden messages-container md:pr-2"
      id="messages-container"
      ref={messagesContainerRef}
      style={{ height: visibleHeight ? `${visibleHeight}px` : 'auto' }}
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
