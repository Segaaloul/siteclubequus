<?php
session_start();



    $servername = "localhost" ;
    $database = "u825210412_clubequus" ;
    $username = "u825210412_selim" ;
    $password = "Selim130603" ;
    
    
    // Créer une connexion
  
   // $conn = mysqli_connect ( $servername, $username, $password, $database,) ;
    
    // Vérifier la connexion
    
    try{
    $bdd = new PDO('mysql:host=localhost;dbname=u825210412_clubequus','u825210412_selim' , 'Selim130603');
    	$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		 //echo "connect  OK !" ;
	}catch(Exception $e)
	{
		echo "erreur " .$e;
	}
    
    
    /*
    if ( !$conn ) {  
        die ( " Échec de la connexion : " . mysqli_connect_error ()) ;
    }else echo "Connecté avec succès" ;
    */
    
   


function Securise($string){
    if(ctype_digit($string)){
        $string = intval($string);
    }else{
        $string = strip_tags($string);
        $string = addcslashes($string,'%_');
    }
    return $string;
}


function passwordhash($str){
    $str = sha1(md5('equss' .$str));
    return $str;
}










//formulaire d'inscription

if(isset($_POST['inscription'])){
    $nom =  Securise($_POST['pseudo']);
    $email = Securise( $_POST['email']);
    $password =  Securise($_POST['password']);
    $password2 = Securise( $_POST['password2']);
    $date = date('d/m/Y');
    if(!empty($nom) AND !empty($email) AND !empty($password) AND !empty($password2))
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if($password == $password2)
            {
                
                $TestEmail = $bdd ->query('SELECT id FROM user WHERE email = "'.$email.'"');
                if($TestEmail->rowCount() < 1){
                    
                    $password = passwordhash($password);
                    
                   $bdd->query('INSERT INTO user (pseudo, email, password,date) VALUES ("'.$nom.'","'.$email.'","'.$password.'","'.$date.'")');
                   $return ="inscription efectuée";
                }else $return=  "l email est deja utilisee !";
            }else  $return= "les deux mot de pass ne corresponde pas ";

        }else $return = "L email est invalide !";

    }else
    {
        $return = "un ou plusieur champs est maquqnts";
    }
}

//formulaire de connexion
if(isset($_POST['login'])){
    $email = Securise($_POST['email']);
    $password =  Securise($_POST['password']);
    if(!empty($email) AND !empty($password)){
        $password = passwordhash($password);
        $verifuser = $bdd -> query('SELECT id,email,pseudo,img FROM user WHERE email ="'.$email.'" AND password ="' .$password.'"');
        
        $userdata = $verifuser->fetch();
        
        if($verifuser -> rowCount() == 1){
                $_SESSION['login'] = $userdata['id'];
                $_SESSION['mail'] = $userdata['email'];
                $_SESSION['pseudo'] = $userdata['pseudo'];
                $_SESSION['img'] = $userdata['img'];
                header('location:admin.php');
              
        }else $return = "identifiant invalide !";

    }else $return = "champs manquant !";

}











 mysqli_close ( $bdd ) ;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet"  type="text/css" href="css/formulaire.css">
</head>
<body>
    <?php  if(isset($_POST['inscription']) AND isset($return)) echo $return;   ?>
<!--
    <div class="inscription">
    <form  action="#" method="POST">
        <input type="text" name="pseudo" placeholder = "Votre nom">
        <input type="email" name="email" placeholder = "Votre email">
        <input type="password" name="password" placeholder="Votre password">
        <input type="password" name="password2" placeholder="confirmer votre password">

        <input type="submit" name="inscription" value="m'inscrire">
   
    </form>
    </div>
   <hr>
    -->
        <?php  if(isset($_POST['login']) AND isset($return)) echo $return;   ?>
     <div class="text">
        <h1><strong>Espace</strong> membre</h1>
    </div>
    <div class="login">
        
        <form class="formbloc" action="#" method="POST">
            <div class="formgroupe">
                <input type="email" name="email" placeholder = "Votre email"  required>
            </div>

            <div class="formgroupe">
            <input type="password" name="password" placeholder="Votre password"  required>
            </div>

            <div class="bouton">
            <input type="submit" name="login" value="se connecter">
            </div>
            
        </form>
    </div>
  

    
</body>
</html>