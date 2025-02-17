export const CHAT_API_ENDPOINT = import.meta.env.PUBLIC_CHAT_API_ENDPOINT || '';
export const API_USERNAME = import.meta.env.PUBLIC_API_USERNAME || '';
export const API_PASSWORD = import.meta.env.PUBLIC_API_PASSWORD || '';
export const API_BASIC_AUTH = `Basic ${Buffer.from(`${API_USERNAME}:${API_PASSWORD}`).toString('base64')}`;
