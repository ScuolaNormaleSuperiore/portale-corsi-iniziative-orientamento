import ReactDOM from 'react-dom/client';

interface ShadowRootOptions {
	mode?: 'open' | 'closed';
	styleSelector?: string;
	containerStyles?: Partial<CSSStyleDeclaration>;
	containerId?: string;
	delegatesFocus?: boolean;
}

const defaultOptions: ShadowRootOptions = {
	mode: 'open',
	styleSelector: 'link[data-chat-styles]',
	// containerStyles: { height: '100%' },
	containerId: 'react-shadow-container',
	delegatesFocus: false,
};

/**
 * Inizializza uno shadow root per l'elemento specificato e prepara un container React
 * @param rootEl - L'elemento HTML su cui creare lo shadow root
 * @param options - Opzioni di configurazione
 * @returns Promise che restituisce un ReactDOM.Root o null in caso di errore
 */
export const initializeShadowRoot = async (
	rootEl: HTMLElement,
	options: Partial<ShadowRootOptions> = {},
): Promise<ReactDOM.Root | null> => {
	try {
		// Unisci le opzioni di default con quelle fornite dall'utente
		const mergedOptions = { ...defaultOptions, ...options };

		// Ottieni o crea lo shadow root
		let shadowRoot = rootEl.shadowRoot;
		if (!shadowRoot) {
			shadowRoot = rootEl.attachShadow({
				mode: mergedOptions.mode as 'open' | 'closed',
				delegatesFocus: mergedOptions.delegatesFocus,
			});
		}

		// Crea o recupera il container
		const containerId =
			mergedOptions.containerId || 'react-shadow-container';
		let container = shadowRoot.getElementById(containerId);
		if (!container) {
			container = document.createElement('div');
			container.id = containerId;
			shadowRoot.appendChild(container);
		}

		// Applica gli stili al container
		if (mergedOptions.containerStyles) {
			Object.assign(container.style, mergedOptions.containerStyles);
		}

		// Crea il root React
		const root = ReactDOM.createRoot(container);

		// Carica gli stili se specificato
		if (mergedOptions.styleSelector) {
			await loadStyles(shadowRoot, mergedOptions.styleSelector);
		}

		return root;
	} catch (error) {
		console.error("Errore nell'inizializzazione dello shadow root:", error);
		return null;
	}
};

/**
 * Carica gli stili dal documento principale nello shadow root
 */
const loadStyles = async (
	shadowRoot: ShadowRoot,
	styleSelector: string,
): Promise<void> => {
	const styleLinks = document.querySelectorAll(styleSelector);

	await Promise.all(
		Array.from(styleLinks).map(async (link) => {
			try {
				const href = link.getAttribute('href');
				if (!href) return;

				// Verifica se lo stile è già caricato
				const existingStyle = shadowRoot.querySelector(
					`style[data-href="${href}"]`,
				);
				if (existingStyle) return;

				// Effettua il fetch e carica lo stile
				const response = await fetch(href);
				if (!response.ok) {
					throw new Error(
						`Impossibile caricare lo stile: ${href}, stato: ${response.status}`,
					);
				}

				const cssText = await response.text();
				const style = document.createElement('style');
				style.textContent = cssText;
				style.setAttribute('data-href', href);
				shadowRoot.appendChild(style);
			} catch (error) {
				console.error(
					`Errore nel caricamento dello stile da ${link.getAttribute('href')}:`,
					error,
				);
			}
		}),
	);
};

/**
 * Ricarica gli stili nello shadow root
 */
export const reloadShadowRootStyles = async (
	rootEl: HTMLElement,
	options: Partial<ShadowRootOptions> = {},
): Promise<void> => {
	try {
		const shadowRoot = rootEl.shadowRoot;
		if (!shadowRoot) return;

		const mergedOptions = { ...defaultOptions, ...options };

		// Rimuovi gli stili esistenti
		shadowRoot.querySelectorAll('style[data-href]').forEach((style) => {
			style.remove();
		});

		// Ricarica gli stili
		if (mergedOptions.styleSelector) {
			await loadStyles(shadowRoot, mergedOptions.styleSelector);
		}
	} catch (error) {
		console.error(
			'Errore nel ricaricare gli stili dello shadow root:',
			error,
		);
	}
};
