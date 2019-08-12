<?php
/**
 * Created by PhpStorm.
 * User: PisoniPC
 * Date: 16/05/2019
 * Time: 08:30
 */

class Usuario_model extends CI_Model {

    function autenticar($email, $senha){
        /*/
            Perfis de usuário:
            [professor] == 1 -> professor
            [professor] == 2 -> professor e coordenador
            [admin] == 1 -> admin
        /*/

        $this->db->select("u.id, e.email, u.senha,
                           count(adm.pessoa_id) as admin")
            ->from("pessoa p")
            ->join('usuario u','u.pessoa_id = p.id ', 'left')
            ->join('email e','e.pessoa_id = p.id', 'left')
            ->join('administrador adm','adm.pessoa_id = p.id', 'left')
            ->where("e.email", $email)
            ->where("u.senha", $senha);

        $query = $this->db->get();
        $usuario = $query->result();
        $usuario = json_decode(json_encode($usuario), True);
        return $usuario;
    }

    function buscarPermissaoAdmin($admin_id){
        $this->db->select("p.*")
            ->from("permissao_admin pa")
            ->join("permissao p","p.id=pa.permissao_id")
            ->where("pa.admin_id",$admin_id);
        $query=$this->db->get();
        $retorno = $query->result();
        $retorno = json_decode(json_encode($retorno), True);
        return $retorno;
    }


    /*/  FUNÇÕES DE BUSCA  /*/

    function buscarUsuarioEspecifico($id){
        $this->db->select("p.id as pessoa_id, p.nome, p.foto, e.email")
            ->from("pessoa p")
            ->join("usuario u", "p.id = u.pessoa_id")
            ->join("email e", "e.pessoa_id = p.id")
            ->where("u.id", $_SESSION['user_data']['id']);
        $query=$this->db->get();
        $retorno = $query->result();
        $retorno = json_decode(json_encode($retorno), True);
        $retorno = $retorno[0];


        /*/  é professor  /*/
        $professor = $this->usuarioProfessor($retorno['pessoa_id']);
        $retorno['professor'] = $professor;

        if($retorno['professor']==2){
            $this->db->select("c.curso_id")
                ->from("coordenador_curso c")
                ->join("professor pr", "pr.id = c.professor_id")
                ->where("pr.id", 1);
            $query=$this->db->get();
            $curso = $query->result();
            $curso = json_decode(json_encode($curso), True);
            $curso = $curso[0];
            $curso = $curso['curso_id'];

            $this->db->select("c.titulo")
                ->from("curso c")
                ->where("c.id", $curso);
            $query=$this->db->get();
            $curso = $query->result();
            $curso = json_decode(json_encode($curso), True);
            $curso = $curso[0];
            $curso = $curso['titulo'];

            $retorno['curso'] = $curso;
        }

        print_r($retorno['pessoa_id']);

        /*/  servidor  /*/
        $this->db->select("serv.funcao_id as id_servidor")
            ->from("servidor serv")
            ->where("serv.pessoa_id", $retorno['pessoa_id']);
        $query=$this->db->get();
        $servidor = $query->result_array();

        $result = array();
        foreach ($servidor as $array){
            array_push($result, $array['id_servidor']);
        }

        if(empty($servidor)){
            $retorno['servidor'] = 0;
        }
        else{
            $retorno['servidor'] = $result;
        }






        return $retorno;
    } // Retorna UM usuário específico

    function buscarUsuario($usuario_id){
        $this->db->select("u.id, p.id as pessoa_id, p.nome, p.rg, p.cpf, u.status ")
            ->from("pessoa p")
            ->join("usuario u","p.id=u.pessoa_id")
            ->where("u.id",$usuario_id);
        $query=$this->db->get();
        $retorno = $query->result();
        $retorno = json_decode(json_encode($retorno), True);
        $retorno = $retorno[0];

        /*/  email  /*/
        $emails = $this->usuarioEmail($retorno['pessoa_id']);
        $retorno['email'] = $emails;

        /*/  é admin  /*/
        $admin = $this->existeAdmin($retorno['pessoa_id']);
        $retorno['admin'] = $admin;

        /*/  permissoes  /*/
        $permissoes = $this->usuarioPermissoes($retorno['pessoa_id']);
        $permissoes = json_decode(json_encode($permissoes), True);
        $retorno['permissoes'] = $permissoes;

        /*/  servidor  /*/
        $servidor = $this->usuarioServidor($retorno['pessoa_id']);
        $servidor = json_decode(json_encode($servidor), True);
        $retorno['servidor'] = $servidor;

        /*/  é aluno  /*/
        $aluno = $this->usuarioAluno($retorno['pessoa_id']);
        $retorno['aluno'] = $aluno;

        /*/  é professor  /*/
        $professor = $this->usuarioProfessor($retorno['pessoa_id']);
        $retorno['professor'] = $professor;


        return $retorno;
    } // Retorna UM usuário específico





    function usuarios_atuais(){

        $this->db->select("u.id, p.foto, p.nome, e.email")
            ->from("pessoa p")
            ->join("usuario u", "u.pessoa_id = p.id")
            ->join("email e", "e.pessoa_id = p.id");
        $query=$this->db->get();
        $retorno = $query->result_array();



        return $retorno;
    } // busca TODOS os usuários


    function autenticar_edicao($pessoa_id){
        /*/  ------ dados pessoais ------  /*/
        $data = array(
            'nome' => $_POST['nome'],
            'cpf' => $_POST['cpf'],
            'rg' => $_POST['rg']
        );
        $this->db->where('id', $pessoa_id);
        $this->db->update('pessoa', $data);

        /*/  email  /*/
        $data = array(
            'email' => $_POST['email']
        );
        $this->db->where('pessoa_id', $pessoa_id);
        $this->db->update('email', $data);

        /*/  status  /*/
        $data = array(
            'status' => filter_input(INPUT_POST, 'status')
        );
        $this->db->where('pessoa_id', $pessoa_id);
        $this->db->update('usuario', $data);



        /*/  ------ checkbox Perfil ------  /*/


        /*/  Aluno  /*/
        if (isset($_POST['aluno']))
        {
            $data = array(
                'status' => 'ativo',
                'pessoa_id' => $pessoa_id,
                'situacao' => 'matriculado',
                'periodo' => '1'
            );

            if($this->usuarioAluno($pessoa_id) == 1){
                $this->db->where('pessoa_id', $pessoa_id);
                $this->db->update('aluno', $data);
            }
            else{
                $this->db->insert('aluno', $data);
            }
        }
        else{
            $this->db->where('pessoa_id', $pessoa_id);
            $this->db->delete('aluno');
        }



        /*/  Professor  /*/
        if (isset($_POST['professor']))
        {
            $data = array(
                'carga_horaria' => '40',
                'pessoa_id' => $pessoa_id,
                'status' => 'ativo',
                'ip' => 'xxx-xxx'
            );

            if($this->usuarioProfessor($pessoa_id) >= 1){
                $this->db->where('pessoa_id', $pessoa_id);
                $this->db->update('professor', $data);
            }
            else{
                $this->db->insert('professor', $data);
            }
        }
        else{
            $this->db->where('pessoa_id', $pessoa_id);
            $this->db->delete('professor');
        }



        /*/  Servidor  /*/
        $servidor = isset($_POST["serv"]) ? $_POST["serv"] : NULL;
        $servidores = array();
        if(!empty($servidor)){
            foreach($servidor as $serv){
                array_push($servidores, $serv);
                if($this->existeServidor($serv, $pessoa_id) == 1){
                    $this->db->insert('servidor', array('funcao_id' => $serv, 'pessoa_id' => $pessoa_id));
                }
            }
            if(!empty($servidores)){
                if(!in_array(1, $servidores)){
                    $this->db->where('pessoa_id', $pessoa_id);
                    $this->db->where('funcao_id', 1);
                    $this->db->delete('servidor');
                }
                if(!in_array(2, $servidores)){
                    $this->db->where('pessoa_id', $pessoa_id);
                    $this->db->where('funcao_id', 2);
                    $this->db->delete('servidor');
                }
                if(!in_array(3, $servidores)){
                    $this->db->where('pessoa_id', $pessoa_id);
                    $this->db->where('funcao_id', 3);
                    $this->db->delete('servidor');
                }
                if(!in_array(4, $servidores)){
                    $this->db->where('pessoa_id', $pessoa_id);
                    $this->db->where('funcao_id', 4);
                    $this->db->delete('servidor');
                }
            }
        }
        else{
            $this->db->where('pessoa_id', $pessoa_id);
            $this->db->delete('servidor');
        }



        /*/  Admin  /*/
        $adminPermissoes = isset($_POST["admin"]) ? $_POST["admin"] : NULL;
        $administrador = isset($_POST["administrador"]) ? $_POST["administrador"] : NULL;
        $permissoes = array();
        if(!empty($administrador)){
            if($this->existeAdmin($pessoa_id) == 1){
                $this->db->insert('administrador', array('pessoa_id' => $pessoa_id, 'status' => "ativo"));
            }
            if(!empty($adminPermissoes)){
                foreach($adminPermissoes as $admin){
                    array_push($permissoes, $admin);
                    if($this->existeAdminPermissao($admin, $pessoa_id) == 1){
                        $this->db->insert('permissao_admin', array('admin_id' => $pessoa_id, 'permissao_id' => $admin));
                    }
                }
                if(!empty($permissoes)){
                    if(!in_array(1, $permissoes)){
                        $this->db->where('admin_id', $pessoa_id);
                        $this->db->where('permissao_id', 1);
                        $this->db->delete('permissao_admin');
                    }
                    if(!in_array(2, $permissoes)){
                        $this->db->where('admin_id', $pessoa_id);
                        $this->db->where('permissao_id', 2);
                        $this->db->delete('permissao_admin');
                    }
                    if(!in_array(3, $permissoes)){
                        $this->db->where('admin_id', $pessoa_id);
                        $this->db->where('permissao_id', 3);
                        $this->db->delete('permissao_admin');
                    }
                    if(!in_array(4, $permissoes)){
                        $this->db->where('admin_id', $pessoa_id);
                        $this->db->where('permissao_id', 4);
                        $this->db->delete('permissao_admin');
                    }
                    if(!in_array(5, $permissoes)){
                        $this->db->where('admin_id', $pessoa_id);
                        $this->db->where('permissao_id', 5);
                        $this->db->delete('permissao_admin');
                    }
                    if(!in_array(6, $permissoes)){
                        $this->db->where('admin_id', $pessoa_id);
                        $this->db->where('permissao_id', 6);
                        $this->db->delete('permissao_admin');
                    }
                }
            }
            else{
                $this->db->where('admin_id', $pessoa_id);
                $this->db->delete('permissao_admin');
            }
        }
        else{
            $this->db->where('pessoa_id', $pessoa_id);
            $this->db->delete('administrador');
        }

        return true;

    } // faz as alterações de edição




    /*/  FUNÇÕES DE CONFIRMAÇÃO  /*/

    function usuarioEmail($pessoa_id){
        $this->db->select("e.email")
            ->from("email e")
            ->join("pessoa p","p.id=e.pessoa_id")
            ->where("p.id", $pessoa_id);
        $query=$this->db->get();
        $result = $query->result();
        $result = json_decode(json_encode($result), True);

        foreach ($result as $email){
            $result = $email['email'];
        }

        if(is_array($result)){
            $result = "sem email";
        }

        return $result;

    } // busca email da pessoa

    function usuarioPermissoes($pessoa_id){
        $this->db->select("perm.permissao_id")
            ->from("permissao_admin perm")
            ->join("administrador adm","perm.admin_id = adm.pessoa_id")
            ->where("adm.pessoa_id", $pessoa_id);
        $query=$this->db->get();
        $result = $query->result();
        $result = json_decode(json_encode($result), True);

        $retorno = array();
        foreach ($result as $array){
            array_push($retorno, $array['permissao_id']);
        }

        return $retorno;
    } // busca se tem permissões

    function usuarioAluno($pessoa_id){
        $this->db->select("a.id")
            ->from("aluno a")
            ->join("pessoa p","a.pessoa_id = p.id")
            ->where("p.id", $pessoa_id);
        $query=$this->db->get();
        $aluno = $query->result();

        if(count($aluno)){
            return 1;
        }
        else{
            return 0;
        }

    } // busca se é aluno

    function usuarioServidor($pessoa_id){
        $this->db->select("serv.funcao_id as id_servidor")
            ->from("servidor serv")
            ->where("serv.pessoa_id", $pessoa_id);
        $query=$this->db->get();
        $result = $query->result();
        $result = json_decode(json_encode($result), True);

        $servidor = array();
        foreach ($result as $array){
            array_push($servidor, $array['id_servidor']);
        }

        return $servidor;
    } // busca se é servidor e retorna serviços

    function usuarioProfessor($pessoa_id){
        $this->db->select("pr.id")
            ->from("professor pr")
            ->join("pessoa p","pr.pessoa_id = p.id")
            ->where("p.id", $pessoa_id);
        $query=$this->db->get();
        $professor = $query->result();

        $this->db->select("cc.curso_id")
            ->from("coordenador_curso cc")
            ->join("professor pr","cc.professor_id = pr.id")
            ->join("pessoa p", "pr.pessoa_id = p.id")
            ->where("p.id", $pessoa_id);
        $query=$this->db->get();
        $coordenador = $query->result();

        if(count($professor)){
            if(count($coordenador)){
                return 2;
            }
            return 1;
        }
        else{
            return 0;
        }

    } // busca se é professor

    function existeServidor($servico, $pessoa_id){
        $this->db->select("serv.funcao_id as id_servidor")
            ->from("servidor serv")
            ->where("serv.pessoa_id", $pessoa_id)
            ->where('serv.funcao_id', $servico);
        $query=$this->db->get();
        $result = $query->result();

        if(count($result)){
            return 0; // existe
        }
        else{
            return 1; // insert
        }
    } // busca se existe servidor e serviços

    function existeAdmin($pessoa_id){
        $this->db->select("admin.pessoa_id")
            ->from("administrador admin")
            ->where("admin.pessoa_id", $pessoa_id);
        $query=$this->db->get();
        $result = $query->result();

        if(count($result)){
            return 0; // existe
        }
        else{
            return 1; // insert
        }
    } // busca se existe admin

    function existeAdminPermissao($perm, $pessoa_id){
        $this->db->select("pa.admin_id")
            ->from("permissao_admin pa")
            ->where("pa.admin_id", $pessoa_id)
            ->where('pa.permissao_id', $perm);
        $query=$this->db->get();
        $result = $query->result();

        if(count($result)){
            return 0; // existe
        }
        else{
            return 1; // insert
        }
    } // busca se admin tem permissoes
}