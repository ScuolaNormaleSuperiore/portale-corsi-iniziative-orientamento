import { activeElementAtom } from "@atoms/activeElement";
import { isProduction } from "@utils/env";
import { useAtom } from "jotai";
import { useEffect } from "react";

export const useShadowRootActiveElement = (shadowRoot: ShadowRoot | null) => {
  const [_, setActiveElement] = useAtom(activeElementAtom);

  useEffect(() => {
    if (!isProduction || !shadowRoot) return;

    // Set initial active element if present
    // ShadowRoot.activeElement is available on DocumentOrShadowRoot
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    const initialActive = (shadowRoot as any).activeElement as HTMLElement | null;
    if (initialActive) setActiveElement(initialActive);

    const handleFocusIn = (event: Event) => {
      setActiveElement(event.target as HTMLElement);
    };

    shadowRoot.addEventListener('focusin', handleFocusIn);

    return () => {
      shadowRoot.removeEventListener('focusin', handleFocusIn);
    };
  }, [shadowRoot, setActiveElement]);

  return;
};