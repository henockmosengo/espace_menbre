
<?php require 'function.php';?>
<?php
    if(empty($_POST)){
        $error=array();
        if(empty($_POST['nom']) || !preg_match('/^[a-z0-9_]+$/',$_POST['nom']))
        {
            $error['nom']="votre nom est non valider (alphanumerique)";
        }
        //pour le mail
        if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
            $error['email']="votre email n'est pas valide";
        }
        //pour le mot de passe
        if(empty($_POST['mdp']) || $_POST['mdp'] !=$_POST['confmdp']) 
        {
            $error['mdp']="vous devez rentrer un mot de passe valide";
        }
        debug($error);
    }
    // inscrire un nouveau
    if(empty($error))
    {
        require 'db.php';
        $req=$pdo->prepare("INSERT INTO `membres`( `prenom`, `email`, `password`,confirmation_token) VALUES (?,?,?,?)");
        // $password=password_hash($_POST['mdp'],PASSWORD_BCRYPT);
        $token=str_random(60);
        debug($token);
        die();
        $req->execute([$_POST['nom'],$_POST['email'],$_POST['mdp'],$token]);
        // envoyer le token
        $user_id=$pdo->lastInsertId();
    mail($_POST['email'],'confirmation de vote compte',"afin de valider votre compte mercide cliquersurce lien\n\nhttp://http://localhost:81/membres/confirmation.php?id=$user_id &token=$token");
    header('location:index.php');
    exit();
    }
?>
<html>
    <head>
        <title>bonjour</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="menu.css">
    </head>
    <body>
    <header>

<nav>
    <div class="logo">STM notification</div>
    <ul>
        <li><a href="#">accueil</a></li>
        <li><a href="#">message</a>
        <ul>
                <li><a href="#">Tout options</a></li>
            </ul>
    </li>
        <li><a href="#">etudiant</a></li>
        <li><a href="#">section</a>
            <ul>
                <li><a href="#">option</a></li>
                <li><a href="#">promotion</a></li>
            </ul>
        </li>
    </ul>
</nav>
</header>

        <div class="text">
            <h3>welcom</h3>
        </div>
        <div class="message">
        <form action="" method="post">
            <label for="nom">Nom</label>
            <input type="text" name="nom"  required>
            <label for="email">Email</label>
            <input type="text" name="email" required> 
            <label for="mdp">Mot de passe</label> 
            <input type="text" name="mdp" id=""> 
            <label for="confmdp">Confirmation mot de passe</label>
            <input type="text" name="confmdp" id="">       
           <input type="submit" value="valider">
                   </form>
         
      
        
        </form>
    </div>
    </body>
</html>