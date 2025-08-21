import { AnimatePresence, motion } from 'framer-motion';
import { useTranslation } from 'react-i18next';
import React, { useEffect, useRef } from 'react';
import Info from '@components/Info';

const Panel: React.FC<{
  isOpen: boolean;
  onClose: () => void;
}> = ({ isOpen, onClose }) => {
  const { t } = useTranslation();
  const panelRef = useRef<HTMLDialogElement>(null);
  const focusIndexRef = useRef<number>(0);

  // Focus trap implementation
  useEffect(() => {
    if (!isOpen) return;

    const modalElement = panelRef.current;
    if (!modalElement) return;

    // Get all focusable elements within the modal
    const getFocusableElements = () => {
      return modalElement.querySelectorAll(
        'button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"]):not([disabled])',
      ) as NodeListOf<HTMLElement>;
    };

    // Focus the first focusable element
    const focusableElements = getFocusableElements();
    if (focusableElements.length > 0) {
      focusIndexRef.current = Math.min(focusIndexRef.current, focusableElements.length - 1);
      focusableElements[focusIndexRef.current].focus();
    }

    const handleKeyDown = (event: KeyboardEvent) => {
      // Handle Escape key
      if (event.key === 'Escape') {
        event.preventDefault();
        onClose();
        return;
      }

      // Handle Tab key for focus trapping
      if (event.key === 'Tab') {
        event.preventDefault();
        const currentFocusableElements = getFocusableElements();
        if (currentFocusableElements.length === 0) return;

        const nextIndex = event.shiftKey
          ? (focusIndexRef.current - 1 + currentFocusableElements.length) % currentFocusableElements.length
          : (focusIndexRef.current + 1) % currentFocusableElements.length;

        currentFocusableElements[nextIndex].focus();
        focusIndexRef.current = nextIndex;
      }
    };

    // Keep index in sync when user focuses via mouse or programmatically
    const handleFocusIn = (event: Event) => {
      const currentFocusableElements = getFocusableElements();
      const target = event.target as HTMLElement | null;
      if (!target) return;
      const idx = Array.from(currentFocusableElements).findIndex((el) => el === target);
      if (idx !== -1) {
        focusIndexRef.current = idx;
      }
    };

    // Attach event listeners on the modal element
    modalElement.addEventListener('keydown', handleKeyDown);
    modalElement.addEventListener('focusin', handleFocusIn);

    // Cleanup function
    return () => {
      modalElement.removeEventListener('keydown', handleKeyDown);
      modalElement.removeEventListener('focusin', handleFocusIn);
    };
  }, [isOpen, onClose]);

  return (
    <AnimatePresence mode="wait">
      {isOpen && (
        <motion.dialog
          initial={{ opacity: 0, x: -300 }}
          ref={panelRef}
          animate={{ opacity: 1, x: 0 }}
          exit={{ opacity: 0, x: -300 }}
          transition={{ duration: 0.3 }}
          className="bg-primary-lighter flex flex-col p-4 pt-14 fixed top-0 left-0 w-full h-full z-50 overflow-y-auto overflow-x-hidden"
          id="chat-contacts-sidebar-mobile"
        >
          <button
            onClick={onClose}
            type="button"
            aria-label={isOpen ? t('sidebar.mobile.info.close') : t('sidebar.mobile.info.open')}
            className="absolute top-4 right-4 flex items-center gap-2"
          >
            <span className="text-md uppercase font-semibold text-primary">
              {isOpen ? t('sidebar.mobile.info.close') : t('sidebar.mobile.info.open')}
            </span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              viewBox="0 0 16 16"
              className="text-primary w-6 h-6"
            >
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
          </button>
          <Info />
        </motion.dialog>
      )}
    </AnimatePresence>
  );
};

export default React.memo(Panel);
