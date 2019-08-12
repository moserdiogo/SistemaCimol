

<style>
    .ibox-footer{
        text-align: end;
        margin-top: 30px;
        margin-left: 10px;
        height: 50px;
        float: left;
    }

    .ibox-title{
        margin-left: 90px;
        margin-top: 20px;
        width: 230px;
    }

    .contentor{
        width: 400px;
        padding: 10px;
        height: 80px;
    }

    .contentor > div{
        text-align: start;
    }

    input{
        float: right;
    }



</style>

<div class="w-75 float-right">
    <div class="tab-pane box active w-auto bg-white m-5" id="list">
      <div style="text-align: center; padding: 30px">
        <form class="form-purple" method="post" id="submit_formulario">
            <div class="ibox-head text-center" >
                <div class="">
                    <h3>Abrir Chamado</h3>
                </div>
            </div>
            
            <div style="margin-left: 200px">
                <div id="alert" style="max-width: 400px "></div>
                <div class="contentor" id="adicionar">
                    <div class="div1">
                        <span class="input-icon input-icon-left">Código</span>
                    </div>
                    <div class="div2">
                        <input class="form-control" type="text" id="codigo" name="codigo">
                    </div>
                </div>

                <div class="contentor" id="equipamento">
                    <div>
                        <span class="input-icon input-icon-left" >Equipamento</span>
                    </div>
                    <div>
                        <input class="form-control" type="text" name="equipamento" >
                    </div>
                </div>

                <div class="contentor" id="num_serie">
                    <div>
                        <span class="input-icon input-icon-left" >Nº de Série</span>
                    </div>
                    <div>
                        <input class="form-control" type="text" name="num_serie" >
                    </div>
                </div>

                <div class="contentor" id="local">

                    <div>
                        <span class="input-icon input-icon-left" >Local</span>
                    </div>
                    <div>
                        <select class="form-control" name="local" id="local_option" ></select>
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal">Novo local</button>
                    </div>

                </div>

                <div class="contentor mt-1" id="defeito">

                    <div  class="mt-5">
                        <span class="input-icon input-icon-left" >Defeito</span>
                    </div>
                    <div>
                        <textarea class="form-control" id="defeito" name="defeito" style="width: 100%;"></textarea>
                    </div>

                </div>

                <div class="" style="text-align: center; max-width: 400px; margin-top: 100px">
                    <a class="btn btn-primary" href="<?php echo base_url() ?>servico/servicos" type="reset">Voltar</a>
                    <button type="submit" class="btn btn-primary ml-2">Abrir chamado</button>
                </div>

            </div>
        </form>
      </div>
    </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  style="text-align: center">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="alert_local">
        </div>
        <form method="post" id="formulario_adicionar_local">
          <div class="form-group mb-3">
            <label for="recipient-name" class="col-form-label">Infome o local</label>
            <input type="text" class="form-control" id="add_local">
          </div>
          <div class="mb-3 mt-5" style="text-align: center">
            <button type="button" class="btn btn-secondary" id="fecha_modal" data-dismiss="modal">Sair</button>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<!--  Modal que edita o chamado -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

		<!-- Carrega Ajax -->
