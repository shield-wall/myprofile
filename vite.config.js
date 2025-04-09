import { resolve } from "path";
import { defineConfig } from "vite";
import dns from 'node:dns'
import basicSsl from '@vitejs/plugin-basic-ssl'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [basicSsl({
      /** name of certification */
      name: 'test',
      /** custom trust domains */
      domains: ['*.custom.com'],
      /** custom certification directory */
      certDir: '/app/.devServer/cert',
  })],
	base: "./",
    assetsInclude: ['**/*.md'],
    build: {
        target: 'esnext',
        rollupOptions: {
            input: {
              main: resolve(__dirname, 'resume-default.html'),
              user_card: resolve(__dirname, 'user-card-default.html'),
            },
          },
    },
    server: {
        host: true,
        port: 8000,
        watch: {
            usePolling: true
        }
    }
});
