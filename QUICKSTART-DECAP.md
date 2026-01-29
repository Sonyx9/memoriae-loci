# Rychlý start s Decap CMS

## ✅ Co je připraveno

- ✅ Admin rozhraní: `/admin/`
- ✅ Konfigurace CMS podle vašeho schématu
- ✅ Railway konfigurace (doporučeno)
- ✅ GitHub Actions pro automatický build (alternativa)

## 🚀 Nastavení (5 minut)

### Hybridní řešení (DOPORUČENO) ⭐

**Web na GitHub Pages + Admin na Railway**

#### 1. GitHub Pages (hlavní web)

1. GitHub → Settings → Pages
2. Source: **GitHub Actions**
3. Hotovo! Web je na `https://YOUR_USERNAME.github.io/YOUR_REPO/`

#### 2. Railway (administrace)

1. **Přihlaste se:** [railway.app](https://railway.app) přes GitHub
2. **New Project** → **Deploy from GitHub repo**
3. **Vyberte repozitář** `MemoriaeLoci`
4. **Hotovo!** Admin je na `https://YOUR_PROJECT.railway.app/admin/`

**Výhody:**
- ✅ Web zdarma na GitHub Pages
- ✅ Admin na Railway (možnost vlastní domény)
- ✅ Oddělené nasazení
- ✅ $5 kreditu zdarma měsíčně

Více: viz `HYBRID-SETUP.md`

### Alternativa: Vše na GitHub Pages

1. **Aktualizujte repo** v `public/admin/config.yml`:
   ```yaml
   repo: YOUR_GITHUB_USERNAME/YOUR_REPO_NAME
   ```

2. **Push do GitHub:**
   ```bash
   git add .
   git commit -m "Add Decap CMS"
   git push origin main
   ```

3. **Nastavte Netlify Git Gateway:**
   - Účet na [netlify.com](https://www.netlify.com/)
   - Přidejte GitHub repozitář
   - Enable Git Gateway v Identity settings

4. **Aktivujte GitHub Pages:**
   - Settings → Pages → Source: GitHub Actions

## 🎉 Použití

### S Railway:
1. Otevřete: `https://YOUR_PROJECT.railway.app/admin/`
2. Přihlaste se přes GitHub (nebo Netlify Git Gateway)
3. Vytvářejte a upravujte články!

### S GitHub Pages:
1. Otevřete: `https://YOUR_USERNAME.github.io/YOUR_REPO/admin/`
2. Přihlaste se přes GitHub
3. Vytvářejte a upravujte články!

## 📝 Workflow

```
Editace v /admin/ 
  → Commit do Git 
  → Automatický build (Railway/GitHub Actions)
  → Automatické nasazení
```

Všechno automaticky! 🚀

## 📚 Více informací

- **Railway:** `RAILWAY-SETUP.md`
- **GitHub Pages:** `DECAP-CMS-SETUP.md`
- **Porovnání:** `DEPLOYMENT-COMPARISON.md`
