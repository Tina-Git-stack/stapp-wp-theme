# Stapp Theme

Ein modernes, responsives WordPress-Theme mit Block-Editor-Unterstützung.

## Features

- ✅ Responsive Design
- ✅ Block-Editor (Gutenberg) Unterstützung
- ✅ Anpassbare Farben und Typografie
- ✅ Widget-bereite Bereiche (Sidebar + 3 Footer-Widgets)
- ✅ Primäres und Footer-Navigationsmenü
- ✅ Custom Logo Support
- ✅ Featured Images
- ✅ Übersetzungsbereit
- ✅ SEO-freundlich
- ✅ Barrierefreundlich

## Installation

1. Lade den Theme-Ordner in `/wp-content/themes/` hoch
2. Aktiviere das Theme in WordPress unter Design > Themes
3. Passe das Theme über Design > Customizer an

## Theme-Struktur

```
stapp-theme/
├── assets/
│   ├── css/
│   │   ├── main.css          # Haupt-Stylesheet
│   │   └── editor-style.css  # Block-Editor Styles
│   └── js/
│       └── main.js            # JavaScript-Funktionen
├── inc/
│   ├── template-tags.php      # Template-Helper-Funktionen
│   └── custom-functions.php   # Custom Theme-Funktionen
├── template-parts/
│   ├── content.php            # Standard Post-Template
│   ├── content-single.php     # Einzelner Post
│   ├── content-page.php       # Seiten-Template
│   ├── content-none.php       # Keine Inhalte gefunden
│   └── content-search.php     # Suchergebnisse
├── functions.php              # Theme-Funktionen
├── style.css                  # Haupt-Theme-Datei
├── theme.json                 # Block-Theme-Konfiguration
├── index.php                  # Haupt-Template
├── header.php                 # Header-Template
├── footer.php                 # Footer-Template
├── sidebar.php                # Sidebar-Template
├── single.php                 # Einzelner Post
├── page.php                   # Seiten-Template
├── archive.php                # Archiv-Template
├── search.php                 # Such-Template
└── 404.php                    # 404-Fehlerseite
```

## Anpassung

### Farben

Das Theme verwendet CSS-Custom-Properties (Variablen), die in `style.css` definiert sind:

```css
:root {
    --color-primary: #0073aa;
    --color-secondary: #23282d;
    --color-text: #333;
    --color-background: #fff;
}
```

### Menüs

Das Theme unterstützt zwei Menü-Positionen:
- **Primäres Menü**: Haupt-Navigation im Header
- **Footer Menü**: Navigation im Footer

Erstelle Menüs unter Design > Menüs

### Widgets

Das Theme bietet 4 Widget-Bereiche:
- **Sidebar**: Hauptseitenleiste
- **Footer Widget 1-3**: Drei Footer-Spalten

Füge Widgets unter Design > Widgets hinzu

### Custom Logo

Lade ein Logo unter Design > Customizer > Website-Identität hoch

## Browser-Unterstützung

- Chrome (neueste Version)
- Firefox (neueste Version)
- Safari (neueste Version)
- Edge (neueste Version)

## Lizenz

Dieses Theme ist unter der GPL v2 oder höher lizenziert.

## Support

Für Fragen und Support wende dich an den Theme-Autor.

## Changelog

### Version 1.0.0
- Initiales Release
- Basis-Theme-Struktur
- Block-Editor-Unterstützung
- Responsive Design
