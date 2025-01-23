import ReactDOM from 'react-dom/client';

export const initializeShadowRoot = async (rootEl: HTMLElement) => {
  let shadowRoot = rootEl.shadowRoot;
  if (!shadowRoot) {
    shadowRoot = rootEl.attachShadow({ mode: 'open' });
  }
  if (shadowRoot) {
    let container = shadowRoot.querySelector('div');
    if (!container) {
      container = document.createElement('div');
      shadowRoot.appendChild(container);
    }
    container.style.height = '100%';
    const root = ReactDOM.createRoot(container);
    const styleLinks = document.querySelectorAll('link[data-chat-styles]');
    await Promise.all(
      Array.from(styleLinks).map(async (link) => {
        try {
          const href = link.getAttribute('href');
          const existingStyle = shadowRoot.querySelector(
            `style[data-href="${href}"]`,
          );
          if (!existingStyle && href) {
            const response = await fetch(href);
            const cssText = await response.text();
            const style = document.createElement('style');
            style.textContent = cssText;
            style.setAttribute('data-href', href);
            shadowRoot.appendChild(style);
          }
        } catch (error) {
          console.error('Error loading styles:', error);
        }
      }),
    );
    return root;
  }
};
