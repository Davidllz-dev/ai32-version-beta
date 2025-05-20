Voici un **plan complet pour une présentation PowerPoint** sur le code PHP que vous avez fourni. Cette présentation est pensée pour être claire, 
pédagogique et structurée, idéale pour une soutenance ou une documentation technique.

---

## 🎯 Objectif de la Présentation

Créer un PowerPoint (ou support équivalent) pour présenter et expliquer :

* Les fonctionnalités du code PHP (affichage des résultats)
* Les méthodes PHP utilisées (fonctions, logique conditionnelle, affichage HTML dynamique)
* L’intégration front-end avec JavaScript
* Le lien avec les fichiers JS (comme `filtres.js`)

---

### 🖼️ **Slide 1 : Titre**

**Titre :**
Structure et fonctionnement du module PHP d'affichage de l’annuaire CD32

**Sous-titre :**
Analyse du code dynamique, de l'intégration JS et des méthodes PHP utilisées.

---

### 🧠 **Slide 2 : Vue d’ensemble du fonctionnement**

* Ce script PHP affiche dynamiquement les résultats d’un annuaire.
* Il utilise les données récupérées de `$resultats`.
* Chaque fiche est générée dans une **"carte" HTML** avec des attributs `data-*`.
* Il est couplé au JavaScript (`main.js` + `filtres.js`) pour permettre le filtrage, la recherche et la pagination.

---

### 🔍 **Slide 3 : Condition principale d'affichage**

```php
<?php if (count($resultats) > 0): ?>
```

* Vérifie si `$resultats` contient au moins un élément.
* **Sinon** : affiche un message d’erreur 404.

---

### 🧱 **Slide 4 : Structure HTML Dynamique**

#### Contenu dynamique généré :

* `<div class="carte-resultat">`
* Rempli avec :

  * Nom, prénom, téléphone, direction, service, etc.
  * Chaque champ provient des données LDAP récupérées (ou d’une base).

---

### 🧩 **Slide 5 : Méthodes PHP utilisées**

| Méthode / Fonction   | Description                           | Application                   |
| -------------------- | ------------------------------------- | ----------------------------- |
| `htmlspecialchars()` | Sécurise l'affichage HTML             | Évite les failles XSS         |
| `str_replace()`      | Supprime les espaces dans les numéros | Normalisation                 |
| `chunk_split()`      | Formate les numéros (ex: 06 01 02...) | Affichage lisible             |
| `isset()` / `??`     | Gère les valeurs nulles               | Définit une valeur par défaut |
| `foreach`            | Boucle sur `$resultats`               | Crée les cartes HTML          |
| `count()`            | Compte les résultats                  | Contrôle l'affichage initial  |
| `strtolower()`       | Minuscule pour comparaisons JS        | Uniformité `data-*`           |

---

### 🏷️ **Slide 6 : Attributs `data-*` des cartes**

Exemples :

```html
<div class="carte-resultat"
     data-nom="durand"
     data-prenom="jean"
     data-telephone="0123456789"
     data-direction="informatique"
     ...>
```

➡ Ces attributs sont utilisés par **JavaScript** pour :

* Filtrer dynamiquement les résultats
* Rechercher globalement dans les données
* Appliquer des filtres personnalisés

---

### 🧪 **Slide 7 : Fonctionnalité de filtrage (JS)**

* Champs `<input>` pour chaque critère (nom, prénom, direction, etc.)
* Formulaire avec ID `filter-form`
* Intégré avec `filtres.js` pour :

  * **Filtrer localement** les cartes
  * **Réinitialiser** les champs
  * **Rechercher globalement** via une barre de recherche

---

### 🎛️ **Slide 8 : Interaction avec JavaScript**

* `main.js` initialise les filtres avec la fonction `initFiltres()`
* Dynamique :

  * Affichage conditionnel
  * Pagination personnalisable
  * Application des filtres

---

### 🧹 **Slide 9 : Cas de réinitialisation / erreurs**

```php
<button type="button" id="reset-filters">Réinitialiser</button>
```

