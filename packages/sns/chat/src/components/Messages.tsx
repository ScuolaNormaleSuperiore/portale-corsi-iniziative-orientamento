import React, { useEffect } from 'react';
import { useAtomValue } from 'jotai';
import { MessageType } from '../types/message';
import { motion, AnimatePresence } from 'framer-motion';
import { messagesAtom } from '@atoms/messages';
import Message from './Message';
import { useScrollToBottom } from '@hooks/useScrollToBottom';

const Messages = ({ visibleHeight }: { visibleHeight: number | null }) => {
	const messages = useAtomValue(messagesAtom);
	const { elementRef, scrollToBottom } = useScrollToBottom<HTMLDivElement>();

	useEffect(() => {
		if (messages.length > 0) {
			scrollToBottom();
		}
	}, [messages, scrollToBottom]);

	if (messages.length === 0) {
		return null;
	}

	return (
		<div
			className="flex flex-col gap-2 lg:gap-4 w-full overflow-y-auto overflow-x-hidden messages-container pr-2 md:pr-4"
			id="messages-container"
			ref={elementRef}
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
								exit={{
									opacity: 0,
									transition: { duration: 0.3 },
								}}
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
