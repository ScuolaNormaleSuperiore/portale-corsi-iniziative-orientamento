import React, { FC } from 'react';
import { motion } from 'framer-motion';
import { isDevelopment } from '@utils/env';
import { useAtomValue, useSetAtom } from 'jotai';
import {
	isLeftColumnCollapsedAtom,
	isPanelOpenAtom,
	toggleLeftColumnAtom,
	togglePanelAtom,
} from '@atoms/layout';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import Panel from '@components/Panel';
import ButtonToggleColumn from '@components/ButtonToggleColumn';
import MessagesContainer from '@components/MessagesContainer';
import Input from '@components/Input';
import Send from '@components/Send';
import Title from '@components/Title';
import Info from '@components/Info';
import clsx from 'clsx';
import './App.css';

const DevHeader: FC = () => (
	<>
		<div className="w-full h-12 bg-primary-darker" />
		<div className="w-full h-20 lg:h-44 bg-white" />
	</>
);

const DevFooter: FC = () => (
	<>
		<div className="w-full h-[28.125rem] bg-primary" />
		<div className="w-full h-20 bg-primary-darker" />
	</>
);

const LeftColumn: FC<{ isCollapsed: boolean; onToggle: () => void }> = ({
	isCollapsed,
	onToggle,
}) => (
	<div
		className={clsx(
			'bg-primary-lighter border-r border-subtle hidden overflow-y-auto lg:flex flex-col py-8 scrollbar-thin scrollbar-thumb-primary scrollbar-track-primary-lighter',
			{
				'px-6': !isCollapsed,
			},
		)}
		id="chat-contacts-sidebar"
	>
		<motion.div
			className="flex flex-col gap-6 w-full"
			animate={{
				alignItems: isCollapsed ? 'center' : 'flex-start',
				flexDirection: isCollapsed ? 'row' : 'column',
				justifyContent: isCollapsed ? 'center' : 'flex-start',
				transition: { duration: 0.3 },
			}}
		>
			<ButtonToggleColumn
				className="hidden lg:flex self-end"
				handler={onToggle}
			/>
			{!isCollapsed && <Info />}
		</motion.div>
	</div>
);

const ChatArea: FC<{
	hasInfo: boolean;
	isPanelOpen: boolean;
	togglePanel: () => void;
}> = ({ hasInfo, isPanelOpen, togglePanel }) => (
	<div className="flex flex-col relative">
		<div className="flex flex-col gap-3 lg:gap-6 container mx-auto max-w-screen-xl flex-grow">
			<div className="px-3 pt-5 md:px-12 md:pt-10 gap-4 flex flex-col">
				{hasInfo && (
					<>
						<ButtonToggleColumn
							className="lg:hidden self-start"
							handler={togglePanel}
						/>
						<Panel isOpen={isPanelOpen} onClose={togglePanel} />
					</>
				)}
				<Title />
			</div>
			<MessagesContainer />
		</div>
		<div className="px-3 py-3 md:px-12 md:py-6 bg-primary-lighter sticky bottom-0">
			<div className="flex relative items-center container mx-auto max-w-screen-xl">
				<Input />
				<Send />
			</div>
		</div>
	</div>
);

const App: FC = () => {
	const rootAttributes = useAtomValue(rootAttributesAtom);
	const isLeftColumnCollapsed = useAtomValue(isLeftColumnCollapsedAtom);
	const isPanelOpen = useAtomValue(isPanelOpenAtom);
	const toggleLeftColumn = useSetAtom(toggleLeftColumnAtom);
	const togglePanel = useSetAtom(togglePanelAtom);

	const hasInfo =
		(rootAttributes?.info?.items && rootAttributes.info.items.length > 0) ||
		false;

	return (
		<>
			{isDevelopment && <DevHeader />}
			<section className="w-full h-[100%_+_1px] text-black flex flex-col border-t border-b border-subtle">
				<div
					className={clsx('w-full h-full', {
						'lg:grid-cols-[50px_1fr]':
							isLeftColumnCollapsed && hasInfo,
						'grid auto-cols-[1fr] lg:grid-cols-[30%_1fr] grid-rows-[1fr]':
							hasInfo,
					})}
				>
					{hasInfo && (
						<LeftColumn
							isCollapsed={isLeftColumnCollapsed}
							onToggle={toggleLeftColumn}
						/>
					)}
					<ChatArea
						hasInfo={hasInfo}
						isPanelOpen={isPanelOpen}
						togglePanel={togglePanel}
					/>
				</div>
			</section>
			{isDevelopment && <DevFooter />}
		</>
	);
};

export default React.memo(App);
