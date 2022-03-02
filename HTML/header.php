    <meta name="viewport" content="width=device-width"/>
    <!-- Connexion CAS -->
    <?php 
        session_start();
        require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/phpCAS/connect_cas.php'; 
        //gestion du type d'utilisateur
        include($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/connect_bdd.php');
        $mail = phpCAS::getAttributes()['mail'];
        $query_role = 'SELECT role FROM role WHERE email="'.$mail.'"';
        $_SESSION["user_type"] = mysqli_fetch_array($connect->query($query_role))[0];
        mysqli_close($connect);
        if(!isset($_SESSION["user_type"])){
            $_SESSION["user_type"] = "utilisateur";
        }
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