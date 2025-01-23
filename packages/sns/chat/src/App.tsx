import React from 'react';
import { motion } from 'framer-motion';
import { isDevelopment } from '@utils/env';
import { useAtomValue } from 'jotai';
import { isLeftColumnCollapsedAtom } from '@atoms/layout';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import ButtonToggleColumn from '@components/ButtonToggleColumn';
import Messages from '@components/Messages';
import Input from '@components/Input';
import Send from '@components/Send';
import Title from '@components/Title';
import Questions from '@components/Questions';
import clsx from 'clsx';
import './App.css';

const App = () => {
  const isLeftColumnCollapsed = useAtomValue(isLeftColumnCollapsedAtom);
  const rootAttributes = useAtomValue(rootAttributesAtom);

  return (
    <>
      {isDevelopment && (
        <>
          <div className="w-full h-12 bg-primary-darker" />
          <div className="w-full h-20 lg:h-44 bg-white" />
        </>
      )}
      <section className="w-full h-full text-black flex flex-col border-t border-subtle">
        <div
          className={clsx('w-full', {
            'lg:grid-cols-[50px_1fr]':
              isLeftColumnCollapsed &&
              rootAttributes?.faqs?.questions &&
              rootAttributes.faqs.questions.length > 0,
            'grid auto-cols-[1fr] lg:grid-cols-[30%_1fr] grid-rows-[1fr]':
              rootAttributes?.faqs?.questions &&
              rootAttributes.faqs.questions.length > 0,
          })}
        >
          {rootAttributes?.faqs?.questions &&
            rootAttributes.faqs.questions.length > 0 && (
              <div
                className={clsx(
                  'bg-primary-lighter border-r border-subtle hidden lg:flex flex-col py-8',
                  {
                    'px-6': !isLeftColumnCollapsed,
                  },
                )}
              >
                <motion.div
                  className="flex flex-col gap-6 w-full"
                  animate={{
                    alignItems: isLeftColumnCollapsed ? 'center' : 'flex-start',
                    flexDirection: isLeftColumnCollapsed ? 'row' : 'column',
                    justifyContent: isLeftColumnCollapsed
                      ? 'center'
                      : 'flex-start',
                    transition: { duration: 0.3 },
                  }}
                >
                  <ButtonToggleColumn className="hidden lg:flex self-end" />
                  {!isLeftColumnCollapsed && <Questions />}
                </motion.div>
              </div>
            )}
          <div className="flex flex-col">
            <div className="flex flex-col gap-3 lg:gap-6 container mx-auto max-w-screen-xl flex-grow">
              <div className="px-6 pt-5 md:px-12 md:pt-10 gap-2 flex flex-col">
                <ButtonToggleColumn className="lg:hidden" />
                <Title />
              </div>
              <div className="flex flex-col px-6 md:px-12 w-full h-[525px] min-h-96 pb-2 lg:pb-4 flex-grow">
                <Messages />
              </div>
            </div>
            <div className="px-6 py-3 md:px-12 md:py-6 bg-primary-lighter sticky bottom-0">
              <div className="flex relative items-center border border-gray rounded overflow-hidden container mx-auto max-w-screen-xl">
                <Input />
                <Send />
              </div>
            </div>
          </div>
        </div>
      </section>
      {isDevelopment && (
        <>
          <div className="w-full h-[28.125rem] bg-primary" />
          <div className="w-full h-20 bg-primary-darker" />
        </>
      )}
    </>
  );
};

export default React.memo(App);
