<style type="text/css">

  *{
    margin: o;
    padding: 0;

  }

  .main {
    position: absolute;
    left: 500;
    
   
  }

  label{
    font-size: 15px;
  }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/temas/admin/css/servicos.css">


<div class="w-75 float-right" style="margin-top: 50px">
    <div class="tab-pane box active w-auto bg-white m-5" id="list">
      <div style="text-align: center; padding: 30px">
        <form  method="post" id="form_alugar" action="<?php echo base_url() ?>armario/armario_alugado">
          <div style="max-width: 400px; margin-left: 220px">
            <div class="ibox-title mb-5" style="">
              <h3>Alugar Armário</h3>
            </div>        
            <div class="form-group">
              <div>
                <label for="armario_id" style="text-align: center">Selecione o numero do armário</label>
              </div>
                <div style="display: flex">
                  <select class="form-control" style="width: 90%" id="armario_id" name="armario_id"></select>
                  <button type="button" class="btn btn-primary" data-toggle="modal" style="width: 10%" data-target="#exampleModal">+</button>
                </div>
                 
            </div>
          
            <div class="form-group" style="margin-top: 15px;">
                <label for="aluno_id" style="text-align: center">Selecione o aluno</label>
                <select class="form-control" style="" id="aluno_id" name="aluno_id">
                </select> 
            </div>
          
            <div class="form-group" style="margin-top: 15px;">
                <label for="data_inicio" style="text-align: center">Data de Início</label>
                <input type="date" style="" class="form-control" id="data_inicio" name="data_inicio" placeholder="Password">
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label for="data_fim" style="text-align: center">Data de Entrega</label>
                <input type="date" style="" class="form-control" id="data_fim" name="data_fim" placeholder="Password">
            </div>
            
            <div class="form-group" style="text-align: center;">
              <br>
              <button type="submit" class="btn btn-primary" name="alugar">Alugar</button>
              <a class="btn btn-outline-secondary" href="<?php echo base_url() ?>armario " type="reset">Voltar</a>         
            </div>
            </div>
        </form>
      </div>
    </div>
</div>


