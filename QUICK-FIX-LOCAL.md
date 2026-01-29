# Rychlé řešení: Admin bez přihlášení na localhostu

## ⚡ Okamžité řešení

Chcete použít admin na localhostu **bez přihlášení**? Změňte backend na `test-repo`:

### 1. Upravte config.yml

Otevřete `public/admin/config.yml` a změňte:

```yaml
backend:
  name: test-repo  # Změňte z "git-gateway" na "test-repo"
```

### 2. Restartujte dev server

```bash
# Zastavte server (Ctrl+C) a spusťte znovu:
npm run dev
```

### 3. Otevřete admin

http://localhost:4321/admin/

**Žádné přihlášení není potřeba!** ✅

## ⚠️ Důležité

- ✅ Můžete prohlížet a testovat UI
- ✅ Můžete editovat články
- ⚠️ **Změny se neukládají do Git** (jen do prohlížeče)
- ⚠️ Pro skutečné ukládání použijte produkční URL nebo Git Gateway

## 🔄 Vrácení zpět na Git Gateway

Pokud chcete použít Git Gateway (s přihlášením), změňte zpět:

```yaml
backend:
  name: git-gateway
```

A nastavte Netlify Git Gateway (viz `ADMIN-LOGIN.md`).