* Permet à l’utilisateur de nettoyer les champs
* JS réagit pour réafficher tous les résultats

---

### 📉 **Slide 10 : Affichage conditionnel en cas d’erreur**

```php
<?php else: ?>
    <div class="ai32-no-resultats">
        <p>Error 404 : Pas d'annuaire CD32 trouvé.</p>
    </div>
<?php endif; ?>
```

➡ Utilisation de **`else`** PHP pour afficher un message alternatif si aucun résultat n’est disponible.

---

### 📌 **Slide 11 : Résumé des bonnes pratiques utilisées**

✅ Échappement des valeurs avec `htmlspecialchars()`
✅ Respect de la séparation logique : données, HTML, JS
✅ Utilisation des `data-*` pour interopérabilité front-end
✅ Pagination et filtrage côté client pour meilleure UX

---

### 📚 **Slide 12 : Conclusion**

* Le fichier PHP génère des **cartes dynamiques** exploitables côté client.
* Il est conçu pour **collaborer** avec JavaScript (filtrage, recherche, pagination).
* Sécurisé, clair, extensible.

---

Souhaitez-vous que je vous exporte cette structure en fichier PowerPoint (.pptx) prêt à télécharger ?



----------------------------------------------------------------------------------------------------------------------------------------------

Voici une **liste complète des méthodes JavaScript utilisées** dans les fichiers `filtres.js` et `main.js`, accompagnée :

1. **de leur usage général (normal)**
2. **et de leur application concrète dans les fichiers fournis.**

---

## 🔧 **Méthodes utilisées dans filtres.js et main.js**

---

### 1. **`parseInt()`**

* **Usage général :** Convertit une chaîne de caractères en nombre entier.
* **Application dans `filtres.js` :**

  ```js
  let cardsParPage = parseInt(localStorage.getItem("cardsParPage") || parPageSelect.value, 10);
  ```

  Sert à convertir la valeur du nombre de cartes par page en entier.

---

### 2. **`localStorage.getItem()` / `localStorage.setItem()`**

* **Usage général :** Stocker et récupérer des données localement dans le navigateur.
* **Application :**

  * `getItem` : récupérer le nombre de cartes à afficher par page.
  * `setItem` : sauvegarder ce nombre lorsque l’utilisateur le modifie.

---

### 3. **`classList.add()` / `classList.remove()`**

* **Usage général :** Ajouter ou retirer une classe CSS d’un élément DOM.
* **Application :**

  ```js
  cardsContainer.classList.add("hidden");
  cardsContainer.classList.remove("hidden");
  ```

  Contrôle de la visibilité des cartes filtrées.

---

### 4. **`innerHTML`**

* **Usage général :** Lire ou modifier le contenu HTML d’un élément.
* **Application :**

  ```js
  cardsContainer.innerHTML = "";
  pagination.innerHTML = "";
  ```

  Réinitialise le contenu avant d’insérer les nouvelles cartes ou la pagination.

---

### 5. **`slice()`**

* **Usage général :** Extraire une portion d’un tableau sans le modifier.
* **Application :**

  ```js
  const paginatedCards = filteredCards.slice(start, start + cardsParPage);
  ```

  Sélectionne les cartes à afficher sur la page actuelle.

---

### 6. **`forEach()`**

* **Usage général :** Itérer sur un tableau et exécuter une fonction pour chaque élément.
* **Application :**
**Présentation PowerPoint : JavaScript - Méthodes Utilisées dans `filtres.js` et `main.js`**

---

### **Slide 1: Titre**

**Titre :** Méthodes JavaScript Utilisées dans le Projet de Filtres
**Sous-titre :** Analyse des fonctions, méthodes et leur rôle dans les fichiers `filtres.js` et `main.js`

---

### **Slide 2: Introduction**

* **Objectif :** Présenter les principales méthodes JavaScript employées dans ce projet.
* **Fichiers analysés :**

  * `filtres.js`
  * `main.js`
* **Focus :** Utilisation générale + Application spécifique dans le code.

---

