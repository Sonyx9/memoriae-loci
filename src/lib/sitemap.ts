/**
 * Sitemap data for sitemap.xml, image sitemap and video sitemap.
 *
 * Mapy jsou dynamické: při každém buildu se generují z aktuálního obsahu
 * (články z content collection, projekty z lib/projects, akce z lib/pastEvents).
 * Nový článek, projekt nebo stránka = po dalším buildu (redeploy) jsou v sitemapách.
 * U článků se pro lastmod používá updatedAt (pokud je) nebo publishedAt.
 */
import { getPublishedArticles } from './articles';
import { projects } from './projects';
import { allPastEvents, EVENTS_PER_PAGE } from './pastEvents';

const SITE = 'https://memoriaeloci.cz';

/** Vrací ISO datum (YYYY-MM-DD) pro lastmod; invalidní řetězec vrátí undefined */
function toLastmod(dateStr: string | undefined): string | undefined {
  if (!dateStr) return undefined;
  const d = new Date(dateStr);
  return isNaN(d.getTime()) ? undefined : d.toISOString().slice(0, 10);
}

export interface SitemapUrl {
  loc: string;
  lastmod?: string; // ISO 8601
  changefreq?: 'always' | 'hourly' | 'daily' | 'weekly' | 'monthly' | 'yearly' | 'never';
  priority?: number;
}

export interface ImageEntry {
  loc: string;
  caption?: string;
  title?: string;
}

export interface UrlWithImages {
  loc: string;
  lastmod?: string;
  images: ImageEntry[];
}

export interface VideoEntry {
  loc: string;
  thumbnail: string;
  title: string;
  description?: string;
  duration?: number; // seconds
  publicationDate?: string;
}

export interface UrlWithVideos {
  loc: string;
  lastmod?: string;
  videos: VideoEntry[];
}

/** Statické stránky – při přidání nové stránky do webu ji přidej i sem */
const STATIC_PAGES: SitemapUrl[] = [
  { loc: '', changefreq: 'weekly', priority: 1 },
  { loc: '/magazin', changefreq: 'weekly', priority: 0.9 },
  { loc: '/nase-vize', changefreq: 'monthly', priority: 0.8 },
  { loc: '/o-nas', changefreq: 'monthly', priority: 0.8 },
  { loc: '/podporte-nas', changefreq: 'monthly', priority: 0.8 },
  { loc: '/kontakt', changefreq: 'monthly', priority: 0.7 },
  { loc: '/ve-jmenu-lilie', changefreq: 'monthly', priority: 0.8 },
  { loc: '/zasady-ochrany-osobnich-udaju', changefreq: 'yearly', priority: 0.5 },
  { loc: '/projekty', changefreq: 'weekly', priority: 0.9 },
  { loc: '/probehle-akce', changefreq: 'weekly', priority: 0.7 },
  { loc: '/admin', changefreq: 'monthly', priority: 0.3 },
];

/** Obrázky z /public/images (bez externích URL) – pro image sitemap */
const PUBLIC_IMAGES = [
  '/images/casova-osa-perzekuce-skautu.webp',
  '/images/den-lidskych-prav.webp',
  '/images/denik-tabor-1973.webp',
  '/images/hejnice-1938.webp',
  '/images/kameny-zmizelych.webp',
  '/images/liberec-hero.webp',
  '/images/liberecke-pribehy.webp',
  '/images/logo-footer.png',
  '/images/podporte-nas.webp',
  '/images/qr-platba.jpg',
  '/images/skautsky-vedouci-charlie-archivni-fotografie.webp',
  '/images/ve-jmenu-lilie-hero.webp',
  '/images/zapomenuta-mista.webp',
  '/images/team/radek-motka.jpg',
  '/images/team/lukas-koula.jpg',
  '/images/team/marketa-filla.webp',
  '/images/team/michaela-motka-kanovska.jpg',
];

