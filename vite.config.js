import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tsconfigPaths from "vite-tsconfig-paths"
import { configDefaults, defineConfig } from "vitest/config"


export default defineConfig({
  plugins: [laravel(['resources/js/app.tsx', 'resources/css/app.css']), react()],
  build: {
    manifest: true,
    outDir: 'public/build',
},
test: {
  exclude: [
    ...configDefaults.exclude,
    "**/node_modules/**",
    "**/fixtures/**",
  ],
},
plugins: [tsconfigPaths()],
});
