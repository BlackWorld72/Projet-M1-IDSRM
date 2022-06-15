    <meta name="viewport" content="width=device-width"/>
    <!-- Connexion CAS et détection de l'utilisateur -> redirection si utilisateur sur age interdite -->
    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'] .'/PHP/detection_utilisateur.php');
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        if(!strpos($url, ucfirst($_SESSION["user_type"])) && !strpos($url, "validation.php")){
            header('Location: /index.php');
        }
    ?>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="/CSS/bootstrap.min.css">
    <!-- Font awesome 6 -->
    <link rel="stylesheet" href="/CSS/font-awesome/css/font-awesome.min.css">
    <!-- Styles custom -->
    <link rel="stylesheet" href="/CSS/styles.css">
