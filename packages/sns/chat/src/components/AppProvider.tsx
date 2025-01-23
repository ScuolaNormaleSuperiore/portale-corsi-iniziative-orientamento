import { useEffect } from 'react';
import { useMediaQuery } from 'usehooks-ts';
import { useAtomValue, useSetAtom } from 'jotai';
import { isPanelOpenAtom } from '@atoms/layout';

const AppProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const isMobile = useMediaQuery('(max-width: 1024px)');
  const setIsPanelOpen = useSetAtom(isPanelOpenAtom);
  const isPanelOpen = useAtomValue(isPanelOpenAtom);

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
