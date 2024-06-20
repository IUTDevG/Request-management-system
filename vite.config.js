import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import dotenv from 'dotenv'

dotenv.config()
export default defineConfig({
    process:{
        env:true
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/utils/filepond.css',
                'resources/js/utils/filepond.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: process.env.VITE_URL
    },
});
