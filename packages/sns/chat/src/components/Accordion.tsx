import React, { useState } from 'react';
import clsx from 'clsx';
import { ChevronUp } from '@components/icons/Chevron';
import { motion, AnimatePresence } from 'framer-motion';
import { AccordionProps } from '../types/accordion';
import AccordionItem from './AccordionItem';

const Accordion: React.FC<AccordionProps> = ({
  title,
  items,
  defaultOpen = false,
}: AccordionProps) => {
  const [isOpen, setIsOpen] = useState(defaultOpen);
  return (
    <div className="flex flex-col w-full bg-white rounded border border-subtle">
      <button
        onClick={() => setIsOpen(!isOpen)}
        className="flex items-center justify-between w-full py-2 md:py-4 px-3 md:px-6 gap-3"
        aria-expanded={isOpen}
        tabIndex={0}
      >
        <p
          className={clsx(
            'text-lg transition-colors duration-300 text-primary font-semibold text-balance',
            {
              'text-primary-active': isOpen,
            },
          )}
        >
          {title}
        </p>
        <motion.span
          animate={{ rotate: isOpen ? 0 : 180 }}
          initial={isOpen ? { rotate: 0 } : { rotate: 180 }}
          transition={{ duration: 0.3 }}
        >
          <ChevronUp className={clsx({ 'rotate-180': isOpen })} />
        </motion.span>
      </button>

      <AnimatePresence>
        <motion.div
          initial={false}
          animate={
            isOpen ? { height: 'auto', opacity: 1 } : { height: 0, opacity: 0 }
          }
          exit={{ height: 0, opacity: 0 }}
          transition={{ duration: 0.3 }}
          className="overflow-hidden"
        >
          <ul className="flex flex-col gap-2 md:gap-4 px-3 md:px-6 py-3 md:py-5">
            {items?.map((item) => (
              <AccordionItem
                key={item.id}
                text={item.title || ''}
                isOpen={isOpen}
              />
            ))}
          </ul>
        </motion.div>
      </AnimatePresence>
    </div>
  );
};

export default React.memo(Accordion);
