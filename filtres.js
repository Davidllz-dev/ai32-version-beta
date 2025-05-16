document.addEventListener("DOMContentLoaded", function () {
    

    const filterForm = document.getElementById("filter-form");
    const cardsContainer = document.getElementById("ai32-cards");
    const allCards = Array.from(document.querySelectorAll(".carte-resultat"));
    const globalSearchInput = document.getElementById("ai32-global-search");
    const clearSearchBtn = document.getElementById("clear-global-search");
    const paginationContainer = document.getElementById("pagination");

    const cardsPerPageSelect = document.getElementById("cards-par-page");
    let cardsPerPage = parseInt(localStorage.getItem("cardsPerPage") || cardsPerPageSelect.value, 6);
    cardsPerPageSelect.value = cardsPerPage;
    
    let filteredCards = [];
    let currentPage = 1;

    cardsContainer.classList.add("hidden");
    cardsPerPageSelect.addEventListener("change", function () {
        cardsPerPage = parseInt(this.value, 10);
        localStorage.setItem("cardsPerPage", cardsPerPage);
        currentPage = 1;
        afficherCartes();
    });


    function afficherCartes() {
        if (filteredCards.length === 0) {
            cardsContainer.classList.add("hidden");
        } else {
            cardsContainer.classList.remove("hidden");
        }

        cardsContainer.innerHTML = "";
        const start = (currentPage - 1) * cardsPerPage;
        const paginatedCards = filteredCards.slice(start, start + cardsPerPage);

        paginatedCards.forEach(card => cardsContainer.appendChild(card));
        afficherPagination();
    }

    function afficherPagination() {
        paginationContainer.innerHTML = "";
        const totalPages = Math.ceil(filteredCards.length / cardsPerPage);

        if (totalPages <= 1) return;

        const prevBtn = document.createElement("button");
        prevBtn.textContent = " Précédent";
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => {
            currentPage--;
            afficherCartes();
        };
        paginationContainer.appendChild(prevBtn);

        const pageInfo = document.createElement("span");
        pageInfo.textContent = ` Page ${currentPage} / ${totalPages} `;
        paginationContainer.appendChild(pageInfo);

        const nextBtn = document.createElement("button");
        nextBtn.textContent = "Suivant ";
        nextBtn.disabled = currentPage === totalPages;
        nextBtn.onclick = () => {
            currentPage++;
            afficherCartes();
        };
        paginationContainer.appendChild(nextBtn);
    }

    function sortCards() {
        filteredCards.sort((a, b) => {
            const nameA = a.dataset.nom || "";
            const nameB = b.dataset.nom || "";
            return nameA.localeCompare(nameB);
        });
    }

    function applyFiltres() {
        const formData = new FormData(filterForm);
        const filters = {};
        for (const [key, value] of formData.entries()) {
            filters[key] = value.trim().toLowerCase();
        }

        filteredCards = allCards.filter(card => {
            return Object.entries(filters).every(([key, value]) =>
                !value || (card.dataset[key] || "").includes(value)
            );
        });

        sortCards();
        currentPage = 1;
        afficherCartes();
    }

    function applyGlobalSearch() {
        const query = globalSearchInput.value.trim().toLowerCase();
        clearSearchBtn.style.display = query ? "block" : "none";

        filteredCards = allCards.filter(card => {
            const allData = Object.values(card.dataset).join(" ").toLowerCase();
            return allData.includes(query);
        });

        sortCards();
        currentPage = 1;
        afficherCartes();
    }

    filterForm.addEventListener("submit", function (e) {
        e.preventDefault();
        applyFiltres();
    });

    document.getElementById("reset-filters").addEventListener("click", function () {
        filterForm.reset();
        globalSearchInput.value = "";
        clearSearchBtn.style.display = "none";

        cardsContainer.classList.add("hidden"); 
        filteredCards = [];

        afficherPagination(); 
    });

    globalSearchInput.addEventListener("input", applyGlobalSearch);
    clearSearchBtn.addEventListener("click", function () {
        globalSearchInput.value = "";
        clearSearchBtn.style.display = "none";
        filteredCards = [];
        sortCards();
        currentPage = 1;
        afficherCartes();
    });


    document.querySelectorAll('.filter-click').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const type = this.dataset.type;
            const value = this.dataset.value;

            filterForm.reset();
            globalSearchInput.value = "";
            clearSearchBtn.style.display = "none";

            const input = document.getElementById(`filter-${type}`);
            if (input) {
                input.value = value;
            }

            applyFiltres();
        });
    });

   
});