<script type="text/javascript">

    $('#equipamento').focusout(function(){
        //alert($('input[name=equipamento]').val());
        if($('input[name=equipamento]').val() != ''){
            $('#alert').html('');
        }
    });

    $('#local').focusout(function(){
        if($('input[name=local]').val() != ''){
            $('#alert').html('');
        }
    });

    $('#defeito').focusout(function(){
        if($('input[name=defeito]').val() != ''){
            $('#alert').html('');
        }
    });
		
	$(document).ready(function(){

	    /*/  pesquisar os locais para o select  /*/
        $.ajax({
            url:"<?php echo base_url() ?>suporte/busca_local",
            method:"POST",
            dataType: 'json',
            success:function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#local_option').append('<option value='+data[i].id+'>'+data[i].descricao+'</option>');
                }
            }
        })


		$('#codigo').keyup(function(){
			
			if ($('#codigo').val().length > 1) {

				var codigo = $('#codigo').val();
				//$('#codigo_input').empty();
				//$('#equipamento').empty();
        		//$('#num_serie').empty();
        		//$('#local').empty();
        		//$('#defeito').empty();
				$.ajax({
		            url:"<?php echo base_url() ?>suporte/busca_detalhes_abrir_chamado",
		            method:"POST",
		            dataType: 'json',
		            data:{codigo:codigo},
		            success:function(data){
                        console.log(data);
		            	if (data[0]) {

		            		$('#codigo_input').html('<div ><span class="input-icon input-icon-left" >Código</span></div><div ><div><input class="form-control" type="text" name="codigo" readonly="readonly" value="'+data[0].codigo+'" ></div></div>');
		            		$('#equipamento').html('<div ><span class="input-icon input-icon-left" >Equipamento</span></div><div ><div><input class="form-control" type="text" name="equipamento" readonly="readonly" value="'+data[0].nome+'" ></div></div>');      		
		            		$('#num_serie').html('<div ><span class="input-icon input-icon-left" >Nº de Série</span></div><div ><div><input class="form-control" type="text" name="num_serie" readonly="readonly" value="'+data[0].num_serie+'" ></div></div>');
		            		$('#local').html('<div ><span class="input-icon input-icon-left" >Local</span></div><div ><div><select class="form-control" name="local" id="local_option" disabled="disabled">'+data[0].descricao+'</select></div></div>');
		            		$('#defeito').html('<div ><span class="input-icon input-icon-left" >Defeito</span></div><div ><div><textarea id="defeito" style="width: 100%;" name="local" ></textarea></div></div>');
                            
                            $.ajax({
                                url:"<?php echo base_url() ?>suporte/busca_local",
                                method:"POST",
                                dataType: 'json',
                                success:function(data){
                                    for (var i = 0; i < data.length; i++) {
                                        $('#local_option').append('<option value='+data[i].id+'>'+data[i].descricao+'</option>');
                                    }
                                }
                            })

		            	}else{

                            $('#codigo_input').html('<div ><span class="input-icon input-icon-left" >Código</span></div><div ><div><input class="form-control" type="text" name="codigo" value="" ></div></div>');
                            $('#equipamento').html('<div ><span class="input-icon input-icon-left" >Equipamento</span></div><div ><div><input class="form-control" type="text" name="equipamento" value="" ></div></div>');
                            $('#num_serie').html('<div ><span class="input-icon input-icon-left" >Nº de Série</span></div><div ><div><input class="form-control" type="text" name="num_serie" value="" ></div></div>');
                            $('#local').html('<div ><span class="input-icon input-icon-left" >Local</span></div><div ><div><select class="form-control" name="local" id="local_option" ></select></div><button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal">Novo local</button></div>');
                            $('#defeito').html('<div class="mt-5" ><span class="input-icon input-icon-left" >Defeito</span></div><div ><div><textarea id="defeito" name="local" style="width: 100%;"></textarea></div></div>');

                            $.ajax({
                                url:"<?php echo base_url() ?>suporte/busca_local",
                                method:"POST",
                                dataType: 'json',
                                success:function(data){
                                    for (var i = 0; i < data.length; i++) {
                                        $('#local_option').append('<option value='+data[i].id+'>'+data[i].descricao+'</option>');
                                    }
                                }
                            })
                        }
		            }
	       		})
			}

		})

		$('#submit_formulario').submit(function(e){
			
            e.preventDefault();
	        var codigo = $('input[name=codigo]').val();
	        var equipamento = $('input[name=equipamento]').val();
	        var num_serie = $('input[name=num_serie]').val();
	        var local_id = $("#local_option").val();
	        var defeito = $('textarea#defeito').val();
	    
	        if (equipamento == '') {

	        	$('#alert').html('<div class="alert alert-danger text-white " style="background-color: red; display:block">Informe o equipamento</div>');
	            return;
	        }
	        if (local == '') {
	        	
                $('#alert').html('<div class="alert alert-danger text-white alert-dismissable" style="background-color: red; display:block">Informe o local</div>');
	            return;
	        }

	        if (defeito == '') {
	        	
                $('#alert').html('<div class="alert alert-danger text-white" style="background-color: red; display:block">Informe o defeito do equipamento</div>');
	            return;
	        }

	        $.ajax({
	            url:"<?php echo base_url() ?>suporte/abrir_chamado_submit",
	            method:"POST",
	            dataType: 'json',
	            data:{codigo:codigo, equipamento:equipamento, num_serie:num_serie, local_id:local_id, defeito:defeito},
	            success:function(data){

	                if (data == true) {
	                	window.location.href = "<?php echo base_url() ?>servico/servicos";
	                	return; 
	                }

	                if ((data[0].num_serie > 0)) {
	                	$('#alert').html('<div class="alert alert-danger text-white alert-dismissable" style="background-color: red">Já existe um chamado aberto com esse Nº de Série</div>');
	                	return;
	                }else if (data[0].codigo > 0) {
	                	$('#alert').html('<div class="alert alert-danger text-white alert-dismissable" style="background-color: red;">Já existe um chamado aberto com esse Código</div>');
	                	$('#alert').focus();
                        return;
	                }                	                
	            }  
	        })         
	    })

	})

	// Evita o envio do formulario com ENTER
   	$(document).keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
   	});
	
	// Ao clicar ENTER abre o formulario para Cadastrar novo chamado, á pedido do Candido
	$(document).keyup(function(e){
		e.preventDefault();
		var key = e.which || e.keyCode;
	  	if (key == 13) { 
	    	$('#adicionar_equipamento').trigger('click');
	  	}
	})

	// Pula o campo ao dar ENTER
	$(document).on('keyup', 'input', function(event) {
	  
	  if (event.which == 13) {
	    var generico = $(document).find('input:visible');
	    var indice = generico.index(event.target) + 1;
	    var seletor = $(generico[indice]).focus();

	    if (seletor.length == 0) {
	      event.target.focus();
	    }
	  }
	})

	$('#formulario_adicionar_local').submit(function(e){
		e.preventDefault();
        var local = $('#add_local').val();
        if (local == '') {
        	alert('Digite o local');
        	//$('#alert').html('<div class="alert alert-danger alert-dismissable"><h4 class="text-white">Informe o local</h4></div>');
           	return;
        }

        $.ajax({
            url:"<?php echo base_url() ?>suporte/adicionar_local",
            method:"POST",
            dataType: 'json',
            data:{local:local},
            success:function(data){
                console.log(data);

                if (data == true) {
                	$.ajax({
			            url:"<?php echo base_url() ?>suporte/busca_local",
			            method:"POST",
			            dataType: 'json',
			            success:function(data){
			            	//$('#local_option').val() = null;
			            	$('#alert_local').empty();
			            	$('#fecha_modal').trigger('click');
                            $('#local_option').empty();
			            	for (var i = 0; i < data.length; i++) {
			            		$('#local_option').append('<option value='+data[i].id+'>'+data[i].descricao+'</option>');
			            	}	
			            }  
			        })
                	//window.location.href = "<?php echo base_url() ?>servico/suporte/abrir_chamado";
                	
                }else {
                    $('#alert_local').html('<div class="alert alert-danger text-white" style="background-color: red; display:block; text-align:center">Este local já está cadastrado</div>')
                }    
        	}  
    	})         
	})

	// Gatilho para abrir modal
	$('#myModal').on('shown.bs.modal', function () {
	   $('#myInput').trigger('focus')
	})

    $('#fecha_modal').click(function() {
        $('#add_local').val('');
        $('#alert_local').empty();
    })
		
</script>