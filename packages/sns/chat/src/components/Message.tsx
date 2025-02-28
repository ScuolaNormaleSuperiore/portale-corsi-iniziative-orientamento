import clsx from 'clsx';
import React from 'react';
import Markdown from 'react-markdown';
import { MessageType } from '../types/message';
import Exclamation from './icons/Exclamation';
import MessageLoader from './MessageLoader';
import Avatar from './Avatar';
import BubbleQuestions from './BubbleQuestions';
const Message = ({ message }: { message: MessageType }) => {
	const { role, error, content, isLoading, isFirstMessage = false } = message;

	const isUserMessage = role === 'user';
	const isAssistantLoading = role === 'assistant' && isLoading;

	return (
		<article
			className={clsx(
				'pt-2 pl-2 pb-2 lg:pl-4 lg:pb-4 lg:pt-4 flex gap-4 items-center w-full',
				{
					'bg-primary-lighter': isUserMessage,
				},
			)}
		>
			{!error && <Avatar role={role} />}
			{error && <Exclamation />}
			<div className="flex flex-col gap-2 w-full overflow-hidden">
				<Markdown
					components={{
						p: ({ children }) => (
							<p
								className={clsx('message-content w-full', {
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
				{isFirstMessage && <BubbleQuestions />}
				{isAssistantLoading && <MessageLoader />}
			</div>
		</article>
	);
};

export default React.memo(Message);
