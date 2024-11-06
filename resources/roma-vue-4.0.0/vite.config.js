import { fileURLToPath, URL } from 'node:url';

import { defineConfig, loadEnv } from 'vite';
import vue from '@vitejs/plugin-vue';

// https://vitejs.dev/config/
export default defineConfig(({ command }) => {
    let mode = command=='build'?'production':'dev';
    const env = loadEnv(mode, process.cwd(), '')
    console.log('command',command);
    console.log('env',env);
    return {
        plugins: [vue()],
        base: command === 'serve' ? '' : '/roma-vue/',
        resolve: {
            alias: {
                '@': fileURLToPath(new URL('./src', import.meta.url))
            },
            dedupe: [
                'vue'
            ]
        },
        server : {
            host: env.APP_HOST,
            hot:true,
        	port : 8001,
            watch: {
                usePolling: true
            },
            proxy: {
                "/api": {
                    target: env.APP_TARGET,
                    changeOrigin: true,
                    secure: false,
                    ws : true,
                    rewrite: (path) => {
                        path = path.replace(/^\/api/, "api");
                        console.log('path ', path);
                        return path;
                    },
                },
                "/admin" : {
                    target: 'http://localhost:7777',
                    changeOrigin: true,
                    secure: false,
                    ws: true,
                    rewrite: (path) => {
                        path = path.replace(/^\/admin/, "");
                        console.log('path ', path);
                        return path;
                    },
                    configure: (proxy, _options) => {
                        proxy.on('error', (err, _req, _res) => {
                            console.log('proxy error');
                        });
                        proxy.on('proxyReq', (proxyReq, req, _res) => {
                            console.log('Sending Request to the Target:');
                        });
                        proxy.on('proxyRes', (proxyRes, req, _res) => {
                            console.log('Received Response from the Target:');
                        });
                    },
                }
            },
        },
        rollupOptions: {
            output: {
                globals: {
                    jquery: 'window.jQuery',
                }
            }
        }
    };
});
