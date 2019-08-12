<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->library('templates');
    }

    public function inicio()
    {
        $this->load->view('templates/header');
        $this->load->view('login');
    }


    /*/  LOGIN E LOGOUT  /*/

    public function login($tentativa)
    {
        $this->load->view('templates/header');
        $this->load->view('login', $tentativa);
    }

    function logout($mandioca)
    {
        unset($_SESSION['user_data']);
        $this->load->view('templates/header');
        $this->load->view('login');
    }


    /*/  CARREGAMENTO DE PÁGINAS  /*/
    public function perfil($perfil){
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('perfil/perfil');
    }

    public function biblioteca(){
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('biblioteca/biblioteca');
    }

    function usuarios_atuais(){
        $_SESSION['usuarios_atuais'] = $this->usuario_model->usuarios_atuais();
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('usuarios/usuarios_atuais');
    }

    function editar_usuario($id){
        $_SESSION['usuario_edicao'] = $this->usuario_model->buscarUsuario($id);
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('usuarios/form_edicao');
    }



    /*/  autenticação do login  /*/
    function autenticar(){
        $this->load->model('usuario_model', 'user');
        $email = $this->input->post('email');
        $senha = md5($this->input->post('senha'));


        $resultado = $this->user->autenticar($email,$senha);

        if(empty($resultado[0])){
            redirect("login/1");
        }
        else{
            $resultado = $resultado[0];
            if($resultado){
                $_SESSION['user_data']['id']=$resultado['id'];
                $_SESSION['user_data']['perfil'] = $this->user->buscarUsuarioEspecifico($_SESSION['user_data']['id']);

                if($resultado['admin'] == 1){
                    $_SESSION['user_data']['permissoes']['titulo']="admin";
                    $permissoes = $this->user->buscarPermissaoAdmin($resultado['id']);
                    $_SESSION['user_data']['permissoes']['permissoes'] = $permissoes[0];
                }
                redirect("perfil/".$resultado['id']);
            }
        }
    }

    /*/  autenticação pós edição  /*/
    function autenticar_edicao_usuario($pessoa_id){

        if($this->usuario_model->autenticar_edicao($pessoa_id)){

            redirect('usuarios_atuais');

        }


    }

}