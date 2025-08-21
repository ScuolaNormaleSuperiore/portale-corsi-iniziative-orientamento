import React from 'react';
import clsx from 'clsx';
import { motion } from 'framer-motion';
import { useAtomValue } from 'jotai';
import { isLeftColumnCollapsedAtom, isPanelOpenAtom } from '@atoms/layout';
import { useTranslation } from 'react-i18next';
import { useMediaQuery } from 'usehooks-ts';

const ButtonToggleColumn: React.FC<{
	className?: string;
	handler?: () => void;
	ariaTags?: Record<string, string>;
	ariaControlId?: string;
}> = ({ className, handler, ariaTags, ariaControlId }) => {
	const isLeftColumnCollapsed = useAtomValue(isLeftColumnCollapsedAtom);
	const isPanelOpen = useAtomValue(isPanelOpenAtom);
	const isMobile = useMediaQuery('(max-width: 1024px)');
	const { t } = useTranslation();

	return (
		<button
			onClick={handler}
			className={clsx(
				'hover:drop-shadow-lg flex items-center',
				className,
			)}
			aria-expanded={isMobile ? isPanelOpen : !isLeftColumnCollapsed}
			aria-controls={ariaControlId}
			{...ariaTags}
		>
			<motion.svg
				animate={{
					rotate: isLeftColumnCollapsed || isPanelOpen ? 180 : 0,
				}}
				transition={{ duration: 0 }}
				initial={false}
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				strokeWidth="2"
				strokeLinecap="round"
				strokeLinejoin="round"
				className="text-primary w-5 h-5"
			>
				<polyline points="15 18 9 12 15 6" />
			</motion.svg>
			<span className="uppercase text-primary font-semibold lg:hidden">
				{isPanelOpen
					? t('sidebar.mobile.info.close')
					: t('sidebar.mobile.info.open')}
			</span>
			<span className="sr-only">
				{t('sidebar.sr')}
			</span>
		</button>
	);
};

export default React.memo(ButtonToggleColumn);
