<?php
    $user_id=$_GET['id'];
    $token=$_GET['token'];
    require 'db.php';
    $req=$pdo->prepare('SELECT confirmation_token FROM membres WHERE id=?');
    $req->execute([$user_id]);
    $user=$req->fetch();
    if($user && $user->confirmation_token=$token)
    {
        session_start();
        $pdo->prepare('UPDATE user SET confirmation_token=NULL,confirmation_at= WHERE id=? ')->execute([$user_id]);
        $_session['auth']=$user;
        header('location:compte.php');
    }
    else{
        $_SESSION['flash']['danger']="ce token n'est plus valide";
    }