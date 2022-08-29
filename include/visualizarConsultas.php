<?php
include_once("../classes/Animais.php");
include_once("../classes/Consultas.php");


?>


<?php

// $objConsulta->selecionarPorDono($_GET['id']);
    $objConsulta = new Consultas();
    $objConsulta->selecionarPorAnimal($_GET['id']);
    $id_consulta_animal = $objConsulta->retornoBD->fetch_object()->id_consulta_animal;
if ($id_consulta_animal != null) {

    $objAnimal = new Animais();
    $objAnimal->selecionarPorId($id_consulta_animal);
    $nomeAnimal = $objAnimal->retornoBD->fetch_object()->nome_animal;
    $nomeDono = $objAnimal->chamaDono($_GET['id']);
    $objConsulta->selecionarPorAnimal($_GET['id']);

?>
    <div class="row">
        <div class="col-lg-6">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-8">
                <h3 class="m-0 font-weight-bold">Consultas do(a) <?= $nomeAnimal; ?> filho(a) de <?= $nomeDono; ?> </h3>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th width=>#</th>
                    <th width="60%">Observações</th>
                    <th width="30%">Data/Hora</th>
                    <th width=>Editar</th>
                    <th width=>Deletar</th>
                </tr>

                <?php

                while ($retorno = $objConsulta->retornoBD->fetch_object()) {
                    echo '<tr><td>' . $retorno->id_consulta . '</td>
                        <td>' . $retorno->observacao_consulta . '</td>
                        <td>' . $retorno->data_consulta . '</td>';

                    echo '<td><a href="?rota=editar_consulta&id=' . $retorno->id_consulta . '" class="btn btn-info btn-circle btn-sm"><i class="fas fa-list"></i></a></td>';
                    echo '<td><a href="#" class="btn btn-danger btn-circle btn-sm" onclick=\'deletarAgendamento("' . $retorno->id_consulta . '");\'><i class="fas fa-trash"></i></a></td></tr>';
                }

                ?>
            </table>
        </div>
    </div>

<?php
} 
?>