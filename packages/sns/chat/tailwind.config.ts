import type { Config } from 'tailwindcss';
import defaultTheme from 'tailwindcss/defaultTheme';

export default {
	content: ['./src/**/*.{js,ts,jsx,tsx}'],
	theme: {
		extend: {
			colors: {
				primary: '#005a73',
				'primary-hover': '#13667e',
				'primary-active': '#002D3A',
				'primary-darker': '#094859',
				'primary-lighter': '#EFF8FA',
				subtle: '#C5C7C9',
				black: '#191919',
				gray: '#5C6F82',
				'secondary-lighter': '#D9DADB',
			},
			fontFamily: {
				sans: ['Titillium Web', ...defaultTheme.fontFamily.sans],
			},
		},
	},
	plugins: [],
} satisfies Config;
