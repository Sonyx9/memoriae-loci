import { defineCollection, z } from 'astro:content';

const articlesCollection = defineCollection({
  type: 'content',
  schema: z.object({
    title: z.string(),
    // slug is automatically generated from filename by Astro - do not include in schema
    date: z.string().optional(), // ISO date string
    publishedAt: z.string().optional(), // Alias for date, kept for backward compatibility
    status: z.enum(['draft', 'published']).default('draft'),
    excerpt: z.string(),
    cover: z.object({
      src: z.string(),
      alt: z.string(),
    }).optional(),
    coverImage: z.string().optional(), // Kept for backward compatibility
    heroCaption: z.string().optional(),
    gallery: z.array(z.object({
      src: z.string(),
      alt: z.string(),
    })).optional(),
    project: z.string().optional(),
    tags: z.array(z.string()).default([]),
    author: z.string().optional(),
    sources: z.array(z.string()).default([]),
  }),
});

export const collections = {
  articles: articlesCollection,
};
