import { atom } from 'jotai';

export const activeElementAtom = atom<HTMLElement | null>(null);

export const activeElementPreventFocusAtom = atom(
	(get) => get(activeElementAtom)?.dataset?.preventFocus === 'true',
);
