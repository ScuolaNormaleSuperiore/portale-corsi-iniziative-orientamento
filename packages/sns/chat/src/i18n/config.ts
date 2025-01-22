import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

i18n.use(initReactI18next).init({
  lng: 'it',
  fallbackLng: 'it',
  debug: false,
  interpolation: {
    escapeValue: false,
  },
  resources: {
    it: {
      translation: {
        chat: {
          send: 'Invia',
          inputPlaceholder: 'Scrivi un messaggio',
          errorMessage: 'Ops! Qualcosa è andato storto, riprova!',
        },
        avatar: {
          user: {
            alt: 'avatar utente',
          },
          assistant: {
            alt: 'avatar assistente',
          },
        },
      },
    },
    en: {
      translation: {
        chat: {
          send: 'Send',
          inputPlaceholder: 'Write a message',
          errorMessage: 'Ops! Something went wrong, try again!',
        },
        avatar: {
          user: {
            alt: 'user avatar',
          },
          assistant: {
            alt: 'assistant avatar',
          },
        },
      },
    },
  },
});

export default i18n;
