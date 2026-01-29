# Nasazení na Railway

## 🚀 Proč Railway?

Railway má oproti GitHub Pages několik výhod:

- ✅ **Jednodušší setup** - vše na jednom místě
- ✅ **Automatické nasazení** z Git (stejně jako GitHub Pages)
- ✅ **Vlastní domény** - snadné připojení vlastní domény
- ✅ **Environment variables** - pro konfiguraci
- ✅ **Lepší pro budoucí rozšíření** - pokud byste potřebovali API nebo databázi
- ✅ **Decap CMS funguje stejně** - Git-based workflow
- ✅ **Zdarma tier** - $5 kreditu měsíčně zdarma

## 📋 Nastavení (5 minut)

### 1. Přihlášení na Railway

1. Jděte na [railway.app](https://railway.app)
2. Přihlaste se přes GitHub
3. Klikněte na **"New Project"**

### 2. Připojení repozitáře

1. Vyberte **"Deploy from GitHub repo"**
2. Vyberte váš repozitář `MemoriaeLoci`
3. Railway automaticky detekuje Astro projekt

### 3. Konfigurace

Railway automaticky:
- ✅ Detekuje `package.json`
- ✅ Spustí `npm install`
- ✅ Spustí `npm run build`
- ✅ Spustí `npm start` (serve dist)

**Žádná další konfigurace není potřeba!** 🎉

### 4. Nastavení domény

1. V Railway projektu → **Settings** → **Networking**
2. Klikněte na **"Generate Domain"** (nebo připojte vlastní)
3. Hotovo!

## 🔐 Decap CMS s Railway

Decap CMS funguje stejně jako s GitHub Pages:

1. **Git Gateway** - použijte Netlify Git Gateway (zdarma)
   - Vytvořte účet na Netlify
   - Přidejte GitHub repozitář
   - Enable Git Gateway v Identity settings
   
2. **Nebo GitHub OAuth** - přímo přes GitHub
   - Vytvořte GitHub OAuth App
   - Přidejte Client ID a Secret do Railway environment variables

### Aktualizace config.yml

V `public/admin/config.yml` zkontrolujte:
```yaml
backend:
  name: git-gateway  # nebo "github" pro přímou autentizaci
  repo: YOUR_USERNAME/YOUR_REPO
  branch: main
```

## 🌐 Environment Variables (volitelné)

V Railway můžete nastavit:
- `NODE_ENV=production`
- Vlastní proměnné pro budoucí rozšíření

## 🔄 Automatické nasazení

Railway automaticky:
1. Sleduje změny v Git (push do main)
2. Spustí build
3. Nasadí novou verzi
4. Hotovo! (obvykle za 1-2 minuty)

## 💰 Ceny

- **Free tier:** $5 kreditu měsíčně zdarma
- **Pro statický web:** Obvykle zdarma nebo velmi levné
- **Placené:** Od $5/měsíc pro větší projekty

## 📊 Porovnání: Railway vs GitHub Pages

| Funkce | Railway | GitHub Pages |
|--------|---------|--------------|
| Setup | ⭐⭐⭐⭐⭐ Jednoduchý | ⭐⭐⭐ Složitější (potřebuje Netlify) |
| Automatické nasazení | ✅ Ano | ✅ Ano |
| Vlastní domény | ✅ Ano | ✅ Ano |
| Environment variables | ✅ Ano | ❌ Ne |
| Budoucí rozšíření (API) | ✅ Snadné | ❌ Obtížné |
| Cena | 💰 Zdarma/$5 | 💰 Zdarma |
| Decap CMS | ✅ Funguje | ✅ Funguje |

## 🎯 Doporučení

**Pro váš projekt doporučuji Railway**, protože:
- Jednodušší setup
- Více flexibility pro budoucí rozšíření
- Lepší pro profesionální projekty
- Stejně jednoduché jako GitHub Pages

## 🛠️ Troubleshooting

### Build selže

- Zkontrolujte Railway logs
- Ověřte, že `package.json` má správné skripty
- Zkontrolujte Node.js verzi (měla by být 18+)

### Decap CMS nefunguje

- Zkontrolujte `public/admin/config.yml`
- Ověřte Git Gateway v Netlify
- Zkontrolujte, že repo v config.yml je správné

### Doména se nezobrazuje

- Počkejte 1-2 minuty na propagaci DNS
- Zkontrolujte Railway networking settings

## 📚 Další informace

- [Railway dokumentace](https://docs.railway.app/)
- [Astro na Railway](https://docs.railway.com/guides/astro)
- [Railway pricing](https://railway.app/pricing)
