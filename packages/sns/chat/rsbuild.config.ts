import { defineConfig } from '@rsbuild/core';
import { pluginReact } from '@rsbuild/plugin-react';

export default defineConfig({
  plugins: [pluginReact()],
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
  tools: {
    htmlPlugin: process.env.NODE_ENV === 'development',
  }
});
