import { useRef } from 'react';

export const useScrollToBottom = <T extends HTMLElement = HTMLDivElement>() => {
	const elementRef = useRef<T>(null);
	const scrollToBottom = () => {
		elementRef.current?.scrollTo({
			top: elementRef.current.scrollHeight,
			behavior: 'smooth',
		});
	};
	return { elementRef, scrollToBottom };
};
