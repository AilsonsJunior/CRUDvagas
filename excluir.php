<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

//valida o id da vaga
if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//consulta a vaga
$obVaga = Vaga::getVaga($_GET['id']);


//Validando vaga 
if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['excluir'])){

    $obVaga->excluir();

    header('location: index.php?status=success');
    exit;
}



include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmarexcluir.php';
include __DIR__.'/includes/footer.php';

?> 