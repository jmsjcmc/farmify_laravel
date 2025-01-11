import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/js/registration.js',
                'resources/js/login.js',
                'resources/js/footer.js'],
            refresh: true,
        }),
    ],
});
