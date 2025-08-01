import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import compression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
        compression({
            algorithm: 'brotliCompress', // or 'gzip'
            ext: '.br',
            threshold: 1024, // Only compress files above 1KB
            deleteOriginFile: false, // Keep original files
        }),
    ],
    build: {
        minify: 'esbuild', // Fast & modern JS minifier
    },
});
