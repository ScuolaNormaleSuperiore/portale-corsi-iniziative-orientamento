import { useRef } from 'react';

export const useScrollToBottom = <T extends HTMLElement = HTMLDivElement>() => {
  const elementRef = useRef<T>(null);
  const scrollToBottom = () => {
    elementRef.current?.scrollIntoView({ behavior: 'smooth' });
  };
  return { elementRef, scrollToBottom };
};
