<?php

// Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan.
require_once "../inc/database.php";

if (!empty($_POST)) {

    //Haetaan valitun tuotteen tiedot
    $videoID = $_POST['videoID'];

    // Poistetaan valitun tuotteen tiedot
    $sql = "DELETE FROM tuote WHERE videoID = videoID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':videoID', $_POST['videoID'], PDO::PARAM_INT);
    $stmt->execute();

    // Ohjataan käyttäjä tuotesivulle
    header("Location: tuote.php");
    exit;
} else {

    // Alustetaan tuotteen tunnistava muuttuja
    $videoID = null;

    /* Tarkistetaan, onko videoID parametri välitetty GET-metodilla
    ja jos on, niin tallennetaan arvo muuttujaan */

    if(!empty($_GET['videoID'])) {
        $videoID = $_REQUEST['videoID'];
    }

    // Jos videoID parametriä ei välitetty, palautetaan käyttäjä takaisin tuote.php sivulle
    if ($videoID == null) {
        header("Location: tuote.php");
    }

    $sql = "SELECT videoID, nimi
            FROM tuote
            WHERE videoID = :videoID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':videoID', $videoID, PDO::PARAM_INT);
    $stmt->execute();

    $asiakas = $stmt->fetch(PDO::FETCH_OBJ);

    if($asiakas === false) {
        header("Location: tuote.php");
    }
}
?>

<?php
    include_once '../inc/header.php';
?>

        <h3>Tuotetietojen poistaminen</h3>
        <p>Haluatko varmasti poistaa tuotteen, <?php echo $tuote->nimi; ?>, tiedot?</p>
        <form action="poista_asiakas.php" method="post">
            <input type="hidden" name="videoID" value="<?php echo $tuote->videoID; ?>">
            <button type="submit" class="btn btn-danger">Poista</button>
            <a href="tuote.php" class="btn">Takaisin</a>
        </form>
<?php
    include_once '../inc/footer.php';
?>