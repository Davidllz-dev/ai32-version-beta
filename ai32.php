<?php if (count($resultats) > 0): ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Annuaire CD32</title>
        <link rel="stylesheet" href="<?= AI32_URL . 'public/css/filtres.css?v=2.0'; ?>">
        <script type="module" src="<?= AI32_URL . 'public/js/main.js?v=1.0'; ?>"></script>
    </head>

    <body>
        <div class="container">

            
            <div class="ai32-search-bar-container">
                <input type="text" id="ai32-global-search" class="ai32-search-bar"
                    placeholder="Recherche par nom, direction, service, etc.">
                <button id="clear-global-search" style="cursor:pointer;">X</button>
            </div>

         
            <?php if (is_array($resultats)): ?>
                <div id="ai32-cards" class="resultats-container">
                    <?php foreach ($resultats as $res): ?>
                        <?php
                       
                        $sn         = htmlspecialchars($res['sn'] ?? '');
                        $prenom     = htmlspecialchars($res['givenname'] ?? '');
                        $mobile     = str_replace(' ', '', $res['mobile'] ?? '');
                        $fixe       = str_replace(' ', '', $res['extensionattribute9'] ?? '');
                        $dga        = htmlspecialchars($res['extensionattribute10'] ?? '');
                        $direction  = htmlspecialchars($res['extensionattribute11'] ?? '');
                        $service    = htmlspecialchars($res['extensionattribute12'] ?? '');
                        $pole       = htmlspecialchars($res['extensionattribute13'] ?? '');
                        $fonction   = htmlspecialchars($res['title'] ?? '');
                        $division   = htmlspecialchars($res['division'] ?? '');
                        ?>

                        <div class="carte-resultat"
                            data-nom="<?= strtolower($sn) ?>"
                            data-prenom="<?= strtolower($prenom) ?>"
                            data-telephone="<?= strtolower(trim($fixe . ' ' . $mobile)) ?>"
                            data-dga="<?= strtolower($dga) ?>"
                            data-direction="<?= strtolower($direction) ?>"
                            data-service="<?= strtolower($service) ?>"
                            data-pole="<?= strtolower($pole) ?>"
                            data-fonction="<?= strtolower($fonction) ?>"
                            data-division="<?= strtolower($division) ?>">

                            <p><strong>Nom :</strong> <?= $sn ?></p>
                            <p><strong>Prénom :</strong> <?= $prenom ?></p>

                            <p><strong>Téléphone :</strong><br>
                                <?php if ($mobile): ?>
                                    <a href="tel:<?= $mobile ?>"><?= chunk_split($mobile, 2, ' ') ?></a><br>
                                <?php endif; ?>
                                <?php if ($fixe): ?>
                                    <a href="tel:<?= $fixe ?>"><?= chunk_split($fixe, 2, ' ') ?></a>
                                <?php endif; ?>
                            </p>

                            <p><strong>DGA :</strong> <?= $dga ?></p>

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

                            <p><strong>Fonction :</strong> <?= $fonction ?></p>
                            <p><strong>Division :</strong> <?= $division ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

          
            <div class="pagination-options">
                <label for="cards-par-page">Lignes / page :</label>
                <select id="cards-par-page">
                    <option value="6" selected>6</option>
                    <option value="10">10</option>
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
                        <h3>Filtres :</h3>
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
                        foreach ($filtres as $key => $label): ?>
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
    </body>
    </html>

<?php else: ?>
    <div class="ai32-no-resultats">
        <p>Error 404 : Pas d'annuaire CD32 trouvé.</p>
    </div>
<?php endif; ?>


    </body>

    </html>
