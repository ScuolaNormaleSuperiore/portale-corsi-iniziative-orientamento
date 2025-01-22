import React from 'react';
import { useAtomValue, useSetAtom } from 'jotai';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import { fetchMessageAtom, isMessageLoadingAtom } from '@atoms/messages';
import Accordion from '@components/Accordion';
import AccordionItem from '@components/AccordionItem';
import clsx from 'clsx';

const Questions: React.FC<{ className?: string }> = ({ className }) => {
  const { faqs } = useAtomValue(rootAttributesAtom);
  const setFetchMessage = useSetAtom(fetchMessageAtom);
  const isMessageLoading = useAtomValue(isMessageLoadingAtom);

  if (!faqs || !faqs?.questions || !faqs?.questions?.length) return null;

  return (
    <div className={clsx('flex flex-col gap-8', className)}>
      {faqs?.title && <h4 className="text-2xl font-semibold">{faqs.title}</h4>}
      <div className="flex flex-col gap-4">
        {faqs?.questions?.map((question, index) => (
          <Accordion
            key={question.id}
            title={question.heading}
            defaultOpen={index === 0}
          >
            {question?.items?.map((item) => (
              <AccordionItem key={item.id}>
                <button
                  className={clsx(
                    'w-full text-left py-2 px-3 transition-shadow duration-300 disabled:opacity-50 disabled:cursor-not-allowed',
                    {
                      'group/button hover:shadow-lg': !isMessageLoading,
                    },
                  )}
                  onClick={() => {
                    if (!isMessageLoading) {
                      setFetchMessage(item.title);
                    }
                  }}
                  disabled={isMessageLoading}
                >
                  <h6 className="text-base duration-300 font-semibold group-hover/button:text-primary-active">
                    <span className="bg-[linear-gradient(transparent_calc(100%_-_1.5px),black_1.5px)] bg-no-repeat bg-[length:0%_100%] duration-300 transition-[background-size] group-hover/button:bg-[length:100%_100%]">
                      {item.title}
                    </span>
                  </h6>
                </button>
              </AccordionItem>
            ))}
          </Accordion>
        ))}
      </div>
    </div>
  );
};

export default React.memo(Questions);
