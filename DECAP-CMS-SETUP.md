# Nastavení Decap CMS pro GitHub Pages

## ✅ Co už je připraveno

- ✅ Admin stránka: `public/admin/index.html`
- ✅ Konfigurace CMS: `public/admin/config.yml`
- ✅ GitHub Actions workflow pro automatický build

## 🚀 Krok 1: Aktualizace konfigurace

1. Otevřete `public/admin/config.yml`
2. Najděte řádek:
   ```yaml
   repo: YOUR_GITHUB_USERNAME/YOUR_REPO_NAME
   ```
3. Nahraďte za vaše údaje, např.:
   ```yaml
   repo: lukas/memoriae-loci
   ```

## 🔐 Krok 2: Nastavení Git Gateway (autentizace)

Decap CMS potřebuje Git Gateway pro autentizaci. Máte dvě možnosti:

### Možnost A: Netlify Git Gateway (DOPORUČENO - nejjednodušší)

1. Vytvořte **zdarma účet** na [Netlify](https://www.netlify.com/)
2. Přidejte váš GitHub repozitář do Netlify
3. V Netlify nastavení:
   - **Build command:** `npm run build`
   - **Publish directory:** `dist`
   - **Enable Git Gateway** v sekci Identity
4. V `public/admin/config.yml` změňte:
   ```yaml
   backend:
     name: git-gateway
   ```
   (Už je to tak nastaveno ✅)

**Výhody:**
- ✅ Zdarma
- ✅ Jednoduché nastavení
- ✅ Funguje s GitHub Pages

### Možnost B: GitHub OAuth (pokročilejší)

Pokud nechcete používat Netlify, můžete nastavit GitHub OAuth přímo:

1. Vytvořte GitHub OAuth App: https://github.com/settings/developers
2. V `public/admin/config.yml` změňte:
   ```yaml
   backend:
     name: github
     repo: YOUR_USERNAME/YOUR_REPO
     branch: main
   ```
3. Přidejte Client ID a Client Secret do Netlify environment variables

## 📝 Krok 3: Push do GitHub

```bash
git add .
git commit -m "Add Decap CMS"
git push origin main
```

## 🌐 Krok 4: Aktivace GitHub Pages

1. Jděte na GitHub repozitář
2. **Settings** → **Pages**
3. **Source:** Vyberte "GitHub Actions"
4. Uložte

## 🎉 Krok 5: První přihlášení

1. Otevřete: `https://YOUR_USERNAME.github.io/YOUR_REPO/admin/`
2. Klikněte na **"Login with GitHub"**
3. Autorizujte aplikaci
4. Hotovo! 🎊

## 📚 Použití

### Přidání nového článku

1. Otevřete `/admin/`
2. Klikněte na **"New Article"**
3. Vyplňte formulář
4. Klikněte na **"Publish"**
5. Článek se automaticky commitne do Git
6. GitHub Actions spustí build
7. Web se automaticky aktualizuje!

### Úprava existujícího článku

1. Otevřete `/admin/`
2. Klikněte na článek v seznamu
3. Upravte obsah
4. Klikněte na **"Save"** nebo **"Publish"**

## 🔄 Workflow

```
1. Editace v Decap CMS (/admin/)
   ↓
2. Commit do Git (automaticky)
   ↓
3. GitHub Actions spustí build
   ↓
4. Web se nasadí na GitHub Pages
   ↓
5. Hotovo! (obvykle za 1-2 minuty)
```

## 🛠️ Řešení problémů

### "Git Gateway is not enabled"

- Zkontrolujte, že máte Git Gateway aktivní v Netlify
- Nebo použijte GitHub OAuth (Možnost B)

### Články se nezobrazují po publikaci

- Zkontrolujte GitHub Actions - build může selhat
- Zkontrolujte, že článek má `status: published`
- Počkejte 1-2 minuty na dokončení buildu

### Obrázky se nezobrazují

- Obrázky se ukládají do `public/images/`
- Cesty v článcích by měly začínat `/images/...`

## 📖 Další informace

- [Decap CMS dokumentace](https://decapcms.org/docs/)
- [Git Gateway setup](https://decapcms.org/docs/git-gateway-backend/)
- [GitHub Pages dokumentace](https://docs.github.com/en/pages)

## 🎯 Výhody oproti PHP adminu

- ✅ **Bez serveru** - funguje jako statický soubor
- ✅ **Bezpečné** - autentizace přes GitHub
- ✅ **Automatický build** - po každém uložení
- ✅ **Moderní UI** - profesionální rozhraní
- ✅ **WYSIWYG editor** - vizuální editace
- ✅ **Media management** - správa obrázků
- ✅ **Git historie** - všechny změny jsou v Git
- ✅ **Funguje s GitHub Pages** - zdarma hosting
