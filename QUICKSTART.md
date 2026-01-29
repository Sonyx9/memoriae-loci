# Rychlý start

## 1. Instalace

```bash
npm install
```

## 2. Vývoj

```bash
npm run dev
```

**Web:** http://localhost:4321

**Admin (Decap CMS):** http://localhost:4321/admin/

**Poznámka:** Pro lokální admin použijte `config.local.yml` (test-repo backend bez autentizace). V produkci se použije `config.yml` s Git Gateway.

## 3. Nasazení

### Hybridní řešení (doporučeno)

**GitHub Pages (web) + Railway (admin)**

1. **GitHub Pages:**
   - Push do GitHub
   - Settings → Pages → Source: GitHub Actions
   - Web: `https://YOUR_USERNAME.github.io/YOUR_REPO/`

2. **Railway (admin):**
   - Přihlaste se na [railway.app](https://railway.app)
   - New Project → Deploy from GitHub repo
   - Admin: `https://YOUR_PROJECT.railway.app/admin/`

Více: viz `HYBRID-SETUP.md`

## 4. Přidání článku

### Přes Decap CMS

**Lokálně (testování):**
1. Otevřete: http://localhost:4321/admin/
2. **Žádné přihlášení** - můžete testovat UI (změny se neuloží do Git)

**Produkce (skutečné ukládání):**
1. Otevřete admin na Railway: `https://YOUR_PROJECT.railway.app/admin/`
2. Přihlaste se přes GitHub nebo Netlify
3. Vytvořte nebo upravte článek
4. Web na GitHub Pages se automaticky aktualizuje

**Poznámka:** Decap CMS nepoužívá tradiční heslo - přihlášení je přes GitHub nebo Netlify.

Více informací: viz `ADMIN-LOGIN.md` a `QUICKSTART-DECAP.md`

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

## 5. Build

```bash
npm run build
```

Výstup v `dist/` - automaticky nasazeno přes GitHub Actions a Railway.

## 5. Projekty

Projekty jsou v `src/lib/projects.ts` - upravte podle potřeby.

## Důležité poznámky

- **Web:** GitHub Pages (zdarma)
- **Admin:** Railway (`/admin/` - Decap CMS)
- **Obrázky:** Vložte do `public/images/` - Decap CMS je tam automaticky uloží
- **Články:** Ukládají se do `src/content/articles/` přes Git
- **Workflow:** Editace v adminu → Commit do Git → Automatický build a nasazení
