<?php
include "connexion.php";
$affichagePublication = $bdd->query("Select * from publication");
include "header.php";

?>

<main class="main">

    <section class="home section">
        <div class="home-container container grid">
            <div>
                <img src="img/tres.png" alt="" class="home-image">
            </div>
        </div>

        <div class="home-text">
            <div class="home-head">
                <h1 class="home-title">Key Sec</h1>
                <h2 class="home-subtitle">A Votre Service </h2>
            </div>
            <div class="home-foot">
                <h1 class="home-title-description"></h1>
                <p class="home-description">Profitez du comfort de votre vie, Et laissez nous vous proteger</p>
                <a href="#" class="button button-flex b">
                    <span class="button-flex">Nous Engager...</span>
                </a>
            </div>
        </div>

    </section>

    <section class="posts">
        <h1 style="text-align: center; padding: 20px;">Posts récentes</h1>



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
            <div class="card-creator">KEY-SECURITY</div>
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
        <div class="card-creator">KEY-SECURITY</div>
        </div>
    </div>
    <?php
    }
    ?>
</div>

        </div>

    </section>

    <section class="teams">
        <h2 style="text-align: center; padding: 20px;">Notre Equipe</h2>
        <div class="team-members-container">
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 team-container">
                <div class="team">
                    <img class="team-img"
                        src="img/ARSENE.jpg">
                    <p class="text-blk name">
                        IRUMVA Arsène
                    </p>
                    <p class="text-blk position">
                        Developeur
                    </p>
                </div>
            </div>
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 team-container">
                <div class="team">
                    <img class="team-img" src="img/dg4.png">
                    <p class="text-blk name">
                        Ishimwe Audiel
                    </p>
                    <p class="text-blk position">
                        Developeur
                    </p>
                </div>
            </div>
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 team-container">
                <div class="team">
                    <img class="team-img"
                        src="img/beni.jpg">
                    <p class="text-blk name">
                        ISABWE Benni Rayson
                    </p>
                    <p class="text-blk position">
                        Developeur
                    </p>
                </div>
            </div>
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-mobile-12 wk-tab-12 team-container">
                <div class="team">
                    <img class="team-img"
                        src="img/Nella.jpg">
                    <p class="text-blk name">
                        Ornella
                    </p>
                    <p class="text-blk position">
                        Developeur
                    </p>
                </div>
            </div>

        </div>

    </section>

</main>


<?php include "footer.php" ?>