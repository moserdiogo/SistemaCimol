<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
body{
    font-family: 'Roboto', sans-serif;
}

 .card-locado{
  width: 150px;
  height: 190px;
  float: left;
  background: #3CB371; 
  padding: 10px;
  box-sizing: border-box;
  color: #FFF;
  margin:10px;
  box-shadow: 0px 2px 18px -4px rgba(0,0,0,0.75);
  text-align: center;
}

.card-vencido{
  width: 150px;
  height: 190px;
  float: left;
  background: #FF0000;
  padding: 10px;
  box-sizing: border-box;
  color: #FFF;
  margin: 10px;
  box-shadow: 0px 2px 18px -4px rgba(0,0,0,0.75);
  text-align: center;
}

.card-disponivel{
  width: 150px;
  height: 190px;
  float: left;
  background: #6A5ACD;
  padding: 10px;
  box-sizing: border-box;
  color: #FFF;
  margin:10px;
  box-shadow: 0px 2px 18px -4px rgba(0,0,0,0.75);
  text-align: center;
}
 
 .card-title{
  margin-top: 0;
  font-size: 60px;
  font-weight: 600;
  letter-spacing: 1.2px;
  color: white;
}
 .card-content{
  font-size: 20px;
  letter-spacing: 0.5px;
  line-height: 0.9;
  font-weight: bold;
  padding-top: 10px;
}
 .card-name{
  letter-spacing: 0.5px;
  line-height: 0.9;
}
</style>

