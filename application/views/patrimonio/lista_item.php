<?php
if(!empty($_SESSION['patrimonio_data'])){
    $select = $_SESSION['patrimonio_data']['select'];
    $serv_patrimonio = $_SESSION['patrimonio_data']["serv_patrimonio"];
}
?>

<div id="mainPatrimonio" class="w-75 float-right p-5">

    <div class="w-100" style="height: 60px;">
        <h4 style="font-size: 30px" class="float-left">Itens</h4>

        <span class="float-right">
            <button class="btn btn-info">
                <a onClick="window.location.href = '<?php echo base_url();?>patrimonios';return false;">Lista Patrimonios </a>
            </button>
        </span>
    </div>

    <div style="height: 50px">
        <span class="float-left">
            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                <a>Adicionar Item</a>
            </button>
        </span>

        <select  id="select" class="float-right custom-select w-25 mt-1">
            <?php
            foreach($select as $key){  ?>
                <option value='<?php echo $key->id_patrimonio ?>'><?php echo $key->nome ?></option>
            <?php }  ?>
        </select>
    </div>

    <div class="table-respnsive mt-2">
        <table class="table table-striped table-bordered table-hover bg-white" style="border-style: solid;">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome Patrimonio</th>
                <th scope="col">Numero de Série</th>
                <th scope="col">Código</th>
                <th scope="col">Local</th>
                <th scope="col">Excluir</th>
                <th scope="col">Editar</th>
            <tr>
            </thead>
            <?php
            $contador = 0;

            foreach ($serv_patrimonio as $serv_patrimonios) {
            ?>
            <tbody>
            <tr>
                <td><?php echo $serv_patrimonios->id_patrimonio?> </td>
                <td>  <?php echo $serv_patrimonios->nome?> </a></td>
                <td> <?php echo $serv_patrimonios->numero_serie?></td>
                <td><?php echo $serv_patrimonios->codigo?></td>
                <td> <?php echo $serv_patrimonios->descricao?> </td>

                <td><a href="<?php echo base_url() . "coordenacao/patrimonio/excluir/" . $serv_patrimonios->id_patrimonio ?>" onclick="return confirmar_exclusao('<?php echo $serv_patrimonios->id_patrimonio ?>')" class="btn btn-danger">Excluir</a></td>

                <td><a href="<?php echo base_url() . "coordenacao/patrimonio/editar/" . $serv_patrimonios->id_patrimonio ?>" onclick=" return ('<?php echo $serv_patrimonios->id_patrimonio?>')" class="btn btn-primary">Editar</a></td>
            </tr>

            <?php $contador++;

            } ?>

            </tbody>
        </table>
    </div>

</div>











<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario" method="post">
                    <div id="alert"></div>

                    <div class="form-group">
                        <label for="numero_Serie">Numero de série</label>
                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="numero_serie" placeholder="digite o numero">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Código</label>
                        <input type="text" class="form-control" id="codigo"  name="codigo"  placeholder="Código">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Descrição Movimento</label>
                        <input type="text" class="form-control" id="codigo"  name="descricao_Movimento"  placeholder="Código">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Local</label>
                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="descricao" placeholder="local">

                        <input type="text" class="form-control" id="id_patrimonio"  name="id_patrimonio"  placeholder="Código">
                        <button type="submit"   <a class="btn btn-success">Enviar </a></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" <a class="btn btn-success" data-dismiss="modal">Sair</a></button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#formulario').submit(function(e){
            e.preventDefault();
            var numero_serie = $('input[name=numero_serie]').val();
            var codigo = $('input[name=codigo]').val();
            var descricao = $('input[name=descricao]').val();
            var descricao_Movimento = $('input[name=descricao_Movimento]').val();
            var id_patrimonio = $('input[name=id_patrimonio]').val();

            $.ajax({
                url: "<?php echo base_url('coordenacao/patrimonio/adicionar')?>",
                method:'post',
                dataType:'json',
                data:{numero_serie:numero_serie,codigo:codigo,descricao:descricao,id_patrimonio:id_patrimonio,descricao_Movimento:descricao_Movimento},

                success:function(data){
                    console.log(data);
                    //alert('fd');
                    if (data[0].numero_serie) {
                        $('#alert').html('Numero de serie já cadastrado');
                    }

                    if (data[0].codigo) {
                        $('#alert').html('Código já cadastrado');
                    }
                },

                error:function(){
                    alert('ERRO');
                }
            });
        });

        $('#exampleModal').hide();

        /*
        var teste = $('#select').val(id_patrimonio);
        $('#select').change(function(){
            alert(teste);
            $('#id_patrimonio').val(teste);
        });
        */

        $('#select').change(function(){
            var id = $('#select').val();
            $('#id_patrimonio').val(id);
        })




        function adicionar_item_modal($id){
            var id = $id;
            //alert();
            $('#id_patrimonio').val(id);
        }



        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        }

    });
</script>
