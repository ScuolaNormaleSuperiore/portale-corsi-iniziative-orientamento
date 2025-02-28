import React, { useRef, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import { useSetAtom, useAtomValue } from 'jotai';
import {
	currentUserMessageAtom,
	fetchMessageAtom,
	isMessageLoadingAtom,
} from '@atoms/messages';
import { useIsMounted } from 'usehooks-ts';
import { delay } from '@utils/stuff';

const Input: React.FC = () => {
	const textAreaRef = useRef<HTMLTextAreaElement>(null);
	const setCurrentUserMessage = useSetAtom(currentUserMessageAtom);
	const currentUserMessage = useAtomValue(currentUserMessageAtom);
	const setFetchMessage = useSetAtom(fetchMessageAtom);
	const isMessageLoading = useAtomValue(isMessageLoadingAtom);
	const isMounted = useIsMounted();
	const { t } = useTranslation();

	const handleSetCurrentMessage = (
		e: React.ChangeEvent<HTMLTextAreaElement>,
	) => {
		setCurrentUserMessage(e.target.value);
	};

	const handleSendMessage = () => {
		if (currentUserMessage?.trim()) {
			setFetchMessage();
		}
	};

	const autoResize = () => {
		if (textAreaRef.current) {
			textAreaRef.current.style.height = '40px';
			textAreaRef.current.style.height =
				textAreaRef.current.scrollHeight + 'px';
			if (textAreaRef.current.scrollHeight > 40) {
				textAreaRef.current.style.overflowY = 'auto';
			} else {
				textAreaRef.current.style.overflowY = 'hidden';
			}
		}
	};

	useEffect(() => {
		autoResize();
	}, [currentUserMessage]);

	useEffect(() => {
		void delay(1600).then(() => {
			if (isMounted()) focusInput();
		});
	}, [isMounted]);

	const focusInput = () => {
		if (textAreaRef.current) {
			textAreaRef.current.focus();
		}
	};

	return (
		<textarea
			ref={textAreaRef}
			className="w-full px-4 py-2 resize-none overflow-x-hidden min-h-10 caret-primary max-h-40 border border-gray"
			value={currentUserMessage}
			onChange={handleSetCurrentMessage}
			onKeyDown={(e) => {
				if (e.key === 'Enter' && !e.shiftKey) {
					e.preventDefault();
					handleSendMessage();
				}
			}}
			inputMode="text"
			placeholder={t('chat.inputPlaceholder')}
			disabled={isMessageLoading}
			autoFocus
			spellCheck={false}
		/>
	);
};

export default React.memo(Input);
