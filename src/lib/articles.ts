import type { Article } from './types';
import { getCollection } from 'astro:content';
import type { CollectionEntry } from 'astro:content';
import { toHttps } from './utils';

export async function getArticles(): Promise<Article[]> {
  const entries = await getCollection('articles');
  return entries.map(entry => ({
    id: entry.data.id || entry.id,
    title: entry.data.title,
    slug: entry.id.replace(/\.md$/, ''), // Astro automatically generates slug from filename (remove .md extension)
    date: entry.data.date || entry.data.publishedAt || '',
    publishedAt: entry.data.publishedAt || entry.data.date || '',
    status: entry.data.status,
    excerpt: entry.data.excerpt,
    content: entry.body, // Raw markdown - will be rendered in template
    cover: entry.data.cover ? { src: toHttps(entry.data.cover.src), alt: entry.data.cover.alt } : undefined,
    coverImage: (() => {
      const coverImg = (entry.data.coverImage && entry.data.coverImage.trim()) || entry.data.cover?.src;
      // Ignore non-existent files and placeholder.svg, use hero image as fallback
      if (!coverImg || coverImg === '/images/placeholder.svg' || coverImg === '/images/liberec.png' || coverImg === '/images/articles/example.jpg') {
        return '/images/liberec-hero.webp';
      }
      return toHttps(coverImg);
    })(),
    heroCaption: entry.data.heroCaption,
    gallery: entry.data.gallery?.map((g) => ({ src: toHttps(g.src), alt: g.alt })) ?? undefined,
    project: entry.data.project,
    tags: entry.data.tags,
    author: entry.data.author,
    sources: entry.data.sources || [],
    entry: entry, // Keep entry for rendering
  })).sort((a, b) => {
    const dateA = a.date || a.publishedAt;
    const dateB = b.date || b.publishedAt;
    return new Date(dateB).getTime() - new Date(dateA).getTime();
  });
}

export async function getArticleEntry(slug: string): Promise<CollectionEntry<'articles'> | null> {
  const entries = await getCollection('articles');
  return entries.find(e => e.id === slug) || null;
}

export async function getPublishedArticles(): Promise<Article[]> {
  const articles = await getArticles();
  return articles.filter(a => a.status === 'published');
}

export async function getArticleBySlug(slug: string): Promise<Article | null> {
  const articles = await getArticles();
  return articles.find(a => a.slug === slug) || null;
}

export async function getArticlesByProject(projectSlug: string): Promise<Article[]> {
  const articles = await getPublishedArticles();
  return articles.filter(a => a.project === projectSlug);
}

export async function getRelatedArticles(article: Article | any, limit: number = 3): Promise<Article[]> {
  const articles = await getPublishedArticles();
  const articleTags = article.tags || [];
  const articleProject = article.project;
  return articles
    .filter(a => a.id !== article.id && (
      (articleProject && a.project === articleProject) || 
      articleTags.some((t: string) => a.tags?.includes(t))
    ))
    .slice(0, limit);
}
