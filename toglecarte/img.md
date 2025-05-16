✅ 1. Ajout HTML de l’image

Ajoute ce bloc dans ton HTML, juste après la barre de recherche et avant le conteneur de cartes (#ai32-cards) :


<div class="ai32-image-centrale" id="image-centrale-container">
    <img src="<?= AI32_URL ?>public/images/GersIMG.png" alt="Image centrale">
</div>



✅ 2. Modification JS (ajoute dans ton DOMContentLoaded)

Ajoute cette logique pour afficher/cacher l’image selon l’état du champ de recherche :


const imageCentrale = document.getElementById("image-centrale-container");

function toggleImageCentrale() {
    const query = globalSearchInput.value.trim();
    if (query === "") {
        imageCentrale.style.display = "flex";
    } else {
        imageCentrale.style.display = "none";
    }
}

globalSearchInput.addEventListener("input", function () {
    applyGlobalSearch();
    toggleImageCentrale();
});

// Au chargement, s'assurer que l'image est visible si aucun texte
toggleImageCentrale();

// Aussi dans le bouton clear
clearSearchBtn.addEventListener("click", function () {
    globalSearchInput.value = "";
    clearSearchBtn.style.display = "none";
    filteredCards = [];
    sortCards();
    currentPage = 1;
    afficherCartes();
    toggleImageCentrale();
});



✅ 3. CSS pour l’image centrée verticalement et horizontalement

Ajoute dans filtres.css :


.ai32-image-centrale {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 40px auto;
    max-width: 500px;
    height: 300px;
    transition: opacity 0.3s ease;
}

.ai32-image-centrale img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    opacity: 0.85;
}



Parfait ! Pour que **l’image centrale apparaisse** quand **aucune recherche globale** *ni filtre latéral* n’est actif, il faut ajuster un peu le JS.

---

### ✅ 1. **Ajoute une fonction `aucunFiltreActif()`**

Cette fonction retournera `true` si **rien n’est rempli** dans les champs :

```js
function aucunFiltreActif() {
    const formData = new FormData(filterForm);
    const filtreActif = [...formData.values()].some(val => val.trim() !== "");
    const rechercheGlobale = globalSearchInput.value.trim() !== "";

    return !filtreActif && !rechercheGlobale;
}
```

---

### ✅ 2. **Mets à jour `toggleImageCentrale()` pour qu’elle l’utilise**

Modifie la fonction ainsi :

```js
function toggleImageCentrale() {
    if (aucunFiltreActif()) {
        imageCentrale.style.display = "flex";
    } else {
        imageCentrale.style.display = "none";
    }
}
```

---

### ✅ 3. **Ajoute `toggleImageCentrale()` dans tous les bons endroits**

#### Après les filtres :

```js
filterForm.addEventListener("submit", function (e) {
    e.preventDefault();
    applyFiltres();
    toggleImageCentrale();
});
```

#### Dans le bouton de réinitialisation :

```js
document.getElementById("reset-filters").addEventListener("click", function () {
    filterForm.reset();
    globalSearchInput.value = "";
    clearSearchBtn.style.display = "none";
    filteredCards = [];
    cardsContainer.classList.add("hidden");
    afficherPagination();
    toggleImageCentrale();
});
```

#### Déjà fait : `input` de la recherche globale et `clearSearchBtn`.

---

### ✅ 4. (Optionnel) Masque l’image si des résultats sont visibles

Tu peux renforcer l'effet visuel en **mettant l’image uniquement quand les cartes sont vides** :

Dans `afficherCartes()`, ajoute à la fin :

```js
toggleImageCentrale();
```

---

### ✅ Résumé comportement

| État recherche / filtres | Image visible ? | Cartes visibles ?    |
| ------------------------ | --------------- | -------------------- |
| Rien rempli              | ✅ oui           | ❌ non                |
| Saisie / filtre actif    | ❌ non           | ✅ oui (si résultats) |
| Tout réinitialisé        | ✅ oui           | ❌ non                |

---

Souhaite-tu que l’image soit aussi **centrée verticalement dans toute la fenêtre** si aucun résultat ?


