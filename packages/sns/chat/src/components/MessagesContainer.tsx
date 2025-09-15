import React, { useRef, useState, useEffect } from 'react';
import Messages from './Messages';
import { useAtomValue } from 'jotai';
import { isMessageLoadingAtom } from '@atoms/messages';
import { useTranslation } from 'react-i18next';

const MessagesContainer = () => {
	const parentRef = useRef<HTMLDivElement>(null);
	const [visibleHeight, setVisibleHeight] = useState<number | null>(null);
	const isMessageLoading = useAtomValue(isMessageLoadingAtom);
	const { t } = useTranslation();

	const updateHeight = () => {
		if (parentRef.current) {
			const rect = parentRef.current.getBoundingClientRect();
			setVisibleHeight(window.innerHeight - rect.top - 90);
		}
	};

	useEffect(() => {
		updateHeight();
		window.addEventListener('resize', updateHeight);
		window.addEventListener('scroll', updateHeight);

		return () => {
			window.removeEventListener('resize', updateHeight);
			window.removeEventListener('scroll', updateHeight);
		};
	}, []);

	return (
		<>
			<div
				className="chat-status sr-only"
				role="status"
				aria-live="polite"
				aria-atomic="true"
			>
				{isMessageLoading ? t('chat.loading.sr') : ''}
			</div>
			<section
				ref={parentRef}
				className="flex flex-col px-3 md:px-12 w-full pb-2 lg:pb-4 lg:h-[525px] lg:min-h-96 h-[350px] min-h-64 flex-grow"
				tabIndex={0}
				role="log"
				aria-live="polite"
				aria-labelledby="chat-heading"
				id="messages-container"
			>
				<span id="chat-heading" className="sr-only">
					{t('chat.heading.sr')}
				</span>
				<Messages visibleHeight={visibleHeight} />
			</section>
		</>
	);
};

export default React.memo(MessagesContainer);
