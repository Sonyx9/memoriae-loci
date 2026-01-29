# Návod na nasazení na klasický hosting

## Požadavky

- **Hosting s PHP** (PHP 7.4 nebo vyšší)
- **FTP přístup** k serveru
- **Základní znalost FTP** klienta

## Krok 1: Build projektu

```bash
npm install
npm run build
```

Výstup bude v adresáři `dist/` - statické HTML, CSS, JS soubory.

## Krok 2: Struktura na serveru

Nahrajte na server následující strukturu:

```
public_html/ (nebo www/ - kořenový adresář webu)
├── index.html                    ← z dist/
├── magazin/                      ← z dist/magazin/
├── projekty/                     ← z dist/projekty/
├── o-nas.html                    ← z dist/
├── podporte-nas.html             ← z dist/
├── kontakt.html                  ← z dist/
├── ve-jmenu-lilie.html           ← z dist/
├── nase-vize.html                ← z dist/
├── _assets/                      ← z dist/_assets/ (CSS, JS)
├── images/                       ← z dist/images/ nebo public/images/
├── favicon.ico                   ← z dist/
├── favicon.svg                   ← z dist/
├── .htaccess                     ← z dist/ nebo public/.htaccess
│
├── admin/                        ← celý adresář admin/
│   ├── index.php
│   ├── auth.php
│   ├── articles.php
│   └── articles/
│       ├── new.php
│       └── edit.php
│
└── src/                          ← adresář src/ (pro PHP admin)
    └── content/
        └── articles/             ← PHP admin sem zapisuje články
            └── *.md
```

## Krok 3: Nahrání souborů přes FTP

### 3.1 Statické soubory (z `dist/`)

1. Otevřete FTP klienta (FileZilla, WinSCP, Total Commander)
2. Připojte se k vašemu hostingu
3. Přejděte do `public_html/` (nebo `www/`)
4. Nahrajte **VŠECHNY** soubory a složky z `dist/`:
   - `index.html`
   - všechny `.html` soubory
   - složku `_assets/` (s celým obsahem)
   - složku `images/` (pokud existuje)
   - `favicon.ico`, `favicon.svg`
   - `.htaccess`

### 3.2 PHP administrace

1. Nahrajte celý adresář `admin/` do `public_html/`
2. Struktura: `public_html/admin/`

### 3.3 Adresář pro články

1. Vytvořte adresář `public_html/src/content/articles/`
2. Nahrajte existující články z `src/content/articles/*.md` (pokud máte)
3. Nebo nechte prázdný - PHP admin ho vytvoří automaticky

**Důležité:** Nastavte oprávnění pro zápis:
- `src/content/articles/` → `chmod 755` (nebo `775`)
- Soubory `.md` → `chmod 644` (nebo `664`)

## Krok 4: Konfigurace

### 4.1 Změna hesla adminu

**PŘED nasazením** upravte v `admin/index.php`:

```php
$correct_password = 'VAŠE_BEZPEČNÉ_HESLO'; // Změňte!
```

Nebo po nahrání upravte přímo na serveru přes FTP editor.

### 4.2 Kontrola cest

PHP admin používá relativní cesty:
- `admin/` → `../src/content/articles/`

Pokud máte jinou strukturu, upravte funkci `getArticlesDir()` v:
- `admin/articles.php`
- `admin/articles/new.php`
- `admin/articles/edit.php`

## Krok 5: Testování

1. **Web:** Otevřete `https://vasadomena.cz` - měl by se zobrazit web
2. **Admin:** Otevřete `https://vasadomena.cz/admin` - měla by se zobrazit přihlašovací stránka
3. **Přihlášení:** Zadejte heslo a přihlaste se
4. **Test článku:** Vytvořte testovací článek
5. **Kontrola:** Zkontrolujte, že se článek zobrazuje na webu

## Řešení problémů

### 404 na `/admin`

- Zkontrolujte, že adresář `admin/` je v `public_html/`
- Zkontrolujte, že `.htaccess` neblokuje PHP soubory
- Zkontrolujte, že hosting podporuje PHP

### PHP admin nefunguje

- Zkontrolujte verzi PHP (měla by být 7.4+)
- Zkontrolujte oprávnění k zápisu do `src/content/articles/`
- Zkontrolujte cesty v PHP souborech

### Články se nezobrazují na webu

- Po vytvoření článku přes admin musíte spustit **nový build** (`npm run build`)
- Nahrajte nové soubory z `dist/` na server
- Nebo použijte Astro preview mode (pokud máte Node.js na serveru)

**Poznámka:** Astro generuje statické HTML, takže nové články vytvořené přes PHP admin se na webu zobrazí až po novém buildu. Pro okamžité zobrazení by bylo potřeba použít Astro v SSR módu (server-side rendering).

### Obrázky se nezobrazují

- Zkontrolujte, že obrázky jsou v `public_html/images/`
- Zkontrolujte cesty v článcích (měly by začínat `/images/...`)

## Aktualizace webu

### Po změně článků přes admin:

1. Spusťte lokálně: `npm run build`
2. Nahrajte nové soubory z `dist/` na FTP

### Po změně kódu/komponent:

1. Upravte lokálně
2. Spusťte: `npm run build`
3. Nahrajte změněné soubory z `dist/` na FTP

### Po změně PHP adminu:

1. Upravte soubory v `admin/`
2. Nahrajte změněné PHP soubory na FTP

## Zálohování

Pravidelně zálohujte:
- `src/content/articles/*.md` - všechny články
- `admin/` - PHP soubory administrace
- Celý `dist/` - build výstup (pro rychlou obnovu)

## Alternativní řešení (pokud potřebujete okamžité zobrazení nových článků)

Pokud chcete, aby se nové články zobrazovaly okamžitě bez buildu, můžete:

1. **Použít Astro SSR** (server-side rendering) - vyžaduje Node.js na serveru
2. **Nebo použít API endpoint**, který načítá články dynamicky

Pro většinu případů je však současné řešení (statický build + PHP admin) dostačující a jednodušší na nasazení.
