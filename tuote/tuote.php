<?php
    include_once '../inc/header.php';
?>

    <div class="row">
        <h3>Tuotetiedot</h3>
    </div>
    <div class="row">
        <p>
            <a href="lisaa_tuote.php" class="btn btn-success">Lisää</a>
        </p>
        <table class="table table.striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nimi</th>
                    <th>Kpl</th>
                    <th>Tuotantovuosi</th>
                    <th>Kuva</th>
                    <th>Juoni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Luodaan tietokantayhteys ja haetaan tuotetietoja
                    require_once '../inc/database.php';
                    $sql = "SELECT * FROM tuote";
                    $result = $pdo->query($sql);
                    while($row = $result->fetch()):
                ?>
                <tr>
                    <td><?php echo $row['videoID']; ?></td>
                    <td><?php echo $row['nimi']; ?></td>
                    <td><?php echo $row['kpl']; ?></td>
                    <td><?php echo $row['tuotantovuosi']; ?></td>
                    <td><?php echo $row['kuva']; ?></td>
                    <td>
                        <a href="poista_tuote.php?videoID=<?php echo $row['videoID'];?> class"btn btn-danger">Poista</a>
                        <a href="paivita_tuote.php?videoID=<?php echo $row['videoID'];?> class"btn btn-success">Päivitä</a>
                        <a href="katso_tuote.php?videoID=<?php echo $row['videoID'];?> class"btn">Katso</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div> 
<?php
    include_once '../inc/footer.php';