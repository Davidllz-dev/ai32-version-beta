

---

## 🧩 Fonctionnalités complémentaires

### 🔘 **Filtres cliquables (`.filter-click`)**

📌 **Description :**
Certains champs comme *Direction*, *Service*, ou *Pôle* dans chaque carte sont **des liens interactifs**.

🧠 **Fonction :**

* En cliquant sur un lien, il :

  * Réinitialise tous les champs
  * Applique automatiquement un filtre sur le champ correspondant (ex: direction)
  * Met à jour l’affichage des résultats

🧩 **Code JS :**

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

---

### 📊 **Choix du nombre de cartes par page**

📌 **Élément :**

```html
<select id="cards-par-page">...</select>
```

🔧 **Fonctionnalité :**

* Permet à l'utilisateur de choisir combien de cartes s'affichent par page : 6, 10, 25, 50, etc.
* La valeur est **mémorisée** dans `localStorage`, donc conservée même après actualisation de la page.

🧩 **Code JS :**

```js
let cardsParPage = parseInt(localStorage.getItem("cardsParPage") || parPageSelect.value, 10);
parPageSelect.value = cardsParPage;

parPageSelect.addEventListener("change", function () {
  cardsParPage = parseInt(this.value, 10);
  localStorage.setItem("cardsParPage", cardsParPage);
  currentPage = 1;
  afficherCartes();
});
```

---

### 🧱 **Système totalement modulaire**

📌 **Structure modulaire :**

* La logique d'affichage, de filtrage, de pagination, et de recherche est centralisée dans une seule fonction : `initFiltres({ ... })`
* Les composants sont injectés (formulaires, cartes, boutons, etc.) sous forme de paramètres, ce qui :

  * Permet la **réutilisation** du module dans d'autres pages ou projets
  * Sépare clairement la **logique JavaScript** de la **structure HTML**

🧩 **Appel du module dans `main.js` :**

```js
initFiltres({
  form,
  cardsContainer,
  cards,
  globalInput,
  clearBtn,
  pagination,
  parPageSelect,
});
```

---

### ✅ Résumé pour la diapositive :

**Fonctionnalités complémentaires**

* 🔘 **Filtres cliquables** : clic sur un champ → filtre appliqué instantanément
* 📊 **Sélection du nombre de cartes par page** avec mémorisation (localStorage)
* 🧱 **Système modulaire** : paramétrable et réutilisable facilement

---

Souhaitez-vous que je transforme ceci en **fichier PowerPoint (.pptx)** ?
