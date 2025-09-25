import { bsIcon } from '@components/icons/bootstrap/icons';

export type RootAttributes = {
	userAvatar: string;
	faqs: Faqs;
	info: Info;
	pageChatTitle: string;
	firstAnswer: string;
	questionsTitle: string;
};

export type Faqs = {
	title?: string;
	questions?: Questions[];
};

export type Questions = {
	id?: string;
	heading: string;
	items?: Question[];
};

export type Question = {
	id?: string;
	title?: string;
};

export type Info = {
	items?: InfoItem[];
};

export type InfoItem = {
	id?: string;
	bsIcon?: bsIcon;
	title?: string;
	list?: InfoItemList[];
	text?: string;
};

export type InfoItemList = {
	id?: string;
	key?: string;
	value?: string;
	valueType?: 'phone' | 'email';
};
