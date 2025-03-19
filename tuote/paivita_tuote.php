<?php

// Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.
require_once "../inc/database.php";

if (!empty($_POST)) {
    //var_dump($_POST);

    // Luetaan lomakkeen lähettämät tiedot
    $nimi = $_POST['nimi'];
    $kuvaus = $_POST['kuvaus'];
    $genre = $_POST['genre'];
    $ikaraja = $_POST['ikaraja'];
    $kesto = $_POST['kesto'];
    $julkaisupaiva = $_POST['julkaisupaiva'];
    $tuotantovuosi = $_POST['tuotantovuosi'];
    $ohjaaja = $_POST['ohjaaja'];
    $nayttelijat = $_POST['nayttelijat'];
    $videoID = $_POST['videoID'];

    // Puutttuvien kenttien ohjetekstit
    $nimiError = '';
    $kuvausError = '';
    $genreError = '';
    $ikarajaError = '';
    $kestoError = '';
    $julkaisupaivaError = '';
    $tuotantovuosiError = '';
    $ohjaajaError = '';
    $nayttelijatError = '';

    /* Alustetaan tarkistusmuuttuja oletuksella, 
    että tiedot on syötetty oikein */

    $valid = true;

    if (empty($nimi)) {
        $nimiError = "Syötä nimi";
        $valid = false;
    }

    if (empty($kuvaus)) {
        $kuvausError = "Syötä kuvaus";
        $valid = false;
    }

    if (empty($genre)) {
        $genreError = "Syötä genre";
        $valid = false;
    }

    if (empty($ikaraja)) {
        $ikarajaError = "Syötä ikäraja";
        $valid = false;
    }

    if (empty($kesto)) {
        $kestoError = "Syötä kesto";
        $valid = false;
    }

    if (empty($julkaisupaiva)) {
        $julkaisupaivaError = "Syötä julkaisupäivä";
        $valid = false;
    }

    if (empty($tuotantovuosi)) {
        $tuotantovuosiError = "Syötä tuotantovuosi";
        $valid = false;
    }

    if (empty($ohjaaja)) {
        $ohjaajaError = "Syötä ohjaaja";
        $valid = false;
    }

    if (empty($nayttelijat)) {
        $nayttelijatError = "Syötä näyttelijät";
        $valid = false;
    }

    if($valid) {
        // Jos käyttäjä antanut kaikki tiedot, tallennetaan tietokantaan
        $sql = "UPDATE tuote
                SET nimi = :nimi, kuvaus = :kuvaus, genre = :genre, ikaraja = :ikaraja, kesto = :kesto, julkaisupaiva = :julkaisupaiva, tuotantovuosi = :tuotantovuosi, ohjaaja = :ohjaaja, nayttelijat = :nayttelijat, kpl = :kpl, kuva = :kuva
                WHERE videoID = :videoID";

        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nimi', $nimi, PDO::PARAM_STR);
        $stmt->bindParam(':kuvaus', $kuvaus, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':ikaraja', $ikaraja, PDO::PARAM_INT);
        $stmt->bindParam(':kesto', $kesto, PDO::PARAM_INT);
        $stmt->bindParam(':julkaisupaiva', $julkaisupaiva, PDO::PARAM_INT);
        $stmt->bindParam(':tuotantovuosi', $tuotantovuosi, PDO::PARAM_INT);
        $stmt->bindParam(':ohjaaja', $ohjaaja, PDO::PARAM_STR);
        $stmt->bindParam(':nayttelijat', $nayttelijat, PDO::PARAM_STR);
        $stmt->bindParam(':kpl', $kpl, PDO::PARAM_INT);
        $stmt->bindParam(':kuva', $kuva, PDO::PARAM_LOB);
        $stmt->execute();

        // ohjaus takaisin asiakastietoihin
        header("Location: tuote.php");
        exit;
    }

} else {
    // Alustetaan tuotteen tunnistava muuttuja
    $videoID = null;

    /* Tarkistetaan, onko videoID parametri välitetty GET-metodilla
    ja jos on, niin tallennetaan arvomuuttujaan */

    if(!empty($_GET['videoID'])) {
        $videoID = $_REQUEST['videoID'];
    }

    // Jos videosID parametriä ei välitetty, palautetaan käyttäjä takaisin tuote.php sivulle
    if ($videoID == null) {
        header("Location: tuote.php");
    }

    // Jos välitettiin, niin haetaan taulusta kyseisen tuotteen tiedot datamuuttujaan
    $sql = "SELECT * FROM tuote WHERE videoID = :videoID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
    $stmt->execute();

    $tuote = $stmt->fetch(PDO::FETCH_OBJ);

    // Luetaan tuotetiedot kannasta
    $nimi = $tuote->nimi;
    $kuvaus= $tuote->kuvaus;
    $genre = $tuote->genre;
    $ikaraja = $tuote->ikaraja;
    $kesto = $tuote->kesto;
    $julkaisupaiva = $tuote->julkaisupaiva;
    $tuotantovuosi = $tuote->tuotantovuosi;
    $ohjaaja = $tuote->ohjaaja;
    $nayttelijat = $tuote->nayttelijat;
    $kpl = $tuote->kpl;
    $kuva = $tuote->kuva;
}
?>

