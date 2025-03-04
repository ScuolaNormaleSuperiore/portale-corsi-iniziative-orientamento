import { defineConfig } from '@rsbuild/core';
import { pluginReact } from '@rsbuild/plugin-react';
import { pluginBabel } from '@rsbuild/plugin-babel';

export default defineConfig({
	plugins: [
		pluginReact(),
		pluginBabel({
			include: /\.(?:jsx|tsx)$/,
			babelLoaderOptions(opts) {
				opts.plugins?.unshift('babel-plugin-react-compiler');
			},
		}),
	],
	html: {
		mountId: 'chat',
	},
	output: {
		cleanDistPath: true,
		manifest: process.env.NODE_ENV === 'production',
		minify: process.env.NODE_ENV === 'production',
		target: 'web',
		polyfill: 'entry',
		assetPrefix: '/chat/',
		distPath: {
			root: '../../../public/chat',
		},
	},
	tools: {
		htmlPlugin: process.env.NODE_ENV === 'development',
	},
});
