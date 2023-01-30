<?php
    if (!empty($_POST)) {
        $name = trim(strip_tags($_POST['name']));

        $errors = [];

        if (empty($name)) {
            $errors['name'] = "Merci de saisir le nom du genre";
        }

        if (empty($errors)) {
            $db = new PDO("mysql:host=localhost:3306;dbname=movieShuffle", 'root', 'rootroot');
            $query = "SELECT COUNT(*) FROM genre WHERE name = :name";
            $datas = $db->prepare($query);
            $datas->bindParam(':name', $name);
            $datas->execute();
            $count = $datas->fetchColumn();
            if ($count == 0) {
                $query = "INSERT INTO genre (name) VALUES (:name)";
                $datas = $db->prepare($query);
                $datas->bindParam(':name', $name);

                if ($datas->execute()) {
                    header('Location:index.php');
                }
            } else {
                $errors['name'] = "Ce genre existe déjà";
            }
        }
    }
?>

<?php include ('templates/header.php') ?>

<section class="add">
    <div class="add__container">
        <h1 class="add__title">Ajouter un genre</h1>
        <form action="" class="add__form" method="POST">
            <div class="add__form-content">
                <label for="name" class="add__form-label">Nom du genre</label>
                <input type="text" name="name" id="name" class="add__form-input">
                <span class="add__form-error"><?= $errors['name'] ?? '' ?></span>
            </div>
            <input type="submit" value="Ajouter le genre" class="add__form-submit">
        </form>
    </div>
</section>

<?php include ('templates/footer.php') ?>