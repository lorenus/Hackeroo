import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        cors: true, // Habilita CORS
        host: 'localhost', // Usa localhost en lugar de [::1]
        port: 5173, // Puerto del servidor de desarrollo
      },
    plugins: [
        laravel({
            input: [
                'resources/css/style.css', 
                'resources/js/animaciones.js'],
            refresh: true,
        }),
    ],
});
