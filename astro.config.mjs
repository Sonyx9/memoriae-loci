import { defineConfig } from 'astro/config';
import tailwind from '@astrojs/tailwind';
import { rehypeRemoveSectionHeadings } from './src/lib/rehype-remove-section-headings.ts';

export default defineConfig({
  site: 'https://memoriaeloci.cz',
  integrations: [tailwind()],
  output: 'static',
  build: {
    assets: '_assets'
  },
  markdown: {
    rehypePlugins: [rehypeRemoveSectionHeadings]
  }
});
