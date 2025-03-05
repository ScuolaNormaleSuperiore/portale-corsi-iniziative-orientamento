type UpdateMessageParams = {
	messageId: string;
	content?: string;
	isLoading?: boolean;
	error?: boolean;
};

type UpdateMessageChunkParams = UpdateMessageParams & {
	content: string;
};

export type { UpdateMessageParams, UpdateMessageChunkParams };
