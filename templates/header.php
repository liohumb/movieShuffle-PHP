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

        <main class="main">
