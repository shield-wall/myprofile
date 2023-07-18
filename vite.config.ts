import { defineConfig } from "vite";

// https://vitejs.dev/config/
export default defineConfig({
	base: "./",
    assetsInclude: ['**/*.md'],
    build: {
        target: 'esnext'
    }
});
