import { atom } from 'jotai';

export const activeElementAtom = atom<HTMLElement | null>(null);