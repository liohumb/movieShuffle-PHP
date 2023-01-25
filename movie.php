<?php
    function convertTime($sec): float|int
    {
        return $sec / 60;
    }

    $id = false;
    $data = array('title' => 'Film Introuvable');

    if (isset($_GET['id'])) {
        $datas = file_get_contents('data/movies.json');
        $movies = json_decode($datas, true);

        foreach ($movies as $movie) {
            if ($movie['id'] == $_GET['id']) {
                $id = true;
                $movie['duration'] = convertTime($movie['duration']);
                $data = $movie;
            }
        }
    }
?>

<?php include('templates/header.php') ?>

<section class="movie">
    <div class="movie__container">
        <img src="assets/images/poster/<?= str_replace(' ', '-', $data['title']) ?>.jpg"
             alt="<?= $data['title'] ?>" class="movie__poster">
        <div class="movie__content">
            <div class="movie__content-infos">
                <span class="movie__content-year"><?= substr($data['releaseDate'], 0, 4) ?></span>
                <h1 class="movie__content-title"><?= $data['title'] ?></h1>
            </div>
            <p class="movie__content-description"><?= $data['description'] ?></p>
            <div class="movie__content-infos">
                <span class="movie__content-gender"><?= implode(", ", $data['genres']) ?></span>
                <span class="movie__content-info">
                    <?= number_format($data['duration'], '2', ' h ') ?>
                    min -
                    <?= date('d/m/Y', strtotime($data['releaseDate'])) ?>
                </span>
            </div>
            <a href="<?= $data['video'] ?>" target="_blank" class="movie__content-button">Bande annonce</a>
        </div>
    </div>
</section>
