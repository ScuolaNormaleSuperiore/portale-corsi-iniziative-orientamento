import { defineConfig } from '@rsbuild/core';
import { pluginReact } from '@rsbuild/plugin-react';

// const { publicVars } = loadEnv();
// const isDev = publicVars.MODE === 'development';

export default defineConfig({
  plugins: [pluginReact()],
  tools: {
    htmlPlugin: true,
  },
  html: {
    mountId: 'chat',
  },
  output: {
    cleanDistPath: true,
    manifest: true,
    target: 'web',
    assetPrefix: '/chat/',
    distPath: {
      root: '../../../public/chat',
    },
  },
});
