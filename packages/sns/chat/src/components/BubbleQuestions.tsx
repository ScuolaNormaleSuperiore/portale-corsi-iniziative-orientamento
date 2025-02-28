import React, { useState, useEffect } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { useSetAtom, useAtomValue } from 'jotai';
import { fetchMessageAtom, isMessageLoadingAtom } from '@atoms/messages';
import { useTranslation } from 'react-i18next';
import { QUESTIONS_API_ENDPOINT } from '@utils/api';
import { Question } from '../types/question';
import { rootAttributesAtom } from '@atoms/rootAttributes';

const variantsContainer = {
	hidden: { opacity: 0, height: 0 },
	visible: { opacity: 1, height: 'auto' },
	exit: { opacity: 0, height: 0 },
};

const variantsQuestion = {
	hidden: { opacity: 0, y: -10 },
	visible: { opacity: 1, y: 0 },
	exit: { opacity: 0, y: 10 },
};

const BubbleQuestions: React.FC = () => {
	const [questions, setQuestions] = useState<Question[]>([]);
	const [isHidden, setIsHidden] = useState(false);
	const setFetchMessage = useSetAtom(fetchMessageAtom);
	const isMessageLoading = useAtomValue(isMessageLoadingAtom);
	const { questionsTitle } = useAtomValue(rootAttributesAtom);
	const { t } = useTranslation();

	useEffect(() => {
		const fetchQuestions = async () => {
			const response = await fetch(QUESTIONS_API_ENDPOINT);
			const data = await response.json();
			if (response.ok && data.questions) {
				setQuestions(data.questions as Question[]);
			}
		};

		if (QUESTIONS_API_ENDPOINT) {
			fetchQuestions();
		}
	}, []);

	if (questions.length === 0) {
		return null;
	}

	return (
		<AnimatePresence>
			{questions.length > 0 && !isHidden ? (
				<motion.div
					initial="hidden"
					animate="visible"
					exit="exit"
					variants={variantsContainer}
					className="flex flex-col gap-3"
				>
					<h3 className="md:text-lg font-semibold mt-2">
						{questionsTitle || t('questions.title')}
					</h3>

					<motion.ul className="list-none flex flex-col gap-3">
						{questions.map((question, index) => (
							<motion.li
								key={question.id}
								initial="hidden"
								animate="visible"
								exit="exit"
								variants={variantsQuestion}
								transition={{ delay: index * 0.1 }}
							>
								<button
									className="px-3 md:px-6 py-1 text-primary font-semibold md:text-lg border border-primary rounded-full hover:bg-primary hover:text-white transition-colors duration-200 hover:shadow-lg bg-white disabled:opacity-50 disabled:cursor-not-allowed"
									onClick={() => {
										setFetchMessage(question.text);
										setIsHidden(true);
									}}
									disabled={isMessageLoading}
								>
									{question.text}
								</button>
							</motion.li>
						))}
					</motion.ul>
				</motion.div>
			) : null}
		</AnimatePresence>
	);
};

export default React.memo(BubbleQuestions);
