# Hybridní nasazení: GitHub Pages + Railway

## 🎯 Koncept

- **GitHub Pages** → Hlavní web (statické stránky)
- **Railway** → Administrace (Decap CMS na `/admin/`)

## ✅ Výhody tohoto přístupu

- ✅ **Hlavní web zdarma** na GitHub Pages
- ✅ **Admin na Railway** - možnost vlastní domény (např. `admin.memoriaeloci.cz`)
- ✅ **Oddělené nasazení** - změny v adminu neovlivní hlavní web
- ✅ **Flexibilita** - Railway může být použito i pro budoucí API

## 🚀 Nastavení

### 1. GitHub Pages (hlavní web)

GitHub Actions workflow už je připraven v `.github/workflows/deploy.yml`.

**Aktivace:**
1. GitHub → Settings → Pages
2. Source: **GitHub Actions**
3. Hotovo!

**URL:** `https://YOUR_USERNAME.github.io/YOUR_REPO/`

### 2. Railway (administrace)

**Nastavení:**

1. **Přihlaste se:** [railway.app](https://railway.app) přes GitHub

2. **Vytvořte nový projekt:**
   - New Project → Deploy from GitHub repo
   - Vyberte repozitář `MemoriaeLoci`

3. **Konfigurace:**
   - Railway automaticky detekuje Astro projekt
   - Build command: `npm run build` (automaticky)
   - Start command: `npx serve dist -p $PORT` (automaticky)

4. **Nastavení domény (volitelné):**
   - Settings → Networking
   - Generate Domain nebo připojte vlastní (např. `admin.memoriaeloci.cz`)

**URL:** `https://YOUR_PROJECT.railway.app/admin/`

### 3. Decap CMS konfigurace

V `public/admin/config.yml` zkontrolujte:

```yaml
backend:
  name: git-gateway  # nebo "github"
  repo: YOUR_USERNAME/YOUR_REPO
  branch: main
```

**Git Gateway setup:**
1. Vytvořte účet na [Netlify](https://www.netlify.com/) (zdarma)
2. Přidejte GitHub repozitář
3. Enable Git Gateway v Identity settings

## 🔄 Workflow

### Přidání/úprava článku:

1. **Otevřete admin:** `https://YOUR_PROJECT.railway.app/admin/`
2. **Přihlaste se** přes GitHub
3. **Vytvořte/upravte článek**
4. **Uložte** → automaticky commitne do Git
5. **GitHub Actions** automaticky přebuildí a nasadí hlavní web
6. **Hotovo!** Článek je na hlavním webu

### Workflow diagram:

```
Decap CMS (Railway)
  ↓
Commit do Git
  ↓
GitHub Actions (GitHub Pages)
  ↓
Hlavní web aktualizován
```

## 🌐 Domény

### Možnost A: Vše na GitHub Pages

- Web: `https://memoriaeloci.cz` (GitHub Pages)
- Admin: `https://memoriaeloci.cz/admin/` (GitHub Pages)

**Výhody:** Vše zdarma, jednoduché

### Možnost B: Hybridní (doporučeno)

- Web: `https://memoriaeloci.cz` (GitHub Pages)
- Admin: `https://admin.memoriaeloci.cz` (Railway)

**Výhody:** 
- Oddělené nasazení
- Vlastní doména pro admin
- Flexibilita pro budoucí rozšíření

## 📝 Konfigurace vlastní domény

### GitHub Pages (hlavní web):

1. GitHub → Settings → Pages
2. Custom domain: `memoriaeloci.cz`
3. Přidejte DNS záznamy podle instrukcí

### Railway (admin):

1. Railway → Settings → Networking
2. Add Custom Domain: `admin.memoriaeloci.cz`
3. Přidejte CNAME záznam podle instrukcí

## 💰 Ceny

- **GitHub Pages:** Zdarma
- **Railway:** $5 kreditu zdarma měsíčně (obvykle stačí pro admin)
- **Celkem:** Zdarma nebo velmi levné

## 🔐 Bezpečnost

- Admin je na samostatné doméně (Railway)
- Hlavní web je statický (GitHub Pages)
- Decap CMS autentizace přes GitHub
- Všechny změny jsou v Git (audit trail)

## 🛠️ Troubleshooting

### Admin se nezobrazuje na Railway

- Zkontrolujte Railway logs
- Ověřte, že build proběhl úspěšně
- Zkontrolujte, že `dist/` obsahuje `admin/` složku

### Články se nezobrazují na hlavním webu

- Zkontrolujte GitHub Actions workflow
- Ověřte, že build proběhl úspěšně
- Počkejte 1-2 minuty na nasazení

### Decap CMS nefunguje

- Zkontrolujte `public/admin/config.yml`
- Ověřte Git Gateway v Netlify
- Zkontrolujte, že repo v config.yml je správné

## 📚 Další informace

- **GitHub Pages:** `.github/workflows/deploy.yml`
- **Railway:** `railway-admin.json`
- **Decap CMS:** `DECAP-CMS-SETUP.md`
