<?php
    include_once '../inc/header.php';
    require_once '../inc/database.php';

    if(!empty($_POST)) {

        $etunimi = $_POST['etunimi'] ?? '';
        $sukunimi = $_POST['sukunimi'] ?? '';
        $lahiosoite = $_POST['lahiosoite'] ?? '';
        $postinumero = $_POST['postinumero'] ?? '';
        $postitoimipaikka = $_POST['postitoimipaikka'] ?? '';
        $puhelin = $_POST['puhelin'] ?? '';
        $kayttajatunnus = $_POST['kayttajatunnus'];
        $salasana = $_POST['salasana'];
        $rooli = $_POST['rooli'] ?? '';
        $sahkoposti = $_POST['sahkoposti'] ?? '';

        // Tarkistetaan tietojen oikeellisuus
        $valid = true;

        if($valid) {
            $sql = "INSERT INTO myyja (etunimi, sukunimi, lahiosoite, postinumero, postitoimipaikka, puhelin, kayttajatunnus, salasana, rooli, sahkoposti) 
            VALUES (:etunimi, :sukunimi, :lahiosoite, :postinumero, :postitoimipaikka, :puhelin, :kayttajatunnus, :salasana, :rooli, :sahkoposti)";

            $salasana = password_hash($salasana, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':etunimi', $etunimi);
            $stmt->bindParam(':sukunimi', $sukunimi);
            $stmt->bindParam(':lahiosoite', $lahiosoite);
            $stmt->bindParam(':postinumero', $postinumero);
            $stmt->bindParam(':postitoimipaikka', $postitoimipaikka);
            $stmt->bindParam(':puhelin', $puhelin);
            $stmt->bindParam(':kayttajatunnus', $kayttajatunnus);
            $stmt->bindParam(':salasana', $salasana);
            $stmt->bindParam(':rooli', $rooli);
            $stmt->bindParam(':sahkoposti', $sahkoposti);

            $stmt->execute();

            header("Location: myyja.php");
            exit;
        }
    } else {

        // Yleiset ohjetekstit
        $etunimiError = 'Syötä etunimi';
        $sukunimiError = 'Syötä sukunimi';
        $lahiosoiteError = 'Syötä lähiosoite';
        $postinumeroError = 'Syötä postinumero';
        $postitoimipaikkaError = 'Syötä postitoimipaikka';
        $puhelinError = 'Syötä puhelinnumero';
        $kayttajatunnusError = 'Syötä käyttäjätunnus';
        $salasanaError = 'Syötä salasana';
        $rooliError = 'Syötä rooli';
        $sahkopostiError = 'Syötä sähköposti';
    }
    ?>

<div class="row">
    <div class="col-8 mx-auto">
        <div class="card card-body bg-light mt-3">
            <h3>Myyjän tietojen lisääminen</h3>

            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

            <div class="mb-3">
                <label for="etunimi" class="form-label">Etunimi</label>
                <input type="text" value="<?php echo (!empty($etunimi)) ? $etunimi : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($etunimiError)) ? 'is-invalid' : ''; ?>" 
                id="etunimi" name="etunimi" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $etunimiError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="sukunimi" class="form-label">Sukunimi</label>
                <input type="text" value="<?php echo (!empty($sukunimi)) ? $sukunimi : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($nimiError)) ? 'is-invalid' : ''; ?>" 
                id="sukunimi" name="sukunimi" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $sukunimiError ?? '' ; ?>></small>
                </div>
            </div>


            <div class="mb-3">
                <label for="lahiosoite" class="form-label">Lähiosoite</label>
                <input type="text" value="<?php echo (!empty($lahiosoite)) ? $lahiosoite : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($lahiosoiteError)) ? 'is-invalid' : ''; ?>" 
                id="lahiosoite" name="lahiosoite" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $lahiosoiteError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="postinumero" class="form-label">Postinumero</label>
                <input type="number" value="<?php echo (!empty($postinumero)) ? $postinumero : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($postinumeroError)) ? 'is-invalid' : ''; ?>" 
                id="postinumero" name="postinumero" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $sahkopostiError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="postitoimipaikka" class="form-label">Postitoimipaikka</label>
                <input type="text" value="<?php echo (!empty($postitoimipaikka)) ? $postitoimipaikka : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($postitoimipaikkaError)) ? 'is-invalid' : ''; ?>" 
                id="postitoimipaikka" name="postitoimipaikka" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $postitoimipaikkaError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="puhelin" class="form-label">Puhelin</label>
                <input type="tel" value="<?php echo (!empty($puhelin)) ? $puhelin : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($puhelinError)) ? 'is-invalid' : ''; ?>" 
                id="puhelin" name="puhelin" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $puhelinError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="kayttajatunnus">Käyttäjätunnus</label>
                <input type="text" value="<?php echo (!empty($kayttajatunnus)) ? $kayttajatunnus : ''; ?>" 
                class="form-control <?php echo (!empty($_POST) && !empty($kayttajatunnusError)) ? 'is-invalid' : ''; ?>" 
                id="kayttajatunnus" name="kayttajatunnus" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small><?php echo $kayttajatunnusError ?? '';?></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="salasana" class="form-label">Salasana</label>
                <input type="password" value="<?php echo (!empty($salasana)) ? $salasana : ''?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($salasanaError)) ? 'is-invalid' : ''; ?>" 
                id="salasana" name="salasana" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small><?php echo $salasanaError ?? '' ; ?></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="rooli" class="form-label">Rooli</label>
                <input type="text" value="<?php echo (!empty($rooli)) ? $rooli : ''?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($rooliError)) ? 'is-invalid' : ''; ?>" 
                id="rooli" name="rooli" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small><?php echo $rooliError ?? '' ; ?></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="sahkoposti" class="form-label">Sähköposti</label>
                <input type="email" value="<?php echo (!empty($sahkoposti)) ? $sahkoposti : ''?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($sahkopostiError)) ? 'is-invalid' : ''; ?>" 
                id="sahkoposti" name="sahkoposti" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small><?php echo $sahkopostiError ?? '' ; ?></small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tallenna</button>
            <a href="tuote/tuote.php" class="btn float-end">Takaisin</a>

            </form>
        </div>
    </div>
</div>
<?php
    include_once '../inc/footer.php';