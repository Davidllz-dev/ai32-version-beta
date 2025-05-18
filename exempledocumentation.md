# AI32 Annuaire – Plugin de recherche et de filtrage d'annuaire

## ✨ Description

Ce plugin permet d’afficher un annuaire interactif, avec des fonctionnalités de 
**recherche globale**, **filtres dynamiques**, **pagination**, et une **interface responsive**. Il est conçu pour une intégration WordPress ou PHP personnalisée.

---

## 📚 Sommaire

1. [Fonctionnalités](#fonctionnalités)
2. [Structure des fichiers](#structure-des-fichiers)
3. [Installation](#installation)
4. [Utilisation](#utilisation)
5. [Configuration JavaScript](#configuration-javascript)
6. [Personnalisation CSS](#personnalisation-css)
7. [Aperçu](#aperçu)
8. [Améliorations futures](#améliorations-futures)

---

## 🛠️ Fonctionnalités

* Recherche globale en direct sur toutes les cartes
* Filtres dynamiques par champs (nom, service, pôle, etc.)
* Pagination configurable par l'utilisateur
* Bouton de réinitialisation des filtres
* Interface adaptée aux mobiles (responsive)
* UI intuitive avec design moderne

---

## 📁 Structure des fichiers

```
ai32-annuaire/
├── public/
│   ├── css/
│   │   └── filtres.css
│   ├── js/
│   │   ├── main.js
│   │   └── filtres.js
├── templates/
│   └── annuaire.php
└── README.md
```

---

## ⚙️ Installation

### 1. Inclure les fichiers dans votre fichier PHP :

```php
<link rel="stylesheet" href="<?= AI32_URL . 'public/css/filtres.css?v=2.0' ?>">
<script type="module" src="<?= AI32_URL . 'public/js/main.js?v=1.0' ?>"></script>
```

### 2. Affichage conditionnel de l'annuaire :

```php
<?php if (count($resultats) > 0): ?>
    <!-- Affichage de l’annuaire -->
<?php endif; ?>
```

---

## 🚀 Utilisation

### Recherche globale :

```html
<input type="text" id="ai32-global-search" placeholder="Rechercher...">
<div id="clear-global-search">X</div>
```

### Filtres dynamiques :

```html
<form id="filter-form">
    <input type="text" name="direction" id="filter-direction">
    <!-- Autres champs similaires -->
</form>
```

### Pagination :

```html
<select id="cards-par-page">
    <option value="10">10</option>
    <option value="25">25</option>
</select>
<div id="pagination" class="pagination-controls"></div>
```

### Carte d'utilisateur :

```html
<div class="carte-resultat" data-nom="dupont" data-service="informatique">
    <p><strong>Nom:</strong> Dupont</p>
</div>
```

---

## 🔧 Configuration JavaScript

Dans `main.js` :

```js
import { initFiltres } from './filtres.js';

document.addEventListener('DOMContentLoaded', () => {
    initFiltres({
        form: document.getElementById("filter-form"),
        cardsContainer: document.getElementById("ai32-cards"),
        cards: Array.from(document.querySelectorAll(".carte-resultat")),
        globalInput: document.getElementById("ai32-global-search"),
        clearBtn: document.getElementById("clear-global-search"),
        pagination: document.getElementById("pagination"),
        perPageSelect: document.getElementById("cards-par-page")
    });
});
```

---

## 🎨 Personnalisation CSS

Modifiez `filtres.css` pour adapter le style selon vos besoins :

```css
body { background-color: #f0f4f8; }
.carte-resultat { width: calc(33.333% - 20px); }
.ai32-filtres button { background-color: #1e2022; color: #fff; }
```

---

## 📈 Aperçu

| Desktop                          | Mobile                             |
| -------------------------------- | ---------------------------------- |
| *(Ajouter captures d'écran ici)* | *(Ajouter capture responsive ici)* |

---

## ✨ Améliorations futures

* Tri alphabétique A-Z / Z-A
* Export CSV
* Recherche avancée multi-critères
* Accessibilité renforcée avec ARIA

---

Merci d'utiliser le plugin **AI32 Annuaire** !

---
------------------------------------------------------------------------------------------------------------------------


Très bien ! Voici une version enrichie du fichier `README.md` qui inclut une **documentation complète du fichier JavaScript principal**, avec **description des fonctions**, **flux logique**, et **responsabilités de chaque fichier** (`main.js`, `filtres.js`, `filtres.css`, etc.).

---

## 📘 Annuaire CD32 – Plugin JavaScript avec Filtres Dynamiques

Ce plugin permet d'afficher dynamiquement un annuaire sous forme de cartes avec des fonctionnalités de recherche globale, filtres par champ (nom, direction, service, etc.), pagination, et personnalisation du nombre de résultats par page.

---

## 📁 Structure du projet

```
annuaire-cd32/
│
├── public/
│   ├── js/
│   │   ├── main.js          # Logique principale : affichage, pagination, recherche
│   │   └── filtres.js       # Logique dédiée aux interactions et filtrage dynamique
│   └── css/
│       └── filtres.css      # Design général des cartes, champs, boutons
│
├── views/
│   └── annuaire.php         # HTML + injection des résultats PHP
│
└── README.md                # Documentation complète
```

---

## 🧠 Fonctionnement global

1. Le HTML est généré par PHP avec un tableau `$resultats`.
2. Chaque carte contient des `data-*` attributs exploitables côté JS.
3. Le JS se charge de :

   * trier les cartes,
   * filtrer les résultats dynamiquement,
   * effectuer une recherche globale,
   * gérer la pagination,
   * réagir à des clics de filtres rapides.

---

## 📂 `main.js` – Documentation complète

Fichier principal qui s'exécute au `DOMContentLoaded`. Il regroupe toutes les fonctions nécessaires à la logique dynamique.

### 🔁 Initialisation

```js
document.addEventListener("DOMContentLoaded", function () {
    // Initialisation des variables DOM et locales
});
```

---

### 🔧 Variables principales

| Variable              | Rôle                                               |
| --------------------- | -------------------------------------------------- |
| `filterForm`          | Formulaire de filtres                              |
| `cardsContainer`      | Conteneur des cartes à afficher                    |
| `allCards`            | Tableau de toutes les cartes présentes dans le DOM |
| `filteredCards`       | Cartes actuellement filtrées                       |
| `cardsPerPage`        | Nombre de cartes visibles par page                 |
| `paginationContainer` | Conteneur des boutons de pagination                |
| `globalSearchInput`   | Champ de recherche globale                         |
| `clearSearchBtn`      | Bouton pour effacer la recherche globale           |

---

### 🔍 Fonction : `applyGlobalSearch()`

Filtre toutes les cartes en fonction d'une recherche globale dans tous les `data-*`.

```js
function applyGlobalSearch() {
    const query = globalSearchInput.value.trim().toLowerCase();
    filteredCards = allCards.filter(card => {
        const allData = Object.values(card.dataset).join(" ").toLowerCase();
        return allData.includes(query);
    });
    afficherCartes();
}
```

---

### 🧩 Fonction : `applyFiltres()`

Lit les valeurs des inputs du formulaire pour filtrer les cartes.

```js
function applyFiltres() {
    const formData = new FormData(filterForm);
    filteredCards = allCards.filter(card => {
        return Object.entries(formData.entries()).every(([key, value]) => {
            return !value || card.dataset[key].includes(value);
        });
    });
    afficherCartes();
}
```

---

### 📄 Fonction : `afficherCartes()`

Affiche les cartes filtrées en appliquant une pagination.

```js
function afficherCartes() {
    const start = (currentPage - 1) * cardsPerPage;
    const paginatedCards = filteredCards.slice(start, start + cardsPerPage);
    cardsContainer.innerHTML = "";
    paginatedCards.forEach(card => cardsContainer.appendChild(card));
    afficherPagination();
}
```

---

### 📑 Fonction : `afficherPagination()`

Construit dynamiquement les boutons "Suivant", "Précédent", avec info de page.

```js
function afficherPagination() {
    paginationContainer.innerHTML = "";
    // Crée les boutons de pagination en fonction du nombre total de pages
}
```

---

### 🔃 Fonction : `sortCards()`

Trie les cartes par ordre alphabétique (`data-nom`).

```js
function sortCards() {
    filteredCards.sort((a, b) => a.dataset.nom.localeCompare(b.dataset.nom));
}
```

---

### 🧼 Fonction : `reset()`

Réinitialise tous les filtres, recherche globale, et cache les cartes.

---

## 📂 `filtres.js`

Dans le cas où vous avez externalisé la logique des filtres, ce fichier peut contenir :

* gestion de l’événement `submit` du formulaire de filtres,
* gestion des clics sur les liens `.filter-click`,
* fonctions réutilisables comme `getFormFilters()`.

💡 Pour éviter les conflits entre fichiers JS :
Assurez-vous que **chaque fichier ne déclare que ce dont il a besoin** et que toutes les fonctions/exportations soient bien **encapsulées dans un IIFE** ou dans un module propre si vous utilisez `type="module"`.

---

## 🎨 `filtres.css`

Ce fichier contient tous les styles :

* **.carte-resultat** : cartes individuelles (dimensions, ombrage, hover…)
* **.ai32-search-bar** : champ de recherche avec bouton clear
* **.ai32-filtres** : formulaire de filtres responsive
* **.pagination-controls** : boutons de navigation

Optimisé pour bureau et mobile (media queries incluses).

---

## ✅ Fonctionnalités

* ✅ Recherche globale instantanée
* ✅ Filtres par champ (multi-filtres cumulables)
* ✅ Pagination dynamique
* ✅ Choix du nombre de cartes par page
* ✅ Réinitialisation facile
* ✅ Responsive design
* ✅ Tri alphabétique

---

## ⚙️ À faire

* Ajouter un **chargement AJAX** des données pour des performances accrues
* Ajouter un système de **cache localStorage** ou IndexedDB
* Export CSV des résultats filtrés
* Ajout de filtres multi-valeurs (checkbox, listes)

---

## 📌 Dépendances

Aucune. Le plugin est en **JavaScript vanilla** (aucune librairie externe requise).

---

## 🚀 Intégration

Dans votre fichier PHP :

```php
<link rel="stylesheet" href="<?php echo AI32_URL . 'public/css/filtres.css?v=2.0'; ?>">
<script src="<?php echo AI32_URL . 'public/js/filtres.js?v=1.0'; ?>" defer></script>
```

---

Souhaitez-vous également que je génère un fichier `.jsdoc` ou vous aide à intégrer une **documentation automatique** avec [JSDoc](https://jsdoc.app/) ou [TypeDoc](https://typedoc.org/)?
