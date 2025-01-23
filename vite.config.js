import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/js/registration.js',
                'resources/js/login.js',
                'resources/js/footer.js',
                'resources/js/user.js',
                'resources/js/admin.js',
                'resources/js/owner.js',
                'resources/js/consumer.js',
            ],
            refresh: true,
        }),
    ],
});