<?php
    include_once '../inc/header.php';
?>

        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card card-body bg-light mt-3">
                    <h3>Tuotetietojen päivittäminen</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-3">
                        <input type="hidden" name="videoID" value="<?php echo $videoID; ?>">
                        <div class="mb-3 row">
                            <label for="nimi" class="col-sm-3 col-form-label">Nimi</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($nimi)) ? $nimi : ''; ?>" name="nimi" class="form-control <?php echo (!empty($nimiError)) ? 'is-valid' : ''; ?>" id="inputNimi">
                                <?php if (!empty($nimiError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $nimiError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kuvaus" class="col-sm-3 col-form-label">Kuvaus</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($kuvaus)) ? $kuvaus : ''; ?>" name="kuvaus" class="form-control <?php echo (!empty($kuvausError)) ? 'is-valid' : ''; ?>" id="inputKuvaus">
                                <?php if (!empty($kuvausError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $kuvausError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="genre" class="col-sm-3 col-form-label">Genre</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($genre)) ? $genre : ''; ?>" name="genre" class="form-control <?php echo (!empty($genreError)) ? 'is-valid' : ''; ?>" id="inputGenre">
                                <?php if (!empty($genreError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $genreError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ikaraja" class="col-sm-3 col-form-label">Ikäraja</label>
                            <div class="col-sm-9">
                                <input type="number" value="<?php echo (!empty($ikaraja)) ? $ikaraja : ''; ?>" name="ikaraja" class="form-control <?php echo (!empty($ikarajaError)) ? 'is-valid' : ''; ?>" id="inputIkaraja">
                                <?php if (!empty($ikarajaError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $ikarajaError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kesto" class="col-sm-3 col-form-label">Kesto</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($kesto)) ? $kesto : ''; ?>" name="kesto" class="form-control <?php echo (!empty($kestoError)) ? 'is-valid' : ''; ?>" id="inputKesto">
                                <?php if (!empty($kestoError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $kestoError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="julkaisupaiva" class="col-sm-3 col-form-label">Julkaisupäivä</label>
                            <div class="col-sm-9">
                                <input type="date" value="<?php echo (!empty($julkaisupaiva)) ? $julkaisupaiva : ''; ?>" name="julkaisupaiva" class="form-control <?php echo (!empty($julkaisupaivaError)) ? 'is-valid' : ''; ?>" id="inputJulkaisupaiva">
                                <?php if (!empty($julkaisupaivaError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $julkaisupaivaError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tuotantovuosi" class="col-sm-3 col-form-label">Tuotantovuosi</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($tuotantovuosi)) ? $tuotantovuosi : ''; ?>" name="tuotantovuosi" class="form-control <?php echo (!empty($tuotantovuosiError)) ? 'is-valid' : ''; ?>" id="inputTuotantovuosi">
                                <?php if (!empty($tuotantovuosiError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $tuotantovuosiError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ohjaaja" class="col-sm-3 col-form-label">Ohjaaja</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($ohjaaja)) ? $ohjaaja : ''; ?>" name="ohjaaja" class="form-control <?php echo (!empty($ohjaajaError)) ? 'is-valid' : ''; ?>" id="inputOhjaaja">
                                <?php if (!empty($ohjaajaError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $ohjaajaError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nayttelijat" class="col-sm-3 col-form-label">Näyttelijät</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($nayttelijat)) ? $nayttelijat : ''; ?>" name="nayttelijat" class="form-control <?php echo (!empty($nayttelijatError)) ? 'is-valid' : ''; ?>" id="inputNayttelijat">
                                <?php if (!empty($nayttelijatError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $nayttelijatError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="kpl" class="col-sm-3 col-form-label">Kpl</label>
                            <div class="col-sm-9">
                                <input type="number" value="<?php echo (!empty($kpl)) ? $kpl : ''; ?>" name="kpl" class="form-control <?php echo (!empty($kplError)) ? 'is-valid' : ''; ?>" id="inputKpl">
                                <?php if (!empty($kplError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $kplError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kpl" class="col-sm-3 col-form-label">Kuva</label>
                            <div class="col-sm-9">
                                <input type="file" value="<?php echo (!empty($kuva)) ? $kuva : ''; ?>" name="kuva" class="form-control <?php echo (!empty($kuvaError)) ? 'is-valid' : ''; ?>" id="inputKuva">
                                <?php if (!empty($kuvaError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $kuvaError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>



                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Tallenna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    include_once '../inc/footer.php';
?>