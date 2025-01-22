import { atom } from 'jotai';
import { RootAttributes } from '../types/rootAttributes';
import { isDevelopment } from '@utils/env';
import { v4 as uuidv4 } from 'uuid';

const productionRootAttributes: RootAttributes = {
  userAvatar: '',
  faqs: {
    title: '',
    questions: [],
  },
  pageTitle: '',
  firstAnswer: '',
};

const developmentRootAttributes: RootAttributes = {
  userAvatar: '',
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

export const rootAttributesAtom = atom<RootAttributes>(
  isDevelopment ? developmentRootAttributes : productionRootAttributes,
);
