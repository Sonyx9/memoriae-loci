import { defineConfig } from 'astro/config';
import tailwind from '@astrojs/tailwind';

export default defineConfig({
  site: 'https://memoriaeloci.cz',
  integrations: [tailwind()],
  output: 'static',
  build: {
    assets: '_assets'
  }
});
