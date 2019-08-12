<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
        $this->load->model('servico_model');
	}

    /*/  CARREGA A VIEW INICIAL  /*/
    public function servicos(){
        $_SESSION['chamados'] = $this->servico_model->busca_chamado();
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('servicos/suporte/index');
    }
	
}
