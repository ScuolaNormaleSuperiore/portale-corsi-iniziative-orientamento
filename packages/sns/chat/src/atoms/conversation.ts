import { atom } from 'jotai';
import { v4 as uuidv4 } from 'uuid';

export const conversationIdAtom = atom<string>(uuidv4());