<?php
/*
<div class="main" style="text-align: center;">
    <div class="col-md-6" >
        <div class="ibox">
            <div class="ibox-footer">
                
                <form  method="post" id="form_alugar" action="<?php echo base_url() ?>coordenacao/armario/armario_alugado">
                  <br><br>        
                  <div class="form-group" style="text-align: left;">
                      <label for="armario_id" style="text-align: center">Selecione o numero do armário</label>
                      <select class="form-control" style="width: 270px; height: 40px; margin-left: 80px;" id="armario_id" name="armario_id"></select>
                      <button type="button" class="btn btn-primary" data-toggle="modal" style="width: 5px; height: 38px; margin-bottom: 10px;" data-target="#exampleModal">+</button> 
                  </div>
               
                  <div class="formgroup" style="text-align: left; margin-top: 15px;">
                      <label for="aluno_id" style="text-align: center">Selecione o aluno</label>
                      <select class="form-control" style="width: 270px; height: 40px; margin-left: 80px;" id="aluno_id" name="aluno_id">
                      </select> 
                  </div>
               
                  <div class="form-group" style="text-align: left; margin-top: 15px;">
                      <label for="data_inicio" style="text-align: center">Data de Início</label>
                      <input type="date" style="width: 255px; height: 30px; margin-left: 80px;" class="form-control" id="data_inicio" name="data_inicio" placeholder="Password">
                  </div>

                  <div class="form-group" style="text-align: left; margin-top: 15px;">
                      <label for="data_fim" style="text-align: center">Data de Entrega</label>
                      <input type="date" style="width: 255px; height: 30px; margin-left: 80px;" class="form-control" id="data_fim" name="data_fim" placeholder="Password">
                  </div>
                  
                  <div class="form-group" style="text-align: center;">
                    <br>
                    <button type="submit" class="btn btn-primary" name="alugar">Alugar</button>
                    <a class="btn btn-outline-secondary" href="<?php echo base_url() ?>coordenacao/armario " type="reset">Voltar</a>         
                  </div>
              </form>
            </div>
    </div>
</div>
</div>

*/
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body" style="text-align: center" >
        
        <div id="modal"></div>
        
        <div id="modal_body">
          <form  id="cadastrar_armario"  method="post">
            <div class="form-group">   
                <h4>Digite o numero do armario</h4>
                <br>
                <input type="text" class="form-control" id="numero" name="numero" >
            </div>
            <br><br>
            <button type="button" class="btn btn-secondary" id="sair" data-dismiss="modal">Sair</button>
            <input type="submit" class="btn btn-primary"  name="cadastrar_armario" value="Cadastrar Armario">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
      //$('#modal').hide();
      // Popula por ajax o select com os numeros dos armarios disponiveis
      $.ajax({
        url:"<?php echo base_url() ?>armario/busca_armarios_disponiveis_ajax",
        method:"POST",
        dataType: 'json',
        success:function(data){
          console.log(data);
            for (var i = 0; i <= data.length; i++) {
               $('#armario_id').prepend("<option value="+data[i].id+" >"+data[i].numero+"</option>");
               //console.log(data.numero);
            }      
        }
      })

      // Permite somente numeros quando cadastra um armario no modal
      $("#numero").keypress(function(e) {
        var square = document.getElementById("numero");
          var key = (window.event)?event.keyCode:e.which;
        if((key > 47 && key < 58)) {
          return true;
        } else {
          return (key == 8 || key == 0)?true:false;
        }

      });

    })
    
    $(document).ready(function(){
      // Popula por ajax o select com os alunos do curso
      $.ajax({
        url:"<?php echo base_url() ?>armario/busca_aluno_alugar_ajax",
        method:"POST",
        dataType: 'json',
        success:function(data){
            console.log(data);
              for (var i = 0; i <= data.length; i++) {
                $('#aluno_id').prepend("<option value="+data[i].id+">"+data[i].nome+"</option>");
              }
          }
      })         
    })

    // Submete o formulariodo modal que cadastra o armario
    $('#cadastrar_armario').submit(function(e){
      e.preventDefault();
      //alert('ff');
      var numero = $('#numero').val();
      if (numero == "") {
        $('#modal').html('<div class="alert alert-danger" role="alert"><h4>Informe o numero do armario</h4></div>');
        return false;
      }

      $.ajax({
        url:"<?php echo base_url() ?>armario/cadastrar_armario",
        method:"POST",
        dataType: 'json',
        data: {numero:numero},
        success:function(data){

          console.log(data);
              if (data >= 1) {
                $('#modal').html('<div class="alert alert-danger" style="background-color: #bb2124" role="alert"><h4 style="color:white;">Armario   '+numero+' já está cadastrado</h4></div>');
                $('#sair').click(function(){
                  $('#modal').empty();
                  $('#numero').val("");
                });
              }else{
                $('#modal_body').hide();
                $('#modal').show();
                $('#modal').empty();
                $('#modal').prepend('<div class="alert alert-success" role="alert"><h4>Cadastro realizado com sucesso</h4></div>');
                $('#modal').append('<br><button id="fechar_modal" type="button" class="btn btn-primary" data-dismiss="modal">Sair</button>');
                $('#fechar_modal').click(function(){
                  $('#modal').hide();
                  $('#modal_body').show();
                  $('#numero').val("");
                });
                
                // Faz uma nova busca por armarios disponiveis depois que cadastramos um novo armario
                $.ajax({
                  url:"<?php echo base_url() ?>armario/busca_armarios_disponiveis_ajax",
                  method:"POST",
                  dataType: 'json',
                  success:function(data){
                    $('#armario_id').empty();
                    for (var i = 0; i <= data.length; i++) {
                      $('#armario_id').prepend("<option value="+data[i].id+" >"+data[i].numero+"</option>");
                         //console.log(data.numero);
                      }      
                    }
                });          
              }
                
        }
      })
    })


    // Validacao do formulario de aluguel de armario
    $('#form_alugar').submit(function(){
      
      if (($('#armario_id').val() == null)){
        alert('Informe o número do armário');
        return false;
      }

      if ($('#data_inicio').val() == ""){
        alert('Informe a data do início da locação');
        return false;
      }

      if ($('#data_fim').val() == ""){
        alert('Informe a data de entrega do armário');
        return false;
      }

      if ($('#data_fim').val() < $('#data_inicio').val()) {
        alert('A data de entrega não pode terminar antes do início');
        return false;
      }
      
    })

    // Abre modal
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })

</script>