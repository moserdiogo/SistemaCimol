<?php
if(!empty($_SESSION['patrimonio_data'])){
    $select = $_SESSION['patrimonio_data']['select'];
    $serv_patrimonio = $_SESSION['patrimonio_data']["serv_patrimonio"];
}
?>

<script>
function confirmar_exclusao(Patrimonio) {
    if (!confirm("Tem certeza que deseja excluir o Patrimonio: " + patrimonio + "?")) {
        return false;
    }
    alert("Patrimonio Excluido com sucesso!");
    return true;
}
</script>


<div class="w-75 float-right p-5">

    <div class="w-100" style="height: 60px;">
        <h4 style="font-size: 30px" class="float-left">Lista de Patrimônios</h4>

        <span class="float-right">
            <button class="btn btn-info">
                <a onClick="window.location.href = '<?php echo base_url();?>patrimonio';return false;">Voltar</a>
            </button>
        </span>
    </div>

    <button class="btn btn-success mt-2">
        <a onClick="window.location.href = '<?= base_url();?>coordenacao/patrimonio/cadastro_patrimonio';return false;">Novo </a>
    </button>


    <div class="table-respnsive mt-4">
        <table class="table table-striped table-bordered table-hover bg-white" style="border-style: solid">
            <thead>
                <tr>
                    <th scope="col">Patrimonios</th>
                <tr>
            </thead>

            <?php
            $contador = 0;

            foreach ($serv_patrimonio as $serv_patrimonios) {  ?>

            <tbody>
                <tr>
                    <td> <?php echo $serv_patrimonios->nome?> </td>
                </tr>
            </tbody>

                <?php $contador++;
            } ?>
        </table>
    </div>

</div>






<script type="text/javascript">

    function adicionar_item_modal($id){
        var id = $id;
        $('#id_patrimonio').val(id);
    }


    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');
    }

</script>



