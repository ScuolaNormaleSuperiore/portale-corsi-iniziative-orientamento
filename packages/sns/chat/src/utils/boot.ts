import {
  Faqs,
  Questions,
  Question,
  RootAttributes,
} from '../types/rootAttributes';
import { v4 as uuidv4 } from 'uuid';
import { store } from '@store/store';
import { messagesAtom } from '@atoms/messages';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import { isDevelopment } from '@utils/env';

export const boot = ({
  rootElement,
}: {
  rootElement: HTMLElement;
}) => {
  let faqs: Faqs;
  let firstAnswer: string;
  let userAvatar: string;
  let pageTitle: string;

  if (isDevelopment) {
    faqs = developmentRootAttributes.faqs;
    firstAnswer = developmentRootAttributes.firstAnswer;
    userAvatar = developmentRootAttributes.userAvatar;
    pageTitle = developmentRootAttributes.pageTitle;
  } else {
    faqs = JSON.parse(rootElement?.getAttribute('data-faqs') || '{}');
    firstAnswer = rootElement.getAttribute('data-first-answer') || '';
    userAvatar = rootElement.getAttribute('data-user-avatar') || '';
    pageTitle = rootElement.getAttribute('data-page-title') || '';
  }

  if (firstAnswer) {
    pushFirstAssistantAnswer(firstAnswer);
  }

  store.set(rootAttributesAtom, {
    userAvatar,
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
    pageTitle,
    firstAnswer,
  });
};

const pushFirstAssistantAnswer = (firstAnswer: string) => {
  store.set(messagesAtom, [
    {
      role: 'assistant',
      content: firstAnswer,
      id: uuidv4(),
      date: new Date().toISOString(),
      isLoading: false,
      error: false,
    },
  ]);
};

const developmentRootAttributes: RootAttributes = {
  userAvatar: 'https://i.imgur.com/Z6BfEFC.jpeg',
  pageTitle: 'Parla con noi',
  firstAnswer:
    'Ciao! Sono qui per aiutarti con tutte le tue domande sui Corsi di orientamento della Scuola Normale Superiore. Scrivi qui la tua domanda o, se preferisci, contattaci:<br><ul><li>Telefono: <a href="tel:+39050509111">+39 050509111</a></li><li>Email: <a href="mailto:orientamento@sns.it">orientamento@sns.it</a></li></ul>',
  faqs: {
    title: 'Qualche argomento di cui posso parlarti:',
    questions: [
      {
        id: uuidv4(),
        heading: 'Domande per i genitori',
        items: [
          {
            id: uuidv4(),
            title:
              'Cosa sono i corsi di orientamento della Scuola Normale Superiore?',
          },
          {
            id: uuidv4(),
            title:
              'Quali sono gli obiettivi principali dei corsi di orientamento?',
          },
          {
            id: uuidv4(),
            title:
              'I corsi di orientamento sono incentrati su materie specifiche o sono interdisciplinari?',
          },
          {
            id: uuidv4(),
            title:
              'I corsi di orientamento sono incentrati su materie insegnate alla Normale?',
          },
          {
            id: uuidv4(),
            title: 'Quando si svolgono i corsi di orientamento?',
          },
        ],
      },
      {
        id: uuidv4(),
        heading: 'Domande per gli studenti',
        items: [
          {
            id: uuidv4(),
            title:
              'Cosa sono i corsi di orientamento della Scuola Normale Superiore?',
          },
          {
            id: uuidv4(),
            title:
              'Quali sono gli obiettivi principali dei corsi di orientamento?',
          },
          {
            id: uuidv4(),
            title:
              'Quali sono le tematiche principali trattate nei corsi di orientamento?',
          },
          {
            id: uuidv4(),
            title:
              'I corsi di orientamento sono incentrati su materie specifiche o sono interdisciplinari?',
          },
          {
            id: uuidv4(),
            title:
              'I corsi di orientamento sono incentrati su materie insegnate alla Normale?',
          },
          {
            id: uuidv4(),
            title: 'Quando si svolgono i corsi di orientamento?',
          },
        ],
      },
    ],
  },
};
