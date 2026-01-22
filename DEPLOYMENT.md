# Návod na nasazení

## Příprava

1. **Build projektu:**
   ```bash
   npm install
   npm run build
   ```

2. **Kontrola výstupu:**
   - Výstup je v adresáři `dist/`
   - Měly by tam být všechny HTML, CSS, JS soubory

## Nasazení na Forpsi FTP

### 1. Připojení k FTP

Použijte FTP klienta (FileZilla, WinSCP, nebo příkazový řádek) a připojte se k vašemu Forpsi hostingu.

### 2. Nahrání souborů

**Statické soubory (z `dist/`):**
- Nahrajte VŠECHNY soubory z `dist/` do kořenového adresáře webu (obvykle `public_html/` nebo `www/`)
- Zachovejte strukturu adresářů

**PHP admin:**
- Nahrajte celý adresář `admin/` do kořenového adresáře
- Ujistěte se, že PHP má oprávnění k zápisu

**Content articles:**
- Adresář `src/content/articles/` musí být přístupný pro PHP admin
- Nastavte oprávnění: `chmod 755` pro adresář, `chmod 644` pro soubory
- Nebo nahrajte adresář `src/content/` na server (může být mimo webroot, pak upravte cestu v PHP adminu)

### 3. Konfigurace

**Změna hesla adminu:**
1. Otevřete `admin/index.php` na serveru
2. Změňte `$correct_password = 'admin123';` na bezpečnější heslo
3. Nebo upravte lokálně a nahrajte znovu

**Cesty v PHP adminu:**
- Pokud je struktura jiná, upravte funkci `getArticlesDir()` v PHP souborech:
  - `admin/articles.php`
  - `admin/articles/new.php`
  - `admin/articles/edit.php`

### 4. Testování

1. Otevřete web v prohlížeči
2. Zkontrolujte, že všechny stránky fungují
3. Přihlaste se do adminu na `/admin`
4. Vytvořte testovací článek
5. Zkontrolujte, že se zobrazuje na webu

## Struktura na serveru

```
public_html/ (nebo www/)
├── index.html
├── pribehy/
│   ├── index.html
│   └── [slug].html
├── projekty/
│   ├── index.html
│   └── [slug].html
├── o-nas.html
├── podporte-nas.html
├── kontakt.html
├── admin/
│   ├── index.php
│   ├── auth.php
│   └── articles.php
├── src/ (nebo jinde, podle konfigurace)
│   └── content/
│       └── articles/
└── _assets/ (CSS, JS, obrázky)
```

## Řešení problémů

### Články se nezobrazují

- Zkontrolujte, že soubory v `src/content/articles/` jsou na serveru
- Zkontrolujte oprávnění souborů
- Zkontrolujte cesty v `src/lib/articles.ts`

### PHP admin nefunguje

- Zkontrolujte, že PHP je na serveru povoleno
- Zkontrolujte oprávnění k zápisu do adresáře s články
- Zkontrolujte cesty v PHP souborech

### Obrázky se nezobrazují

- Zkontrolujte, že obrázky jsou v `public/images/` nebo `dist/images/`
- Zkontrolujte cesty v článcích (měly by začínat `/images/...`)

## Aktualizace webu

1. Proveďte změny lokálně
2. Spusťte `npm run build`
3. Nahrajte změněné soubory z `dist/` na FTP
4. Pokud jste změnili PHP admin, nahrajte také `admin/`

## Zálohování

Pravidelně zálohujte:
- Adresář `src/content/articles/` (články)
- Adresář `admin/` (PHP soubory)
- Konfigurační soubory
