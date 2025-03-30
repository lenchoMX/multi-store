// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purgecss from '@fullhuman/postcss-purgecss';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [
                purgecss({
                    content: [
                        './resources/**/*.blade.php',
                        './resources/**/*.js',
                    ],
                    safelist: ['theme-*', 'swal2-*', 'btn-*'], // Conserva las clases de temas, SweetAlert2 y Bootstrap
                }),
            ],
        },
    },
});