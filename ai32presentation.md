Voici une **explication détaillée pas à pas** de ce code PHP/HTML/CSS/JS, que vous pourrez **présenter avec confiance**. Ce code affiche un **annuaire de contacts professionnels** dans un navigateur, avec des **fonctions de recherche, filtrage, pagination et affichage dynamique**.

---

## 🔁 Structure générale du code

```php
<?php if (count($resultats) > 0): ?>
```

* Vérifie si le tableau `$resultats` contient des données (résultats d'une requête, probablement LDAP ou BDD).
* Si oui, le HTML de la page s'affiche.
* Sinon, un message d’erreur est affiché à la fin (`Error 404`).

---

## 🧱 Partie HTML – Structure de la page

```html
<!DOCTYPE html>
<html lang="fr">
```

* Déclaration du document HTML en français.

### `<head>`

```html
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Annuaire CD32</title>
<link rel="stylesheet" href="<?= AI32_URL . 'public/css/filtres.css?v=2.0'; ?>">
<script type="module" src="<?= AI32_URL . 'public/js/main.js?v=1.0'; ?>"></script>
```

* Définition de l'encodage UTF-8.
* Adaptation du site au mobile (`viewport`).
* Inclusion du fichier CSS pour le style.
* Inclusion d’un fichier JavaScript en mode **module ES6** (`main.js`) pour gérer les filtres, pagination, etc.

---

## 🔍 Barre de recherche globale

```html
<div class="ai32-search-bar-container">
    <input type="text" id="ai32-global-search" class="ai32-search-bar"
        placeholder="Recherche par nom, direction, service, etc.">
    <button id="clear-global-search" style="cursor:pointer;">X</button>
</div>
```

* Champ de recherche global.
* Un bouton "X" pour effacer la recherche (probablement géré par JavaScript).

---

## 🧾 Affichage des résultats

```php
<?php if (is_array($resultats)): ?>
    <div id="ai32-cards" class="resultats-container">
```

* Vérifie que `$resultats` est bien un tableau.
* Crée un conteneur HTML pour les cartes de chaque contact.

### 🧩 Boucle `foreach`

```php
<?php foreach ($resultats as $res): ?>
```

* Parcourt chaque entrée (personne) dans les résultats.

#### 🛡️ Sécurisation et traitement des données

```php
$sn         = htmlspecialchars($res['sn'] ?? '');
$prenom     = htmlspecialchars($res['givenname'] ?? '');
$mobile     = str_replace(' ', '', $res['mobile'] ?? '');
$fixe       = str_replace(' ', '', $res['extensionattribute9'] ?? '');
$dga        = htmlspecialchars($res['extensionattribute10'] ?? '');
...
```

* Récupère les champs depuis le tableau `$res`.
* `htmlspecialchars()` empêche les injections HTML.
* `str_replace(' ', '', ...)` nettoie les numéros de téléphone.

---

## 🧾 Affichage d'une carte (personne)

```html
<div class="carte-resultat"
     data-nom="<?= strtolower($sn) ?>"
     ...
>
```

* Chaque carte affiche les infos d'une personne.
* Les attributs `data-*` servent au JavaScript pour le filtrage ou tri.

### 📞 Téléphones

```php
<?php if ($mobile): ?>
    <a href="tel:<?= $mobile ?>"><?= chunk_split($mobile, 2, ' ') ?></a>
<?php endif; ?>
```

* `chunk_split()` formate le numéro (ex: `0607080900` → `06 07 08 09 00`)
* `href="tel:..."` permet d’appeler en un clic depuis un smartphone.

### 🔗 Filtres cliquables

```html
<a href="#" class="filter-click" data-type="direction" data-value="<?= strtolower($direction) ?>">
```

* Permet de filtrer dynamiquement (géré par JS) en cliquant sur une valeur comme la Direction ou le Service.

---

## 📄 Pagination

```html
<div class="pagination-options">
    <label for="cards-par-page">Lignes / page :</label>
    <select id="cards-par-page">
```

* Choix du nombre de résultats visibles par page.
* Géré par JavaScript via l’élément `#pagination`.

---

## 🎛️ Zone des filtres

```html
<form id="filter-form">
    <h3>Filtres :</h3>
    ...
</form>
```

* Formulaire avec champs de filtre (par nom, prénom, etc.)
* Chaque filtre est un champ de saisie.
* Deux boutons :

  * `Appliquer` : applique les filtres (via JS)
  * `Réinitialiser` : vide tous les filtres

---

## ❌ Sinon : pas de résultats

```php
<?php else: ?>
    <div class="ai32-no-resultats">
        <p>Error 404 : Pas d'annuaire CD32 trouvé.</p>
    </div>
<?php endif; ?>
```

* Si `$resultats` est vide → affiche une erreur.

---

## 🔁 Fonctionnement global

1. **PHP** récupère les données (résultats d’un annuaire, ex. LDAP ou BDD).
2. Si des données sont trouvées :

   * Génère la page HTML avec tous les contacts.
   * Génère une carte par personne.
3. **JavaScript** gère :

   * Le champ de recherche global.
   * Le filtrage dynamique avec les attributs `data-*`.
   * La pagination.
   * Le bouton "réinitialiser".
4. **CSS** stylise toute l’interface (`filtres.css`).

---

## 🧠 Ce qu’il faut savoir pour ta présentation

### ✅ Concepts PHP

* `if`, `foreach`, `htmlspecialchars`, `str_replace`, `chunk_split`, `<?= ... ?>`
* Les opérateurs `??` pour valeurs par défaut.

### ✅ Concepts HTML/JS/CSS

* Structure HTML (`<div>`, `<form>`, `<input>`, `<select>`, etc.)
* `data-*` attributes pour JavaScript
* `href="tel:..."` pour les appels
* Utilisation du fichier CSS externe
* Utilisation du fichier JS pour l’interactivité

### ✅ Fonctionnalités clés

* Annuaire avec affichage par carte
* Recherche et filtres dynamiques
* Pagination personnalisable
* Liens filtrables cliquables
* Téléphone cliquable
* Affichage conditionnel : présence ou absence de résultats

---

## 🗣️ Astuce pour ta soutenance

Quand tu présentes, structure ton discours comme suit :

1. **Contexte** : "Ce projet est un annuaire web dynamique pour le CD32..."
2. **Fonctionnalités** : "...permet la recherche, le filtrage, la pagination, etc."
3. **Technos** : "Il utilise PHP côté serveur, HTML/CSS pour l’affichage, et JavaScript pour l’interactivité."
4. **Points techniques** : Expliquer comment sont générées les cartes, comment le JS interagit avec les `data-*`, comment les numéros sont formatés, etc.
5. **Améliorations possibles** (bonus) : ex. tri, ajout d’un export CSV, lien email, etc.

6. 

---
-----------------------------------------------------------------------------------------------------------------------------------------

Parfait ! Voici une **explication détaillée, claire et pédagogique** des deux fichiers **JavaScript** : `filtres.js` et `main.js`. Cela te permettra de **présenter et faire valider ton travail avec assurance**.

---

## ✅ FICHIER `main.js` – **Le point d'entrée**

### Fonctionnement général :

Ce fichier **attend que le DOM soit complètement chargé**, puis il **initialise le système de filtres** en appelant la fonction `initFiltres()` définie dans `filtres.js`.

### Détail ligne par ligne :

```js
"use strict";
```

* Active le **mode strict** pour éviter les erreurs silencieuses et améliorer la qualité du code.

```js
import { initFiltres } from './filtres.js';
```

* Importe la **fonction principale `initFiltres()`** depuis le fichier `filtres.js`.

```js
document.addEventListener("DOMContentLoaded", () => {
```

* Attends que **tout le HTML soit chargé**, pour être sûr que tous les éléments soient disponibles.

```js
  const form = document.getElementById("filter-form");
  const cardsContainer = document.getElementById("ai32-cards");
  const cards = Array.from(document.querySelectorAll(".carte-resultat"));
  const globalInput = document.getElementById("ai32-global-search");
  const clearBtn = document.getElementById("clear-global-search");
  const pagination = document.getElementById("pagination");
  const parPageSelect = document.getElementById("cards-par-page");
```

* Ces lignes **récupèrent tous les éléments HTML utiles** : le formulaire de filtre, les cartes, le champ de recherche global, le bouton de réinitialisation, la pagination, et la sélection du nombre de cartes par page.

```js
  if (form && cards.length > 0) {
    initFiltres({
      form,
      cardsContainer,
      cards,
      globalInput,
      clearBtn,
      pagination,
      parPageSelect,
    });
  }
```

* Si on a bien un formulaire et des cartes, on appelle `initFiltres()` avec tous les éléments nécessaires à la logique de filtrage.

---

## ✅ FICHIER `filtres.js` – **La logique complète du filtre**

Ce fichier contient **tout le cœur du fonctionnement des filtres, de la recherche et de la pagination**.

---

### 🔧 Fonction `initFiltres({ ... })`

Fonction appelée une fois que tous les éléments sont prêts.

#### 1. **Initialisation**

```js
let cardsParPage = parseInt(localStorage.getItem("cardsParPage") || parPageSelect.value, 10);
```

* Récupère depuis le **localStorage** (mémorisation du navigateur) le nombre de cartes par page, sinon utilise la valeur par défaut du `<select>`.

```js
parPageSelect.value = cardsParPage;
let filteredCards = [];
let currentPage = 1;
cardsContainer.classList.add("hidden");
```

* Initialise : tableau de cartes filtrées vide, page actuelle = 1, cache les cartes au départ.

---

### 🧩 Fonction `afficherCartes()`

Affiche **uniquement les cartes visibles** sur la page actuelle.

```js
const start = (currentPage - 1) * cardsParPage;
const paginatedCards = filteredCards.slice(start, start + cardsParPage);
```

* Calcule les cartes à afficher en fonction de la page actuelle.

```js
cardsContainer.innerHTML = "";
paginatedCards.forEach((card) => cardsContainer.appendChild(card));
```

* Vide le conteneur, puis ajoute les cartes à afficher.

---

### 📄 Fonction `afficherPagination()`

Gère les **boutons "Précédent", "Suivant"**, et le numéro de page.

```js
const totalPages = Math.ceil(filteredCards.length / cardsParPage);
```

* Calcule le **nombre total de pages**.

Crée les boutons :

```js
const prevBtn = document.createElement("button");
const nextBtn = document.createElement("button");
```

Ajoute des événements :

```js
prevBtn.onclick = () => { currentPage--; afficherCartes(); };
nextBtn.onclick = () => { currentPage++; afficherCartes(); };
```

---

### 🔠 Fonction `sortCards()`

Trie les cartes par **ordre alphabétique du nom** :

```js
filteredCards.sort((a, b) => {
  const nameA = a.dataset.nom || "";
  const nameB = b.dataset.nom || "";
  return nameA.localeCompare(nameB);
});
```

---

### 🔍 Fonction `applyFiltres()`

Quand on remplit les champs du formulaire :

```js
const formData = new FormData(form);
const filters = {};
for (const [key, value] of formData.entries()) {
  filters[key] = value.trim().toLowerCase();
}
```

* Récupère les valeurs des champs, les nettoie (trim + lowercase).

```js
filteredCards = cards.filter((card) => {
  return Object.entries(filters).every(([key, value]) =>
    !value || (card.dataset[key] || "").includes(value)
  );
});
```

* Filtre les cartes selon les champs de formulaire.
* `dataset[key]` correspond aux attributs HTML `data-*` (par ex. `data-nom`, `data-service`, etc.)

Puis trie et affiche :

```js
sortCards();
currentPage = 1;
afficherCartes();
```

---

### 🌐 Fonction `applyGlobalSearch()`

Recherche globale sur tous les champs :

```js
const query = globalInput.value.trim().toLowerCase();
```

```js
filteredCards = cards.filter((card) => {
  const allData = Object.values(card.dataset).join(" ").toLowerCase();
  return allData.includes(query);
});
```

* On concatène tous les `data-*` d'une carte pour une **recherche globale** (nom, service, fonction, etc.)

---

### 🧼 Réinitialisation

```js
document.getElementById("reset-filters").addEventListener("click", function () {
  form.reset();
  globalInput.value = "";
  clearBtn.style.display = "none";
  filteredCards = [];
  cardsContainer.classList.add("hidden");
  currentPage = 1;
  afficherPagination();
});
```

* Remet tout à zéro : formulaire, recherche, cartes.

---

### 🧠 Interactions utilisateur

#### Quand on tape dans la barre de recherche :

```js
globalInput.addEventListener("input", applyGlobalSearch);
```

#### Quand on clique sur le bouton "X" pour effacer :

```js
clearBtn.addEventListener("click", function () {
  globalInput.value = "";
  clearBtn.style.display = "none";
  filteredCards = [];
  cardsContainer.classList.add("hidden");
  currentPage = 1;
  afficherCartes();
});
```

#### Quand on clique sur un **lien de filtre rapide** dans une carte :

```js
document.querySelectorAll(".filter-click").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const type = this.dataset.type;
    const value = this.dataset.value;

    form.reset();
    globalInput.value = "";
    clearBtn.style.display = "none";

    const input = document.getElementById(`filter-${type}`);
    if (input) {
      input.value = value;
    }

    applyFiltres();
  });
});
```

* Pré-remplit le champ concerné (ex : `Direction`) et applique le filtre.

---

### 🔁 Changement du nombre de cartes par page

```js
parPageSelect.addEventListener("change", function () {
  cardsParPage = parseInt(this.value, 10);
  localStorage.setItem("cardsParPage", cardsParPage);
  currentPage = 1;
  afficherCartes();
});
```

* Change dynamiquement le nombre de résultats visibles, et sauvegarde ce choix pour la prochaine visite.

---

## ✅ Résumé de ce que tu peux dire en présentation :

> Ce système permet à l'utilisateur de filtrer dynamiquement un annuaire selon plusieurs critères (nom, service, DGA, etc.). Le fichier `main.js` initialise le tout dès que le document est chargé, tandis que `filtres.js` gère toute la logique : filtres avancés, recherche globale, pagination, tri alphabétique et interactions utilisateur.
>
> C'est optimisé avec du stockage local (`localStorage`) pour mémoriser le choix utilisateur, et tout repose sur des `data-*` dans les cartes HTML pour un filtrage très performant **sans recharger la page**.

---

Souhaitez-vous aussi un **diaporama**, un **document à imprimer** ou un **script de présentation orale** ?


------------------------------------------------------------------------------------------------------------------------------------
Parfait ! Voici une **présentation complète en trois formats** que tu pourras utiliser selon tes besoins :

---

## 🖼️ 1. Diaporama (format pour PowerPoint / Google Slides)

### **Slide 1 – Titre**

**Filtrage dynamique de fiches (JS)**
🔍 **Recherche – Filtres – Pagination**

---

### **Slide 2 – Objectif du script**

* Permettre aux utilisateurs de **filtrer, rechercher et trier** une liste de fiches (ou cartes) dynamiquement.
* Offrir une **expérience fluide** sans rechargement de page.
* Fonctionne avec **HTML + JavaScript** pur.

---

### **Slide 3 – main.js**

* Fichier principal exécuté au chargement.
* Récupère tous les éléments HTML nécessaires.
* Appelle la fonction `initFiltres()` depuis `filtres.js`.

✅ Sépare bien **logique** et **initialisation**.

---

### **Slide 4 – filtres.js : initialisation**

* Fonction `initFiltres({...})` reçoit tous les éléments HTML.
* Récupère les **préférences utilisateur** (nombre de cartes par page).
* Cache les résultats au départ.

---

### **Slide 5 – Recherche et Filtres**

* `applyFiltres()` : filtre via les champs du formulaire.
* `applyGlobalSearch()` : recherche **globale** dans tous les champs `data-*`.
* Résultats filtrés stockés dans `filteredCards`.

---

### **Slide 6 – Pagination**

* `afficherCartes()` : n’affiche que les cartes d’une page.
* `afficherPagination()` : ajoute boutons "Précédent" / "Suivant".
* La pagination est recalculée à chaque action.

---

### **Slide 7 – Tri alphabétique**

* `sortCards()` : trie les cartes par nom (champ `data-nom`).
* Utilise `localeCompare()` pour un tri **alphabétique universel**.

---

### **Slide 8 – Réinitialisation**

* Bouton "Réinitialiser les filtres" :

  * Vide les champs,
  * Réinitialise la pagination,
  * Cache les résultats.
* Le bouton "X" efface la recherche globale.

---

### **Slide 9 – Autres fonctionnalités**

* Liens cliquables `.filter-click` pour appliquer un filtre rapide (ex : clic sur "DGA").
* Sélecteur du nombre de cartes par page, avec mémoire (`localStorage`).

---

### **Slide 10 – Conclusion**

🧠 Code modulaire, simple à maintenir.
⚙️ 100% dynamique, sans rechargement.
✅ Compatible avec des centaines de fiches.
📦 Réutilisable pour tout type de fiche : agents, produits, services, etc.

---

## 📝 2. Document à imprimer (résumé pour validation)

---

### 📄 Titre : Fonctionnement des fichiers `main.js` et `filtres.js`

#### 🔹 `main.js`

* S’occupe d’attendre que la page soit chargée.
* Récupère les éléments HTML nécessaires (formulaire, cartes, pagination…).
* Appelle la fonction `initFiltres()` du fichier `filtres.js`.

#### 🔹 `filtres.js`

* **Initialise les filtres** à partir des éléments reçus.
* Utilise un tableau temporaire `filteredCards` pour stocker les résultats.
* Prend en compte :

  * Les **champs de formulaire** (par filtre),
  * La **recherche globale** (barre de recherche),
  * Le **tri alphabétique** (automatique),
  * La **pagination** (selon choix utilisateur).

#### 🔹 Points forts

* Aucune requête serveur : tout se passe en **JavaScript côté client**.
* Très réactif même avec de nombreuses cartes.
* Utilise `data-*` pour rendre le code HTML plus flexible.

#### 🔹 Interaction utilisateur

* Mise à jour automatique des résultats dès qu’un filtre est changé.
* Affichage intelligent des boutons "Précédent" / "Suivant".
* Recherche rapide dans **tous les champs** d’une carte.
* Mémoire utilisateur grâce au `localStorage`.

---

## 🎙️ 3. Script de présentation orale (2-3 minutes)

> Bonjour, je vous présente ici le fonctionnement des scripts `main.js` et `filtres.js` qui permettent de filtrer dynamiquement une liste de fiches.
>
> `main.js` est très simple : il attend que la page HTML soit prête, puis initialise la logique des filtres en appelant la fonction `initFiltres()`.
> Tous les éléments HTML importants (formulaire, cartes, champ de recherche, pagination…) sont récupérés et transmis à cette fonction.
>
> `filtres.js` contient toute la logique du filtrage :
>
> * Les utilisateurs peuvent filtrer via les champs du formulaire ou rechercher dans tous les champs en une seule fois.
> * Les résultats sont triés par ordre alphabétique, affichés par page, et la pagination est générée dynamiquement.
> * Il y a aussi des filtres rapides (liens dans les cartes) qui permettent d'appliquer un filtre en un clic.
>
> Tout est instantané, sans rechargement de page, et le nombre de résultats par page est mémorisé entre les sessions.
>
> C’est un système robuste, évolutif, et facilement réutilisable dans d’autres contextes comme un annuaire, un catalogue de produits, ou une bibliothèque.

---

Souhaites-tu que je génère un **fichier PowerPoint ou PDF prêt à l'emploi** ? Si oui, indique ton **préférence de format** (PowerPoint `.pptx`, PDF, Google Slides, etc.) et je le prépare pour toi.
