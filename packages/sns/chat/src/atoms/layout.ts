import { atom } from 'jotai';

export const isLeftColumnCollapsedAtom = atom<boolean>(false);
export const isPanelOpenAtom = atom<boolean>(false);

export const toggleLeftColumnAtom = atom(null, (get, set) => {
  set(isLeftColumnCollapsedAtom, !get(isLeftColumnCollapsedAtom));
});

export const togglePanelAtom = atom(null, (get, set) => {
  set(isPanelOpenAtom, !get(isPanelOpenAtom));
});
