import { quasar, transformAssetUrls } from '@quasar/vite-plugin';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import { defineConfig } from 'vite';
 
export default defineConfig({
  plugins: [
    vue({template: { transformAssetUrls }}),
    quasar({
      sassVariables: 'resources/sass/quasar-variables.scss'
    }),
    laravel({
      input: ['resources/js/app.js', 'resources/css/app.css'],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  css: {
    preprocessorOptions: {
      css: {
        additionalData: `
          @import '@fortawesome/fontawesome-free/css/all.css';
        `
      }
    }
  },
});