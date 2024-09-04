import { quasar, transformAssetUrls } from '@quasar/vite-plugin';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import { defineConfig } from 'vite';
 
export default defineConfig({  
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          // Example: create a chunk for vendor libraries
          vendor: ['vue']
        }
      }
    }
  },
  plugins: [
    vue({template: { transformAssetUrls }}),
    quasar(),
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