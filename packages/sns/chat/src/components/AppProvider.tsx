import { useEffect } from 'react';
import { useMediaQuery } from 'usehooks-ts';
import { useAtomValue, useSetAtom } from 'jotai';
import { isPanelOpenAtom } from '@atoms/layout';
import { useIsMounted } from 'usehooks-ts';
import { delay } from '@utils/stuff';

const AppProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const isMobile = useMediaQuery('(max-width: 1024px)');
  const setIsPanelOpen = useSetAtom(isPanelOpenAtom);
  const isPanelOpen = useAtomValue(isPanelOpenAtom);
  const isMounted = useIsMounted();

  useEffect(() => {
    void delay(1500).then(() => {
      if (isMounted()) window.dispatchEvent(new Event('sns-chat-is-loaded'));
    });
  }, [isMounted]);

  useEffect(() => {
    if (!isMobile && isPanelOpen) {
      setIsPanelOpen(false);
    }
    if (isPanelOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'auto';
    }
  }, [isMobile, isPanelOpen, setIsPanelOpen]);

  return <>{children}</>;
};

export default AppProvider;
