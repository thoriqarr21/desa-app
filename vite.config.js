import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/build/', // 👈 penting untuk jalur relatif di Vercel
    build: {
        outDir: 'public/build', // 👈 hasil build akan masuk ke sini
        emptyOutDir: true,
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
