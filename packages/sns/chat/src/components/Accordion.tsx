import React, { useState } from 'react';
import clsx from 'clsx';
import { ChevronUp } from '@components/icons/Chevron';
import { motion, AnimatePresence } from 'framer-motion';
import { AccordionProps } from '../types/accordion';

const Accordion: React.FC<AccordionProps> = ({
  children,
  title,
  defaultOpen = false,
}: AccordionProps) => {
  const [isOpen, setIsOpen] = useState(defaultOpen);
  return (
    <div className="flex flex-col w-full bg-white rounded border border-subtle">
      <button
        onClick={() => setIsOpen(!isOpen)}
        className="flex items-center justify-between w-full py-4 px-6 gap-6"
      >
        <p
          className={clsx(
            'text-base transition-colors duration-300 text-primary font-semibold',
            {
              'text-primary-active': isOpen,
            },
          )}
        >
          {title}
        </p>
        <motion.span
          animate={{ rotate: isOpen ? 180 : 0 }}
          initial={isOpen ? { rotate: 180 } : { rotate: 0 }}
          transition={{ duration: 0.3 }}
        >
          <ChevronUp className={clsx({ 'rotate-180': isOpen })} />
        </motion.span>
      </button>

      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={false}
            animate={{ height: 'auto', opacity: 1 }}
            exit={{ height: 0, opacity: 0 }}
            transition={{ duration: 0.3 }}
            className="overflow-hidden"
          >
            <ul className="flex flex-col gap-4 px-6 py-5">{children}</ul>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
};

export default React.memo(Accordion);
