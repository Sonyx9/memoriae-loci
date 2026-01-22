# Rychlý start

## 1. Instalace

```bash
npm install
```

## 2. Vývoj

```bash
npm run dev
```

Otevřete http://localhost:4321

## 3. Přidání článku

### Přes admin (po nasazení)
1. Přejděte na `/admin`
2. Heslo: `admin123` (změňte v produkci!)
3. Vytvořte nový článek

### Manuálně
Vytvořte soubor `src/content/articles/muj-clanek.md`:

```markdown
---
title: "Můj článek"
slug: "muj-clanek"
status: published
publishedAt: "2024-01-20"
excerpt: "Krátký popis"
coverImage: "/images/articles/obrazek.jpg"
project: "zapomenuta-mista"
tags: ["historie"]
---

Obsah článku...
```

## 4. Build

```bash
npm run build
```

Výstup v `dist/` - nahrajte na FTP.

## 5. Projekty

Projekty jsou v `src/lib/projects.ts` - upravte podle potřeby.

## Důležité poznámky

- **Heslo adminu:** Změňte v `admin/index.php` před nasazením!
- **Obrázky:** Vložte do `public/images/` nebo `src/images/`
- **Cesty:** PHP admin očekává články v `src/content/articles/`
