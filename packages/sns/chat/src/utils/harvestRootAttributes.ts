import {
  RootAttributes,
  Faqs,
  Questions,
  Question,
} from '../types/rootAttributes';
import { v4 as uuidv4 } from 'uuid';

export const harvestRootAttributes = ({
  rootElement,
}: {
  rootElement: HTMLElement;
}): RootAttributes => {
  const faqs: Faqs = JSON.parse(rootElement?.getAttribute('data-faqs') || '{}');
  return {
    userAvatar: rootElement.getAttribute('data-user-avatar') || '',
    faqs: {
      ...faqs,
      questions:
        faqs?.questions?.map((question: Questions) => ({
          ...question,
          id: uuidv4(),
          items:
            question.items?.map((item: Question) => ({
              ...item,
              id: uuidv4(),
            })) || [],
        })) || [],
    },
    pageTitle: rootElement.getAttribute('data-page-title') || '',
    firstAnswer: rootElement.getAttribute('data-first-answer') || '',
  };
};
