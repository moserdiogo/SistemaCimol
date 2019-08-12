<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Armario extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('armario_model');

	}

    //  CARREGA A VIEW INICIAL
	public function index(){
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('armario/index');
	}
	
	// Busca todos armários quando carrega a página
	public function busca_todos_armarios_index_ajax(){

		$curso_id = Armario::buscaCursoId();
		
		$data['locados'] = $this->armario_model->busca_armario_locado($curso_id);
		$data['vencidos'] = $this->armario_model->busca_armario_vencido($curso_id);
		$data['disponiveis'] = $this->armario_model->busca_armario_disponivel($curso_id);

		echo json_encode($data);
	}

	// Carrega a página para alugar armário
	public function alugar(){
	
		$this->load->view('armario/alugar/index');
		$this->load->view('templates/header');
        $this->load->view('templates/nav');
	}

	// Aluga o armário e redireciona para a página inicial
	public function armario_alugado(){

		$curso_id = Armario::buscaCursoId();

		if (isset($_POST['alugar'])) {
			$inserir = array(
			//'armario_id' => $this->input->post('armario_id'),
			'armario_id' => $this->input->post('armario_id'),
			'data_fim' => $this->input->post('data_fim'),
			'data_inicio' => $this->input->post('data_inicio'),
			'aluno_id' => $this->input->post('aluno_id'),
			'data_entrega' => null,
			'curso_id' => $curso_id
			);

			$this->armario_model->alugar($inserir);

			redirect('armario/index', 'refresh');
		}
	}

	// Cadastra um novo armário
	public function cadastrar_armario(){

		$curso_id = Armario::buscaCursoId();
	
		$data = array(
		'numero' => $this->input->post('numero'),
		'curso_id' => $curso_id
		);

		$armario = $this->armario_model->cadastrar_armario($data);

		if ($armario[0]->numero > 0) {
			echo json_encode($armario[0]->numero);
		}else{
			echo json_encode($armario[0]->numero);
		}
	}
	
	// Processa a devolução do armário e retorna para a página inicial
	public function devolvido(){

		if (isset($_POST['devolver'])) {

			$this->armario_model->entrega_armario($this->input->post('armario_id'), $this->input->post('data_entrega'));

			redirect('armario/index', 'refresh');
			/*
			$this->load->view('armario/devolver/devolvido');
			$this->load->view('templates/header');
			$this->load->view('templates/nav');
			*/
		}	
	}


	// Busca todos armários locados inclusive os vencidos para fazer a entrega. Retorna por ajax para a página "devolver/index"
	public function busca_todos_locados_ajax(){
		
		$curso_id = Armario::buscaCursoId();

		$locados = $this->armario_model->busca_todos_locados($curso_id);
		echo json_encode($locados);
	}


	// Carrega a página devolver/index, página usada para devolver os armários
	public function devolver(){

		$this->load->view('armario/devolver/index');
		$this->load->view('templates/header');
        $this->load->view('templates/nav');
	}


	// Busca todos alunos do curso e retorna por ajax para a página "armario/index"
	public function busca_aluno_alugar_ajax(){
		
		$curso_id = Armario::buscaCursoId();
		
		$alunos = $this->armario_model->busca_aluno_ajax($curso_id);
		echo json_encode($alunos);
	}


	// Busca numero e id dos armários disponiveis para serem alugados e retorna para a página "armario/index" e também para a página "alugar/index"
	public function busca_armarios_disponiveis_ajax(){
		
		$curso_id = Armario::buscaCursoId();

		$disponiveis = $this->armario_model->busca_armario_disponivel($curso_id);
		echo json_encode($disponiveis);
	}


	// Busca aluno e retorna para a pagina devolver/index por ajax, para mostrar de qual aluno é o armario que está sendo devolvido.
	public function busca_aluno_devolver_ajax(){
		
		$aluno = $this->armario_model->busca_aluno_devolver_ajax($this->input->post('armario_id'));		
		echo json_encode($aluno);
	}


	// Busca numero e id dos armários locados e retorna por ajax para a página armario/index
	public function armarios_locados_ajax(){
		
		$curso_id = Armario::buscaCursoId();
		
		$locados = $this->armario_model->busca_armario_locado($curso_id);
		echo json_encode($locados);
	}


	// Busca numero e id dos armários vencidos e retona por ajax para a pagina armario/index
	public function armarios_vencidos_ajax(){
		
		$curso_id = Armario::buscaCursoId();
		
		$vencidos = $this->armario_model->busca_armario_vencido($curso_id);
		echo json_encode($vencidos);
	}

	public function buscaCursoId() {
		
		$curso_id = $_SESSION['user_data']['perfil']['curso'];
		if($curso_id == "Informática"){
            $curso_id = 16;
		}

		switch ($curso_id) {

			case 'Eletrônica':
				$curso_id = 10;
				break;
			case 'Eletrotécnica':
				$curso_id = 11;
				break;
			case 'Móveis':
				$curso_id = 12;
				break;
			case 'Mecânica':
				$curso_id = 13;
				break;
			case 'Design de Móveis':
				$curso_id = 14;
				break;
			case 'Química':
				$curso_id = 15;
				break;
			case 'Informática':
				$curso_id = 16;
				break;
			case 'Meio Ambiente':
				$curso_id = 17;
				break;	
			
			default:
				# code...
				break;
		}

		return $curso_id;
	}

}
