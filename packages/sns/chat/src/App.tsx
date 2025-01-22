import { useState } from 'react';
import { motion } from 'framer-motion';
import { isDevelopment } from '@utils/env';
import Messages from '@components/Messages';
import Scroller from '@components/Scroller';
import Input from '@components/Input';
import Send from '@components/Send';
import Title from '@components/Title';
import Questions from '@components/Questions';
import './App.css';
import clsx from 'clsx';

const App = () => {
  const [isLeftColumnCollapsed, setIsLeftColumnCollapsed] = useState(false);
  return (
    <>
      {isDevelopment && (
        <>
          <div className="w-full h-12 bg-primary-darker" />
          <div className="w-full h-44 bg-white" />
        </>
      )}
      <section className="w-full h-full text-black flex flex-col border-t border-subtle">
        <div
          className={clsx(
            'grid auto-cols-[1fr] lg:grid-cols-[33%_1fr] grid-rows-[1fr] gap-[0px_0px]',
            {
              'lg:grid-cols-[50px_1fr]': isLeftColumnCollapsed,
            },
          )}
        >
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
                justifyContent: isLeftColumnCollapsed ? 'center' : 'flex-start',
                transition: { duration: 0.3 },
              }}
            >
              <button
                onClick={() => setIsLeftColumnCollapsed(!isLeftColumnCollapsed)}
                className="w-6 h-6 self-end hover:drop-shadow-lg"
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
              {!isLeftColumnCollapsed && <Questions />}
            </motion.div>
          </div>
          <div className={clsx('flex flex-col')}>
            <div className="flex flex-col gap-6 flex-grow">
              <div className="px-6 pt-5 md:px-12 md:pt-10">
                <Title />
              </div>
              <div className="flex flex-col px-6 md:px-12 min-h-96 overflow-y-auto">
                <Messages />
                <Scroller />
              </div>
            </div>
            <div className="px-6 py-3 md:px-12 md:py-6 bg-primary-lighter sticky bottom-0">
              <div className="flex items-center relative border border-gray rounded overflow-hidden">
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

export default App;
