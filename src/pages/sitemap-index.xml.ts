/**
 * Sitemap index – odkazuje na sitemap.xml, sitemap-images.xml;
 * sitemap-videos.xml se přidá jen pokud existují videa (prázdný video sitemap je u Google neplatný).
 */
import { getUrlsWithVideos } from '../lib/sitemap';

export const prerender = true;

export async function GET() {
  const site = 'https://memoriaeloci.cz';
  const now = new Date().toISOString().slice(0, 10);
  const hasVideos = (await getUrlsWithVideos()).length > 0;

  const videoSitemapEntry = hasVideos
    ? `  <sitemap>
    <loc>${site}/sitemap-videos.xml</loc>
    <lastmod>${now}</lastmod>
  </sitemap>
`
    : '';

  const xml = `<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>${site}/sitemap.xml</loc>
    <lastmod>${now}</lastmod>
  </sitemap>
  <sitemap>
    <loc>${site}/sitemap-images.xml</loc>
    <lastmod>${now}</lastmod>
  </sitemap>
${videoSitemapEntry}</sitemapindex>`;

  return new Response(xml, {
    headers: {
      'Content-Type': 'application/xml; charset=utf-8',
      'Cache-Control': 'public, max-age=3600',
    },
  });
}
