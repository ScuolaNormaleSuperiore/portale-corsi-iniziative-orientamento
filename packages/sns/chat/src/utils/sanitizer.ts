import DOMPurify from 'isomorphic-dompurify';

export function sanitize(message: string): string {
	return DOMPurify?.sanitize(message, { ALLOWED_TAGS: ['#text'] }) || '';
}

export function sanitizeFormattedMessage(message: string): string {
	return (
		DOMPurify?.sanitize(message, {
			ALLOWED_TAGS: [
				'p',
				'br',
				'b',
				'i',
				'u',
				's',
				'a',
				'code',
				'pre',
				'ul',
				'ol',
				'li',
				'blockquote',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'strong',
			],
			FORBID_TAGS: ['style', 'script'],
			FORBID_ATTR: ['style', 'script'],
		}) || ''
	);
}
