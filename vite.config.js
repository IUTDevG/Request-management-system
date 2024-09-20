import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'

// dotenv.config()
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css',
                'resources/css/utils/filepond.css',
                'resources/js/utils/filepond.js',
                'resources/js/alpine.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
});
