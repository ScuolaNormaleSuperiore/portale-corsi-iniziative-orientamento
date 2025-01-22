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
  environments: {
    development: {
      tools: {
        htmlPlugin: true,
      },
    },
    production: {
      tools: {
        htmlPlugin: false,
      },
    },
  },
});
