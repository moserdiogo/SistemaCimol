<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Patrimonio_model extends CI_Model{

    public function listaPatrimonio() {

        /*
        $this->db->select('nome, numero_serie, codigo, descricao, id_patrimonio')
        ->from('serv_patrimonio')
        ->join('serv_item_patrimonio', 'serv_patrimonio_id_patrimonio=id_patrimonio')
        ->join('serv_local', 'serv_item_patrimonio_id_item=id_item');
        //->where('serv_patrimonio_id_patrimonio=', $valores['serv_patrimonio_id_patrimonio']);
        $query=$this->db->get();
        $resultado=$query->result();

        //return $this->db->get('serv_patrimonio'); 
        return $resultado;
        */

        $this->db->select('*')
                 ->from('serv_patrimonio');
        $query=$this->db->get();
        $resultado=$query->result();

        //return $this->db->get('serv_patrimonio'); 
        return $resultado;
        
        
    } 
    public function listaItem() {

        
        $this->db->select('nome, numero_serie, codigo, descricao, id_patrimonio')
                 ->from('serv_patrimonio')
                 ->join('serv_item_patrimonio', 'serv_patrimonio_id_patrimonio=id_patrimonio')
                 ->join('serv_local', 'id=serv_local_id');
        //->where('serv_patrimonio_id_patrimonio=', $valores['serv_patrimonio_id_patrimonio']);
        $query=$this->db->get();
        $resultado=$query->result();

        //return $this->db->get('serv_patrimonio'); 
        return $resultado;
        

        
        
    }   

  
    
    public function buscaPatrimonio() {
        $pesq = $this->input->post("pesq");
        $this->db->like("id_patrimonio",$pesq);
        return $this->db->get('serv_patrimonio');
        
    }  

    public function getPatrimonios($id) {
        return $this->db->where("id_patrimonio",$id)->get("serv_patrimonio");
        

    }
    
    public function excluir($id){
        return $this->db->where("id_patrimonio",$id)->delete("serv_patrimonio")   ;
        

    }

    public function salvar(){
        $id_patrimonio= $this->input->post("id_patrimonio");
        
        $valores= array(
            "id_patrimonio"=>$this->input->post("id_patrimonio"),
            "nome" =>$this->input->post("nome"),

            
            );
        if($id_patrimonio==""){
            $qry = $this->db->insert("serv_patrimonio",$valores);
        }else{
            $this->db->where("id_patrimonio",$id_patrimonio);
            $qry= $this->db->update("serv_patrimonio",$valores);
        }
            redirect("coordenacao/patrimonio/lista_patrimonio");
        return $qry;  

        
    }

    public function adicionar(){


        $item=array(

           //"serv_item_patrimonio_id_item"=> $resultado[0]->id_item,
           "descricao" =>$this->input->post("descricao"),

           );

        $this->db->insert("serv_local",$item);

        $id_local = $this->db->insert_id();

        //$this->db->where("id_item",$id)-get("serv_item_patrimonio");
        $valores=array(

         "serv_patrimonio_id_patrimonio"=>$this->input->post("id_patrimonio"),
         "numero_serie" =>$this->input->post("numero_serie"),
         "codigo"=>$this->input->post("codigo"),
         "serv_local_id"=>$id_local,
         );
        
        $this->db->select('count(numero_serie) as numero_serie')
        ->from('serv_item_patrimonio s')
        ->where('s.numero_serie=', $valores['numero_serie']);
        //->where('s.codigo=', $valores['codigo']);
        $query=$this->db->get();
        $resultado=$query->result();

        $this->db->select('count(codigo) as codigo')
        ->from('serv_item_patrimonio s')
        //->where('s.numero_serie=', $valores['numero_serie'])
        ->where('s.codigo=', $valores['codigo']);
        $query=$this->db->get();
        $resultado2=$query->result();

        //return $resultado[0]->numero_serie;
        if ($resultado[0]->numero_serie > 0 ) {
            return $resultado;
        }

        if ($resultado2[0]->codigo > 0) {
            return $resultado2;
        }


        $this->db->insert("serv_item_patrimonio",$valores);

        
        $this->db->select('id_item as id_item')
        ->from('serv_item_patrimonio')
        ->where('serv_patrimonio_id_patrimonio=', $valores['serv_patrimonio_id_patrimonio']);
        $query=$this->db->get();
        $resultado=$query->result();




        $data=array(

            'data_movimento'=>date('Y-m-d'),
             "descricao" =>$this->input->post("descricao_Movimento"),
            "serv_item_patrimonio_id_item"=> $resultado[0]->id_item,


            );

        $this->db->insert("serv_movimento",$data);

        

        

    }




}











