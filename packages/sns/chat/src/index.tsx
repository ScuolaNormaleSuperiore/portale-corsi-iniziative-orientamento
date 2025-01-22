import ReactDOM from 'react-dom/client';
import { Provider } from 'jotai';
import { store } from '@store/store';
import { rootAttributesAtom } from '@atoms/rootAttributes';
import { harvestRootAttributes } from '@utils/harvestRootAttributes';
import { isDevelopment } from '@utils/env';
import App from './App';
import './i18n/config';

const rootEl = document.getElementById('chat');
if (rootEl) {
  // let shadowRoot = rootEl.shadowRoot;
  // if (!shadowRoot) {
  //   shadowRoot = rootEl.attachShadow({ mode: 'open' });
  // }
  // if (shadowRoot) {
  //   // Check if container already exists
  //   let container = shadowRoot.querySelector('div');
  //   if (!container) {
  //     container = document.createElement('div');
  //     shadowRoot.appendChild(container);
  //   }
  //   const root = ReactDOM.createRoot(container);
  //   const styleLinks = document.querySelectorAll('link[data-chat-styles]');
  //   styleLinks.forEach(async (link) => {
  //     try {
  //       // Check if style already exists
  //       const existingStyle = shadowRoot.querySelector(`style[data-href="${link.getAttribute('href')}"]`);
  //       if (!existingStyle) {
  //         const response = await fetch(link.getAttribute('href') || '');
  //         const cssText = await response.text();
  //         const style = document.createElement('style');
  //         style.textContent = cssText;
  //         style.setAttribute('data-href', link.getAttribute('href') || '');
  //         shadowRoot.appendChild(style);
  //       }
  //     } catch (error) {
  //       console.error('Error loading styles:', error);
  //     }
  //   });
  //   if (!isDevelopment) {
  //     store.set(
  //       rootAttributesAtom,
  //       harvestRootAttributes({ rootElement: rootEl }),
  //     );
  //   }
  //   root.render(
  //     <Provider store={store}>
  //       <App />
  //     </Provider>,
  //   );
  // }

  if (!isDevelopment) {
    store.set(
      rootAttributesAtom,
      harvestRootAttributes({ rootElement: rootEl }),
    );
  }

  const root = ReactDOM.createRoot(rootEl);
  root.render(
    <Provider store={store}>
      <App />
    </Provider>,
  );
}
