# Lokální vývoj s Decap CMS

## 🚀 Spuštění

1. **Spusťte Astro dev server:**
   ```bash
   npm run dev
   ```

2. **Otevřete admin:**
   - URL: http://localhost:4321/admin/
   - Nebo: http://localhost:4321/admin/index.html

## ⚠️ Důležité poznámky

### Decap CMS na localhostu

Decap CMS **funguje na localhostu**, ale má omezení:

- ✅ **Zobrazení článků** - funguje
- ✅ **Editace existujících článků** - funguje (s test-repo backend)
- ⚠️ **Ukládání změn** - potřebuje Git Gateway nebo GitHub OAuth
- ⚠️ **Vytváření nových článků** - potřebuje Git Gateway

### Možnosti pro lokální vývoj

#### Možnost 1: Použít test-repo backend (jednoduché)

Decap CMS automaticky použije `test-repo` backend na localhostu, který:
- ✅ Umožňuje editaci
- ⚠️ Změny se **neukládají do Git** (jen do localStorage)
- ✅ Vhodné pro testování UI

**Poznámka:** Změny se neuloží do souborů, jen do prohlížeče!

#### Možnost 2: Použít Git Gateway (plná funkčnost)

1. Nastavte Netlify Git Gateway (viz `DECAP-CMS-SETUP.md`)
2. V `public/admin/config.yml` použijte `git-gateway`
3. Na localhostu bude fungovat plně (s autentizací)

#### Možnost 3: Použít produkční URL

Pro plnou funkčnost otevřete admin na produkční URL:
- Railway: `https://YOUR_PROJECT.railway.app/admin/`
- GitHub Pages: `https://YOUR_USERNAME.github.io/YOUR_REPO/admin/`

## 🔧 Konfigurace

### Lokální config (`config.local.yml`)

Pro lokální vývoj můžete použít `config.local.yml` s `test-repo` backendem:

```yaml
backend:
  name: test-repo  # Bez autentizace, změny jen v prohlížeči
```

### Produkční config (`config.yml`)

Pro produkci použijte `config.yml` s Git Gateway:

```yaml
backend:
  name: git-gateway
  repo: YOUR_USERNAME/YOUR_REPO
```

## 📝 Workflow pro lokální vývoj

### Testování UI a funkcí:

1. Spusťte `npm run dev`
2. Otevřete http://localhost:4321/admin/
3. Testujte rozhraní (změny se neuloží do Git)

### Skutečné ukládání článků:

1. Použijte produkční URL (Railway nebo GitHub Pages)
2. Nebo použijte Git Gateway na localhostu
3. Nebo editujte soubory manuálně v `src/content/articles/`

## 🎯 Doporučení

Pro lokální vývoj:
- ✅ **Testování UI:** Použijte localhost s test-repo backendem
- ✅ **Skutečné ukládání:** Použijte produkční URL nebo Git Gateway
- ✅ **Rychlé změny:** Editujte soubory manuálně v `src/content/articles/`

## 🛠️ Troubleshooting

### Admin se nezobrazuje

- Zkontrolujte, že Astro dev server běží
- Otevřete http://localhost:4321/admin/ přímo
- Zkontrolujte konzoli prohlížeče (F12)

### Decap CMS hlásí chybu

- Na localhostu může hlásit chyby s Git Gateway - to je normální
- Použijte test-repo backend nebo produkční URL

### Změny se neukládají

- Na localhostu s test-repo backendem se změny neukládají do Git
- Použijte produkční URL nebo Git Gateway pro skutečné ukládání
