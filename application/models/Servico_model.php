<?php
class Servico_model extends CI_Model{


	// Abrir chamado
	public function abrir_chamado($dados){

		// Conta se já existe algum chamado em ABERTO com o código passado. Se abrir um chamado sem código não entra não IF.
		if ($dados['codigo'] != '') {
			
			$this->db->select('count(codigo) as codigo')
			->from('serv_equipamento e')
			->join('serv_chamado c','e.id=c.id_equipamento')
			//->where('e.id=', 'c.id_equipamento')
			->where('e.codigo=', $dados['codigo'])
			->where('c.status!=', 'Finalizado');
			$query=$this->db->get();
			$resultado=$query->result();

			if ($resultado[0]->codigo > 0) {
				return $resultado;
			}
		}

		// Conta se já existe algum chamado em ABERTO com o Número de série passado. Se abrir um chamado sem número de série não entra não IF.
		if ($dados['num_serie'] != '') {
			
			$this->db->select('count(num_serie) as num_serie')
			->from('serv_equipamento e')
			->join('serv_chamado c','e.id=c.id_equipamento')
			//->where('e.id=', 'c.id_equipamento')
			->where('e.num_serie=', $dados['num_serie'])
			->where('c.status!=', 'Finalizado');
			$query=$this->db->get();
			$resultado=$query->result();
			
			if ($resultado[0]->num_serie > 0) {
				return $resultado;
			}
		}
		

		$dados_equipamento = array(
			'codigo' => $dados['codigo'],
			'num_serie' => $dados['num_serie'],
			'nome' => $dados['nome'],
			'local_id' => $dados['local_id'],
		);
			
		$this->db->insert('serv_equipamento', $dados_equipamento);
		$id_equipamento = $this->db->insert_id();

		$dados_chamado = array(
			'id_equipamento' => $id_equipamento,
			'status' => 'pendente',
			'data_abertura' => date('Y-m-d'),
			'defeito' => $dados['defeito'],
		);

		$this->db->insert('serv_chamado', $dados_chamado);
			
		return true;	
	}


	// Busca chamado e retorna para a página inicial
	public function busca_chamado(){

		if (isset($dados)) {
			$this->db->select('*')
			->from('serv_chamado c')
			->join('serv_equipamento e','e.codigo=c.codigo_equipamento')
			->where('c.codigo_equipamento=', $dados['codigo_equipamento']);
			$query=$this->db->get();
			$resultado=$query->result();
			return $resultados[] = $resultado ;	
		}else{
			
			$this->db->select('e.*, c.*')
			->from('serv_chamado c')
			->join('serv_equipamento e','e.id=c.id_equipamento');
			$this->db->order_by('c.data_abertura');
			$query=$this->db->get();
			$resultado=$query->result();
			return $resultado;
		}
					
	}


	// Busca detalhes pelo código, quando é digitado o código no inicio da página ao abrir chamado
	public function busca_detalhes_abrir_chamado($codigo){

		$this->db->select('e.*, c.*, l.*')
		->from('serv_chamado c')
		->join('serv_equipamento e','e.id=c.id_equipamento')
		->join('serv_local l','l.id=e.local_id')
		->where('e.codigo=', $codigo);
		//->where('aa.data_entrega=', null);
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;
	}


	// Busca detalhes dos chamados que são mostrados no modal
	public function busca_detalhes($id){

		$this->db->select('e.*, c.*, l.descricao')
		->from('serv_chamado c')
		->join('serv_equipamento e','e.id=c.id_equipamento')
		->join('serv_local l','l.id=e.local_id')
		->where('c.id_equipamento=', $id);
		//->where('aa.data_entrega=', null);
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;
	}


	// Busca chamados por STATUS quando são filtrados pelo select
	public function busca_chamado_ajax($status){
			
			if ($status == "Todos" || $status == 'todos') {
				
				$this->db->select('*')
				->from('serv_chamado c')
				->join('serv_equipamento e','e.id=c.id_equipamento');
				$query=$this->db->get();
				$resultado=$query->result();
				return $resultados[] = $resultado ;
			}

			$this->db->select('*')
			->from('serv_chamado c')
			->join('serv_equipamento e','e.id=c.id_equipamento')
			->where('c.status=', $status);
			$query=$this->db->get();
			$resultado=$query->result();
			return $resultados[] = $resultado ;
	}


	// Edita o chamado
	public function editar_chamado($dados){

		// Se 
		if ($dados['data_atendimento'] != '') {
			$this->db->set('data_atendimento', $dados['data_atendimento']);
		}
		if ($dados['data_solucao'] != '') {
			$this->db->set('data_solucao', $dados['data_solucao']);
		}

		$this->db->set('status', $dados['status']);
		$this->db->set('defeito', $dados['defeito']);
		$this->db->set('solucao', $dados['solucao'])

		->where('serv_chamado.id_equipamento=', $dados['id_equipamento'])
		->update('serv_chamado');
		

		// Altera a outra tabela, serv_equipamento
		$this->db->set('codigo', $dados['codigo']);
		$this->db->set('num_serie', $dados['num_serie']);
		$this->db->set('nome', $dados['nome'])
		//$this->db->set('local_id', $dados['local'])
		//$this->db->set('nome', $dados['nome'])

		->where('serv_equipamento.id=', $dados['id_equipamento'])
		->update('serv_equipamento');

		return true;
	}



	public function busca_local(){
		$this->db->select('*')
		->from('serv_local');
		//->join('serv_equipamento e','e.id=c.id_equipamento')
		//->where('c.equipamento_codigo=', $dados['equipamento_codigo'])
		//->where('c.status=', $status);
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;	
	}



	public function adicionar_local($local){
		
		$this->db->select('l.id, l.descricao')
		->from('serv_local l')
		->where('l.descricao=', $local);
		$query=$this->db->get();
		$resultado=$query->result();

		foreach ($resultado as $key) {
			if ($key->descricao == $local) {
				//$this->db->insert('serv_local', $data);
				return false;
			}
		}

		$data = array(
			'descricao' => $local,
		);

		$this->db->insert('serv_local', $data);
			
		return true;	
	}





	public function buscar_por_codigo(){



    }


    public function existe_codigo($codigo){

        $this->db->select('*')
            ->from('serv_equipamento e')
            ->where('e.codigo', $codigo);
        $query=$this->db->get();
        $resultado=$query->result_array();

        if(empty($resultado)){
            return 0;
        }
        else{
            return 1;
        }

    }
}