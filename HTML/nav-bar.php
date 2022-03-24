<section class="menu" id="menu-nav-bar">
    <div class="nav-bar-header">
        <?php include("logoUniversiteLeMans.html"); ?>
        <a href="javascript:void(0);" class="icon-params" onclick="document.getElementById('menu-nav-bar').classList.toggle('responsive')">
            <i aria-hidden="true" class="fa fa-times fa-3x"></i>
            <p class="icon-params-bar"></p>
            <p class="icon-params-bar"></p>
            <p class="icon-params-bar"></p>
        </a>
    </div>
    <ul class="navbar">
        <?php
            $user_type = ucfirst($_SESSION['user_type']);
            switch($user_type){
                case "Administrateur":
                    $files = ["listedesdemandes.php", "gestiondesroles.php", "faireunedemande.php"];
                    break;
                case "Operateur":
                    $files = ["listedesdemandes.php", "faireunedemande.php"];
                    break;
                case "Utilisateur":
                    $files = ["faireunedemande.php", "prendreunrendezvous.php", "consultermesdemandes.php"];
                    break;
            }

            function getTitle($url) {
                $page = file_get_contents($url);
                $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
                return $title;
            }

            foreach ($files as $page) {
                $title = getTitle(__DIR__.'/'.$user_type.'/'.$page);
                echo "<li><a href='/Projet-M1-IDSRM/HTML/$user_type/$page'>$title</a>";
            }
        ?>
        <li><a href="?logout=">Déconnexion</a>
    </ul>
</section>
<script>
    var path = window.location.pathname;
    var page = path.split("/").pop();
    for(elem of document.querySelector(".navbar").getElementsByTagName('a')){
        if(elem.href.includes(page) && !elem.href.includes("logout")){
            elem.className = "active";
        }
    }
</script>
