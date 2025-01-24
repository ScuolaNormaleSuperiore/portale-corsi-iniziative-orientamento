import React from 'react';
import { useAtomValue } from 'jotai';
import { rootAttributesAtom } from '../atoms/rootAttributes';

const Title = () => {
  const rootAttributes = useAtomValue(rootAttributesAtom);
  return (
    <h1 className="text-3xl md:text-4xl lg:text-5xl font-bold">
      {rootAttributes.pageTitle}
    </h1>
  );
};

export default React.memo(Title);
