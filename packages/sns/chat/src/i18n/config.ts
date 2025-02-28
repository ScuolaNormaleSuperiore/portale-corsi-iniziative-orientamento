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
				},
				message: {
					error: 'Mi dispiace, sembra che ci sia stato un problema. Prova a ricaricare la pagina o riprova più tardi.',
				},
				avatar: {
					user: {
						alt: 'avatar utente',
					},
					assistant: {
						alt: 'avatar assistente',
					},
				},
				questions: {
					title: 'Prova a farmi queste domande...',
				},
				sidebar: {
					mobile: {
						faq: {
							open: 'Apri FAQ',
							close: 'Chiudi FAQ',
						},
						info: {
							open: 'Apri Info',
							close: 'Chiudi Info',
						},
					},
				},
			},
		},
		en: {
			translation: {
				chat: {
					send: 'Send',
					inputPlaceholder: 'Write a message',
				},
				message: {
					error: "I'm sorry, it seems there was an issue. Please try reloading the page or try again later.",
				},
				avatar: {
					user: {
						alt: 'user avatar',
					},
					assistant: {
						alt: 'assistant avatar',
					},
				},
				questions: {
					title: 'Try asking me these questions...',
				},
				sidebar: {
					mobile: {
						faq: {
							open: 'Open FAQ',
							close: 'Close FAQ',
						},
						info: {
							open: 'Open Info',
							close: 'Close Info',
						},
					},
				},
			},
		},
	},
});

export default i18n;
