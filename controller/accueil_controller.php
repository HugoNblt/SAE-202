<?php
require_once('model/commentaire_model.php');

function index()
{
    $comments = getPublishedComments();
    require('view/autres_pages/header.php');
    require('view/accueil_view.php');
     require('view/autres_pages/footer.php');
}
?>