import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import glob from 'fast-glob';

// Resolve CSS and JS files
const cssFiles = glob.sync('resources/**/*.css');
const jsFiles = glob.sync('resources/**/*.js');

export default defineConfig({
    plugins: [
        laravel({
            input: [...cssFiles, ...jsFiles], // Include both CSS and JS files
            refresh: true,
        }),
    ],
});