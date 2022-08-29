<?php
include_once("../classes/Animais.php");
include_once("../classes/Consultas.php");
include_once("../classes/Cliente.php");

// $objAnimal = new Animais();
// $objAnimal->selecionarPorId($_GET['id']);
// echo $_GET['id'];
// $nomeAnimal = $objAnimal->retornoBD->fetch_object()->nome_animal;
// echo "Nome: " .$nomeAnimal;
// $objAnimal->selecionarPorId($_GET['id']);
// $id_animal_cliente = $objAnimal->retornoBD->fetch_object()->id_animal_cliente;
// echo " id cliente: " .$id_animal_cliente;
// $ObjCiente = new Cliente();
// $ObjCiente->selecionarPorId($id_animal_cliente);
// $cpfDonoAnimal = $ObjCiente->retornoBD->fetch_object()->cpf_cliente;
// // echo " cpf: " .$cpfDonoAnimal;
$objConsulta = new Consultas();
$objConsulta->selecionarPorId($_GET['id']);
$id_consulta_animal = $objConsulta->retornoBD->fetch_object()->id_consulta_animal;
$objAnimal = new Animais();
$objAnimal->selecionarPorId($id_consulta_animal);
$nomeAnimal = $objAnimal->retornoBD->fetch_object()->nome_animal;
$objAnimal->selecionarPorId($id_consulta_animal);
$id_animal_cliente = $objAnimal->retornoBD->fetch_object()->id_animal_cliente;
$ObjCiente = new Cliente();
$ObjCiente->selecionarPorId($id_animal_cliente);
$cpfDonoAnimal = $ObjCiente->retornoBD->fetch_object()->cpf_cliente;
// $objConsulta = new Consultas();
if (isset($_GET['id'])) {
    $objConsulta->selecionarPorId($_GET['id']);
}
// $objConsulta->chamaAnimalEDono($_GET['id']);
// $nomeAnimal = $objConsulta->retornoBD->fetch_object()->nomeAnimal;
// echo $nomeAnimal;
// $objConsulta->chamaAnimalEDono($_GET['id']);
// $cpfDonoAnimal = $objConsulta->retornoBD->fetch_object()->cpfDonoAnimal;
// echo $cpfDonoAnimal;
// $objConsulta->selecionarPorAnimal($_GET['id']);
$retorno = $objConsulta->retornoBD->fetch_object();
$newData = explode(" ", $retorno->data_consulta);
// $date = date_create($retorno->data_consulta);
// $horas = date_create($retorno->data_consulta);
// echo date_format($horas, 'H:i');
// echo date_format($date, 'd/m/Y');
// echo " data ".$newData[0];
// echo " hora ".$newData[1];
// echo " data ".$retorno->data_consulta;

// echo " format ". $newData[0]->date_format("d/m/y");
?>

<div class="container">
    <div class="row">
        <div class="col-10">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Animal</label>
                    <input type="text" class="form-control" id="nome-animal" aria-describedby="nomeHelp" name="nomeAnimal" value="<?php echo $nomeAnimal; ?>" disabled>
                    <div id="nome" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label for="cpfDono" class="form-label">CPF do Dono</label>
                    <input type="text" class="form-control" id="cpfDono-animal" aria-describedby="cpfDonoHelp" name="cpfDonoAnimal" value="<?= $cpfDonoAnimal;?>" disabled>
                    <div id="cpfDono" class="form-text"></div>
                </div>

                <div class="mb-3">
                    <label for="dataConsulta" class="form-label">Data</label>
                    <input type="time" class="form-control" id="hora-consulta" aria-describedby="horaConsultaHelp" name="horaConsultaAnimal" value="<?php echo $newData[1] ?>">
                    <input type="date" class="form-control" id="data-consulta" aria-describedby="dataConsultaHelp" name="dataConsultaAnimal" value="<?php echo $newData[0] ?>" >
                    <div id="dataConsulta" class="form-date"></div>
                </div>
                <div class="mb-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <input type="text" class="form-control" id="observacoes-consulta" aria-describedby="observacoesHelp" name="observacoesConsulta" value="<?php echo $retorno->observacao_consulta; ?>">
                    <div id="observacoes" class="form-text"></div>
                </div>

                <input type="hidden" value="<?php echo $retorno->id_consulta; ?>" name="idConsulta" >
                <input type="hidden" name="formEditarConsulta">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
</div>
<?php

// }else{
//     header("Location:../index.html");
// }
?>