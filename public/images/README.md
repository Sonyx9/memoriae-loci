# Obrázky

## Struktura

```
images/
├── articles/          # Obrázky pro články
│   └── example.jpg
├── projects/          # Obrázky pro projekty
│   ├── zapomenuta-mista.jpg
│   ├── pribehy-mest.jpg
│   └── venkovska-dedictvi.jpg
├── hero.jpg           # Hero obrázek pro homepage
└── cinematic.jpg      # Cinematic mezisekce
```

## Použití

- **Články:** Cesty v článcích by měly být `/images/articles/nazev.jpg`
- **Projekty:** Definovány v `src/lib/projects.ts` jako `heroImage: "/images/projects/..."`

## Formáty

Doporučené formáty:
- **Hero obrázky:** 1920x1080px nebo větší, JPG/WebP
- **Články:** 1200x675px (16:9), JPG/WebP
- **Projekty:** 800x600px (4:3), JPG/WebP

## Optimalizace

Před nahráním optimalizujte obrázky pro web (např. pomocí TinyPNG, ImageOptim).
