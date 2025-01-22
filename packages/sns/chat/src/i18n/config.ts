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
      },
    },
    en: {
      translation: {
        chat: {
          send: 'Send',
          inputPlaceholder: 'Write a message',
          errorMessage: 'Ops! Something went wrong, try again!',
        },
      },
    },
  },
});

export default i18n;
