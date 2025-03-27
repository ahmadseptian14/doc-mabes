import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        proxy: {
            '/sanctum/csrf-cookie': {
                target: 'http://127.0.0.1:8000',
                changeOrigin: true,
                secure: false,
                credentials: 'include',
            },
        },
    }
});
