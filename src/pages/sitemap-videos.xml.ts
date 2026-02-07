/**
 * Sitemap videí – připraveno pro budoucí video obsah (aktuálně prázdný validní urlset)
 */
import { getUrlsWithVideos } from '../lib/sitemap';

export const prerender = true;

export async function GET() {
  const urlEntries = await getUrlsWithVideos();

  const urlElements = urlEntries
    .map(
      (entry) => `  <url>
    <loc>${entry.loc}</loc>${entry.lastmod ? `\n    <lastmod>${entry.lastmod}</lastmod>` : ''}
    <video:video>
      <video:thumbnail_loc>${entry.videos[0]?.thumbnail ?? ''}</video:thumbnail_loc>
      <video:title>${entry.videos[0]?.title ?? ''}</video:title>${entry.videos[0]?.description ? `\n      <video:description>${entry.videos[0].description}</video:description>` : ''}${entry.videos[0]?.duration != null ? `\n      <video:duration>${entry.videos[0].duration}</video:duration>` : ''}${entry.videos[0]?.publicationDate ? `\n      <video:publication_date>${entry.videos[0].publicationDate}</video:publication_date>` : ''}
    </video:video>
  </url>`
    )
    .join('\n');

  const xml = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
${urlElements || '  <!-- Žádná videa – struktura připravena pro budoucí obsah -->\n'}
</urlset>`;

  return new Response(xml, {
    headers: {
      'Content-Type': 'application/xml; charset=utf-8',
      'Cache-Control': 'public, max-age=3600',
    },
  });
}
