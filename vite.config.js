import { defineConfig } from 'vite';  // Chỉ giữ import này.
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tsconfigPaths from 'vite-tsconfig-paths';
import { configDefaults } from 'vitest/config';  // Chỉ lấy các config cần.

export default defineConfig({
  plugins: [
    laravel(['resources/js/app.tsx', 'resources/css/app.css']),
    react(),
    tsconfigPaths()
  ],
  build: {
    manifest: true,
    outDir: 'public/build',
  },
  test: {
    exclude: [
      ...configDefaults.exclude,
      '**/node_modules/**',
      '**/fixtures/**',
    ],
  },
});
