<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style_crous.css" />
    <link rel='stylesheet' href='css/style_navigation.css'>
    <link rel='stylesheet' href='css/dark_mode.css'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <title>Espace MMI | Menu</title>
    <link rel="icon" href="img/favicon.png">

</head>

<body>

<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: index.php?access_denied');
        exit();
    }

    ?>
    <header>
        <div class='menu'>

            <!-- Logo Accueil -->
            <a href='accueil.php'><img class="logo" src='./img/logo.svg' alt="page d'accueil"
                    aria-current="currentpage"></a>

            <!-- Navigation desktop -->
            <nav class='navigation'>
                <ul class='choix'>
                    <li><a href='cours.php'>Mes cours</a></li>
                    <li><a href='vie_etudiante.php'>Vie étudiante</a></li>
                    <li><a href='vie_scolaire.php'>Vie scolaire</a></li>
                    <li><a href='page_crous.php'>Crous</a></li>
                </ul>

                <!-- Barre de recherche -->
                <div class='group'>
                    <svg viewBox='0 0 24 24' aria-hidden='true' class='icon'>
                        <g>
                            <path
                                d='M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z'>
                            </path>
                        </g>
                    </svg>
                    <label for="barre de recherche"></label>
                    <input id="barre de recherche" class='input' type='search' placeholder='Search' />
                </div>

                <!-- minis icons + lien pdp permettant de se déconnecter et d'aller dans les paramètres  -->
                <div class='icon-photo'>
                    <a href='messagerie.php'><img class='lettre' src='./img/1-lettre.svg' alt="messagerie"></a>
                    <button class="dark_button" onclick="toggleDarkMode()"><img class='dark_mode' src='./img/1-moon.svg'
                            alt="mode sombre"></button>



                    <!-- PHP - LIEN VERS LA PAGE profil.php POUR MODIF LA PDP-->
                    <div class='photo-2'>

                        <?php
                        include('connexion.php');

                        if (isset($_SESSION["login"])) {
                            $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE login=:login');
                            $stmt->bindValue(':login', $_SESSION["login"], PDO::PARAM_STR);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                echo "
                                <a href='profil.php'> <img src='upload/{$result['photoprofil']}' alt='' class='photo-2'></a>";
                            }
                        }
                        ?>

                    </div>
                    <!-- FIN PHP-->
                    <form action="deconnexion.php" method="GET">
                        <button type="submit" name="deconnect" id="btnDeconnexion">
                            <img class="logout" src="img/1-logout.svg" alt="Déconnexion">
                        </button>
                    </form>

                </div>
            </nav>

            <!-- Navigation mobile & tablette -->
            <div class='menu-burger'>

                <span id='burger-menu'> <img class="img_menu" src='./img/menu.svg' alt='menu'></span>

                <nav class='burger'>


                    <!-- PHP/ STRUCTURE POUR ADAPTER A L UTILISATEUR   -->
                    <?php
                    include('connexion.php');

                    if (isset($_SESSION["login"])) {
                        $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE login=:login');
                        $stmt->bindValue(':login', $_SESSION["login"], PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo "
                            <div class='kelis'>
                                <div class='profil-1'>
                                    <a href='profil.php'>
                                        <div class='photo-1'>
                                        <img src='upload/{$result['photoprofil']}' class='photo-1' alt=''>
                                        </div>
                                    </a>
                                    <div class='profil-2'>";


                        echo "<h1> {$result['prenom']} {$result['nom']}</h1>";
                        echo "<p>{$result['promotion']}</p>";

                        echo "       </div>
                                </div>
                                <div class='profil-3'>
                                <h2>À propos</h2>";
                        echo "<p>{$result['bio']}</p> 
                                </div>
                            </div>";

                    }
                    ?>
                    <!-- FIN PHP   -->


                    <ul class='choix-2'>
                        <li><a href='cours.php'>Mes cours</a></li>
                        <li><a href='vie_etudiante.php'>Vie étudiante</a></li>
                        <li><a href='vie_scolaire.php'>Vie scolaire</a></li>
                        <li><a href='page_crous.php'>Crous</a></li>
                    </ul>


                    <div class='tools'>
                        <div class='tool'>
                            <img class="param" src='img/1-param.png' alt=''>
                            <a href='profil.php'><p>Profil</p></a>
                        </div>
                        <div class='tool'>
                            <img class="lettre" src='img/1-lettre.svg' alt=''>
                            <a href='messagerie.php'><p>Messagerie</p></a>
                        </div>
                        <div class='tool'>
                            <button class="flex_bouton" onclick="toggleDarkMode()"><img class='dark_mode'
                                    src='./img/1-moon.svg' alt="mode sombre">
                                <p>Mode sombre</p>
                            </button>
                        </div>
                        <div class='tool'>
                            <img class="logout" src='img/1-logout.svg' alt=''>
                            <form action="deconnexion.php" method="GET">
                                <button class="btnDeconnexion" type="submit" name="deconnect" id="btnDeconnexion">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>

                </nav>

                <div class='overlay'></div>

            </div>

        </div>

    </header>





    <div class="flex_tout">

        <div class="header_main">

            <div class="container presentation">
                <p>Bienvenue sur la page officielle du Centre Régional des Œuvres Universitaires et
                    Scolaires (CROUS) dédiée aux Restaurants Universitaires à Créteil.</p>
            </div>

            <main class="container">

                <section class="menu_hebdomadaire">
                    <h1>Menu hebdomadaire</h1>
                    <div class="card shadow">
                        <div class="infos">
                            <h2>Restaurant universitaire ESIEE:</h2>
                            <div>
                                <p>PAIEMENT POSSIBLE: <br>
                                    Carte bancaire <br>
                                    IZLY</p>
                                    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 'Membre du CROUS') {
          echo "<a href='ajouter_menu.php?lieu=ESIEE'><button class='btn add'>Ajouter menu</button></a>";
        } ?>
                                    <a href="menu_du_jour.php?lieu=ESIEE"><button class="btn">Voir le menu</button></a>
                            </div>
                        </div>
                        <hr class="border">
                        <div class="infos">
                            <h2>Restaurant universitaire Copernic:</h2>
                            <div>
                                <p>PAIEMENT POSSIBLE: <br>
                                    Carte bancaire <br>
                                    IZLY</p>

                                    <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 'Membre du CROUS') {
          echo "<a href='ajouter_menu.php?lieu=Copernic'><button class='btn add'>Ajouter menu</button></a>";
        } ?>
                                    <a href="menu_du_jour.php?lieu=Copernic"><button class="btn">Voir le menu</button></a>
                            </div>
                        </div>
                        <hr class="border">
                        <div class="infos">
                            <h2>Menu de la caféteria</h2>
                            <div>
                                <p>PAIEMENT POSSIBLE: <br>
                                    Carte bancaire <br>
                                    IZLY</p>
                                <a href="documents/menu.pdf"><button class="btn">Voir le menu</button></a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- La carte -->
                <section class="decouvrez_resto">
                    <h1>Découvrez nos Restaurants Universitaires</h1>
                    <div>
                        <div id="map"></div>
                        
                    </div>
                </section>

            </main>


        </div>

        <aside class="container horaires">
            <div class="card shadow">

                <h1>Horaires des Restaurants :</h1>

                <div class="flex">
                    <p>Lundi:</p>
                    <p>11h30 - 14h</p>
                </div>
                <hr class="border">
                <div class="flex">
                    <p>Mardi:</p>
                    <p>11h30 - 14h</p>
                </div>
                <hr class="border">
                <div class="flex">
                    <p>Mercredi:</p>
                    <p>11h30 - 14h</p>
                </div>
                <hr class="border">
                <div class="flex">
                    <p>Jeudi:</p>
                    <p>11h30 - 14h</p>
                </div>
                <hr class="border">
                <div class="flex">
                    <p>Vendredi:</p>
                    <p>11h30 - 14h</p>
                </div>
                <hr class="border">
                <div class="flex">
                    <p>Samedi:</p>
                    <p>Fermé</p>
                </div>
                <hr class="border">
                <div class="flex">
                    <p>Dimanche:</p>
                    <p>Fermé</p>
                </div>

            </div>
        </aside>

    </div>

    <footer>
        <a href='mentions_legales.html'>
            <p> Mentions légales </p>
        </a>
    </footer>



</body>
<script src="js/script_accueil.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

</html>

<script src='js/script_dark_mode.js'></script>

<script>
    var map = L.map('map').setView([48.83930298535587, 2.584485412835638], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// map.getContainer().style.filter = 'grayscale(100%)';


  var esiee = L.marker([48.83930298535587, 2.584485412835638],
  {alt: 'restaurant esiee'}).addTo(map).bindPopup('Restaurant universitaire ESIEE'),

    copernic    = L.marker([48.83915815998255, 2.5865923016626855],
  {alt: 'restaurant copernic'}).addTo(map).bindPopup('Restaurant universitaire Copernic'),

    gustave    = L.marker([48.83782595966588, 2.587036191587554],
  {alt: 'cafeteria gustave eiffel'}).addTo(map).bindPopup('Cafétéria IUT Gustave-Eiffel'),
    golden    = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.');



</script>