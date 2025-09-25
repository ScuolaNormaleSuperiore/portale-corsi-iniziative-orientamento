import React from 'react';
import { useAtomValue } from 'jotai';
import { rootAttributesAtom } from '../atoms/rootAttributes';

const Title = () => {
	const rootAttributes = useAtomValue(rootAttributesAtom);
	return (
		<h2 className="text-3xl md:text-4xl lg:text-5xl font-bold">
			{rootAttributes.pageChatTitle}
		</h2>
	);
};

export default React.memo(Title);
