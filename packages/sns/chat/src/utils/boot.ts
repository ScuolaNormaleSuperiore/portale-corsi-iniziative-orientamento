import {
	Info,
	InfoItem,
	InfoItemList,
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
	// let faqs: Faqs;
	let info: Info;
	let firstAnswer: string;
	let userAvatar: string;
	let pageTitle: string;
	let questionsTitle: string;
	if (isDevelopment) {
		// faqs = developmentRootAttributes.faqs;
		info = developmentRootAttributes.info;
		firstAnswer = developmentRootAttributes.firstAnswer;
		questionsTitle = developmentRootAttributes.questionsTitle;
		userAvatar = developmentRootAttributes.userAvatar;
		pageTitle = developmentRootAttributes.pageTitle;
	} else {
		// faqs = JSON.parse(rootElement?.getAttribute('data-faqs') || '{}');
		info = JSON.parse(rootElement?.getAttribute('data-info') || '{}');
		firstAnswer = rootElement.getAttribute('data-first-answer') || '';
		questionsTitle = rootElement.getAttribute('data-questions-title') || '';
		userAvatar = rootElement.getAttribute('data-user-avatar') || '';
		pageTitle = rootElement.getAttribute('data-page-title') || '';
	}

	if (firstAnswer) {
		pushFirstAssistantAnswer(firstAnswer);
	}

	store.set(rootAttributesAtom, {
		userAvatar,
		info: {
			...info,
			items: info.items?.map((item: InfoItem) => ({
				...item,
				id: uuidv4(),
				list: item.list?.map((list: InfoItemList) => ({
					...list,
					id: uuidv4(),
				})),
			})),
		},
		// faqs: {
		// 	...faqs,
		// 	questions:
		// 		faqs?.questions?.map((questions: Questions) => ({
		// 			...questions,
		// 			id: uuidv4(),
		// 			items:
		// 				questions.items?.map((question: Question) => ({
		// 					...question,
		// 					id: uuidv4(),
		// 				})) || [],
		// 		})) || [],
		// },
		pageTitle,
		firstAnswer,
		questionsTitle,
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
			isFirstMessage: true,
			error: false,
		},
	]);
};

const developmentRootAttributes: RootAttributes = {
	userAvatar: 'https://i.imgur.com/Z6BfEFC.jpeg',
	pageTitle: 'Parla con noi',
	questionsTitle: 'Prova a farmi queste domande...',
	firstAnswer:
		'Benvenute e benvenuti al chatbot informativo dei Corsi di Orientamento della Scuola Normale Superiore! Siamo felici di fornirvi assistenza e informazioni per supportarvi nelle vostre scelte di studio e nel vostro percorso di orientamento. Qui potrete parlare con un sistema automatico progettato per rispondere alle vostre domande in modo rapido e pratico.',
	info: {
		items: [
			{
				bsIcon: 'info-circle',
				title: 'Info utili',
				text: 'Se preferite interagire con un operatore o operatrice o avete esigenze specifiche, vi invitiamo a contattarci direttamente ai seguenti recapiti, durante gli orari di ufficio:',
			},
			{
				bsIcon: 'clock',
				title: 'Orari ufficio',
				list: [
					{
						key: 'Lunedì - Venerdì:',
						value: '09:30 - 12:30',
					},
					{
						key: 'Lunedì, Martedì, Mercoledì, Giovedì:',
						value: '14:30 - 16:30',
					},
				],
			},
			{
				bsIcon: 'ear',
				title: 'Contatti',
				list: [
					{
						key: 'Email:',
						value: 'orientamento@sns.it',
						valueType: 'email',
					},
					{
						key: 'Telefono:',
						value: '+39 050 50 9307 / 9670 / 9057 / 9493',
					},
					{
						key: 'Cellulare:',
						value: '+39 331 6990724 / +39 347 1092201',
					},
				],
				text: 'Siamo a vostra disposizione per qualsiasi ulteriore informazione! Vi auguriamo una piacevole esperienza di consultazione e un buon percorso di orientamento presso la Scuola Normale Superiore.',
			},
		],
	},
	// faqs: {
	// 	title: 'Qualche argomento di cui posso parlarti:',
	// 	questions: [
	// 		{
	// 			heading: 'Domande studenti',
	// 			items: [
	// 				{
	// 					title: 'Cosa sono i corsi di orientamento della Scuola Normale Superiore?',
	// 				},
	// 				{
	// 					title: 'Quali sono gli obiettivi principali dei corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'Quali sono le tematiche principali trattate nei corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'I corsi di orientamento sono incentrati su materie specifiche o sono interdisciplinari?',
	// 				},
	// 				{
	// 					title: 'I corsi di orientamento sono incentrati su materie insegnate alla Normale?',
	// 				},
	// 				{ title: 'Quando si svolgono i corsi di orientamento?' },
	// 				{
	// 					title: 'Quali sono i criteri di selezione ai corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'La Scuola offre vitto e alloggio per chi partecipa ai corsi?',
	// 				},
	// 				{
	// 					title: "Che differenza c’è tra 'Settimane orientamento' e 'Scuola Orientamento'?",
	// 				},
	// 			],
	// 		},
	// 		{
	// 			heading: 'Domande genitori',
	// 			items: [
	// 				{
	// 					title: 'Cosa sono i corsi di orientamento organizzati dalla Scuola Normale Superiore?',
	// 				},
	// 				{
	// 					title: 'Quali sono gli obiettivi principali di questi corsi di orientamento?',
	// 				},
	// 				{ title: 'A chi sono rivolti i corsi di orientamento?' },
	// 				{
	// 					title: 'Quanti studenti partecipano ogni anno ai corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'Quali sono i temi principali trattati durante i corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'Se mio figlio viene scelto, quanto impegno richiedono questi corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'È necessario avere conoscenze o competenze specifiche per partecipare ai corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'Il corso di orientamento è adatto anche a chi viene da piccole scuole o paesi?',
	// 				},
	// 				{
	// 					title: 'Mio figlio non è mai stato fuori casa da solo. Sarebbe seguito e accompagnato durante i corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'Quali sono i criteri di selezione ai corsi di orientamento per gli studenti?',
	// 				},
	// 				{
	// 					title: 'Come si invia la candidatura ai corsi di orientamento e quali documenti sono necessari?',
	// 				},
	// 				{
	// 					title: 'Entro quando bisogna presentare la domanda di iscrizione ai corsi di orientamento?',
	// 				},
	// 				{
	// 					title: 'Posso presentare la domanda ai corsi di orientamento per conto di mio figlio/figlia?',
	// 				},
	// 				{
	// 					title: 'I corsi trattano argomenti specifici delle discipline scientifiche, umanistiche o entrambi?',
	// 				},
	// 				{
	// 					title: 'Chi sono i docenti che tengono le lezioni dei corsi di orientamento? Si tratta di professori della Scuola Normale o di esperti esterni?',
	// 				},
	// 				{
	// 					title: 'Come posso contattare la Scuola Normale per ricevere ulteriori dettagli o chiarimenti sui corsi di orientamento?',
	// 				},
	// 			],
	// 		},
	// 	],
	// },
};