### **Slide 3: `parseInt`**

| Méthode    | Utilisation normale                   | Application dans le projet                                   |
| ---------- | ------------------------------------- | ------------------------------------------------------------ |
| `parseInt` | Convertir une chaîne en nombre entier | Utilisé pour convertir la valeur du sélecteur `cardsParPage` |

---

### **Slide 4: `addEventListener`**

| Méthode            | Utilisation normale                    | Application dans le projet                              |
| ------------------ | -------------------------------------- | ------------------------------------------------------- |
| `addEventListener` | Attacher un événement à un élément DOM | Utilisé pour les filtres, les champs de recherche, etc. |

---

### **Slide 5: `filter`**

| Méthode  | Utilisation normale                                            | Application dans le projet                                                |
| -------- | -------------------------------------------------------------- | ------------------------------------------------------------------------- |
| `filter` | Créer un nouveau tableau avec des éléments qui passent un test | Filtrer les cartes selon les champs de formulaire ou la recherche globale |

---

### **Slide 6: `sort` & `localeCompare`**

| Méthode         | Utilisation normale                            | Application dans le projet         |
| --------------- | ---------------------------------------------- | ---------------------------------- |
| `sort`          | Trier les éléments d'un tableau                | Trier les cartes filtrées par nom  |
| `localeCompare` | Comparer deux chaînes en fonction de la locale | Utilisé dans le callback de `sort` |

---

### **Slide 7: `forEach`**

| Méthode   | Utilisation normale                                   | Application dans le projet               |
| --------- | ----------------------------------------------------- | ---------------------------------------- |
| `forEach` | Exécuter une fonction sur chaque élément d'un tableau | Afficher chaque carte dans la pagination |

---

### **Slide 8: `querySelectorAll` / `getElementById`**

| Méthode            | Utilisation normale                | Application dans le projet                              |
| ------------------ | ---------------------------------- | ------------------------------------------------------- |
| `querySelectorAll` | Récupérer plusieurs éléments DOM   | Sélectionner les cartes                                 |
| `getElementById`   | Récupérer un élément unique par ID | Sélection du formulaire, input global, pagination, etc. |

---

### **Slide 9: `classList.add` / `classList.remove`**

| Méthode            | Utilisation normale                     | Application dans le projet              |
| ------------------ | --------------------------------------- | --------------------------------------- |
| `classList.add`    | Ajouter une classe CSS à un élément DOM | Masquer le conteneur des cartes si vide |
| `classList.remove` | Retirer une classe CSS d'un élément DOM | Montrer les cartes si filtrage réussi   |

---

### **Slide 10: `FormData` & `entries`**

| Méthode     | Utilisation normale                                  | Application dans le projet                       |
| ----------- | ---------------------------------------------------- | ------------------------------------------------ |
| `FormData`  | Créer un objet contenant les données d'un formulaire | Récupérer dynamiquement les champs du formulaire |
| `entries()` | Itérer sur les paires clé/valeur d'un objet          | Création des filtres dynamiques                  |

---

### **Slide 11: `slice`**

| Méthode | Utilisation normale              | Application dans le projet               |
| ------- | -------------------------------- | ---------------------------------------- |
| `slice` | Extraire une partie d'un tableau | Création de pages de cartes (pagination) |

---

### **Slide 12: Conclusion**

* Le projet met en œuvre des méthodes fondamentales de JavaScript.
* Une combinaison de manipulation DOM, logique de filtrage et pagination.
* Bonne séparation des responsabilités entre `filtres.js` (logique) et `main.js` (initialisation).

---

### **Slide 13: Questions ?**

**Merci de votre attention !**






















-------------------------------------------------------------------------------------------------------------------------------------------------------------------------

  ```js
  paginatedCards.forEach((card) => cardsContainer.appendChild(card));
  ```

  Affiche les cartes sur la page.

---

### 7. **`createElement()`**

* **Usage général :** Crée un nouvel élément HTML dans le DOM.
* **Application :**

  ```js
  const prevBtn = document.createElement("button");
  ```

  Crée les boutons de navigation pour la pagination.

