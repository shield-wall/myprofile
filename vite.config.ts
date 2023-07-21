import { resolve } from "path";
import { defineConfig } from "vite";

// https://vitejs.dev/config/
export default defineConfig({
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
    }
});
