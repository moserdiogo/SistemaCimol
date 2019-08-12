<?php
class Armario_model extends CI_Model{
	
	// testando, busca armarios disponiveis
	public function busca_armario_disponivel($curso){

		$this->db->select('a.numero, aa.armario_id')
		->from('armario_aluno aa')
		->join('armario a','aa.armario_id=a.id')	
		->where('aa.data_entrega=', null)
		->where('a.curso_id=', $curso);
		$this->db->order_by('a.numero'); 
		$query=$this->db->get();
		$armarioLocado=$query->result();
		

		$this->db->select('a.numero, a.id')
		->from('armario a')		
		->where('a.curso_id=', $curso);
		//->where('aa.data_entrega!=', null);
		$this->db->order_by('a.numero');
		$query=$this->db->get();
		$armarios=$query->result();
		
		$resultado = null;
		foreach ($armarios as $armario) {
			//echo "<pre>";
			//print_r($armario);
			//echo "</pre>";
			// Esta função "buscaArmário" se encontra no fim do código
			if (!$this->buscaArmario($armario->id, $armarioLocado)) {
				$resultado[] = $armario;
			}	
		}
		
		return $resultado;
	}

	// Busca aluno de um armario especifico para devolver.
	public function busca_aluno_devolver_ajax($armario_id){
		$this->db->select('p.nome, al.id')
		->from('pessoa p')
		->join('aluno al','al.pessoa_id=p.id')
		->join('aluno_turma at','al.id=at.aluno_id')
		->join('turma t','at.turma_id=t.id')
		->join('armario_aluno aa','al.id=aa.aluno_id')
		//->join('usuario u','al.pessoa_id=u.id')
		//->join('pessoa p','u.pessoa_id=p.id')	
		//->join('curso c','c.id=u.usuario_id');	
		//->where('al.id=p.id');
		//->where('t.segmento_curso_curso_id=', $curso)
		->where('aa.armario_id=', $armario_id)
		->where('aa.data_entrega=', null);
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;
	}

	// Insere um novo armário locado, os dados são passados em um array como paramentro
	public function alugar($data){

		//$this->db->insert('armario_aluno', $data);
		$this->db->select('count(aa.aluno_id) as aluno_id, count(aa.armario_id) as armario_id, data_inicio, data_fim, data_entrega')
		->from('armario_aluno aa')
		->where('aa.aluno_id=', $data['aluno_id'])
		->where('aa.armario_id=', $data['armario_id']);
		$query=$this->db->get();
		$resultado=$query->result();

		// Verifica se já existe um registro com o mesmo ID do aluno e ID do armário, como são chaves primárias compostas devem ser únicas
		if (($resultado[0]->aluno_id == 1) && ($resultado[0]->armario_id == 1)) {

			$dados = array('armario_id' => $data['armario_id'],
				'aluno_id' => $data['aluno_id'],
				'data_inicio' => $data['data_inicio'], 
				'data_fim' => $data['data_fim'], 
				'data_entrega' => $data['data_entrega']);
			
			// Se já houver registro com mesmo ID do aluno e armário, temos que atualizar a tabela
			$this->db->where('aluno_id', $data['aluno_id']);
			$this->db->where('armario_id=', $data['armario_id']);
			$this->db->update('armario_aluno', $dados);

			//echo "atualizou";
			return true;
		}else{
			// Caso não há registro, é inserido os dados na tabela
			$dados = array('armario_id' => $data['armario_id'],
				'aluno_id' => $data['aluno_id'],
				'data_inicio' => $data['data_inicio'], 
				'data_fim' => $data['data_fim'], 
				'data_entrega' => $data['data_entrega']);

			$this->db->insert('armario_aluno', $dados);
			//$this->alugar($inserir);
			//echo $resultado[0]->aluno_id;
			
			return true;
		}
	}


	// Busca alunos do curso
	public function busca_aluno_ajax($curso){
		/*
		$this->db->select('*')
		->from('aluno a')
		->join('pessoa p','p.id=a.pessoa_id')
		->join('usuario u', 'u.pessoa_id=p.id')
		->join('curso c', 'c.usuario_id=u.id')
		->where('c.titulo=', $curso);
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;
		*/
		$this->db->select('a.id, p.nome')
		->from('aluno a')
		->join('pessoa p', 'p.id=a.pessoa_id')
		->where('a.curso_id=', $curso);
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado;
	}
	