---

### 8. **`textContent`**

* **Usage général :** Lire ou écrire le texte d’un élément DOM.
* **Application :**

  ```js
  pageInfo.textContent = ` Page ${currentPage} / ${totalPages} `;
  ```

  Affiche le numéro de la page courante.

---

### 9. **`addEventListener()`**

* **Usage général :** Écoute un événement sur un élément.
* **Application :**

  * Pour le formulaire :

    ```js
    form.addEventListener("submit", ...)
    ```
  * Pour le champ global :

    ```js
    globalInput.addEventListener("input", applyGlobalSearch);
    ```

---

### 10. **`preventDefault()`**

* **Usage général :** Empêche le comportement par défaut d’un événement (ex : rechargement d’un formulaire).
* **Application :**

  ```js
  e.preventDefault();
  ```

---

### 11. **`FormData()`**

* **Usage général :** Collecter automatiquement les données d’un formulaire.
* **Application :**

  ```js
  const formData = new FormData(form);
  ```

---

### 12. **`entries()`**

* **Usage général :** Renvoie les paires clé/valeur d’un objet ou d’un `FormData`.
* **Application :**

  ```js
  for (const [key, value] of formData.entries())
  ```

---

### 13. **`trim()`**

* **Usage général :** Supprime les espaces blancs autour d’une chaîne.
* **Application :**

  ```js
  value.trim().toLowerCase();
  ```

---

### 14. **`toLowerCase()`**

* **Usage général :** Convertit une chaîne en minuscules.
* **Application :** Rend la recherche insensible à la casse.

---

### 15. **`Object.entries()` / `Object.values()`**

* **Usage général :**

  * `entries()` : obtient les paires clé/valeur.
  * `values()` : obtient uniquement les valeurs.
* **Application :**

  ```js
  Object.entries(filters).every(...)
  Object.values(card.dataset).join(" ")
  ```

---

### 16. **`filter()`**

* **Usage général :** Crée un nouveau tableau contenant uniquement les éléments qui passent un test.
* **Application :**

  ```js
  filteredCards = cards.filter(...)
  ```

---

### 17. **`sort()`**

* **Usage général :** Trie un tableau.
* **Application :**

  ```js
  filteredCards.sort((a, b) => ...)
  ```

---

### 18. **`localeCompare()`**

* **Usage général :** Compare deux chaînes selon l’ordre alphabétique local.
* **Application :**

  ```js
  return nameA.localeCompare(nameB);
  ```

---

### 19. **`querySelectorAll()`**

* **Usage général :** Sélectionne tous les éléments correspondants à un sélecteur CSS.
* **Application :**

  ```js
  document.querySelectorAll(".filter-click")
  ```

---

### 20. **`getElementById()`**

* **Usage général :** Sélectionne un élément par son ID.
* **Application :** Utilisé de nombreuses fois pour accéder aux éléments du formulaire, champs de recherche, boutons, etc.

---

### 21. **`appendChild()`**

* **Usage général :** Ajoute un nœud enfant à un élément.
* **Application :**

  ```js
  cardsContainer.appendChild(card);
  ```

---

### 22. **`disabled` (propriété)**

* **Usage général :** Désactive un bouton HTML.
* **Application :**

  ```js
  prevBtn.disabled = currentPage === 1;
  ```

---

### 23. **`value` (propriété)**

* **Usage général :** Lire ou modifier la valeur d’un champ de formulaire.
* **Application :** Utilisé pour lire les champs du filtre et modifier ceux par défaut.

---

### 24. **`includes()`**

* **Usage général :** Vérifie si une chaîne contient une sous-chaîne.
* **Application :**

  ```js
  allData.includes(query)
  ```

---

### 25. **`join()`**

* **Usage général :** Assemble les éléments d’un tableau en une chaîne.
* **Application :**

  ```js
  Object.values(card.dataset).join(" ")
  ```

---

Souhaitez-vous que je transforme cette liste en un tableau PowerPoint ou PDF ?
