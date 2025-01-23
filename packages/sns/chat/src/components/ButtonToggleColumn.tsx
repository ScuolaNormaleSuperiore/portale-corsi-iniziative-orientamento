import React from 'react';
import clsx from 'clsx';
import { motion } from 'framer-motion';
import { useAtomValue } from 'jotai';
import { isLeftColumnCollapsedAtom, isPanelOpenAtom } from '@atoms/layout';

const ButtonToggleColumn: React.FC<{
  className?: string;
  handler?: () => void;
}> = ({ className, handler }) => {
  const isLeftColumnCollapsed = useAtomValue(isLeftColumnCollapsedAtom);
  const isPanelOpen = useAtomValue(isPanelOpenAtom);
  return (
    <button
      onClick={handler}
      className={clsx(
        'w-6 h-6 hover:drop-shadow-lg flex items-center justify-center',
        className,
      )}
    >
      <motion.svg
        animate={{ rotate: isLeftColumnCollapsed || isPanelOpen ? 0 : 180 }}
        transition={{ duration: 0 }}
        initial={false}
        width="20"
        height="20"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        strokeWidth="2"
        strokeLinecap="round"
        strokeLinejoin="round"
      >
        <polyline points="15 18 9 12 15 6" />
      </motion.svg>
    </button>
  );
};

export default React.memo(ButtonToggleColumn);
