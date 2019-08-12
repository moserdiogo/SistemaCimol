$(document).ready(function(){
    
    // Ajax que busca todos os cards da pagina inicial
    $.ajax({
      url:"<?php echo base_url() ?>coordenacao/armario/busca_todos_armarios_index_ajax",
      method:"POST",
      dataType: 'json',
                    //data:{select_armario:select_armario},
                    success:function(data){
                      // Limpa a div "CARDS". Quando o usuário clica novamente em "todos", a DIV é limpa para carregar todos os cards.
                      $('#cards').empty();
                      
                      for (var i = 0; i < data['locados'].length; i++) {
                       // Altera o formato da data no card
                       var d = new Date(data['locados'][i].data_fim);
                       data_fim = (d.toLocaleDateString());
                       // Adiciona os cards na div "CARDS"
                       $('#cards').prepend('<div class="card"><h2 class="card-title" >'+data['locados'][i].numero+'</h2><p>'+data['locados'][i].nome+'</p><h4>Entrega '+data_fim+'</h4>');          
                     }

                     for (var i = 0; i < data['vencidos'].length; i++) {
                       var d = new Date(data['vencidos'][i].data_fim);
                       data_fim = (d.toLocaleDateString());
                       $('#cards').append('<div class="card-vencido"><h2 class="card-title" >'+data['vencidos'][i].numero+'</h2><p>'+data['vencidos'][i].nome+'</p><h4>Vencido '+data_fim+'</h4>');          
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
                    url:"<?php echo base_url() ?>coordenacao/armario/armarios_locados_ajax",
                    method:"POST",
                    dataType: 'json',
                    data:{select_armario:select_armario},
                    success:function(data){
                    $('#cards').empty();
                    for (var i = 0; i < data.length; i++) {
                         var d = new Date(data[i].data_fim);
                         data_fim = (d.toLocaleDateString());                         
                         $('#cards').prepend('<div class="card"><h2 class="card-title" >'+data[i].numero+'</h2><p>'+data[i].nome+'</p><h4>Entrega '+data_fim+'</h4>');          

                         }
                         //console.log(data);
                    }
               })
            break;
            // Carrega apenas armários disponíveis
            case 'disponiveis':
               $.ajax({
                    url:"<?php echo base_url() ?>coordenacao/armario/busca_armarios_disponiveis_ajax",
                    method:"POST",
                    dataType: 'json',
                    data:{select_armario:select_armario},
                    success:function(data){
                    $('#cards').empty();
                    for (var i = 0; i < data.length; i++) {
                         $('#cards').prepend('<div class="card-disponivel"><h2 class="card-title">'+data[i].numero+'</h2><h4 id="titulo_disponivel">Disponível</h4>');          
                         }
                         //console.log(data);
                    }
               })
            break;
            // Carrega apenas armários vencidos
            case 'vencidos':
               $.ajax({
                    url:"<?php echo base_url() ?>coordenacao/armario/armarios_vencidos_ajax",
                    method:"POST",
                    dataType: 'json',
                    data:{select_armario:select_armario},
                    success:function(data){
                    $('#cards').empty();
                    for (var i = 0; i < data.length; i++) {
                         var d = new Date(data[i].data_fim);
                         data_fim = (d.toLocaleDateString());
                         $('#cards').prepend('<div class="card-vencido"><h2 class="card-title" id="numero_vencido">'+data[i].numero+'</h2><p id="nome_vencido">'+data[i].nome+'</p><h4 id="entrega_vencido">Vencido '+data_fim+'</h4>');          
                         }
                         //console.log(data);
                    }
               })
            break;
            // Carrega todos os armários
            case 'todos':
              $.ajax({
                    url:"<?php echo base_url() ?>coordenacao/armario/busca_todos_armarios_index_ajax",
                    method:"POST",
                    dataType: 'json',
                    //data:{select_armario:select_armario},
                    success:function(data){
                    $('#cards').empty();
                      
                      for (var i = 0; i < data['locados'].length; i++) {
                         var d = new Date(data['locados'][i].data_fim);
                         data_fim = (d.toLocaleDateString());
                         $('#cards').prepend('<div class="card"><h2 class="card-title" >'+data['locados'][i].numero+'</h2><p>'+data['locados'][i].nome+'</p><h4>Entrega '+data_fim+'</h4>');          
                      }

                      for (var i = 0; i < data['vencidos'].length; i++) {
                         var d = new Date(data['vencidos'][i].data_fim);
                         data_fim = (d.toLocaleDateString());
                         $('#cards').append('<div class="card-vencido"><h2 class="card-title" >'+data['vencidos'][i].numero+'</h2><p>'+data['vencidos'][i].nome+'</p><h4>Entrega '+data_fim+'</h4>');          
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