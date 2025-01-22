import DOMPurify from 'isomorphic-dompurify';

export function sanitize(message: string): string {
  return DOMPurify?.sanitize(message) || '';
}
