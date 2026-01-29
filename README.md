# Memoriae Loci - Statický web

Moderní, vizuálně silný web pro neziskovou organizaci Memoriae Loci, zaměřený na prezentaci projektů a příběhů míst.

## Technologie

- **Astro** - statický generátor webu
- **Tailwind CSS** - styling
- **Decap CMS** - Git-based administrace článků
- **Markdown** - obsah článků

## Struktura projektu

```
MemoriaeLoci/
├── src/
│   ├── components/       # Komponenty (Navigation, Footer)
│   ├── content/
│   │   └── articles/    # Markdown články
│   ├── layouts/         # Layout komponenty
│   ├── lib/             # Utility funkce
│   └── pages/           # Stránky webu
├── public/
│   └── admin/           # Decap CMS administrace
│       ├── index.html   # Admin rozhraní
│       └── config.yml   # CMS konfigurace
└── dist/                # Build výstup (generováno)
```

## Instalace

1. Nainstalujte závislosti:
```bash
npm install
```

2. Spusťte vývojový server:
```bash
npm run dev
```

3. Web bude dostupný na `http://localhost:4321`

## Build pro produkci

```bash
npm run build
```

Výstup bude v adresáři `dist/`, který obsahuje čisté HTML, CSS a JS soubory připravené k nasazení na GitHub Pages nebo FTP hosting.

## Nasazení

### Hybridní řešení (doporučeno) ⭐

**GitHub Pages (hlavní web) + Railway (administrace)**

1. **GitHub Pages:**
   - Push do GitHub repozitáře
   - Settings → Pages → Source: GitHub Actions
   - Hotovo! Web je na GitHub Pages

2. **Railway (admin):**
   - Přihlaste se na [railway.app](https://railway.app)
   - New Project → Deploy from GitHub repo
   - Vyberte repozitář
   - Hotovo! Admin je na Railway

**Výhody:**
- ✅ Web zdarma na GitHub Pages
- ✅ Admin na Railway (možnost vlastní domény)
- ✅ Oddělené nasazení

Více informací: viz `HYBRID-SETUP.md`

### Klasický hosting (FTP)

1. Spusťte build: `npm run build`
2. Nahrajte obsah adresáře `dist/` na FTP server
3. Pro administraci použijte Decap CMS přes GitHub (Git-based workflow)

## Přidání článku

### Přes Decap CMS (doporučeno)

1. Po nasazení otevřete `/admin/`
2. Přihlaste se přes GitHub
3. Vytvořte nebo upravte článek
4. Web se automaticky přebuildí a nasadí

### Manuálně

Vytvořte nový `.md` soubor v `src/content/articles/` s následující strukturou:

```markdown
---
title: "Název článku"
slug: "slug-clanku"
status: published
publishedAt: "2024-01-15"
excerpt: "Krátký popis článku"
coverImage: "/images/articles/obrazek.jpg"
project: "zapomenuta-mista"
tags: ["tag1", "tag2"]
---

Obsah článku v Markdown formátu...
```

## Struktura stránek

- `/` - Homepage
- `/pribehy` - Výpis článků
- `/pribehy/[slug]` - Detail článku
- `/projekty` - Přehled projektů
- `/projekty/[slug]` - Detail projektu
- `/o-nas` - O nás
- `/podporte-nas` - Podpořte nás
- `/kontakt` - Kontakt

## Administrace

- **Admin URL:** `https://YOUR_PROJECT.railway.app/admin/` (Railway)
- **Decap CMS** - Git-based administrace
- Přihlášení přes GitHub
- Automatický build a nasazení po každé změně
- Změny se automaticky projeví na hlavním webu (GitHub Pages)

## Projekty

Projekty jsou definovány staticky v `src/lib/projects.ts`. Pro přidání nového projektu upravte tento soubor.

## Design

Web používá tmavý design s oranžovými akcenty:
- Pozadí: `slate-950` / `slate-900`
- Text: `slate-50` / `slate-200`
- Akcent: `orange-500` (accent)

## Omezení

- ❌ Žádné AI aplikace, chaty, externí API
- ❌ Žádný komplexní backend
- ✅ Statický web s Git-based administrací (Decap CMS)
- ✅ Funguje na GitHub Pages nebo klasickém FTP hostingu

## Podpora

Pro dotazy nebo problémy kontaktujte správce projektu.
