<?php
if (!empty($_POST)) {
    /* Tämä testaamista varten:
     var_dump($_POST); */
    
     // Luetaan lomakkeen lähettämät tiedot
    $henkilotunnus = $_POST['henkilotunnus'];
    $etunimi = $_POST['etunimi'];
    $sukunimi = $_POST['sukunimi'];
    $lahiosoite = $_POST['lahiosoite'];
    $postinumero = $_POST['postinumero'];
    $postitoimipaikka = $_POST['postitoimipaikka'];
    $sahkoposti = $_POST['sahkoposti'];
    $puhelin = $_POST['puhelin'];

    // Puuttuvien kenttien ohjetekstit
    $henkilotunnusError = '';
    $etunimiError = '';
    $sukunimiError = '';
    $lahiosoiteError = '';
    $postinumeroError = '';
    $postitoimipaikkaError = '';
    $sahkopostiError = '';
    $puhelinError = '';

    /* alustetaan tarkistusmuuttuja
    oletus, että tiedot oikein */

    $valid = true;

    if (empty($henkilotunnus)) {
        $henkilotunnusError = "Syötä henkilötunnus";
        $valid = false;
    }
    if (empty($etunimi)) {
        $etunimiError = "Syötä etunimi";
        $valid = false;
    }

    if (empty($sukunimi)) {
        $sukunimiError = "Syötä sukunimi";
        $valid = false;
    }

    if (empty($lahiosoite)) {
        $lahiosoiteError = "Syötä lähiosoite";
        $valid = false;
    }

    if (empty($postinumero)) {
        $postinumeroError = "Syötä postinumero";
        $valid = false;
    }

    if (empty($postitoimipaikka)) {
        $postitoimipaikkaError = "Syötä postitoimipaikka";
        $valid = false;
    }

    if (empty($sahkoposti)) {
        $sahkopostiError = "Syötä sähköposti";
        $valid = false;
    }

    if (empty($puhelin)) {
        $puhelinError = "Syötä puhelin";
        $valid = false;
    }

    // Tallennetaan tietokantaan, jos käyttäjä antanut kaikki tiedot

    if ($valid) {
        require_once "../inc/database.php";

        $sql = "INSERT INTO asiakas (henkilotunnus, etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, sahkoposti, puhelinnumero)
        VALUES (:henkilotunnus, :etunimi, :sukunimi, :lahiosoite, :postinumero, :postitoimipaikka, :sahkoposti, :puhelin)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':henkilotunnus', $henkilotunnus, PDO::PARAM_STR);
        $stmt->bindParam(':etunimi', $etunimi, PDO::PARAM_STR);
        $stmt->bindParam(':sukunimi', $sukunimi, PDO::PARAM_STR);
        $stmt->bindParam(':lahiosoite', $lahiosoite, PDO::PARAM_STR);
        $stmt->bindParam(':postinumero', $postinumero, PDO::PARAM_STR);
        $stmt->bindParam(':postitoimipaikka', $postitoimipaikka, PDO::PARAM_STR);
        $stmt->bindParam(':sahkoposti', $sahkoposti, PDO::PARAM_STR);
        $stmt->bindParam(':puhelin', $puhelin, PDO::PARAM_STR);
        $stmt->execute();

        // ohjaus takaisin asiakastietoihin
        header("Location: asiakas.php");
        exit;
    }
}
?>

<?php
    include_once '../inc/header.php';
?>

        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card card-body bg-light mt-3">
                    <h3>Asiakastietojen lisääminen</h3>
                    <form action="lisaa_asiakas.php" method="POST" class="mt-3">

                        <div class="mb-3 row">
                            <label for="etunimi" class="col-sm-3 col-form-label">Etunimi</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($etunimi)) ? $etunimi : ''; ?>" name="etunimi" class="form-control <?php echo (!empty($etunimiError)) ? 'is-valid' : ''; ?>" id="inputEtunimi">
                                <?php if (!empty($etunimiError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $etunimiError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="sukunimi" class="col-sm-3 col-form-label">Sukunimi</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($sukunimi)) ? $sukunimi : ''; ?>" name="sukunimi" class="form-control <?php echo (!empty($sukunimiError)) ? 'is-valid' : ''; ?>" id="inputSukunimi">
                                <?php if (!empty($sukunimiError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $sukunimiError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="sahkoposti" class="col-sm-3 col-form-label">Sähköposti</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($sahkoposti)) ? $sahkoposti : ''; ?>" name="sahkoposti" class="form-control <?php echo (!empty($sahkopostiError)) ? 'is-valid' : ''; ?>" id="inputSahkoposti">
                                <?php if (!empty($sahkopostiError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $sahkopostiError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div> 

                        <div class="mb-3 row">
                            <label for="henkilotunnus" class="col-sm-3 col-form-label">Henkilötunnus</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($henkilotunnus)) ? $henkilotunnus : ''; ?>" name="henkilotunnus" class="form-control <?php echo (!empty($henkilotunnusError)) ? 'is-valid' : ''; ?>" id="inputHenkilotunnus">
                                <?php if (!empty($henkilotunnusError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $henkilotunnusError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="lahiosoite" class="col-sm-3 col-form-label">Lähiosoite</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($lahiosoite)) ? $lahiosoite : ''; ?>" name="lahiosoite" class="form-control <?php echo (!empty($lahiosoiteError)) ? 'is-valid' : ''; ?>" id="inputLahiosoite">
                                <?php if (!empty($lahiosoiteError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $lahiosoiteError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="postinumero" class="col-sm-3 col-form-label">Postinumero</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($postinumero)) ? $postinumero : ''; ?>" name="postinumero" class="form-control <?php echo (!empty($postinumeroError)) ? 'is-valid' : ''; ?>" id="inputPostinumero">
                                <?php if (!empty($postinumeroError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $postinumeroError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="postitoimipaikka" class="col-sm-3 col-form-label">Postitoimipaikka</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($postitoimipaikka)) ? $postitoimipaikka : ''; ?>" name="postitoimipaikka" class="form-control <?php echo (!empty($postitoimipaikkaError)) ? 'is-valid' : ''; ?>" id="inputPostitoimipaikka">
                                <?php if (!empty($postinumeroError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $postitoimipaikkaError; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="puhelin" class="col-sm-3 col-form-label">Puhelin</label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo (!empty($puhelin)) ? $etunimi : ''; ?>" name="puhelin" class="form-control <?php echo (!empty($puhelinError)) ? 'is-valid' : ''; ?>" id="inputPuhelin">
                                <?php if (!empty($puhelinError)) : ?>
                                    <div class="invalid-feedback">
                                        <small><?php echo $puhelinError; ?></small>
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