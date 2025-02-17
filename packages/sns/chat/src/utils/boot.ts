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
        faqs?.questions?.map((questions: Questions) => ({
          ...questions,
          id: uuidv4(),
          items:
            questions.items?.map((question: Question) => ({
              ...question,
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
    'Ciao! Sono qui per aiutarti a rispondere alle tue domande sulla Scuola Normale Superiore di Pisa. Scrivi pure la tua domanda e proverò a darti tutte le informazioni di cui hai bisogno!',
  faqs: {
    title: 'Qualche argomento di cui posso parlarti:',
    questions: [
      {
        heading: 'Domande studenti',
        items: [
          {
            title:
              'Cosa sono i corsi di orientamento della Scuola Normale Superiore?',
          },
          {
            title:
              'Quali sono gli obiettivi principali dei corsi di orientamento?',
          },
          {
            title:
              'Quali sono le tematiche principali trattate nei corsi di orientamento?',
          },
          {
            title:
              'I corsi di orientamento sono incentrati su materie specifiche o sono interdisciplinari?',
          },
          {
            title:
              'I corsi di orientamento sono incentrati su materie insegnate alla Normale?',
          },
          { title: 'Quando si svolgono i corsi di orientamento?' },
          {
            title:
              'Quali sono i criteri di selezione ai corsi di orientamento?',
          },
          {
            title:
              'La Scuola offre vitto e alloggio per chi partecipa ai corsi?',
          },
          {
            title:
              "Che differenza c’è tra 'Settimane orientamento' e 'Scuola Orientamento'?",
          },
        ],
      },
      {
        heading: 'Domande genitori',
        items: [
          {
            title:
              'Cosa sono i corsi di orientamento organizzati dalla Scuola Normale Superiore?',
          },
          {
            title:
              'Quali sono gli obiettivi principali di questi corsi di orientamento?',
          },
          { title: 'A chi sono rivolti i corsi di orientamento?' },
          {
            title:
              'Quanti studenti partecipano ogni anno ai corsi di orientamento?',
          },
          {
            title:
              'Quali sono i temi principali trattati durante i corsi di orientamento?',
          },
          {
            title:
              'Se mio figlio viene scelto, quanto impegno richiedono questi corsi di orientamento?',
          },
          {
            title:
              'È necessario avere conoscenze o competenze specifiche per partecipare ai corsi di orientamento?',
          },
          {
            title:
              'Il corso di orientamento è adatto anche a chi viene da piccole scuole o paesi?',
          },
          {
            title:
              'Mio figlio non è mai stato fuori casa da solo. Sarebbe seguito e accompagnato durante i corsi di orientamento?',
          },
          {
            title:
              'Quali sono i criteri di selezione ai corsi di orientamento per gli studenti?',
          },
          {
            title:
              'Come si invia la candidatura ai corsi di orientamento e quali documenti sono necessari?',
          },
          {
            title:
              'Entro quando bisogna presentare la domanda di iscrizione ai corsi di orientamento?',
          },
          {
            title:
              'Posso presentare la domanda ai corsi di orientamento per conto di mio figlio/figlia?',
          },
          {
            title:
              'I corsi trattano argomenti specifici delle discipline scientifiche, umanistiche o entrambi?',
          },
          {
            title:
              'Chi sono i docenti che tengono le lezioni dei corsi di orientamento? Si tratta di professori della Scuola Normale o di esperti esterni?',
          },
          {
            title:
              'Come posso contattare la Scuola Normale per ricevere ulteriori dettagli o chiarimenti sui corsi di orientamento?',
          },
        ],
      },
    ],
  },
};
