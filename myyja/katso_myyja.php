<?php
// Hetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.

require_once "../inc/database.php";

// Alustetaan myyjän tunnistava muuttuja
$myyjaID = null;

/* Tarkistetaan, onko myyjaID parametri välitetty GET-metodilla
ja jos on, niin tallennetaan arvo muuttujaan */

if (!empty($_GET['myyjaID'])) {
    $asiakasID = $_REQUEST['myyyjaID'];
}

// Jos myyjaID parametriä ei ole välitetty, palautetaan käyttäjä takaisin myyja.php sivulle
if ($myyjaID==null) {
    header("Location: myyja.php");
}

// Jos välitettiin, haetaan taulusta kys. myyjän tiedot datamuuttujaan
$sql = "SELECT * FROM myyja WHERE myyjaID = myyjaID";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':myyjaID', $myyjaID, PDO::PARAM_INT);
$stmt->execute();

$myyja = $stmt->fetch(PDO::FETCH_OBJ);

// Luetaan myyjän tiedot kannasta
$etunimi = $myyja->etunimi;
$sukunimi= $myyja->sukunimi;
$lahiosoite = $myyja->lahiosoite;
$postinumero = $myyja->postinumero;
$postitoimipaikka = $myyja->postitoimipaikka;
$puhelin = $myyja->puhelin;
$kayttajatunnus = $myyja->kayttajatunnus;
$rooli = $myyja->rooli;
$sahkoposti = $asiakas->sahkposti;


?>

<?php
    include_once '../inc/header.php';
?>

        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card card-body bg-light mt-3">
                    <h3>Myyjän tietojen katsominen</h3>
                    <form class="mt-3">

                        <div class="mb-3 row">
                            <label for="etunimi" class="col-sm-3 col-form-label">Etunimi</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $etunimi; ?>" name="etunimi" class="form-control" id="inputEtunimi">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="sukunimi" class="col-sm-3 col-form-label">Sukunimi</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $sukunimi; ?>" name="sukunimi" class="form-control" id="inputSukunimi">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="sahkoposti" class="col-sm-3 col-form-label">Sähköposti</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $sahkoposti; ?>" name="sahkoposti" class="form-control" id="inputSahkoposti">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kayttajatunnus" class="col-sm-3 col-form-label">Käyttjätunnus</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $kayttajatunnus; ?>" name="kayttajatunnus" class="form-control" id="inputKayttajatunus">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="rooli" class="col-sm-3 col-form-label">Rooli</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $rooli; ?>" name="rooli" class="form-control" id="inputRooli">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="lahiosoite" class="col-sm-3 col-form-label">Lähiosoite</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $lahiosoite; ?>" name="lahiosoite" class="form-control" id="inputLahiosoite">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="postinumero" class="col-sm-3 col-form-label">Postinumero</label>
                            <div class="col-sm-9">
                                <input type="number" readonly value="<?php echo $postinumero; ?>" name="postinumero" class="form-control" id="inputPostinumero">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="postitoimipaikka" class="col-sm-3 col-form-label">Postitoimipaikka</label>
                            <div class="col-sm-9">
                                <input type="text" readonly value="<?php echo $postitoimipaikka; ?>" name="postitoimipaikka" class="form-control" id="inputPostitoimipaikka">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="puhelin" class="col-sm-3 col-form-label">Puhelin</label>
                            <div class="col-sm-9">
                                <input type="number" readonly value="<?php echo $puhelin; ?>" name="puhelin" class="form-control" id="inputPuhelin">
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