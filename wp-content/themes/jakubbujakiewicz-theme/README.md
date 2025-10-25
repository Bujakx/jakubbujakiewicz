# WordPress Theme - Jakub Bujakiewicz

Nowoczesny, lekki motyw WordPress dla strony trenera personalnego z pełnym wsparciem WooCommerce.

## Charakterystyka

- **Czysty kod**: Napisany zgodnie ze standardami WordPress
- **Szybkość**: Zoptymalizowany pod kątem wydajności
- **Responsywność**: W pełni responsywny design
- **WooCommerce**: Pełne wsparcie dla sklepu internetowego
- **SEO**: Zoptymalizowany pod wyszukiwarki
- **Nowoczesny design**: Ciemny motyw z zielonymi akcentami (#0ed145)

## Wymagania

- WordPress 5.0 lub nowszy
- PHP 7.4 lub nowszy
- WooCommerce 5.0 lub nowszy (opcjonalnie)

## Instalacja

### 1. Wgranie motywu

**Opcja A: Przez panel WordPress**
1. Zaloguj się do panelu administracyjnego WordPress
2. Przejdź do **Wygląd → Motywy**
3. Kliknij **Dodaj nowy**
4. Kliknij **Wgraj motyw**
5. Wybierz plik ZIP z motywem
6. Kliknij **Zainstaluj teraz**
7. Po instalacji kliknij **Aktywuj**

**Opcja B: Przez FTP**
1. Spakuj folder `jakubbujakiewicz-theme` do pliku ZIP
2. Połącz się z serwerem przez FTP
3. Przejdź do katalogu `/wp-content/themes/`
4. Wgraj folder motywu
5. W panelu WordPress przejdź do **Wygląd → Motywy** i aktywuj motyw

### 2. Konfiguracja podstawowa

#### Menu nawigacyjne
1. Przejdź do **Wygląd → Menu**
2. Utwórz nowe menu lub wybierz istniejące
3. Przypisz menu do lokalizacji **Primary Menu**
4. Dodaj strony: Strona główna, Usługi, Blog, O mnie, Kontakt

#### Logo
1. Przejdź do **Wygląd → Dostosuj → Tożsamość witryny**
2. Kliknij **Wybierz logo**
3. Wgraj plik logo (preferowany format: PNG z przezroczystym tłem)
4. Zalecana wielkość: 200x60px

#### Strona główna
1. Utwórz nową stronę (Strony → Dodaj nową)
2. Nazwij ją "Strona główna"
3. Przejdź do **Ustawienia → Czytanie**
4. Wybierz **Statyczna strona**
5. Jako **Strona główna** wybierz utworzoną stronę

### 3. Konfiguracja WooCommerce

#### Instalacja WooCommerce
1. Przejdź do **Wtyczki → Dodaj nową**
2. Wyszukaj "WooCommerce"
3. Kliknij **Zainstaluj teraz**
4. Po instalacji kliknij **Aktywuj**
5. Przejdź przez kreator konfiguracji WooCommerce

#### Podstawowe ustawienia sklepu
1. Przejdź do **WooCommerce → Ustawienia**
2. Skonfiguruj:
   - Walutę (PLN - Polski złoty)
   - Kraj i region
   - Metody płatności
   - Metody dostawy

#### Dodawanie produktów
1. Przejdź do **Produkty → Dodaj nowy**
2. Wypełnij dane produktu:
   - Nazwa
   - Opis
   - Cena
   - Zdjęcie główne
3. Kliknij **Opublikuj**

### 4. Konfiguracja zaawansowana

#### Widgety
1. Przejdź do **Wygląd → Widgety**
2. Dostępne obszary widgetów:
   - **Sidebar**: Pasek boczny (blog, strony)
   - **Footer**: Stopka strony

#### Permalinki
1. Przejdź do **Ustawienia → Permalinki**
2. Wybierz **Nazwa wpisu** lub **Struktura niestandardowa**: `/%postname%/`
3. Kliknij **Zapisz zmiany**

## Struktura motywu

```
jakubbujakiewicz-theme/
├── style.css              # Główny plik CSS
├── functions.php          # Funkcje motywu
├── header.php             # Nagłówek
├── footer.php             # Stopka
├── index.php              # Strona główna bloga/archiwum
├── single.php             # Pojedynczy wpis
├── page.php               # Strona
├── archive.php            # Archiwum wpisów
├── search.php             # Wyniki wyszukiwania
├── 404.php                # Strona błędu 404
├── woocommerce.php        # Szablon WooCommerce
├── js/
│   └── main.js            # Główny plik JavaScript
├── assets/
│   └── images/
│       └── logo.png       # Logo motywu
└── README.md              # Ten plik
```

## Dostosowywanie

### Kolory
Motyw wykorzystuje zmienne CSS dla łatwej personalizacji. Edytuj w pliku `style.css`:

```css
:root {
    --primary-color: #0ed145;      /* Główny kolor (zielony) */
    --secondary-color: #2ef95d;    /* Kolor dodatkowy */
    --dark-bg: #000000;            /* Ciemne tło */
    --text-color: #ffffff;         /* Kolor tekstu */
}
```

### Czcionki
Motyw domyślnie używa Google Fonts:
- **Inter**: Tekst główny
- **Poppins**: Nagłówki

Zmiana czcionek w `functions.php` w funkcji `jakubbujakiewicz_theme_scripts()`.

### Layout
Wszystkie szablony można dostosować poprzez edycję odpowiednich plików PHP.

## Optymalizacja wydajności

### Zalecane wtyczki
1. **WP Rocket** lub **W3 Total Cache** - cache
2. **Smush** - optymalizacja obrazów
3. **Autoptimize** - minifikacja CSS/JS
4. **Cloudflare** - CDN

### Wyłączenie niepotrzebnych funkcji WordPress
W pliku `functions.php` dodaj:

```php
// Wyłącz emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Wyłącz embeds
remove_action('wp_head', 'wp_oembed_add_discovery_links');
```

## Wsparcie

W razie problemów:
1. Sprawdź **Ustawienia → Czytanie** - upewnij się, że strona główna jest ustawiona
2. Sprawdź **Wygląd → Menu** - upewnij się, że menu jest przypisane
3. Wyczyść cache (przeglądarka + wtyczka cache)
4. Sprawdź wersję PHP (minimum 7.4)

## Bezpieczeństwo

### Rekomendowane wtyczki
1. **Wordfence Security** - firewall i ochrona
2. **iThemes Security** - zabezpieczenia WordPress
3. **UpdraftPlus** - backup

### Podstawowe zabezpieczenia
1. Używaj silnych haseł
2. Regularnie aktualizuj WordPress, motywy i wtyczki
3. Ogranicz próby logowania
4. Używaj SSL (HTTPS)

## Licencja

Ten motyw jest własnością Jakub Bujakiewicz i przeznaczony do użytku na stronie jakubbujakiewicz.pl.

## Historia zmian

### Wersja 1.0.0
- Pierwsze wydanie
- Pełne wsparcie WooCommerce
- Responsywny design
- Zoptymalizowany pod SEO