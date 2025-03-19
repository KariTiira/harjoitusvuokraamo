
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Harjoitusvuokraamo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php // if(tarkistaKirjautuminen()): ?>
                <li class="nav-item">
                    <a href="/asiakas/asiakas.php" class="nav-link active" aria-current="page">Asiakas</a>
                </li>
                <li class="nav-item">
                    <a href="/tuote/tuote.php" class="nav-link">Tuote</a>
                </li>
                <li class="nav-item">
                    <a href="/myyja/myyja.php" class="nav-link">Myyjä</a>
                </li>
                <li class="nav-item">
                    <a href="vuokraus.php" class="nav-link">Vuokraus</a>
                </li>
                <li class="nav-item">
                    <a href="vuokralla.php" class="nav-link">Vuokralla</a>
                </li>
            <?php //endif; ?>
            </ul>
            <form class="d-flex me-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Hae" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Hae</button>
            </form>
            <?php // if (tarkistaKirjautuminen()): ?>
               <!-- <a href="ulos.php" class="nav-link">Ulos<i class="bi bi-box-arrow-right"></i></a>-->
            <?php //else: ?>
                <a href="kirjaudu.php" class="nav-link">Kirjaudu<i class="class"bi bi-box-arrow-in-right"></i></a>
            <?php // endif; ?>
        </div>
    </div>
</nav>