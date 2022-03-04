    <meta name="viewport" content="width=device-width"/>
    <!-- Connexion CAS -->
    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/detection_utilisateur.php');
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        if(!strpos($url, ucfirst($_SESSION["user_type"])) && !strpos($url, "validation.php")){
            header('Location: /Projet-M1-IDSRM/index.php');
        }
    ?>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="/Projet-M1-IDSRM/CSS/bootstrap.min.css">
    <!-- Font awesome 6 -->
    <link rel="stylesheet" href="/Projet-M1-IDSRM/CSS/font-awesome/css/font-awesome.min.css">
    <!-- Styles custom -->
    <link rel="stylesheet" href="/Projet-M1-IDSRM/CSS/styles.css">