import { Question } from './rootAttributes';

export interface AccordionProps {
	title: string;
	items: Question[];
	defaultOpen?: boolean;
}
