export type RoleType = 'user' | 'assistant';

export interface MessageType {
  id: string;
  content: string;
  role: RoleType;
  date: string;
  isLoading?: boolean;
  error?: boolean;
}
