import React from 'react';
import clsx from 'clsx';
import { sanitize } from '@utils/sanitizer';
import { useAtomValue, useSetAtom } from 'jotai';
import { isMessageLoadingAtom, fetchMessageAtom } from '@atoms/messages';
import { isPanelOpenAtom } from '@atoms/layout';
const AccordionItem: React.FC<{ text: string; isOpen: boolean }> = ({
  text,
  isOpen = false,
}) => {
  const isMessageLoading = useAtomValue(isMessageLoadingAtom);
  const setFetchMessage = useSetAtom(fetchMessageAtom);
  const setIsPanelOpen = useSetAtom(isPanelOpenAtom);

  if (!text) return null;

  return (
    <li className="w-full bg-white rounded border border-subtle">
      <button
        className={clsx(
          'w-full text-left py-1 md:py-2 px-3 md:px-4 transition-shadow duration-300 disabled:opacity-50 disabled:cursor-not-allowed',
          {
            'group/button hover:shadow-lg': !isMessageLoading,
          },
        )}
        onClick={() => {
          if (!isMessageLoading && text) {
            setFetchMessage(sanitize(text));
            setIsPanelOpen(false);
          }
        }}
        disabled={isMessageLoading}
        tabIndex={isOpen ? 0 : -1}
        aria-expanded={isOpen}
        aria-label={text}
      >
        <h6 className="text-base duration-300 font-semibold group-hover/button:text-primary-active">
          <span className="bg-[linear-gradient(transparent_calc(100%_-_1.5px),black_1.5px)] bg-no-repeat bg-[length:0%_100%] duration-300 transition-[background-size] group-hover/button:bg-[length:100%_100%]">
            {text}
          </span>
        </h6>
      </button>
    </li>
  );
};

export default React.memo(AccordionItem);
