<?php
    include_once '../inc/header.php';
    include_once '../inc/database.php';

    if(!empty($_POST)) {

        //$videoID = $_POST['videoID'];
        $nimi = $_POST['nimi'];
        $kuvaus = $_POST['kuvaus'];
        $genre = $_POST['genre'];
        $ikaraja = $_POST['ikaraja'];
        $kesto = $_POST['kesto'];
        $julkaisupaiva = $_POST['julkaisupaiva'];
        $tuotantovuosi = $_POST['tuotantovuosi'];
        $ohjaaja = $_POST['ohjaaja'];
        $nayttelijat = $_POST['nayttelijat'];
        $kpl = intval($_POST['kpl']);
        $kuva = $_FILES['kuva']['name'];

        // Tarkistetaan tietojen oikeellisuus
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

        if(empty($kuva)) {
            $valid = false;
            $kuvaError = "Lisää kuva";
        }

        if(!is_int($kpl) || ($kpl < 1|| $kpl > 20)) {
            $valid = false;
            $kplError = "Syötä kappalemäärä väliltä 1-20";
        }


        if($valid) {
            $tmp_name = $_FILES['kuva']['tmp_name'];
            move_uploaded_file($tmp_name, '../img/ .$kuva');

            $sql = "INSERT INTO tuote (nimi, kuvaus, genre, ikaraja, kesto, julkaisupaiva, tuotantovuosi, ohjaaja, nayttelijat, kpl, kuva) 
            VALUES (:nimi, :kuvaus, :genre, :ikaraja, :kesto, :julkaisupaiva, :tuotantovuosi, :ohjaaja, :nayttelijat, :kpl, :kuva);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nimi', $nimi);
            $stmt->bindParam(':kuvaus', $kuvaus);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':ikaraja', $ikaraja);
            $stmt->bindParam(':kesto', $kesto);
            $stmt->bindParam(':julkaisupaiva', $julkaisupaiva);
            $stmt->bindParam(':tuotantovuosi', $tuotantovuosi);
            $stmt->bindParam(':ohjaaja', $ohjaaja);
            $stmt->bindParam(':nayttelijat', $nayttelijat);
            $stmt->bindParam(':kpl', $kpl);
            $stmt->bindParam(':kuva', $kuva);
            $stmt->execute();
            
            header("Location tuote.php");
            exit;
        }

    } else {

        // Yleiset ohjetekstit
        $nimiError = 'Syötä nimi';
        $kuvausError = 'Syötä kuvaus';
        $genreError = 'Syötä genre';
        $ikarajaError = 'Syötä ikäraja';
        $kestoError = 'Syötä kesto';
        $julkaisupaivaError = 'Syötä julkaisupäivä';
        $tuotantovuosiError = 'Syötä tuotantovuosi';
        $ohjaajaError = 'Syötä ohjaaja';
        $nayttelijatError = 'Syötä näyttelijät';
        $kplError = 'Syötä kpl-määrä väliltä 1-20';
        $kuvaError = 'Lisää kuva';
        
    }
?>

<div class="row">
    <div class="col-8 mx-auto">
        <div class="card card-body bg-light mt-3">
            <h3>Tuotetietojen lisääminen</h3>

            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

            <div class="mb-3">
                <label for="nimi" class="form-label">Nimi</label>
                <input type="text" value="<?php echo (!empty($nimi)) ? $nimi : ''; ?>" class="form-control 
                <?php echo (!empty($_POST) && !empty($nimiError)) ? 'is-invalid' : ''; ?>" 
                id="nimi" name="nimi" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $nimiError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="kuvaus" class="form-label">Kuvaus</label>
                <textarea class="form-control <?php echo (!empty($_POST) && !empty($kuvausError)) ? 'is-invalid' : ''; ?>" 
                name="kuvaus" id="kuvaus" rows="5" required></textarea>
                <div class="invalid-feedback">
                    <small><?php echo $kuvausError ?? '';?></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" value="<?php echo (!empty($genre)) ? $genre : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($genreError)) ? 'is-invalid' : ''; ?>" 
                id="genre" name="genre" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $genreError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="ikaraja" class="form-label">Ikäraja</label>
                <input type="number" value="<?php echo (!empty($ikaraja)) ? $ikaraja : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($ikarajaError)) ? 'is-invalid' : ''; ?>" 
                id="ikaraja" name="ikaraja" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $ikarajaError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="kesto" class="form-label">Kesto</label>
                <input type="text" value="<?php echo (!empty($kesto)) ? $kesto : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($kestoError)) ? 'is-invalid' : ''; ?>" 
                id="kesto" name="kesto" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $kestoError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="julkaisupaiva" class="form-label">Julkaisupäivä</label>
                <input type="date" value="<?php echo (!empty($julkaisupaiva)) ? $julkaisupaiva : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($julkaisupaivaError)) ? 'is-invalid' : ''; ?>" 
                id="julkaisupaiva" name="julkaisupaiva" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $julkaisupaivaError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="tuotantovuosi" class="form-label">Tuotantovuosi</label>
                <input type="number" value="<?php echo (!empty($tuotantovuosi)) ? $tuotantovuosi : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($tuotantovuosiError)) ? 'is-invalid' : ''; ?>" 
                id="tuotantovuosi" name="tuotantovuosi" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $tuotantovuosiError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="ohjaaja" class="form-label">Ohjaaja</label>
                <input type="text" value="<?php echo (!empty($ohjaaja)) ? $ohjaaja : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($ohjaajaError)) ? 'is-invalid' : ''; ?>" 
                id="ohjaaja" name="ohjaaja" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $ohjaajaError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="nayttelijat" class="form-label">Näyttelijät</label>
                <input type="text" value="<?php echo (!empty($nayttelijat)) ? $nayttelijat : ''; ?>" class="form-control" 
                <?php echo (!empty($_POST) && !empty($nayttelijatError)) ? 'is-invalid' : ''; ?>" 
                id="nayttelijat" name="nayttelijat" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $nayttelijatError ?? '' ; ?>></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="kpl" class="form-label">Kpl</label>
                <input type="number" value="<?php echo (empty($kpl)) ? $kpl : ''?> class="form-control" 
                <?php echo (!empty($_POST) && !empty($kplError)) ? 'is-invalid' : ''; ?>" 
                id="kpl" name="kpl" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small><?php echo $kplError ?? '' ; ?></small>
                </div>
            </div>

            <div class="mb-3">
                <label for="kuva" class="form-label">Kuva</label>
                <input type="file" value="<?php echo (!empty($kuva)) ? $kuva : ''; ?> class="form-control 
                <?php echo (!empty($_POST) && !empty($kuvaError)) ? 'is-invalid' : ''; ?>" 
                id="kuva" name="kuva" aria-describedby="" required>
                <div class="invalid-feedback">
                    <small <?php echo $kuvaError ?? '' ; ?>></small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tallenna</button>
            <a href="tuote.php" class="btn float-end">Takaisin</a>

            </form>
        </div>
    </div>
</div>
<?php
    include_once '../inc/footer.php';