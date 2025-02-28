import React from 'react';
import { AnimatePresence, motion } from 'framer-motion';

const MessageLoader: React.FC = () => {
	return (
		<AnimatePresence>
			<motion.div
				className="flex gap-1 items-center overflow-hidden py-1 mt-1"
				initial={{ opacity: 0 }}
				animate={{ opacity: 1 }}
				exit={{ opacity: 0, transition: { duration: 0.3 } }}
			>
				<div className="w-1.5 h-1.5 bg-primary rounded-full animate-[bounce_0.6s_infinite]" />
				<div className="w-1.5 h-1.5 bg-primary rounded-full animate-[bounce_0.6s_infinite_0.1s]" />
				<div className="w-1.5 h-1.5 bg-primary rounded-full animate-[bounce_0.6s_infinite_0.2s]" />
			</motion.div>
		</AnimatePresence>
	);
};

export default React.memo(MessageLoader);
