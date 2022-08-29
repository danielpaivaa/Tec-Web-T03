<?php
include_once("../classes/Animais.php");
// session_start();
// if (isset($_SESSION['administrador'])){
?>
<div class="row">
    <div class="col-lg-6">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-8">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Pesquisar Animais</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome-Animal" aria-describedby="nomeHelp" name="nomeAnimal">
                            <div id="nome" class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$objAnimal = new Animais();

if (isset($_GET['id'])) {
    $objAnimal->selecionarPorId($_GET['id']);
}else if (isset($_POST['nomeAnimal'])){
    $objAnimal->selecionarPorNome($_POST['nomeAnimal']);
} else {
    $objAnimal->selecionarAnimais();
}

if ($objAnimal->retornoBD != null) {
?>
    <br/>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th width=>#</th>
                    <th width="18%">Nome</th>
                    <th width="18%">Raça</th>
                    <th width="18%">Espécie</th>
                    <th width="18%">Sexo</th>
                    <th width="18%">Dono(a)</th>
                    <th width=>Editar</th>
                    <th width=>Consultas</th>
                    <th width=>Deletar</th>
                </tr>

                <?php

                while ($retorno = $objAnimal->retornoBD->fetch_object()) {
                    echo '<tr><td>' . $retorno->id_animal . '</td>
                        <td>' . $retorno->nome_animal . '</td>
                        <td>' . $retorno->raca_animal . '</td>
                        <td>' . $retorno->especie_animal . '</td>
                        <td>' . $retorno->sexo_animal . '</td>
                        <td>' . $objAnimal->chamaDono($retorno->id_animal) . '</td>';

                    echo '<td><center><a href="?rota=editar_animal&id='.$retorno->id_animal.'" class="btn btn-info btn-circle btn-sm"><i class="fas fa-list"></i></a></center></td>';
                    echo '<td><center><a href="?rota=visualizar_consultas&id='.$retorno->id_animal.'" class="btn btn-success btn-circle btn-sm"><i class="bi bi-hospital"></i></a></center></td>';
                    echo '<td><center><a href="#" class="btn btn-danger btn-circle btn-sm" onclick=\'deletarAnimal("' . $retorno->id_animal . '");\'><i class="fas fa-trash"></i></a></center></td></tr>';

                }

                ?>
            </table>
        </div>
    </div>
    
<?php
}
// }else{
//     header("Location:../index.php");
// }
?>