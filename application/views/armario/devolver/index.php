<style type="text/css">
    label{
        font-size: 15px;
    }
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/temas/admin/css/servicos.css">

<div class="w-75 float-right" style="margin-top: 50px">
    <div class="tab-pane box active w-auto bg-white m-5" id="list">
      <div style="text-align: center; padding: 30px">
        <form class="form-purple" method="post" id="form_entrega" action="<?php echo base_url() ?>armario/devolvido">
                <div class="ibox-head">
                    <div class="ibox-title mb-5" style="">
                        <h3>Devolver Armário</h3>
                    </div>
                </div>
                <div class="ibox-body" style="max-width: 400px; margin-left: 250px">
                    <div class="form-group mb-2">
                        <div class="input-group-icon input-group-icon">
                            <span class="input-icon input-icon-left" style="">Nº Armário</span>
                            <select class="form-control" id="armario_id" name="armario_id" style="">
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="input-group-icon input-group-icon-left">
                            <fieldset disabled>
                                <div class="form-group" id="aluno">            
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <div class="input-group-icon input-group-icon-left">
                            <span class="input-icon input-icon-left" style="">Data entrega</span>
                            <input type="date" class="form-control" id="data_entrega" name="data_entrega" style="" >
                        </div>
                    </div>

                </div>
                <div class="ibox-footer">
                    <button class="btn btn-primary mr-2" name="devolver" type="submit">Devolver</button>
                    <a class="btn btn-outline-secondary" href="<?php echo base_url() ?>/armario" type="reset">Voltar</a>
                </div>
            </form>
      </div>
    </div>
</div>



<?php
/*
<div style="text-align: center; width: 500px; float: left; margin-left: 200px;">
<div class="col-md-6" >
    <div class="ibox">
        <form class="form-purple" method="post" id="form_entrega" action="<?php echo base_url() ?>coordenacao/armario/devolvido">
            <div class="ibox-head">
                <div class="ibox-title" style="margin-left: 160px;">Devolver Armário</div>
            </div>
            <div class="ibox-body">
                <div class="form-group mb-4">
                    <div class="input-group-icon input-group-icon-left">
                        <span class="input-icon input-icon-left" style="width: 100px;">Nº Armário</span>
                        <select class="form-control" id="armario_id" name="armario_id" style="width: 250px; margin-left: 20px;">
                        </select>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="input-group-icon input-group-icon-left">
                        <fieldset disabled>
                            <div class="form-group" id="aluno">            
                            </div>
                        </fieldset>
                    </div>
                </div>
                
                <div class="form-group mb-4">
                    <div class="input-group-icon input-group-icon-left">
                        <span class="input-icon input-icon-left" style="width: 100px;">Data entrega</span>
                        <input type="date" class="form-control" id="data_entrega" name="data_entrega" style="height: 25px; margin-left: 20px;" >
                    </div>
                </div>

            </div>
            <div class="ibox-footer">
                <button class="btn btn-primary mr-2" name="devolver" type="submit">Devolver</button>
                <a class="btn btn-outline-secondary" href="<?php echo base_url() ?>coordenacao/armario " type="reset">Voltar</a>
            </div>
        </form>
    </div>
</div>
</div>

*/
?>


<!--
<div style="text-align: center;">
    <div>
      <h2>Devolver Armário</h2>
    </div>
    <form  method="post" id="form_entrega" action="<?php echo base_url() ?>coordenacao/armario/devolvido">
        <div class="form-group">
            <label for="armario_id">Selecione o numero do armário</label>
            <select class="form-control" id="armario_id" name="armario_id">
            </select>  
        </div>
            
        <fieldset disabled>
            <div class="form-group" id="aluno">            
            </div>
        </fieldset>

        <div class="form-group">
            <label for="data_entrega">Data de Entrega</label>
            <input type="date" class="form-control" id="data_entrega" name="data_entrega" >
        </div>
        <br>
        <a class="btn btn-danger " href="<?php echo base_url() ?>coordenacao/armario ">Voltar</a>
        <button type="submit" class="btn btn-success btn-lg mr-2" name="devolver">Devolver</button>
    </form>
</div>
<!-- ------------------------------------------------------------------------------ -->

<script src="<?php echo base_url();  ?>public/temas/admin/scripts/ajax.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url:"<?php echo base_url() ?>armario/busca_todos_locados_ajax",
            method:"POST",
            dataType: 'json',
            success:function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#armario_id').prepend("<option value="+data[i].armario_id+" >"+data[i].numero+"</option>");         
                }
                console.log(data);
            }  
        })         
    })

    $('#armario_id').change(function(){
        var armario_id = $('#armario_id').val();
        $.ajax({
            url:"<?php echo base_url() ?>armario/busca_aluno_devolver_ajax",
            method:"POST",
            dataType: 'json',
            data:{armario_id:armario_id},
            success:function(data){
                    //$('#aluno').html("<label for='aluno'>Aluno</label><input type='text' class='form-control' value="+data[0].nome+" >");
                  //console.log(data);
                  $('#aluno').html('<span class="input-icon input-icon-left" style="width: 100px;">Aluno</span><input type="text" class="form-control" value='+data[0].nome+' style="height: 25px; margin-left: 20px;" >');
            }  
        })         
    })

    $('#form_entrega').submit(function(){

        if ($('#data_entrega').val() == ""){
          alert('Informe a data de entrega do armário');
          return false;
        }
      
    })

</script>