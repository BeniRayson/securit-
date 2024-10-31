<?php
include "connexion.php";
$affichagePublication = $bdd->query("SELECT publication.*, COALESCE(users.username, 'Unknown') AS username FROM publication LEFT JOIN users ON publication.auteur = users.id");
include "header.php";
?>

<section class="main">
    <section class="posts" style="padding-top: 50px">
        <h1 style="text-align: center; padding: 20px;">Toutes les Publications</h1>
        <div class="card-container">
            <?php
            while ($dataRecup = $affichagePublication->fetch()) {
                ?>
                <div class="card card-1" onclick="showPub(this.nextElementSibling)">
                    <div class="card-img"></div>
                    <a href="" class="card-link">
                        <div class="card-img-hovered"></div>
                    </a>
                    <div class="card-info">
                        <div class="card-about">
                            <div class="card-time"><?php echo $dataRecup["date_pub"]; ?></div>
                        </div>
                        <h1 class="card-title"><?php echo $dataRecup["titre"]; ?></h1>
                        <div class="card-creator">Écrit Par <?php echo $dataRecup["username"]; ?></div>
                    </div>
                </div>
                <div class="pub" style="display: none;">
                    <div class="close-btn" onclick="hidePub(this.parentElement)">&times;</div>
                    <h1 class="card-title"><?php echo $dataRecup["titre"]; ?></h1>
                    <br>
                    <br>
                    <p class="cont"><?php echo $dataRecup["article"]; ?></p>
                    <div class="details-pub">
                        <div class="card-time"><?php echo $dataRecup["date_pub"]; ?></div>
                        <div class="card-creator">Écrit Par <?php echo $dataRecup["username"]; ?></div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</section>

<?php include "footer.php"; ?>