export async function getAllSitemapUrls(): Promise<SitemapUrl[]> {
  const urls: SitemapUrl[] = [];
  const now = new Date().toISOString().slice(0, 10);

  for (const p of STATIC_PAGES) {
    urls.push({
      ...p,
      loc: p.loc === '' ? SITE + '/' : SITE + p.loc + '/',
      lastmod: now,
    });
  }

  const articles = await getPublishedArticles();
  for (const a of articles) {
    urls.push({
      loc: `${SITE}/magazin/${a.slug}/`,
      lastmod: toLastmod(a.updatedAt) ?? toLastmod(a.publishedAt) ?? now,
      changefreq: 'monthly',
      priority: 0.8,
    });
  }

  for (const project of projects) {
    urls.push({
      loc: project.externalUrl?.startsWith('http')
        ? project.externalUrl
        : `${SITE}${project.externalUrl || `/projekty/${project.slug}/`}`,
      lastmod: now,
      changefreq: 'monthly',
      priority: 0.8,
    });
  }

  const totalPages = Math.max(1, Math.ceil(allPastEvents.length / EVENTS_PER_PAGE));
  for (let page = 1; page <= totalPages; page++) {
    urls.push({
      loc: page === 1 ? `${SITE}/probehle-akce/` : `${SITE}/probehle-akce/${page}/`,
      lastmod: now,
      changefreq: 'weekly',
      priority: 0.6,
    });
  }

  return urls;
}

export async function getUrlsWithImages(): Promise<UrlWithImages[]> {
  const articles = await getPublishedArticles();
  const projectsList = projects;
  const now = new Date().toISOString().slice(0, 10);
  const result: UrlWithImages[] = [];

  const add = (loc: string, images: ImageEntry[], lastmod = now) => {
    if (images.length > 0) result.push({ loc, lastmod, images });
  };

  add(`${SITE}/`, [
    { loc: `${SITE}/images/liberec-hero.webp`, title: 'Liberec 1968' },
    { loc: `${SITE}/images/logo-footer.png`, title: 'Memoriae Loci' },
    { loc: `${SITE}/images/hejnice-1938.webp`, title: 'Hejnice 1938' },
  ]);
  add(`${SITE}/magazin/`, articles.slice(0, 12).map((a) => ({
    loc: a.coverImage.startsWith('http') ? a.coverImage : SITE + a.coverImage,
    title: a.title,
  })));
  add(`${SITE}/projekty/`, projectsList.map((p) => ({
    loc: p.heroImage.startsWith('http') ? p.heroImage : SITE + p.heroImage,
    title: p.heroImageAlt || p.name,
  })));
  add(`${SITE}/ve-jmenu-lilie/`, [
    { loc: `${SITE}/images/skautsky-vedouci-charlie-archivni-fotografie.webp`, title: 'Skautský výcvik' },
    { loc: `${SITE}/images/podporte-nas.webp`, title: 'Podpora' },
  ]);
  add(`${SITE}/podporte-nas/`, [
    { loc: `${SITE}/images/podporte-nas.webp`, title: 'Podpora' },
    { loc: `${SITE}/images/qr-platba.jpg`, title: 'QR platba' },
  ]);
  add(`${SITE}/nase-vize/`, [
    { loc: `${SITE}/images/team/radek-motka.jpg`, title: 'Bc. Radek Moťka' },
    { loc: `${SITE}/images/team/lukas-koula.jpg`, title: 'Mgr. Lukáš Koula' },
    { loc: `${SITE}/images/team/marketa-filla.webp`, title: 'Mgr. Markéta Filla' },
    { loc: `${SITE}/images/team/michaela-motka-kanovska.jpg`, title: 'Ing. Michaela Moťka Kaňovská' },
  ]);

  for (const a of articles) {
    const img = a.coverImage.startsWith('http') ? a.coverImage : SITE + a.coverImage;
    const lastmod = toLastmod(a.updatedAt) ?? toLastmod(a.publishedAt) ?? now;
    add(`${SITE}/magazin/${a.slug}/`, [{ loc: img, title: a.title }], lastmod);
  }

  for (const project of projectsList) {
    if (project.externalUrl?.startsWith('http')) continue;
    const projectLoc = `${SITE}${project.externalUrl || `/projekty/${project.slug}/`}`;
    add(projectLoc, [{
      loc: project.heroImage.startsWith('http') ? project.heroImage : SITE + project.heroImage,
      title: project.heroImageAlt || project.name,
    }]);
  }

  return result;
}

/** Videa – aktuálně žádná na webu; struktura připravena pro budoucí obsah */
export async function getUrlsWithVideos(): Promise<UrlWithVideos[]> {
  const result: UrlWithVideos[] = [];
  return result;
}

export function getStandaloneImageEntries(): ImageEntry[] {
  return PUBLIC_IMAGES.map((path) => ({
    loc: SITE + path,
    title: path.split('/').pop()?.replace(/\.[^.]+$/, '') ?? path,
  }));
}
