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
        animate={{ rotate: isLeftColumnCollapsed || isPanelOpen ? 180 : 0 }}
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
        className="text-primary"
      >
        <polyline points="15 18 9 12 15 6" />
      </motion.svg>
    </button>
  );
};

export default React.memo(ButtonToggleColumn);
