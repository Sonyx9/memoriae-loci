import type { CollectionEntry } from 'astro:content';

export interface Article {
  id: string;
  title: string;
  slug: string;
  date: string;
  publishedAt: string;
  status: 'draft' | 'published';
  excerpt: string;
  content: string;
  cover?: { src: string; alt: string };
  coverImage?: string;
  heroCaption?: string;
  gallery?: Array<{ src: string; alt: string }>;
  project?: string;
  tags: string[];
  author?: string;
  sources?: string[];
  entry?: CollectionEntry<'articles'>;
}

export interface Project {
  slug: string;
  name: string;
  description: string;
  heroImage: string;
  heroImageAlt?: string;
  heroImageTitle?: string;
  heroImageDescription?: string;
  longDescription?: string;
  externalUrl?: string;
  subtitle?: string;
}
