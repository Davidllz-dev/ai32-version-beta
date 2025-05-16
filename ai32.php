<?php if (count($resultats) > 0):  ?>
    <link rel="stylesheet" href="<?php echo AI32_URL . 'public/css/filtres.css?v=2.0'; ?>">
    <script src="<?php echo AI32_URL . 'public/js/filtres.js?v=1.0'; ?>" defer></script>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>


        <?php if (isset($resultats) && is_array($resultats)): ?>
            <div class="container">

                <div class="ai32-search-bar-container">
                    <input type="text" id="ai32-global-search" class="ai32-search-bar"
                        placeholder="Recherche par nom, direction, service, etc.">
                    <div id="clear-global-search" style="cursor:pointer;">X</div>
                </div>

                <!-- <div class="image-centrale">
                    <img src="<?= AI32_URL ?>public/images/GersIMG.png" alt="Image centrale">
                </div> -->

                <div id="ai32-cards" class="resultats-container">

                    <?php foreach ($resultats as $res): ?>
                        <div class="carte-resultat" data-nom="<?= strtolower($res['sn'] ?? '') ?>"
                            data-prenom="<?= strtolower($res['givenname'] ?? '') ?>"
                            data-telephone="<?= strtolower(($res['extensionattribute9'] ?? '') . ' ' . ($res['mobile'] ?? '')) ?>"
                            data-dga="<?= strtolower($res['extensionattribute10'] ?? '') ?>"
                            data-direction="<?= strtolower($res['extensionattribute11'] ?? '') ?>"
                            data-service="<?= strtolower($res['extensionattribute12'] ?? '') ?>"
                            data-pole="<?= strtolower($res['extensionattribute13'] ?? '') ?>"
                            data-fonction="<?= strtolower($res['title'] ?? '') ?>"
                            data-division="<?= strtolower($res['division'] ?? '') ?>">

                            <p><strong>Nom :</strong> <?= htmlspecialchars($res['sn'] ?? '') ?>
                            </p>
                            <p><strong>Prénom :</strong> <?= htmlspecialchars($res['givenname'] ?? '') ?>
                            </p>
                            <p><strong>Téléphone :</strong><br>
                                <a href="tel:<?= str_replace(' ', '', $res['mobile'] ?? '') ?>">
                                    <?= chunk_split(str_replace(' ', '', $res['mobile'] ?? ''), 2, ' ') ?>
                                </a><br>
                                <a href="tel:<?= str_replace(' ', '', $res['extensionattribute9'] ?? '') ?>">
                                    <?= chunk_split(str_replace(' ', '', $res['extensionattribute9'] ?? ''), 2, ' ') ?>
                                </a>
                            </p>

                            <p><strong>DGA :</strong> <?= htmlspecialchars($res['extensionattribute10'] ?? '') ?>
                            </p>

                            <?php
                            $direction = htmlspecialchars($res['extensionattribute11'] ?? '');
                            $service = htmlspecialchars($res['extensionattribute12'] ?? '');
                            $pole = htmlspecialchars($res['extensionattribute13'] ?? '');
                            ?>
                            <p><strong>Direction :</strong>
                                <a href="#" class="filter-click" data-type="direction" data-value="<?= strtolower($direction) ?>">
                                    <?= $direction ?>
                                </a>
                            </p>
                            <p><strong>Service :</strong>
                                <a href="#" class="filter-click" data-type="service" data-value="<?= strtolower($service) ?>">
                                    <?= $service ?>
                                </a>
                            </p>
                            <p><strong>Pôle :</strong>
                                <a href="#" class="filter-click" data-type="pole" data-value="<?= strtolower($pole) ?>">
                                    <?= $pole ?>
                                </a>
                            </p>

                            <p><strong>Fonction :</strong> <?= htmlspecialchars($res["title"] ?? '') ?>
                            </p>
                            <p><strong>Division :</strong> <?= htmlspecialchars($res["division"] ?? '') ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


                </div>
                <div class="pagination-options">
                    <label for="cards-par-page">lignes / page:</label>
                    <select id="cards-par-page">
                        <option value="6">6</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>

                <div id="pagination" class="pagination-controls"></div>
                <div class="ai32-filtres">
                    <aside>
                        <form id="filter-form">
                            <h3>Filtres:</h3>
                            <?php
                            $filtres = [
                                "nom" => "Nom",
                                "prenom" => "Prénom",
                                "telephone" => "Téléphone",
                                "DGA" => "DGA",
                                "direction" => "Direction",
                                "service" => "Service",
                                "pole" => "Pôle",
                                "fonction" => "Fonction",
                                "division" => "Division"
                            ];
                            foreach ($filtres as $key => $label):
                            ?>
                                <label for="filter-<?= $key ?>"><?= $label ?> :</label>
                                <input type="text" id="filter-<?= $key ?>" name="<?= $key ?>"
                                    placeholder="Filtrer par <?= strtolower($label) ?>">
                            <?php endforeach; ?>
                            <button type="submit">Appliquer</button>
                            <button type="button" id="reset-filters">Réinitialiser</button>
                        </form>
                    </aside>
                </div>
            </div>
        <?php else: ?>
            <div class="ai32-no-resultats">
                <p>Error 404: Pas annuaire cd32 trouvée.</p>
            </div>
        <?php endif; ?>

    </body>

    </html>