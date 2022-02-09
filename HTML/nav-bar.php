<section class="menu" id="menu-nav-bar">
    <div class="nav-bar-header">
        <?php include("logoUniversiteLeMans.html"); ?>
        <a href="javascript:void(0);" class="icon-params" onclick="openNavBar()">
            <i aria-hidden="true" class="fa fa-times fa-3x"></i>
            <p class="icon-params-bar"></p>
            <p class="icon-params-bar"></p>
            <p class="icon-params-bar"></p>
        </a>
    </div>
    <ul class="navbar">
        <li><a class="active" href="Utilisateur/faireunedemande.php">Faire une demande</a>
        <li><a href="prendrerendezvous.html">Prendre un rendez-vous</a>
        <li><a href="mesdemandes.html">Consulter mes demandes</a>
        <li><a href="?logout=">Déconnexion</a>
    </ul>
</section>
<script>
    function openNavBar() {
        var x = document.getElementById("menu-nav-bar");
        if (x.className === "menu") {
            x.className += " responsive";
        } else {
            x.className = "menu";
        }
    }
</script>