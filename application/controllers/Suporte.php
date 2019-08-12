<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suporte extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		$this->load->model('servico_model');
	}


	public function abrir_chamado(){
		
		$this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('servicos/suporte/abrir_chamado');
	}

	public function abrir_chamado_submit(){
		
		$dados = array(
			'codigo' => $this->input->post('codigo'),
			'id_equipamento' => 3,
			'num_serie' => $this->input->post('num_serie'),
			'nome' => $this->input->post('equipamento'),
			//'descricao' => $this->input->post('descricao'),
			'status' => 'pendente',
			'data_abertura' => date('Y-m-d'),
			'defeito' => $this->input->post('defeito'),
			'local_id' => $this->input->post('local_id'), 
		);

		$chamado = $this->servico_model->abrir_chamado($dados);

		echo json_encode($chamado);

	}

	// Filtra os chamados por STATUS
	public function busca_chamado_ajax(){

		$status = $this->input->post('status');
		$dados = $this->servico_model->busca_chamado_ajax($status);
		echo json_encode($dados);

	}


	public function busca_detalhes_abrir_chamado(){

		$dados = $this->servico_model->busca_detalhes_abrir_chamado($this->input->post('codigo'));
		echo json_encode($dados);

	}


    public function busca_detalhes(){
		
		$id = $this->input->post('id');

        $this->db->select('e.*, c.*, l.descricao')
            ->from('serv_chamado c')
            ->join('serv_equipamento e','e.id=c.id_equipamento')
            ->join('serv_local l', 'l.id = e.local_id')
            ->where('c.id_equipamento=', $id)
            ->order_by('c.id_equipamento', 'DESC')
            ->limit(1);
        $query=$this->db->get();
        $resultado=$query->result_array();

        echo json_encode($resultado);
    }


	public function alterar($teste){

		$this->servico_model->alterar($teste);

	}


	public function finalizar_chamado_submit(){

		$dados = array(
			'codigo' => $this->input->post('codigo'),
			'data_solucao' => $this->input->post('data_solucao'),
			'solucao' => $this->input->post('solucao'), 
		);

		$this->servico_model->finalizar_chamado($dados);
		$this->index();

	}


	public function editar($id){

		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$data['chamado'] = $this->servico_model->busca_detalhes($id);

        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('servicos/suporte/editar_chamado', $data);
		
	}


	public function editar_submit(){
	
		$dados = array(
			'codigo' => $this->input->post('codigo'),
			'id_equipamento' => $this->input->post('id_equipamento'),
			'num_serie' => $this->input->post('num_serie'),
			'nome' => $this->input->post('equipamento'),
			// do local 'descricao' => $this->input->post('descricao'),
			'status' => $this->input->post('status'),
			'data_atendimento' => $this->input->post('data_atendimento'),
			'data_solucao' => $this->input->post('data_solucao'),
			'defeito' => $this->input->post('defeito'),
			'solucao' => $this->input->post('solucao'),
			//'local_id' => $this->input->post('local_id'),

		);

		$this->servico_model->editar_chamado($dados);

		redirect('servico/servicos', 'refresh');
	}


	public function busca_local(){
		
		$local = $this->servico_model->busca_local();
		echo json_encode($local);
	}


	public function adicionar_local(){

		$adicionar = $this->servico_model->adicionar_local($this->input->post('local'));
		if ($adicionar) {
			echo json_encode($adicionar);
		}else {
			echo json_encode('Já tem');
		}
		
	}


	public function buscar_codigo(){
		
		$codigo = $_SESSION['codigo'];
        $local = $this->servico_model->existe_codigo($codigo);

        echo $local;
    }


}
