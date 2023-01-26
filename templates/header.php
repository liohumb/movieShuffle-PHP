<?php
    $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');

    $query = "SELECT name FROM genre";

    $datas = $db->prepare($query);
    $datas->execute();
    $genres = $datas->fetchAll();
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Movie Shuffle</title>
        <!-- BOX ICONS -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- STYLESHEET -->
        <link rel="stylesheet" href="assets/styles/css/style.css">
    </head>
    <body>
    <!-- NAVIGATION -->
        <header class="nav">
            <div class="nav__left">
                <button class="nav__menu">
                    <i class='bx bx-menu nav__menu-icon'></i>
                </button>
                <h1 class="nav__title">
                    <a href="index.php" class="nav__title-link">MovieShuffle</a>
                </h1>
            </div>
            <div class="nav__right">
                <form action="search.php" method="GET">
                    <label for="search" class="nav__search">
                        <i class='bx bx-search nav__search-icon'></i>
                    </label>
                    <input type="text" name="search" id="search" class="nav__search-input" placeholder="Rechercher (puis enter)">
                    <i class='bx bx-x nav__search-close'></i>
                </form>
            </div>
        </header>
        <nav class="nav__modal">
            <ul class="nav__modal-menu">
                <li>
                    <form action="search.php" method="GET" class="nav__modal-search">
                        <button type="submit" class="nav__modal-menu--search">
                            <i class='bx bx-search nav__modal-menu--search---icon'></i>
                        </button>
                        <input type="text" name="search" id="search" class="nav__modal-menu--search---input" placeholder="Rechercher un film">
                    </form>
                </li>
                <li>
                    <form action="gender.php" method="GET" class="nav__modal-gender">
                        <label for="gender" class="nav__modal-menu--gender">Choisissez un genre :</label>
                        <Select id="gender" class="nav__modal-menu--gender---select">
                            <?php foreach ($genres as $genre) { ?>
                                <option value="<?= $genre['name'] ?>" class="nav__modal-menu--gender---option"><?= $genre['name'] ?></option>
                            <?php } ?>
                        </Select>
                        <input type="submit" value="Rechercher" class="nav__modal-menu--gender---submit">
                    </form>
                </li>
                <li>
                    <a href="" class="nav__modal-menu--link">
                        <i class='bx bx-plus'></i>
                        Ajouter un film
                    </a>
                </li>
            </ul>
        </nav>

        <main class="main">
