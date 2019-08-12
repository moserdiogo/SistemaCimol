<?php

    if(!empty($_SESSION['chamados'])){
        $chamados = $_SESSION['chamados'];
    }

    $usuario_atual = $_SESSION['user_data'];

    if(is_array($usuario_atual['perfil']['servidor'])) {

        if (in_array(5, $usuario_atual['perfil']['servidor'])) {
            //$suporte = 1;
            $suporte = 1;
        }
        else{
            //$suporte = 0;
            $suporte = 1;
        }
    }
    else{
        //$suporte = 0;
        $suporte = 1;
    }
?>

<div class="float-right w-75">
    <div style=" float: right; width: 80%; margin-right: 10%; text-align: center;">
        <div class="page-wrapper">
                <div class="page-content fade-in-up">
                    <div class="ibox">
                        <div class="ibox-body">
                            <h3 class="font-strong mb-4">Ordem de Serviços</h3>
                            <div class="flexbox mb-2">
                                <div class="flexbox">
                                    <label class="mb-0 mr-2" style="margin-right: 10px;">Filtrar:</label>
                                    <select class="selectpicker show-tick form-control" id="type-filter" title="Please select"  data-width="150px">
                                        <option>Todos</option>
                                        <option>Pendente</option>
                                        <option>Aguardando orçamento</option>
                                        <option>Aguardando peça</option>
                                        <option>Finalizado</option>
                                    </select>
                                </div>
                                <div class="input-group-icon input-group-icon-left mr-3">
                                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                    <a class="btn btn-primary " style="margin-top:10px;" href="<?php echo base_url() ?>suporte/abrir_chamado">Abrir Chamado</a>
                                </div>
                            </div>
                            <div class="table-responsive row">
                                <table class="table table-bordered bg-white" id="datatable">
                                    <thead class="thead-default thead-lg thead-dark">
                                        <tr>
                                            <th>Código</th>
                                            <th>Equipamento</th>
                                            <th>Abertura</th>
                                            <th>Defeito</th>
                                            <th>Status</th>
                                            <th>Detalhes</th>
                                            <?php
                                                if($suporte == 1){
                                                    echo ' <th>Editar</th>';
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody id="tabela">
                                        <?php
                                            foreach ($chamados as $chamado) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $chamado->codigo ?></td>
                                                    <td>
                                                        <a href=""><b><?php echo $chamado->nome ?></b></a>
                                                    </td>

                                                    <td><?php echo date('d/m/Y', strtotime($chamado->data_abertura)) ?></td>
                                                    <td><?php echo $chamado->defeito ?></td>
                                                    <td>
                                                        <?php 
                                                            
                                                            if ($chamado->status == 'Pendente') {
                                                                ?><button class="btn btn-danger" disabled><strong style="color:white;" style="max-width: 100px"><?php echo $chamado->status ?><strong></button> <?php
                                                            }
                                                            //echo $chamado->status 
                                                        ?>
                                                        <?php 
                                                            if ($chamado->status == 'Finalizado') {
                                                                ?><button class="btn btn-success" disabled><strong style="color:white;" style="max-width: 100px"><?php echo $chamado->status ?><strong></button> <?php
                                                            }
                                                        ?>
                                                        <?php 
                                                            if ($chamado->status == 'Aguardando orçamento') {
                                                                ?><button class="btn btn-warning btn-sm" disabled style="max-width: 100px"><strong style="color:white;"><?php echo $chamado->status ?><strong></button> <?php
                                                            }
                                                        ?>
                                                        <?php 
                                                            if ($chamado->status == 'Aguardando peça') {
                                                                ?><button class="btn btn-primary btn-sm" style="max-width: 100px" disabled><strong style="color:white;"><?php echo $chamado->status ?><strong></button> <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="busca_detalhes(<?php echo $chamado->id ?>)"><span>DETALHES</span></button>
                                                    </td>

                                                    <?php if($suporte == 1){ ?>
                                                        <td style="text-align: center">
                                                            <a class="btn btn-link btn-sm" href="<?php echo base_url() ?>suporte/editar/<?php echo $chamado->id ?>" ><span>EDITAR</span></a>
                                                            
                                                        </td>
                                                    <?php }  ?>
                                                </tr>
                                            <?php
                                            }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <main>

                <table class="table table-bordered" style="max-width: 500px; text-align:center; margin-left: 120px; margin-top: 30px">
                    <tbody>
                        <tr>
                            <th scope="row" class="col-sm-4">Código</th>
                            <td id="detalhes_codigo" class="col-sm-8"></td>
                        </tr>
                        <tr>
                            <th scope="row">Equipamento</th>
                            <td id="detalhes_nome"></td>
                        </tr>
                        <tr>
                            <th scope="row">Número de série</th>
                            <td id="detalhes_num_serie"></td>
                        </tr>
                        <tr>
                            <th scope="row">Data abertura</th>
                            <td id="detalhes_data_abertura"></td>
                        </tr>
                        <tr>
                            <th scope="row">Data atendimento</th>
                            <td id="detalhes_data_atendimento"></td>
                        </tr>
                        <tr>
                            <th scope="row">Data solução</th>
                            <td id="detalhes_data_solucao"></td>
                        </tr>
                        <tr>
                            <th scope="row">Local</th>
                            <td id="detalhes_local"></td>
                        </tr>
                        <tr>
                            <th scope="row">Defeito</th>
                            <td id="detalhes_defeito"></td>
                        </tr>
                        <tr>
                            <th scope="row">Solução</th>
                            <td id="detalhes_solucao"></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td id="detalhes_status"></td>
                        </tr>
                    </tbody>
                </table>
    
            </main>
        </div>
        <div></div>
    </div>
</div>
      </div>
      <div class="text-center pb-3">
        <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Sair</button>
      </div>
    </div>
  </div>
</div>


<!-- -------------------------------------Fim dos Modais ----------------------------------------->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Carrega Ajax -->
<script type="text/javascript">

    var urll = '<?php echo base_url(); ?>';
    function get_url() {
        var newURL = window.location.protocol + "//" + window.location.host + "/sistemaCimol/";
        return urll;
    }

	$(document).ready(function(){

        <?php
            if ($suporte = 1) {
                ?>
                    function editar(id) {
                        return '<a class="btn btn-link btn-sm" href="<?php echo base_url() ?>suporte/editar/'+id+'" ><span>EDITAR</span></a>';
                    }
                <?php
            }
        ?>

        $('#exampleModal').hide();
        var url = get_url();

		$('#type-filter').change(function(){
			
            var status = $('#type-filter').val();
			$.ajax({
	            url: url + "suporte/busca_chamado_ajax",
	            method:"POST",
	            dataType: 'json',
	            data:{status:status},
	            success:function(data){

	            	$('#tabela').empty();
	               	for (var i = 0; i < data.length; i++) {

                        switch (data[i].status) {
                            
                            case 'Pendente':
                                $('#tabela').append('<tr><td style="text-align: center">'+ data[i].codigo +'</td><td><a href=""><b>'
                                +data[i].nome+'</b></a></td><td>'+data_abertura+'</td><td>'+data[i].defeito+'</td><td><button class="btn btn-danger" style="max-width: 100px" disabled><strong style="color:white;">'+data[i].status+'<strong></button></td><td><button class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="busca_detalhes('+data[i].id+')"><span>DETALHES</span></button></td><td>'+editar(data[i].id)+'</td>');   
                                break;
                            
                            case 'Aguardando orçamento' : 
                                $('#tabela').append('<tr><td style="text-align: center">'+ data[i].codigo +'</td><td><a href=""><b>'
                                +data[i].nome+'</b></a></td><td>'+data_abertura+'</td><td>'+data[i].defeito+'</td><td><button class="btn btn-warning" style="max-width: 100px" disabled><strong style="color:white;">'+data[i].status+'<strong></button></td><td><button class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="busca_detalhes('+data[i].id+')"><span>DETALHES</span></button></td><td>'+editar(data[i].id)+'</td>');
                                break;
                            
                            case 'Aguardando peça' :
                                $('#tabela').append('<tr><td style="text-align: center">'+ data[i].codigo +'</td><td><a href=""><b>'
                                +data[i].nome+'</b></a></td><td>'+data_abertura+'</td><td>'+data[i].defeito+'</td><td><button class="btn btn-primary" style="max-width: 100px" disabled><strong style="color:white;">'+data[i].status+'<strong></button></td><td><button class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="busca_detalhes('+data[i].id+')"><span>DETALHES</span></button></td><td>'+editar(data[i].id)+'</td>');
                                break;

                            case 'Finalizado' :
                                $('#tabela').append('<tr><td style="text-align: center">'+ data[i].codigo +'</td><td><a href=""><b>'
                                +data[i].nome+'</b></a></td><td>'+data_abertura+'</td><td>'+data[i].defeito+'</td><td><button class="btn btn-success" style="max-width: 100px" disabled><strong style="color:white;">'+data[i].status+'<strong></button></td><td><button class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="busca_detalhes('+data[i].id+')"><span>DETALHES</span></button></td><td>'+editar(data[i].id)+'</td>');
                            default:
                                break;
                        }
                        var data_abertura = formatar_data(data[i].data_abertura);
                           
	               	}
	            }
       		})
		})
	})


	function busca_detalhes(id){
		
        var id = id;
        var url = get_url();

		$.ajax({
            url: url + "suporte/busca_detalhes",
            method:"POST",
            dataType: 'json',
            data:{id:id},
            success:function(data){

                console.log("aqui ");
                console.log(data[0].data_abertura);

            	$('#detalhes_status').empty();
            	$('#detalhes_solucao').empty();
            	$('#detalhes_defeito').empty();
            	$('#detalhes_codigo').empty();
            	$('#detalhes_nome').empty();
            	$('#detalhes_num_serie').empty();
            	$('#detalhes_data_abertura').empty();
            	$('#detalhes_data_atendimento').empty();
            	$('#detalhes_data_solucao').empty();
            	$('#detalhes_local').empty();

                console.log(data);

                $("#modal_detalhes").fadeIn('fast');

            	$('#detalhes_status').html(data[0].status);

            	if (data[0].solucao != null) {
                	$('#detalhes_solucao').html(data[0].solucao);	
                }

            	if (data[0].defeito != null) {
            		$('#detalhes_defeito').html(data[0].defeito);
            	}            	

            	if (data[0].codigo != null) {
            		$('#detalhes_codigo').html(data[0].codigo);	
            	} 	
                
                $('#detalhes_nome').html(data[0].nome);

                $('#detalhes_num_serie').html(data[0].num_serie);

                var data_abertura = formatar_data(data[0].data_abertura);
                $('#detalhes_data_abertura').html(data_abertura);

                var data_atendimento = formatar_data(data[0].data_atendimento);
                if (data[0].data_atendimento != null) {
                	$('#detalhes_data_atendimento').html(data_atendimento);	
                }

                var data_solucao = formatar_data(data[0].data_solucao);
                if (data[0].data_solucao != null) {
                	$('#detalhes_data_solucao').html(data_solucao);	
                }

                $('#detalhes_local').html(data[0].descricao);	
               
            }
       })
	}

</script>

<!-- Trigger que abre os Modal -->
<script type="text/javascript">

    // Gatilho para abrir modal
	$('#myModal').on('shown.bs.modal', function () {
	   $('#myInput').trigger('focus');

	})

    // Função para formatar a hora
    function formatar_data(data){
        var aux = data.split('-');
        data = aux[2]+'/'+aux[1]+'/'+aux[0];
        return data;
    }	

</script>