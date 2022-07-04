
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
</head>
<body>
    <h1>Contactez-nous</h1>
    <h3>Pour Toute demande, remplissez le formulaire ci-dessous</h3>

    <form method="post">
        <label > Email</label>
        <input type="email" name="email" required >
        <label>Sujet</label>
        <input type="text" name="sujet" required>
        <textarea name="message" required></textarea>
        <input type="submit" value="Envoyer le message"></input>


    </form>


<?php
$message = "ce message vien du site clubequus hammamet 
mail de la personne : " . $_POST["email"] ."
sont message : " . $_POST["message"];

if(isset($_POST["message"]))
{

$result = mail("selim03gaaloul@gmail.com",$_POST["sujet"],$message,"From:contact@clubequus-hammamet.com");
if($result)
{
    echo "<p> mail envoyer </p>" ;
}


}



?>



    
</body>
</html>




