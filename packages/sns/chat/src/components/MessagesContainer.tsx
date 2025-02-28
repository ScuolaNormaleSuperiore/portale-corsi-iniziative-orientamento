import React, { useRef, useState, useEffect } from 'react';
import Messages from './Messages';

const MessagesContainer = () => {
	const parentRef = useRef<HTMLDivElement>(null);
	const [visibleHeight, setVisibleHeight] = useState<number | null>(null);

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
		<div
			ref={parentRef}
			className="flex flex-col px-3 md:px-12 w-full pb-2 lg:pb-4 lg:h-[525px] lg:min-h-96 h-[350px] min-h-64 flex-grow"
		>
			<Messages visibleHeight={visibleHeight} />
		</div>
	);
};

export default React.memo(MessagesContainer);
