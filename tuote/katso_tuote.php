<?php
// Hetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.

require_once "../inc/database.php";

// Alustetaan tuotteen tunnistava muuttuja
$videoID = null;

/* Tarkistetaan, onko videoID parametri välitetty GET-metodilla
ja jos on, niin tallennetaan arvo muuttujaan */

if (!empty($_GET['videoID'])) {
    $videoID = $_REQUEST['videoID'];
}

// Jos asiakasID parametriä ei ole välitetty, palautetaan käyttäjä takaisin asiakas.php sivulle
if ($videoID==null) {
    header("Location: tuote.php");
}

// Jos välitettiin, haetaan taulusta kys. videon tiedot datamuuttujaan
$sql = "SELECT * FROM tuote WHERE videoID = videoID";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
$stmt->execute();

$tuote = $stmt->fetch(PDO::FETCH_OBJ);

// Luetaan tuotteen tiedot kannasta
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

?>

<?php
    include_once '../inc/header.php';
?>

        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card card-body bg-light mt-3">
                    <h3>Tuotetietojen katsominen</h3>
                    <form class="mt-3">

                        <div class="mb-3 row">
                            <label for="nimi" class="col-sm-3 col-form-label">Nimi</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $nimi; ?>" name="nimi" class="form-control" id="inputNimi">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kuvaus" class="col-sm-3 col-form-label">Kuvaus</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $kuvaus; ?>" name="kuvaus" class="form-control" id="inputKuvaus">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="genre" class="col-sm-3 col-form-label">Genre</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $genre; ?>" name="genre" class="form-control" id="inputGenre">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ikaraja" class="col-sm-3 col-form-label">Ikäraja</label>
                            <div class="col-sm-9">
                                <input type="number" readonly value="<?php echo $ikaraja; ?>" name="ikaraja" class="form-control" id="inputIkaraja">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kesto" class="col-sm-3 col-form-label">Kesto</label>
                            <div class="col-sm-9">
                                <input type="number" readonly value="<?php echo $kesto; ?>" name="kesto" class="form-control" id="inputKesto">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="julkaisupaiva" class="col-sm-3 col-form-label">Julkaisupäivä</label>
                            <div class="col-sm-9">
                                <input type="date" readonly value="<?php echo $julkaisupaiva; ?>" name="julkaisupaiva" class="form-control" id="inputJulkaisupaiva">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tuotantovuosi" class="col-sm-3 col-form-label">Tuotantovuosi</label>
                            <div class="col-sm-9">
                                <input type="number" readonly value="<?php echo $tuotantovuosi; ?>" name="tuotantovuosi" class="form-control" id="inputTuotantovuosi">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ohjaaja" class="col-sm-3 col-form-label">Ohjaaja</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $ohjaaja; ?>" name="ohjaaja" class="form-control" id="inputOhjaaja">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nayttelijat" class="col-sm-3 col-form-label">Näyttelijät</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $nayttelijat; ?>" name="nayttelijat" class="form-control" id="inputNayttelijat">
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="kpl" class="col-sm-3 col-form-label">Kpl</label>
                            <div class="col-sm-9">
                                <input type="number" readonly value="<?php echo $kpl; ?>" name="kpl" class="form-control" id="inputKpl">
                            </div>
                        </div>

                        <div class="col-12">
                            <a href="asiakas.php" class="btn">Takaisin</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

<?php
    include_once '../inc/footer.php';
?>