import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            '/css/app.css',
            '/js/app.js',
        ]),
    ],
});
