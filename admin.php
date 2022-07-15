<?php 
session_start();

if(!isset($_SESSION['login'] , $_SESSION['mail'], $_SESSION['pseudo'],$_SESSION['img'] )){
    header('location:databaseconnect.php');
}

    $id = $_SESSION['login'];
    $email = $_SESSION['mail'];
    $pseudo = $_SESSION['pseudo'];
    
    $image = $_SESSION['img'];
    
    echo "votre id estt :" .$id ;
    echo "votre email est :" .$email ;
    echo "votre pseudo est :".$pseudo;
    echo "votre image est :".$image;








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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleadmin.css">
    <title>admin/ <?php echo($pseudo); ?> </title>
    
</head>
<body>
 
<!-- Menu de navigation -->
<div id="barre">

<nav class="menu-nav">
    <ul>
        
        <!--  
        <li class="btn">
            <a href="#">
                Accueil
            </a>
        </li>
        <li class="btn">
            <a href="actualite.html">
                Actualité
            </a>
            
        </li>
        <li class="btn">
            <a href="propos.html">
                A propos
            </a>
            
        </li>
        <li class="dragon">
            <a class="dragon" href="dragon.html"> Les Dragons</a>
            <div class="dropdown-content">
                <a href="index2.php">se connecter</a>
            
            </div>
        </li>
        -->
        <li class="btn" style="float:right">
            <a href="logout.php">
                Log out
            </a>
        </li>
    </ul>
</nav>
</div>












    
    <header>
        <div id="head">

        
            <div class="img">
                
                    <img src= "<?php echo($image); ?>" width="300">
                
            </div>
                 
            <div class="ktiba">
                
                    <h1 class="bienvenue"> bonjour <?php echo($pseudo);    ?></h1> 
                
            </div>
                
        
        </div>
    </header>




  







    <div class="deco1">
    
    </div>

    <div class="box1">
        


        
        <?php  if(isset($_POST['inscription']) AND isset($return)) echo $return;   ?>

        <div class="inscription">
            <form  action="#" method="POST">
                <input type="text" name="pseudo" placeholder = "Votre nom">
                <input type="email" name="email" placeholder = "Votre email">
                <input type="password" name="password" placeholder="Votre password">
                <input type="password" name="password2" placeholder="confirmer votre password">

                <div class="boutton">
                    <input type="submit" name="inscription" value="Inscrire">

                </div>

            </form>
        </div>

        <div class="contenu">
            lala
        </div>


        
        
        
    </div>



</body>
</html>