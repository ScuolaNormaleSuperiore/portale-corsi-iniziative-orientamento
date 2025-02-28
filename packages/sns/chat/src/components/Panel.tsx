import React from 'react';
import { AnimatePresence, motion } from 'framer-motion';
// import Questions from '@components/Questions';
import Info from '@components/Info';
import { useTranslation } from 'react-i18next';

const Panel: React.FC<{
	isOpen: boolean;
	onClose: () => void;
}> = ({ isOpen, onClose }) => {
	const { t } = useTranslation();
	return (
		<AnimatePresence mode="wait">
			{isOpen && (
				<motion.div
					initial={{ opacity: 0, x: -300 }}
					animate={{ opacity: 1, x: 0 }}
					exit={{ opacity: 0, x: -300 }}
					transition={{ duration: 0.3 }}
					className="bg-primary-lighter flex flex-col p-4 pt-14 fixed top-0 left-0 w-full h-full z-50 overflow-y-auto overflow-x-hidden"
				>
					<button
						onClick={onClose}
						type="button"
						aria-label={
							isOpen
								? t('sidebar.mobile.info.close')
								: t('sidebar.mobile.info.open')
						}
						className="absolute top-4 right-4 flex items-center gap-2"
					>
						<span className="text-md uppercase font-semibold text-primary">
							{isOpen
								? t('sidebar.mobile.info.close')
								: t('sidebar.mobile.info.open')}
						</span>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="16"
							height="16"
							fill="currentColor"
							viewBox="0 0 16 16"
							className="text-primary w-6 h-6"
						>
							<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
						</svg>
					</button>
					{/* <Questions /> */}
					<Info />
				</motion.div>
			)}
		</AnimatePresence>
	);
};

export default React.memo(Panel);
