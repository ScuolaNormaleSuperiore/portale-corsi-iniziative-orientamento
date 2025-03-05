import React from 'react';
import { useAtomValue } from 'jotai';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import Accordion from '@components/Accordion';
import clsx from 'clsx';

const Questions: React.FC<{ className?: string }> = ({ className }) => {
	const { faqs } = useAtomValue(rootAttributesAtom);

	if (!faqs || !faqs?.questions || !faqs?.questions?.length) return null;

	return (
		<div className={clsx('flex flex-col gap-4 md:gap-8 w-full', className)}>
			{faqs?.title && (
				<h4 className="text-lg md:text-2xl font-semibold">
					{faqs.title}
				</h4>
			)}
			<div className="flex flex-col gap-2 md:gap-4">
				{faqs?.questions?.map((question, index) => (
					<Accordion
						key={question.id}
						title={question.heading}
						items={question?.items || []}
						defaultOpen={index === 0}
					/>
				))}
			</div>
		</div>
	);
};

export default React.memo(Questions);
