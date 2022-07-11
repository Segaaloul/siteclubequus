
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>contact</title>
    <link rel="stylesheet" type="text/css" href="css/styles2.css">
</head>
<body>


   <!-- Header -->
   <header>
        <div id="head">

        
            <div class="img">
                <img src="img/téléchargement.jpg" width="150">
            </div>
                 
            <div class="ktiba">
                <h1 class="bienvenue">Formulaire de contact</h1> 
            </div>
                
        
        </div>
    </header>



    
    <div class="text">
        <h1><strong>Contactez</strong>-nous</h1>
        <h3>Pour Toute demande, remplissez le formulaire ci-dessous</h3>

    </div>

  <div class="formulaire">
    <form class="formbloc" method="post" >
                <!-- <label > Email</label> -->
                <div class="formgroupe">
                <input type="email" name="email" placeholder="votre email" required > <br/> <br/>
                </div>
                
                <!-- <label>Sujet</label> -->
                <div class="formgroupe">
                <input type="text" name="sujet" placeholder="votre Sujet"required> <br/> <br/>
                </div>
                
                <!-- <label>Message</label> -->
                <div class="formgroupe">
                <textarea name="message" placeholder="votre message"required></textarea> <br/> <br/>
                </div>

                <div class="bouton">
                <input type="submit" value="Envoyer"></input> <br/> <br/>
                </div>
                


            </form>


            <?php
            $message = "Ce message vien du site clubequus hammamet 
            Mail de l'expéditeur : " . $_POST["email"] ."
            Message : " . $_POST["message"];

            if(isset($_POST["message"]))
            {

            $result = mail("selim03gaaloul@gmail.com",$_POST["sujet"],$message,"From:contact@clubequus-hammamet.com");
            if($result)
            {
                echo "<p> mail envoyer </p>" ;
            }


            }



            ?>

    
       


  </div>

   







<!-- Pied de la page -->

<footer>
    <div class="contact">
        <p>
            Numero: +216 50 111 079
        </p>
        <p>
            Numero: +216 55 848 890
        </p>
        
    </div>

    <div class="copy">
        <p>
            Copyright &copy; Selim Gaaloul - 2022 - All Right Reseved
        </p>
    </div>

    <div class="QR" style="float:right">
        <img src="img/qr_instagram_selim.png" width="120px">
        
    </div>

</footer>
    
</body>



</html>




