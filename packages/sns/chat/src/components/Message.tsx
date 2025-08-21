import clsx from 'clsx';
import React from 'react';
import Markdown from 'react-markdown';
import { MessageType } from '../types/message';
import Exclamation from './icons/Exclamation';
import MessageLoader from './MessageLoader';
import Avatar from './Avatar';
import BubbleQuestions from './BubbleQuestions';
import { sanitizeFormattedMessage } from '@utils/sanitizer';
import { useTranslation } from 'react-i18next';

const Message = ({ message }: { message: MessageType }) => {
	const { role, error, content, isLoading, isFirstMessage = false } = message;
	const { t } = useTranslation();
	const isUserMessage = role === 'user';
	const isAssistantLoading = role === 'assistant' && isLoading;

	return (
		<section
			className={clsx(
				'p-1 md:pt-2 md:pl-2 md:pb-2 lg:pl-4 lg:pb-4 lg:pt-4 flex gap-3 md:gap-4 items-center w-full',
				{
					'bg-primary-lighter': isUserMessage,
				},
			)}
			tabIndex={0}
			aria-labelledby={`message-${role}-${message.id}`}
		>
			<span id={`message-${role}-${message.id}`} className="sr-only">
				{`${isUserMessage ? t('chat.user.sr') : t('chat.assistant.sr')} ${new Date(message.date).toLocaleTimeString('it-IT', { hour: '2-digit', minute: '2-digit' })}: ${sanitizeFormattedMessage(content).slice(0, 150)}${content.length > 150 ? '...' : ''}`}
			</span>
			{!error && <Avatar role={role} />}
			{error && <Exclamation />}
			<div className="flex flex-col w-full overflow-hidden">
				<div className="message-content">
					<Markdown
						components={{
							p: ({ children }) => (
								<p
									className={clsx('p-2', {
										'text-red-700': error,
									})}
								>
									{children}
								</p>
							),
							a: ({ children, href }) => (
								<a
									href={href}
									target="_blank"
									rel="noopener noreferrer"
									className="text-primary underline font-bold"
								>
									{children}
								</a>
							),
						}}
					>
						{content}
					</Markdown>
				</div>
				{isFirstMessage && <BubbleQuestions />}
				{isAssistantLoading && <MessageLoader />}
			</div>
		</section>
	);
};

export default React.memo(Message);
