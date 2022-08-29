<?php
include_once("../classes/Cliente.php");
include_once("../classes/Animais.php");
include_once("../classes/Consultas.php");

// $objCliente = new Cliente();
// $objAnimal = new Animais();

if(isset($_POST['idClienteDeletar'])){
    $objCliente = new Cliente();
    $objCliente->deletar($_POST['idClienteDeletar']);
}else if(isset($_POST['idAnimalDeletar'])) {
    $objAnimal = new Animais();
    $objAnimal->deletar($_POST['idAnimalDeletar']);

}else if(isset($_POST['idAgendamentoDeletar'])) {
    $objAnimal = new Consultas();
    $objAnimal->deletar($_POST['idAgendamentoDeletar']);

}

