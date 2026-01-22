# Struktura projektu Memoriae Loci

## Přehled

Statický/polostatický web pro neziskovou organizaci Memoriae Loci s jednoduchou PHP administrací pro články.

## Adresářová struktura

```
MemoriaeLoci/
├── admin/                      # PHP administrace
│   ├── index.php              # Login stránka
│   ├── auth.php               # Autentizace helper
│   ├── articles.php           # Seznam článků
│   └── articles/
│       ├── new.php            # Nový článek
│       └── edit.php          # Editace článku
│
├── public/                     # Statické soubory
│   ├── images/                # Obrázky (články, projekty)
│   └── favicon.svg            # Favicon
│
├── src/
│   ├── components/            # Astro komponenty
│   │   ├── Navigation.astro
│   │   └── Footer.astro
│   │
│   ├── content/               # Content collections
│   │   ├── config.ts          # Schema pro články
│   │   └── articles/          # Markdown články
│   │       └── *.md
│   │
│   ├── layouts/               # Layout komponenty
│   │   └── BaseLayout.astro
│   │
│   ├── lib/                   # Utility funkce
│   │   ├── articles.ts        # Načítání článků
│   │   ├── projects.ts        # Definice projektů
│   │   ├── types.ts           # TypeScript typy
│   │   └── utils.ts           # Pomocné funkce
│   │
│   └── pages/                 # Stránky webu
│       ├── index.astro        # Homepage
│       ├── o-nas.astro        # O nás
│       ├── podporte-nas.astro  # Podpořte nás
│       ├── kontakt.astro      # Kontakt
│       ├── pribehy/
│       │   ├── index.astro    # Výpis článků
│       │   └── [slug].astro   # Detail článku
│       └── projekty/
│           ├── index.astro    # Přehled projektů
│           └── [slug].astro   # Detail projektu
│
├── dist/                       # Build výstup (generováno)
│
├── astro.config.mjs           # Astro konfigurace
├── tailwind.config.mjs        # Tailwind konfigurace
├── tsconfig.json              # TypeScript konfigurace
├── package.json               # NPM závislosti
├── README.md                   # Hlavní dokumentace
├── QUICKSTART.md              # Rychlý start
├── DEPLOYMENT.md              # Návod na nasazení
└── STRUCTURE.md               # Tento soubor
```

## URL struktura

### Veřejné stránky
- `/` - Homepage
- `/pribehy` - Výpis článků (s filtrováním)
- `/pribehy/[slug]` - Detail článku
- `/projekty` - Přehled projektů
- `/projekty/[slug]` - Detail projektu
- `/o-nas` - O nás
- `/podporte-nas` - Podpořte nás
- `/kontakt` - Kontakt

### Administrace
- `/admin` - Login
- `/admin/articles` - Seznam článků
- `/admin/articles/new` - Nový článek
- `/admin/articles/edit?file=...` - Editace článku

## Datový model

### Article (Markdown + YAML frontmatter)
```yaml
---
title: "Název článku"
slug: "slug-clanku"
status: published | draft
publishedAt: "2024-01-15"
excerpt: "Krátký popis"
coverImage: "/images/articles/obrazek.jpg"
project: "zapomenuta-mista"
tags: ["historie", "dokumentace"]
---
```

### Project (staticky v `src/lib/projects.ts`)
```typescript
{
  slug: string;
  name: string;
  description: string;
  heroImage: string;
  longDescription?: string;
}
```

## Technologie

- **Astro** - statický generátor
- **Tailwind CSS** - styling
- **TypeScript** - typování
- **PHP** - administrace článků
- **Markdown** - obsah článků

## Build proces

1. `npm run build` - generuje statické HTML/CSS/JS do `dist/`
2. Upload `dist/` na FTP
3. Upload `admin/` na FTP
4. Upload `src/content/articles/` na FTP (nebo upravit cesty v PHP)

## Důležité poznámky

- PHP admin očekává články v `src/content/articles/` (relativně k admin složce)
- Změňte výchozí heslo v `admin/index.php` před nasazením
- Obrázky vložte do `public/images/`
- Projekty jsou definovány staticky v `src/lib/projects.ts`
