<?php
include_once("../classes/Conexao.php");
include_once("../classes/Utilidades.php");
include_once("../classes/Cliente.php");
// session_start();
class Animais
{

    private $nome;
    private $id;
    private $raca;
    private $sexo;
    private $especie;
    private $utilidades;

    public $retornoBD;
    public $conexaoBD;
    public $animais;

    public function  __construct()
    {
        $objConexao = new Conexao();
        $this->conexaoBD = $objConexao->getConexao();
        $this->utilidades = new Utilidades();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getRaca()
    {
        return $this->raca;
    }
    public function getEspecie()
    {
        return $this->especie;
    }
    public function getSexo()
    {
        return $this->sexo;
    }
    public function getDono()
    {
        return $this->cpf_dono;
    }


    public function setNome($nome)
    {
        //validacao
        return $this->nome =  mb_strtoupper($nome, 'UTF-8');
    }
    public function setId($id)
    {
        //validacao
        return $this->id = $id;
    }
    public function setRaca($raca)
    {
        return $this->raca = $raca;
    }
    public function setEspecie($especie)
    {
        return $this->especie = $especie;
    }
    public function setSexo($sexo)
    {
        return $this->sexo = $sexo;
    }
    public function setDono($cpf_dono)
    {
        return $this->cpf_dono = $cpf_dono;
    }
    
    public function cadastrar()
    {

        if ($this->getDono() != null) {
                $objDono = new Cliente;
                $objDono->selecionarPorCPF($this->getDono());
                $dono_id = $objDono->retornoBD->fetch_object()->id_cliente;
            if ($dono_id){
                $interacaoMySql = $this->conexaoBD->prepare("INSERT INTO animais (id_animal_cliente, nome_animal, raca_animal, especie_animal, sexo_animal) 
                VALUES (?, ?, ?, ?, ?)");
                $interacaoMySql->bind_param('issss', $dono_id, $this->getNome(), $this->getRaca(), $this->getEspecie(), $this->getSexo());
                $retorno = $interacaoMySql->execute();

                $id = mysqli_insert_id($this->conexaoBD);
            }

            return $this->utilidades->validaRedirecionar($retorno, $id, "admin.php?rota=visualizar_animais", "O animal foi cadastrado com sucesso!");
        } else {
            return $this->utilidades->mesagemParaUsuario("Erro, cadastro não realizado! Dono não encontrado.");
        }
    }

    public function editar()
    {

        if ($this->getId() != null) {

            $interacaoMySql = $this->conexaoBD->prepare("UPDATE animais SET nome_animal=?, raca_animal=?, especie_animal=?, sexo_animal=? WHERE id_animal=?");
            $interacaoMySql->bind_param('ssssi', $this->getNome(), $this->getRaca(), $this->getEspecie(), $this->getSexo(), $this->getId());
            $retorno = $interacaoMySql->execute();
            if ($retorno === false) {
                trigger_error($this->conexaoBD->error, E_USER_ERROR);
            }

            $id = mysqli_insert_id($this->conexaoBD);

            return $this->utilidades->validaRedirecionar($retorno, $this->getId(), "admin.php?rota=visualizar_animais", "Os dados do animal foram alterados com sucesso!");
        } else {
            return $this->utilidades->mesagemParaUsuario("Erro! nome não foi infomado.");
        }
    }

    public function selecionarPorId($id)
    {
        $sql = "select * from animais where id_animal='$id'";
        $this->retornoBD = $this->conexaoBD->query($sql);

    }
    public function selecionarPorRaca($raca)
    {
        $sql = "select * from animais where raca_animal='$raca'";
        $this->retornoBD = $this->conexaoBD->query($sql);

    }
    public function selecionarPorNome($nome)
    {
        $sql = "SELECT * FROM `animais` WHERE `nome_animal`='$nome'";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }
    public function selecionarPorEspecie($especie)
    {
        $sql = "select * from animais where especie_animal='$especie'";
        $this->retornoBD = $this->conexaoBD->query($sql);

    }
    
    public function selecionarAnimais()
    {
        $sql = "select * from animais order by data_cadastro_animal DESC";
        $this->retornoBD = $this->conexaoBD->query($sql);
    }

       public function chamaDono($id)
    {
        $ObjCiente = new Cliente();
        $animal = new Animais();
        $animal->selecionarPorId($id);
        $ObjCiente->selecionarPorId((int)$animal->retornoBD->fetch_object()->id_animal_cliente);
        $nomeDono = $ObjCiente->retornoBD->fetch_object()->nome_cliente;
        // echo $nomeDono;
        return $nomeDono;
        // $sql = "select * from animais";
        // $this->animais = $this->conexaoBD->query($sql);
        // $animais = [];
        // while ($retorno = $this->animais->fetch_object()) {
        //     $objDono = new Cliente;
        //     $objDono->selecionarPorId((int)$retorno->id_animal_cliente);
        //     $dono = $objDono->retornoBD->fetch_object();
        //     $retorno->dono= $dono;
        //     array_push($animais, $retorno);            
        // }
        // foreach ($this->animais as $animal) {
        //     $objDono = new Cliente;
        //     $objDono->selecionarPorId((int)$animal->id_animal_cliente);
        //     $dono = $objDono->retornoBD->fetch_object();
        //     $animal = $dono;
        //     // $animal= array_merge($animal, ["dono"=> $dono]);
        //     // print_r($animal);
        // }
        // print_r($animal);
        // return $animais;
    }

    public function deletar($id)
    {
        $sql = "DELETE from animais where id_animal=$id";
        $this->retornoBD = $this->conexaoBD->query($sql);
        $this->utilidades->validaRedirecionaAcaoDeletar($this->retornoBD, 'admin.php?rota=visualizar_animais', 'O animal foi deletado com sucesso!');
    }

}
