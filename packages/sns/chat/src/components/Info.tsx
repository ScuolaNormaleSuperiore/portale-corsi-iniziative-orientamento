import { FC } from 'react';
import { useAtomValue } from 'jotai';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import clsx from 'clsx';

const Info: FC = () => {
	const { info } = useAtomValue(rootAttributesAtom);

	if (!info || !info?.items || !info?.items?.length) return null;

	return (
		<div className="flex flex-col gap-6">
			{info?.items?.map((item, index) => (
				<div key={item.id} className="flex flex-col gap-6">
					<div
						className={clsx(
							'flex items-center gap-2 text-primary font-semibold',
							{
								'text-2xl': index === 0,
								'text-xl': index !== 0,
							},
						)}
					>
						<i className={`bi bi-${item.bsIcon}`} />
						{index === 0 ? (
							<h4>{item.title}</h4>
						) : (
							<h5>{item.title}</h5>
						)}
					</div>

					{item?.list && item?.list?.length > 0 && (
						<ul className="flex flex-col gap-2">
							{item.list.map((listItem) => (
								<li
									key={listItem.id}
									className="flex flex-wrap gap-x-2"
								>
									<strong>{listItem.key}</strong>
									{listItem.valueType === 'phone' && (
										<a
											className="text-primary underline"
											href={`tel:${listItem.value}`}
											target="_blank"
											rel="noopener noreferrer"
										>
											{listItem.value}
										</a>
									)}
									{listItem.valueType === 'email' && (
										<a
											className="text-primary underline"
											href={`mailto:${listItem.value}`}
											target="_blank"
											rel="noopener noreferrer"
										>
											{listItem.value}
										</a>
									)}
									{!listItem.valueType && (
										<span>{listItem.value}</span>
									)}
								</li>
							))}
						</ul>
					)}

					{item?.text && item?.text?.length > 0 && <p>{item.text}</p>}
				</div>
			))}
		</div>
	);
};

export default Info;
