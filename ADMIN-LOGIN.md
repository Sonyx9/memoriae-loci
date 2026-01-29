# Jak se přihlásit do Decap CMS

## 🔐 Přihlášení do Decap CMS

Decap CMS používá **Netlify Identity** (Git Gateway) nebo **GitHub OAuth** pro autentizaci.

## 🚀 Lokální vývoj (localhost) - BEZ PŘIHLÁŠENÍ

### Rychlé řešení: Použijte test-repo backend

Pro lokální testování **bez přihlášení**, změňte v `public/admin/config.yml`:

```yaml
backend:
  name: test-repo  # Změňte z "git-gateway" na "test-repo"
```

**Pak:**
1. Restartujte dev server (`npm run dev`)
2. Otevřete: http://localhost:4321/admin/
3. **Žádné přihlášení není potřeba!** ✅

⚠️ **Poznámka:** S test-repo backendem se změny neukládají do Git (jen do prohlížeče).

### Alternativa: Vytvořte Netlify účet

Pokud chcete použít Git Gateway na localhostu:

1. **Vytvořte účet na Netlify:**
   - Jděte na [netlify.com](https://www.netlify.com/)
   - Vytvořte zdarma účet

2. **Nastavte Git Gateway:**
   - Přidejte GitHub repozitář do Netlify
   - Settings → Identity → Enable Identity
   - Settings → Identity → Enable Git Gateway

3. **Vytvořte účet v adminu:**
   - Otevřete: http://localhost:4321/admin/
   - Klikněte na **"Sign up"** (vytvoření účtu)
   - Zadejte email a heslo
   - Potvrďte email (přijde vám email od Netlify)
   - Hotovo!

## 🚀 Lokální vývoj (localhost)

### Možnost 1: Test-repo backend (bez přihlášení)

Na localhostu můžete použít `test-repo` backend, který **nevyžaduje přihlášení**:

1. Otevřete: http://localhost:4321/admin/
2. **Žádné přihlášení není potřeba** - můžete testovat UI
3. ⚠️ **Poznámka:** Změny se neukládají do Git (jen do prohlížeče)

### Možnost 2: Git Gateway (s přihlášením)

Pro plnou funkčnost na localhostu:

1. **Nastavte Netlify Git Gateway:**
   - Vytvořte účet na [netlify.com](https://www.netlify.com/)
   - Přidejte GitHub repozitář
   - Enable Git Gateway v Identity settings

2. **Přihlášení:**
   - Otevřete: http://localhost:4321/admin/
   - Klikněte na **"Login with Netlify Identity"**
   - Vytvořte účet nebo se přihlaste
   - Hotovo!

## 🌐 Produkce (Railway nebo GitHub Pages)

### Přihlášení přes GitHub

1. Otevřete admin URL:
   - Railway: `https://YOUR_PROJECT.railway.app/admin/`
   - GitHub Pages: `https://YOUR_USERNAME.github.io/YOUR_REPO/admin/`

2. Klikněte na **"Login with GitHub"**

3. Autorizujte aplikaci

4. Hotovo! 🎉

### Přihlášení přes Netlify Git Gateway

1. Otevřete admin URL

2. Klikněte na **"Login with Netlify Identity"**

3. Přihlaste se nebo vytvořte účet

4. Hotovo!

## ⚙️ Konfigurace

### Aktuální nastavení

V `public/admin/config.yml` je nastaveno:

```yaml
backend:
  name: git-gateway  # Používá Netlify Git Gateway
  repo: YOUR_GITHUB_USERNAME/YOUR_REPO_NAME
```

### Změna na GitHub OAuth

Pokud chcete použít přímo GitHub (bez Netlify):

```yaml
backend:
  name: github
  repo: YOUR_USERNAME/YOUR_REPO
  branch: main
```

**Pak budete potřebovat:**
- GitHub OAuth App (vytvořte na GitHub Settings → Developer settings)
- Client ID a Client Secret

## 🎯 Rychlý start

### Pro lokální testování (bez přihlášení):

1. Otevřete: http://localhost:4321/admin/
2. **Žádné přihlášení** - můžete prohlížet a testovat UI
3. Změny se neuloží do Git

### Pro skutečné ukládání:

1. **Nastavte Netlify Git Gateway** (viz výše)
2. Nebo použijte **produkční URL** (Railway/GitHub Pages)
3. Přihlaste se přes GitHub nebo Netlify

## ❓ Časté otázky

### Proč není tradiční heslo?

Decap CMS je Git-based CMS - všechny změny se ukládají do Git repozitáře. Proto potřebuje autentizaci přes Git provider (GitHub) nebo Git Gateway (Netlify).

### Můžu použít jiné přihlašovací údaje?

Ne, Decap CMS podporuje pouze:
- GitHub OAuth
- Netlify Git Gateway
- GitLab OAuth
- Bitbucket OAuth

### Jak přidám další uživatele?

- **GitHub OAuth:** Přidejte uživatele jako collaboratory do GitHub repozitáře
- **Netlify Git Gateway:** Přidejte uživatele v Netlify Identity settings

## 🔗 Užitečné odkazy

- [Decap CMS dokumentace](https://decapcms.org/docs/)
- [Git Gateway setup](https://decapcms.org/docs/git-gateway-backend/)
- [GitHub OAuth setup](https://decapcms.org/docs/github-backend/)
