import ReactDOM from 'react-dom/client';
import { Provider } from 'jotai';
import { store } from '@store/store';
import { boot } from '@utils/boot';
import App from './App';
import './i18n/config';

const rootEl = document.getElementById('chat');
if (rootEl) {
  boot({ rootElement: rootEl });
  const root = ReactDOM.createRoot(rootEl);
  root.render(
    <Provider store={store}>
      <App />
    </Provider>,
  );
}
