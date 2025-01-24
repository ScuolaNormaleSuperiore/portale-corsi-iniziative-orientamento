import { Converter } from 'showdown';
const converter = new Converter({
  tables: true,
  strikethrough: true,
  tasklists: true,
  emoji: true,
  smoothLivePreview: true,
});
export function formatMessage(message: string): string {
  return converter.makeHtml(message);
}