	// Busca todos armários locados inclusive os vencidos
	public function busca_todos_locados($curso){
		
		$this->db->select('a.numero, aa.armario_id')
		->from('armario_aluno aa')
		->join('armario a','aa.armario_id=a.id')	
		->where('aa.data_entrega=', null)
		->where('a.curso_id=', $curso);
		$this->db->order_by('a.numero'); 
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;
	}

	// Busca armários os vencidos
	public function busca_armario_vencido($curso_id){

		$data_atual = date('Y-m-d');
		$this->db->select('a.numero, aa.data_fim, p.nome, aa.armario_id, c.titulo')
		->from('armario_aluno aa')
		->join('armario a','aa.armario_id=a.id')
		->join('curso c','a.curso_id=c.id')	
		->join('aluno al','al.id=aa.aluno_id')
		->join('pessoa p','al.pessoa_id=p.id')
		->where('aa.data_fim<=', $data_atual)
		->where('a.curso_id=', $curso_id)
		->where('aa.data_entrega=', null);
		$this->db->order_by('a.numero');
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado ;
	}

	// Realiza a entrega de armário
	public function entrega_armario($armario_id, $data_entrega){
		
		$data = array('data_entrega' => $data_entrega);
		$this->db->where('armario_id=', $armario_id);
		$this->db->update('armario_aluno', $data);
		$entregue = "entregue";
		return $entregue;
	}

	// Busca somente os armários locados que não estão vencidos
	public function busca_armario_locado($curso){
		
		$data_atual = date('Y-m-d');
		$this->db->select('a.numero, aa.data_fim, p.nome, aa.armario_id')
		->from('armario_aluno aa')
		->join('armario a','aa.armario_id=a.id')
		->join('aluno al','al.id=aa.aluno_id')
		->join('pessoa p','al.pessoa_id=p.id')
		->where('aa.data_entrega=', null)
		->where('aa.data_fim>=', $data_atual)
		->where('a.curso_id=', $curso);
		$this->db->order_by('a.numero');
		$query=$this->db->get();
		$resultado=$query->result();
		return $resultados[] = $resultado;
	}

	public function busca_armario_duplicado($inserir){


		$this->db->select('count(aa.aluno_id) as aluno_id, count(aa.armario_id) as armario_id, data_inicio, data_fim, data_entrega')
		->from('armario_aluno aa')
		//->join('armario a','aa.armario_id=a.id')	
		->where('aa.aluno_id=', $inserir['aluno_id'])
		->where('aa.armario_id=', $inserir['armario_id']);
		//$this->db->order_by('a.numero'); 
		//$query = $this->db->get_where('armario_aluno',));
		$query=$this->db->get();
		$resultado=$query->result();


		if ($resultado[0]->aluno_id == 1) {
			//echo "Sem registro";			
			$this->db->where('aluno_id', $inserir['aluno_id']);
			$this->db->where('armario_id=', $inserir['armario_id']);
			$this->db->update('armario_aluno', $inserir);

			//echo "atualizou";
		}else{
			$this->alugar($inserir);
			//echo $resultado[0]->aluno_id;
			return true;
		}
			//echo count($resultado);
		return $resultados[] = $resultado ;
	}

	public function cadastrar_armario($data){

		$this->db->select('count(a.numero) as numero')
		->from('armario a')
		->where('a.curso_id=', $data['curso_id'])
		->where('a.numero=', $data['numero']);
		$query=$this->db->get();
		$resultado=$query->result();

		if ($resultado[0]->numero > 0) {
			//echo "já tem";
			//return false;
			return $resultado;
		}else{
			$this->db->insert('armario', $data);
			//return true;
			return $resultado;
		}

		return $resultados[] = $resultado;	
	}

	function buscaArmario($id, $armarios){
		foreach ($armarios as $armario) {
			if ($id == $armario->armario_id) {
				return true;				
			}
		}
		return false;
	}

}