<div class="w-75 float-right" style="margin-top: -30px">
    <div class="tab-pane box active w-auto bg-white m-5" id="list">
        <div style="text-align: center; padding: 30px; overflow: hidden">
            <div>
                <div class="mb-3" style="display: inline-flex">
                    <div class="static-widget" style="margin: 10px; padding: 10px; box-sizing:border-box; overflow: hidden;  background-color: #3CB371; color: white">
                        <h4 class="m-0" >Alugados</h4>
                        <h4 style="font-size: 20px;" id="qt_alugados"></h4>
                    </div>
                    <div class="static-widget text-white" style="margin: 10px; padding: 10px; box-sizing:border-box; overflow: hidden; background-color: #6A5ACD;">
                        <h5 class="m-0">Disponíveis</h5>
                        <h4 style="font-size: 20px;" id="qt_disponiveis"></h4>
                    </div>
                    <div class="static-widget" style="margin: 10px; padding: 10px; box-sizing:border-box; overflow: hidden; background-color: #FF0000; color: white">
                        <h4 class="m-0">Vencidos</h4>
                        <h4 style="font-size: 20px;" id="qt_vencidos"></h4>
                    </div>
                </div>
            </div>

            <div style="display: inline-flex; align-items: baseline" ><span class="input-icon input-icon-left" style="font-size: 18px;">Filtrar </span></td>
                <div>
                <select class="form-control-lg" id="select_armario" style="width: 200px">
                    <option value="todos">Todos</option>
                    <option value="locados">Locados</option>
                    <option value="disponiveis">Disponíveis</option>
                    <option value="vencidos">Vencidos</option>
                </select>
                </div>
                
                <div style="display: inline-flex; margin-top: 10px">
                <div><a style="margin-left: 5px; padding: 5px" href="<?php echo base_url() ?>armario/alugar" class="btn btn-primary active center" role="button" aria-pressed="true">&ensp;Alugar&ensp;</a></div>
                <div><a style="margin-left: 10px; padding: 5px" href="<?php echo base_url() ?>armario/devolver" class="btn btn-primary active center" role="button" aria-pressed="true">Devolver</a></div>
                </div>
            </div>
            <div id="cards" class="" style="">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){

        // Ajax que busca todos os cards da pagina inicial
        $.ajax({
            url:'<?php echo base_url() ?>armario/busca_todos_armarios_index_ajax',
            method:'POST',
            dataType: 'json',
            success:function(data) {

                // Limpa a div "CARDS". Quando o usuário clica novamente em "todos", a DIV é limpa para carregar todos os cards.
                $('#cards').empty();
                $('#qt_alugados').html(data['locados'].length);
                $('#qt_vencidos').html(data['vencidos'].length);
                $('#qt_disponiveis').html(data['disponiveis'].length);
                
                for (var i = 0; i < data['locados'].length; i++) {
                    
                    // Altera o formato da data no card
                    var d = new Date(data['locados'][i].data_fim);
                    data_fim = (d.toLocaleDateString());
                    // Adiciona os cards na div "CARDS"
                    $('#cards').prepend('<div class="card-locado"><h2 class="card-title" >'+data['locados'][i].numero+'</h2><span class="card-name">'+data['locados'][i].nome+'</span><div class="card-content">Entrega '+data_fim+'</div>');          
                }

                for (var i = 0; i < data['vencidos'].length; i++) {
                    var d = new Date(data['vencidos'][i].data_fim);
                    data_fim = (d.toLocaleDateString());
                    $('#cards').append('<div class="card-vencido"><h2 class="card-title" >'+data['vencidos'][i].numero+'</h2><span class="card-name">'+data['vencidos'][i].nome+'</span><div class="card-content">Vencido '+data_fim+'</div>');          
                }

                for (var i = 0; i < data['disponiveis'].length; i++) {
                    var d = new Date(data['disponiveis'][i].data_fim);
                    data_fim = (d.toLocaleDateString());
                    $('#cards').append('<div class="card-disponivel"><h2 class="card-title" >'+data['disponiveis'][i].numero+'</h2><p></p><h4>Disponível</h4>');          
                }
            }
        })
    })

    // Quando o usuário filtra os armários é carregado um ajax que busca os armários selecionados
    $('#select_armario').change(function(){
      var select_armario = $('#select_armario').val();

        switch (select_armario) {
            // Carrega apenas armários locados
            case 'locados':
               $.ajax({
                    url:"<?php echo base_url() ?>armario/armarios_locados_ajax",
                    method:"POST",
                    dataType: 'json',
                    data:{select_armario:select_armario},
                    success:function(data){
                        
                        $('#cards').empty();
                        for (var i = 0; i < data.length; i++) {
                            var d = new Date(data[i].data_fim);
                            data_fim = (d.toLocaleDateString());                         
                            $('#cards').prepend('<div class="card-locado"><h2 class="card-title" >'+data[i].numero+'</h2><span class="card-name">'+data[i].nome+'</span><div class="card-content">Entrega '+data_fim+'</div>');          
                        }
                    }
                })
                break;
            
            // Carrega apenas armários disponíveis
            case 'disponiveis':
               $.ajax({
                    url:"<?php echo base_url() ?>armario/busca_armarios_disponiveis_ajax",
                    method:"POST",
                    dataType: 'json',
                    data:{select_armario:select_armario},
                    success:function(data){
                        $('#cards').empty();
                        for (var i = 0; i < data.length; i++) {
                            $('#cards').prepend('<div class="card-disponivel"><h2 class="card-title">'+data[i].numero+'</h2><div class="card-content" id="titulo_disponivel">Disponível</div></div>');          
                        }
                    }
               })
                break;

            // Carrega apenas armários vencidos
            case 'vencidos':
                $.ajax({
                    url:"<?php echo base_url() ?>armario/armarios_vencidos_ajax",
                    method:"POST",
                    dataType: 'json',
                    data:{select_armario:select_armario},
                    success:function(data){
                    $('#cards').empty();
                        for (var i = 0; i < data.length; i++) {
                            var d = new Date(data[i].data_fim);
                            data_fim = (d.toLocaleDateString());
                            $('#cards').append('<div class="card-vencido"><h2 class="card-title" >'+data[i].numero+'</h2><span class="card-name">'+data[i].nome+'</span><div class="card-content">Vencido '+data_fim+'</div>');       
                        }
                    }
                })
                break;

            // Carrega todos os armários
            case 'todos':
                $.ajax({
                    url:"<?php echo base_url() ?>armario/busca_todos_armarios_index_ajax",
                    method:"POST",
                    dataType: 'json',
                    success:function(data){
                        
                        $('#cards').empty();
                      
                        for (var i = 0; i < data['locados'].length; i++) {
                            var d = new Date(data['locados'][i].data_fim);
                            data_fim = (d.toLocaleDateString());
                            $('#cards').prepend('<div class="card-locado"><h2 class="card-title" >'+data['locados'][i].numero+'</h2><span class="card-name">'+data['locados'][i].nome+'</span><div class="card-content">Entrega '+data_fim+'</div>');          
                        }

                        for (var i = 0; i < data['vencidos'].length; i++) {
                            var d = new Date(data['vencidos'][i].data_fim);
                            data_fim = (d.toLocaleDateString());
                            $('#cards').append('<div class="card-vencido"><h2 class="card-title" >'+data['vencidos'][i].numero+'</h2><span class="card-name">'+data['vencidos'][i].nome+'</span><div class="card-content">Vencido '+data_fim+'</div>');          
                        }

                        for (var i = 0; i < data['disponiveis'].length; i++) {
                            var d = new Date(data['disponiveis'][i].data_fim);
                            data_fim = (d.toLocaleDateString());
                            $('#cards').append('<div class="card-disponivel"><h2 class="card-title" >'+data['disponiveis'][i].numero+'</h2><h4>Disponível</h4>');          
                        }
                    }
                })
                break;
        }            
    })

</script>