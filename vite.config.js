import { defineConfig } from 'vite';

export default defineConfig(({ command }) => ({
    base: command === 'serve' ? '' : './',

    build: {
        cssMinify: false,
        outDir: 'dist',
        emptyOutDir: true,
        manifest: true,

        rollupOptions: {
            input: {
                main: 'assets/js/main.js',
            },
        },
    },

    server: {
        host: '127.0.0.1',
        port: 5173,
        strictPort: true,
        cors: true,
        origin: 'http://127.0.0.1:5173',
    },
}));
