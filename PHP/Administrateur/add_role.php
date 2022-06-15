<?php
    require_once('detection_utilisateur.php');
        
    include('../connect_bdd.php');
    if(strcmp("administrateur", $_SESSION["user_type"])!=0) return false;
    function escape_sql_wild($s)
        /* escapes SQL pattern wildcards in s. */
    {
        $result = array();
        foreach(str_split($s) as $ch)
        {
            if ($ch == "\\" || $ch == "%" || $ch == "_")
            {
                $result[] = "\\";
            } /*if*/
            $result[] = $ch;
        } /*foreach*/
        return
            implode("", $result);
    }

    function securiser($value){
        $val = escape_sql_wild(strip_tags(trim($value)));
        return $val;
    }

    $email = securiser($_POST['email']);
    $role = securiser($_POST['role']);


    $query_roles = $connect->prepare("INSERT INTO role VALUES (?, ?)");
    $query_roles->bind_param('ss', $email, $role);

    $query_roles->execute();

    mysqli_close($connect);
    header('Location: /HTML/validation.php');
    exit;