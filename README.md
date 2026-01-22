# Memoriae Loci - Statický web

Moderní, vizuálně silný web pro neziskovou organizaci Memoriae Loci, zaměřený na prezentaci projektů a příběhů míst.

## Technologie

- **Astro** - statický generátor webu
- **Tailwind CSS** - styling
- **PHP** - jednoduchá administrace článků
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
├── admin/               # PHP administrace
│   ├── index.php        # Login
│   └── articles.php     # Správa článků
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

Výstup bude v adresáři `dist/`, který obsahuje čisté HTML, CSS a JS soubory připravené k nahrání na FTP hosting.

## Nasazení na Forpsi

1. Spusťte build: `npm run build`
2. Nahrajte obsah adresáře `dist/` na FTP server
3. Nahrajte také adresář `admin/` (PHP soubory)
4. Nastavte správná oprávnění pro adresář `src/content/articles/` (PHP admin potřebuje zápis)

### Důležité poznámky

- PHP admin očekává, že články jsou v `src/content/articles/` (relativně k admin složce)
- Změňte výchozí heslo v `admin/index.php`
- Ujistěte se, že PHP má oprávnění k zápisu do adresáře s články

## Přidání článku

### Přes PHP admin

1. Přejděte na `/admin`
2. Přihlaste se
3. Klikněte na "Nový článek"
4. Vyplňte formulář a uložte

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

- `/admin` - Login
- `/admin/articles` - Seznam článků
- `/admin/articles/new` - Nový článek
- `/admin/articles/edit` - Editace článku

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
- ✅ Statický web s jednoduchou PHP administrací
- ✅ Funguje na klasickém FTP hostingu

## Podpora

Pro dotazy nebo problémy kontaktujte správce projektu.
