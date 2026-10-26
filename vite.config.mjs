import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'node:path';

export default defineConfig({
	base: './',

	plugins: [
		tailwindcss(),
	],

	build: {
		outDir: resolve(
			process.cwd(),
			'assets/dist'
		),

		emptyOutDir: true,
		sourcemap: false,
		target: 'es2018',

		lib: {
			entry: resolve(
				process.cwd(),
				'assets/scripts/src/main.js'
			),

			name: 'WebsiteNITheme',
			formats: ['iife'],
			fileName: () => 'script.js',
			cssFileName: 'style',
		},
	},
});
