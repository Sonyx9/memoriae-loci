# Alternativní CMS řešení pro Astro

Váš současný PHP admin má problémy s routingem. Zde jsou lepší hotová řešení:

## 🎯 Doporučená řešení

### 1. **Decap CMS (dříve Netlify CMS)** ⭐ NEJLEPŠÍ VOLBA
- ✅ **Zdarma a open-source**
- ✅ **Git-based** - články se ukládají přímo do Git repozitáře
- ✅ **Bez serveru** - funguje jako statický soubor
- ✅ **WYSIWYG editor** s preview
- ✅ **Media management** pro obrázky
- ✅ **Funguje s klasickým hostingem** (stačí Git)

**Instalace:**
```bash
npm install decap-cms
```

**Výhody:**
- Články se ukládají do `src/content/articles/` přes Git
- Po commit do Git se automaticky spustí build
- Žádný PHP server potřebný
- Bezpečné - autentizace přes Git provider (GitHub, GitLab)

**Nevýhody:**
- Vyžaduje Git workflow
- Potřebujete Git hosting (GitHub, GitLab, Bitbucket)

---

### 2. **Tina CMS** ⭐ MODERNÍ ŘEŠENÍ
- ✅ **Visual editor** přímo na webu
- ✅ **Type-safe** - používá vaše Astro schema
- ✅ **Git-based** nebo cloud
- ✅ **Bezplatná verze** dostupná

**Instalace:**
```bash
npm install tinacms
```

**Výhody:**
- Editace přímo na webu (in-context editing)
- Automaticky používá vaše TypeScript typy
- Moderní UI

**Nevýhody:**
- Složitější setup
- Pro cloud verzi potřebujete Tina Cloud účet

---

### 3. **Keystatic** ⭐ OFICIÁLNÍ ASTRO CMS
- ✅ **Vyvinuto Astro týmem**
- ✅ **Git-based**
- ✅ **Strukturovaný obsah** podle vašeho schema
- ✅ **Open-source**

**Instalace:**
```bash
npm install @keystatic/core @keystatic/astro
```

**Výhody:**
- Oficiální podpora Astro
- Perfektní integrace s Astro Content Collections
- Type-safe

**Nevýhody:**
- Novější, méně dokumentace
- Vyžaduje React

---

### 4. **Forestry CMS** (nyní Tina)
- ⚠️ **Přesunuto na Tina CMS** - viz výše

---

### 5. **Headless CMS (Contentful, Strapi, Sanity)**
- ✅ **Profesionální řešení**
- ✅ **API-based**
- ✅ **Skvělé pro týmy**

**Nevýhody:**
- 💰 Placené (některé mají free tier)
- Vyžaduje externí službu
- Složitější setup

---

## 🚀 Rychlé řešení: Decap CMS

Nejjednodušší pro váš případ:

### Setup Decap CMS:

1. **Instalace:**
```bash
npm install decap-cms
```

2. **Vytvořte `public/admin/index.html`:**
```html
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Content Manager</title>
  <script src="https://identity.netlify.com/v1/netlify-identity-widget.js"></script>
</head>
<body>
  <script src="https://unpkg.com/decap-cms@^3.0.0/dist/decap-cms.js"></script>
</body>
</html>
```

3. **Vytvořte `public/admin/config.yml`:**
```yaml
backend:
  name: git-gateway
  branch: main

media_folder: "public/images"
public_folder: "/images"

collections:
  - name: "articles"
    label: "Články"
    folder: "src/content/articles"
    create: true
    slug: "{{slug}}"
    fields:
      - {label: "Název", name: "title", widget: "string"}
      - {label: "Datum publikace", name: "publishedAt", widget: "date"}
      - {label: "Status", name: "status", widget: "select", options: ["draft", "published"]}
      - {label: "Perex", name: "excerpt", widget: "text"}
      - {label: "Obrázek", name: "coverImage", widget: "image", required: false}
      - {label: "Projekt", name: "project", widget: "string", required: false}
      - {label: "Tagy", name: "tags", widget: "list", default: []}
      - {label: "Obsah", name: "body", widget: "markdown"}
```

4. **Přidejte Git Gateway** (pro autentizaci)

**Výhody:**
- ✅ Funguje s klasickým hostingem
- ✅ Články v Git repozitáři
- ✅ Automatický build po commit
- ✅ Bez PHP serveru

---

## 💡 Doporučení

Pro váš projekt doporučuji **Decap CMS** nebo **Keystatic**:

1. **Decap CMS** - pokud chcete rychlé řešení bez složitého setupu
2. **Keystatic** - pokud chcete oficiální Astro řešení s lepší integrací

Oba jsou Git-based, takže:
- Články se ukládají do `src/content/articles/`
- Po commit do Git se spustí build
- Žádný PHP server potřebný
- Bezpečnější než vlastní PHP admin

---

## 🔧 Oprava současného PHP adminu

Pokud chcete zůstat u PHP adminu, problém může být:

1. **JavaScript blokuje kliknutí** - zkontrolujte konzoli prohlížeče (F12)
2. **Špatná cesta** - zkuste přímo otevřít URL v prohlížeči
3. **PHP server routing** - možná potřebuje router script

Můžu vám pomoct nastavit některé z těchto řešení. Které preferujete?
