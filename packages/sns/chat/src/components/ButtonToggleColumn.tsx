import React from 'react';
import clsx from 'clsx';
import { motion } from 'framer-motion';
import { useAtomValue, useSetAtom } from 'jotai';
import { isLeftColumnCollapsedAtom, toggleLeftColumnAtom } from '@atoms/layout';

const ButtonToggleColumn: React.FC<{ className?: string }> = ({
  className,
}) => {
  const isLeftColumnCollapsed = useAtomValue(isLeftColumnCollapsedAtom);
  const toggleLeftColumn = useSetAtom(toggleLeftColumnAtom);
  return (
    <button
      onClick={toggleLeftColumn}
      className={clsx(
        'w-6 h-6 hover:drop-shadow-lg flex items-center justify-center',
        className,
      )}
    >
      <motion.svg
        animate={{ rotate: isLeftColumnCollapsed ? 0 : 180 }}
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
