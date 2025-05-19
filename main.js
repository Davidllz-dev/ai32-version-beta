"use strict";
import { initFiltres } from './filtres.js';

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("filter-form");
  const cardsContainer = document.getElementById("ai32-cards");
  const cards = Array.from(document.querySelectorAll(".carte-resultat"));
  const globalInput = document.getElementById("ai32-global-search");
  const clearBtn = document.getElementById("clear-global-search");
  const pagination = document.getElementById("pagination");
  const parPageSelect = document.getElementById("cards-par-page");

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
});

