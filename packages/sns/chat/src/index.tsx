import ReactDOM from 'react-dom/client';
import { Provider } from 'jotai';
import { store } from '@store/store';
import { boot } from '@utils/boot';
import { isProduction } from '@utils/env';
import { initializeShadowRoot } from '@utils/shadow';
import App from './App';
import './i18n/config';

const initializeApp = async () => {
  const rootEl = document.getElementById('chat');

  if (!rootEl) return;

  const root = isProduction
    ? await initializeShadowRoot(rootEl)
    : ReactDOM.createRoot(rootEl);

  if (!root) return;

  boot({ rootElement: rootEl });

  root.render(
    <Provider store={store}>
      <App />
    </Provider>,
  );
};

initializeApp().catch(console.error);
