# Glass Container Guide

## Verwendung von Glass-Effekten in WordPress

### Übersicht

Es gibt **zwei Arten** von Gruppen/Sektionen:

1. **Transparente Gruppen** (Standard) - kein Glass-Effekt
2. **Glass Container** - mit Glass-Effekt

---

## 1. Transparente Gruppen (Standard)

**Verwendung:**
- Einfache Inhalts-Sektionen
- Text ohne besonderen visuellen Fokus
- Standard-Layout

**Im WordPress Block Editor:**
1. Gruppe erstellen
2. Klasse hinzufügen (z.B. `ueber-uns`, `leistungen`, etc.)
3. Fertig - automatisch transparent & zentriert

**CSS:**
```css
.ueber-uns {
    max-width: 1200px;
    margin: 0 auto;
    padding: 4rem var(--spacing-unit);
    background: transparent;
}
```

---

## 2. Glass Container (mit Effekt)

**Verwendung:**
- Wichtige Inhalte hervorheben
- Call-to-Actions
- Featured Sections
- Besondere Aufmerksamkeit

**Im WordPress Block Editor:**

### Methode A: Einzelne Klasse
1. Gruppe erstellen
2. Zusätzliche CSS-Klasse: `glass-container`
3. Fertig!

### Methode B: Mit Variante
1. Gruppe erstellen
2. Zusätzliche CSS-Klasse: `glass-container centered` (für schmalere Box)
   - ODER: `glass-container wide` (für breitere Box)

**Verfügbare Varianten:**
- `glass-container` - Standard (max-width: 1200px)
- `glass-container centered` - Schmal (max-width: 900px)
- `glass-container wide` - Breit (max-width: 1400px)

**Beispiel:**
```
Gruppe: "Über uns"
Zusätzliche CSS-Klasse(n): glass-container centered
```

---

## Glass-Effekt Details

**Was macht der Glass-Effekt?**
- Halbtransparenter Hintergrund (3% Weiß)
- Blur-Effekt (20px backdrop-filter)
- Subtiler Border (10% Weiß)
- Abgerundete Ecken (24px border-radius)
- Schatten für Tiefe
- Padding für Innenabstand

**CSS-Eigenschaften:**
```css
.glass-container {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 4rem 3rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}
```

---

## Best Practices

### Wann Glass Container verwenden?
✅ Hero-Bereiche
✅ Call-to-Action Sektionen
✅ Featured Content
✅ Wichtige Ankündigungen
✅ Kontakt-Bereiche

### Wann NICHT verwenden?
❌ Normaler Fließtext
❌ Listen/Aufzählungen
❌ Footer-Inhalte (außer spezielle CTAs)
❌ Jede zweite Sektion (zu viel Glass = wirkt überladen)

---

## Responsive Verhalten

- **Desktop:** volle Größe & Padding
- **Tablet (< 768px):** reduziertes Padding (3rem 2rem), border-radius: 20px
- **Mobile (< 480px):** kleines Padding (2.5rem 1.5rem), border-radius: 16px

---

## Beispiel-Strukturen

### Einfache Sektion (transparent)
```
Gruppe "ueber-uns"
├── Überschrift H2
├── Absatz
└── Absatz
```

### Glass Container Sektion
```
Gruppe "glass-container centered"
├── Überschrift H2
├── Absatz
└── Button
```

### Verschachtelt (Hero-Style)
```
Gruppe "is-style-hero-section"
└── Gruppe "hero-glass-container"
    ├── Überschrift (hero-headline)
    ├── Überschrift (hero-subline)
    └── Absatz (hero-description)
```

---

## Zusammenfassung

**Regel:**
- **Kein Glass = keine Klasse** (oder eigene wie `ueber-uns`)
- **Mit Glass = Klasse `glass-container`** (+ optional `centered` oder `wide`)

Das war's! 🎨
