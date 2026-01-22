# Přidání nového článku

## Struktura souboru

Vytvořte nový Markdown soubor v `src/content/articles/` s názvem ve formátu `slug-clanku.md`.

## Frontmatter (YAML metadata)

### Povinná pole

```yaml
---
title: "Název článku"
date: "2024-01-15"  # nebo publishedAt (obě jsou podporovány)
status: published
excerpt: "Krátký popis článku, který se zobrazí v náhledu."
project: "slug-projektu"  # Volitelné, slug projektu z src/lib/projects.ts
tags: ["tag1", "tag2"]      # Pole tagů
---
```

**Důležité:** `slug` se automaticky generuje z názvu souboru (např. `nazev-clanku.md` → slug: `nazev-clanku`). NEPŘIDÁVEJTE `slug` do frontmatteru!

### Volitelná pole

```yaml
---
# Nový formát cover obrázku (doporučeno)
cover:
  src: "/images/articles/nazev-clanku/cover.jpg"
  alt: "Popis obrázku"

# Starý formát (stále podporován)
coverImage: "/images/articles/nazev-clanku/cover.jpg"

# Popisek pod hero obrázkem
heroCaption: "Liberec, 1952 — paměť místa"

# Galerie obrázků (zobrazí se jako thumbnaily pod hero obrázkem)
gallery:
  - src: "/images/articles/nazev-clanku/1.jpg"
    alt: "Popis prvního obrázku"
  - src: "/images/articles/nazev-clanku/2.jpg"
    alt: "Popis druhého obrázku"
---
```

## Obsah článku

Po frontmatter následuje obsah v Markdown formátu:

```markdown
# Nadpis první úrovně

Text odstavce.

## Nadpis druhé úrovně

Další obsah...

### Nadpis třetí úrovně

- Seznam
- Položek
```

## Příklad kompletního článku

```markdown
---
title: "Politický proces s Libereckými skauty (1952)"
date: "2024-05-10"
status: published
excerpt: "V letech 1951–1952 došlo k zatýkání skautských činovníků v Liberci."
cover:
  src: "/images/articles/skauti-1952/cover.jpg"
  alt: "Liberec v mlze – paměť města"
heroCaption: "Liberec, 1952 — paměť místa"
project: "Kameny zmizelých"
tags: ["Liberec", "Skaut", "50. léta"]
gallery:
  - src: "/images/articles/skauti-1952/1.jpg"
    alt: "Historický snímek Liberce"
  - src: "/images/articles/skauti-1952/2.jpg"
    alt: "Skautské setkání"
---

# Úvod

Obsah článku...
```

## Umístění obrázků

Obrázky umístěte do `public/images/articles/nazev-clanku/`:

```
public/
  images/
    articles/
      nazev-clanku/
        cover.jpg
        1.jpg
        2.jpg
```

## Poznámky

- **Slug**: Automaticky generován z názvu souboru (např. `politicky-proces-liberecke-skauty-1952.md` → URL: `/pribehy/politicky-proces-liberecke-skauty-1952`). **NEPŘIDÁVEJTE `slug` do frontmatteru!**
- **Status**: Použijte `published` pro publikované články, `draft` pro koncepty
- **Datum**: Formát `YYYY-MM-DD`. Můžete použít buď `date` nebo `publishedAt` (obě jsou podporovány)
- **Projekt**: Musí odpovídat `slug` projektu v `src/lib/projects.ts`
- **Galerie**: Obrázky v galerii se zobrazí jako thumbnaily pod hero obrázkem a lze je kliknout pro zobrazení v lightboxu

## Design

Článek se zobrazí v editoriálním layoutu:
- **Desktop**: Split layout - obrázek vlevo (65%), textový panel vpravo (35%)
- **Mobile**: Stack layout - obrázek nahoře, text pod ním
- **Typografie**: Serif font pro nadpisy, vysoký kontrast, hodně prostoru
- **Interakce**: Parallax efekt na desktopu, lightbox pro galerii
