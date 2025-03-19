<?php /*
    include_once 'inc/header.php';
    require_once 'inc/database.php';

if (!empty($_POST)) {
    // var_dump($_POST);
    // Luetaan vuokrauslomakkeen data
$asiakasID = $_POST['asiakasID'];
$vuokrauspvm = $_POST['vuokrauspvm'];
$tuote = $_POST['tuote'];
$alkamisaika = $_POST['alkamisaika'];
$paattymisaika = $_POST['paattymisaika'];
$hinta = $_POST['hinta'];

    // Tietojen oikeellisuuden tarkistaminen
    $valid = true;
    $if($valid) {
        try{
            $pdo->beginTransaction();
            $sql = "INSERT INTO vuokraus
                    (asiakasID, myyjaID, vuokrauspvm
                    VALUES (:asiakasID, :myyjaID, :vuokrauspvm)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':asiakasID', $asiakasID);
            $stmt->bindParam(':myyjaID', $_SESSION['myyjaID']);
            $stmt->bindParam(':vuokrauspvm', $vuokrauspvm);
            $stmt->execute();

            // Haetaan tehdyn vuokrauksen vuokrausID
            $vuokrausID = $pdo->lastInserId();
            // Viedään vuokrauset vuokrausrivi-tauluun
            foreach($tuote as $key => $value) {
                $sql = "INSER INTO vuokrausrivi (vuokrausID, tuoteID, alkamisaika, paattymisaika, hinta)
                VALUE (:vuokrausID, :tuoteID, :alkamisaika, :paattymisaika, :hinta)";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':vuokrausID', $vuokrausID);
                $stmt->bindParam(':tuoteID', $tuote[$key]);
                $stmt->bindParam(':alkamisaika', $alkamisaika[$key]);
                $stmt->bindParam(':paattymisaika', $paattymisaika[$key]);
                $stmt->bindParam(':hinta', $hinta[key]);
                $stmt->execute();
            }
            // Hyväksytään muutokset tietokantaan
            $pdo->commit();
            header("Location: vuokraus_onnistui.php");
            exit;
        } catch(Exception $e) {
            echo $e->getMessage();
            $stmt->debugDumpParams();
            // Peruutetaan muutokset tietokantaan
            $pdo->rollBack();
        }
    }
}

// Asiakastietojen haku pudotuslistaan
    $sql = "SELECT asiakasID, CONCAT(etunimi, ' ', sukunimi) nimi
            FROM asiakas
            ORDER BY sukunimi, etunimi DESC";
    $asiakkaat = $pdo->query($sql);
    // Tuotetietojen haku
    $sql = "SELECT tuoteID, nimi 
            FROM tuote 
            ORDER BY nimi";
    $tuotteet = $pdo->query($sql);
?> 

<form action="" method="post">
    <div class="row">
        <h3>Vuokraustiedot</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Asiakas</th>
                    <th>Vuokrauspvm</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="asiakasID" id="" class="form-select"><?php while($row = $asiakkaat->fetch()): ;?><option value="<?php echo $row['asiakasID']; ?>"><?php echo $row['nimi']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    </td>
                    <td>
                        <input type="date" value="<?= date('Y-m-d'); ?>" name="vuokrauspvm" class="form-control">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h3>Vuokrattavat tuotteet</h3>
    <div class="row mt-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Tuote</th>
                    <th>Alkamisaika</th>
                    <th>Päättymisaika</th>
                    <th>Hinta</th>
                    <th>Toiminto</th>
                </tr>
            </thead>
            <tbody>
                <tr id="rivi-1">
                    <td>&nbsp;</td>
                    <td>
                        <select name="tuote[]" id="" class="form-select"><?php while($row = $tuotteet->fetch()): ?><option value="<?= $row['tuoteID']; ?>"><?= $row['nimi']; ?></option></select>
                    </td>
                    <td>
                        <input type="datetime-local" class="form-control" name="alkamisaika[]">
                    </td>
                    <td>
                        <input type="datetime-local" class="form-control" name="paattymisaika[]">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="hinta[]">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger piiloon">Poista rivi</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="d-grid">
                            <button type="button" id="lisaaRivi" class="btn btn-success">Lisää rivi</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Tallenna</button>
    </div>
</form>
<?php
    include_once 'inc/footer.php';