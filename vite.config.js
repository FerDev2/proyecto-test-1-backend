import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'build', // <- mantiene la salida en public/build
        }),
        tailwindcss(),
    ],
    build: {
        outDir: 'public/build', // <- importante
        emptyOutDir: true
    }
});
