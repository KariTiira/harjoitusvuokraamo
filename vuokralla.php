<?php /*
    include_once 'inc/header.php';
    require_once 'inc/database.php';

    if(!empty($_POST)) {
        $vuokrausriviID = $_POST['vuokrausriviID'];

        // var_dump($vuokrausriviID):

        foreach($vuokrausriviID as $arvo) {
            $sql = "UPDATE vuokrausrivi
                    SET palautettu = 1
                    WHERE vuokrausriviID = :vuokrausriviID";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':vuokrausriviID', $arvo);
            $stmt->execute();
        }

        header("Location: vuokralla.php");
        exit;
    } else {
        $sql = "SELECT CONCAT(a.etunimi, ' ', a.sukunimi) asiakas,
                v.vuokrauspvm, m.nimi myyyja, t.nimi tuote, vr.alkamisaika, 
                vr.paattymisaika, vr.palautettu, vr.vuokrausriviID
                FROM asiakas a, vuokraus v, myyja m, vuokrausrivi vr, tuote t
                WHERE a.asiakasID = v.asiakasID
                AND v.myyjaID = m.myyjaID
                AND v.vuokrausID = vr.vuokrausID
                AND vr.tuoteID = t.tuoteID
                AND  vr.palautettu IS NULL";

        $vuokralla = $pdo->query($sql);
    }
?>

<div class="row">
    <h3>Vuokralla olevat tuotteet</h3>
    <form action="" method="post">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Asiakas</th>
                    <th>Tuote</th>
                    <th>Alkamisaika</th>
                    <th>Päättyymisaika</th>
                    <th>Myyjä</th>
                    <th>Palautus</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $vuokralla->fetch()) : ?>
                    <tr>
                        <td><?php echo $row['asiakas']; ?></td>
                        <td><?php echo $row['tuote']; ?></td>
                        <td><?php echo $row['alkamisaika']; ?></td>
                        <td><?php echo $row['paattymisaika']; ?></td>
                        <td><?php echo $row['myyja']; ?></td>
                        <td><input type="checkbox" name="vuokrausriviID[]" value="<?php echo $row['vuokrausriviID']; ?>"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Palauta</button>
    </form>
</div>


<?php
    include_once 'inc/footer.php';