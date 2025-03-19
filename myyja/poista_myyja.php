<?php

// Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.
require_once "../inc/database.php";

if (!empty($_POST)) {

    //Haetaan valitun asiakkaan tiedot
    $myyjaID = $_POST['myyjaID'];

    // Poistetaan valitun myyjän tiedot
    $sql = "DELETE FROM myyja WHERE myyjaID = :myyjaID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':myyjaID', $_POST['myyjaID'], PDO::PARAM_INT);
    $stmt->execute();

    // Ohjataan käyttäjä myyjäsivulle
    header("Location: myyja.php");
    exit;
} else {

    // Alustetaan myyjän tunnistava muuttuja
    $myyjaID = null;

    /* Tarkistetaan, onko myyjaID parametri välitetty GET-metodilla
    ja jos on, niin tallennetaan arvo muuttujaan */

    if(!empty($_GET['myyjaID'])) {
        $myyjaID = $_REQUEST['myyjaID'];
    }

    // Jos myyjaID parametriä ei välitetty, palautetaan käyttäjä takaisin myyja.php sivulle
    if ($myyjaID == null) {
        header("Location: myyja.php");
    }

    $sql = "SELECT myyjaID, CONCAT(etunimi, ' ', sukunimi) AS nimi
            FROM myyja
            WHERE myyjaID = :myyjaID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':myyjaID', $myyjaID, PDO::PARAM_INT);
    $stmt->execute();

    $myyja = $stmt->fetch(PDO::FETCH_OBJ);

    
    if($myyja === false) {
        header("Location: myyja/myyja.php");
    }
}
?>

<?php
    include_once '../inc/header.php';
?>

        <h3>Myyjätietojen poistaminen</h3>
        <p>Haluatko varmasti poistaa myyjän, <?php echo $myyja->nimi; ?>, tiedot?</p>
        <form action="poista_myyja.php" method="post">
            <input type="hidden" name="myyjaID" value="<?php echo $myyja->myyjaID; ?>">
            <button type="submit" class="btn btn-danger">Poista</button>
            <a href="myyyja.php" class="btn">Takaisin</a>
        </form>
<?php
    include_once '../inc/footer.php';
?>