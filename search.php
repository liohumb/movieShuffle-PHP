<?php
    $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $per_page = 4;
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $per_page;

        $query = "SELECT COUNT(*) as total FROM movie WHERE title LIKE :title";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':title', '%' . $search . '%');
        $stmt->execute();
        $total = $stmt->fetch();

        $query = "SELECT movie.id, movie.title, movie.description, 
                    GROUP_CONCAT(genre.name SEPARATOR ', ') AS genres 
                    FROM movie JOIN movie_genre ON movie.id = movie_genre.movie_id 
                    JOIN genre ON genre.id = movie_genre.genre_id 
                    WHERE movie.title LIKE :title GROUP BY movie.id, movie.title
                    LIMIT :per_page OFFSET :offset";

        $datas = $db->prepare($query);
        $datas->bindValue(':title', '%' . $search . '%');
        $datas->bindValue(':per_page', $per_page, PDO::PARAM_INT);
        $datas->bindValue(':offset', $offset, PDO::PARAM_INT);
        $datas->execute();
        $movies = $datas->fetchAll();
    }
?>

<?php include ('templates/header.php') ?>

<section class="search">
    <div class="search__container">
        <h1 class="search__count">
            <?= $total['total']?>
            <?= $total['total'] == 1 ? 'Film' : 'Films' ?>
            pour votre recherche
        </h1>
        <?php if(!empty($movies)) { ?>
            <?php foreach ($movies as $movie) { ?>
                <div class="search__movie">
                    <img src="assets/images/poster/<?= $movie['id'] . '-' . str_replace(' ', '-', strtolower($movie['title'])) ?>.jpg"
                         alt="<?= $movie['title'] ?>"
                         class="search__movie-poster">
                    <div class="search__movie-infos">
                        <a href="movie.php?id=<?= $movie['id'] ?>" class="search__movie-infos--title">
                            <h1 class="search__movie-infos--title---link"><?= $movie['title'] ?></h1>
                        </a>
                        <span class="search__movie-infos--gender"><?= $movie['genres'] ?></span>
                        <?php
                            $words = explode(' ', $movie['description']);
                            $description = implode(' ', array_slice($words, 0, 33));
                            $description .= (count($words) > 10) ? '...' : '';
                        ?>
                        <p class="search__movie-infos--description"><?= $description ?></p>
                    </div>
                </div>
            <?php } ?>
            <div class="search__pagination">
                <?php
                    $search = $_GET['search'];
                    $per_page = 4;
                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                ?>

                <?php if ($total['total'] > 4) { ?>
                    <?php if ($page > 1) { ?>
                        <a href="search.php?search=<?= $search ?>&page=<?= $page - 1 ?>" class="search__pagination-prev"><?= $page - 1 ?></a>
                    <?php } ?>
                    <span class="search__pagination-page"><?= $page ?></span>
                    <?php if (count($movies) == $per_page) { ?>
                        <a href="search.php?search=<?= $search ?>&page=<?= $page + 1 ?>" class="search__pagination-next"><?= $page + 1 ?></a>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p class="search__empty">Aucun résultat trouvé pour votre recherche</p>
        <?php } ?>
    </div>
</section>

<?php include ('templates/footer.php') ?>
