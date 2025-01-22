import { atom } from 'jotai';
import { RootAttributes } from '../types/rootAttributes';

export const rootAttributesAtom = atom<RootAttributes>({
  userAvatar: '',
  faqs: {
    title: '',
    questions: [],
  },
  pageTitle: '',
  firstAnswer: '',
});
