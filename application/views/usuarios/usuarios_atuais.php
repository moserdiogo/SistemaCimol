<?php
$usuarios = $_SESSION['usuarios_atuais'];

?>
<style>
    td, th, th > span{
        vertical-align: middle!important;
    }
</style>

<div class="w-75 float-right">
    <div class="tab-pane box active w-auto bg-white m-5" id="list">

        <table cellpadding="0" cellspacing="0" border="0" class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"><div>Id</div></th>
                <th scope="col"><div>Foto</div></th>
                <th scope="col"><div>Nome</div></th>
                <th scope="col"><div>Email</div></th>
                <th scope="col"><div>Ações</div></th>
            </tr>
            </thead>

            <tbody>

            <?php
            foreach ($usuarios as $usuario){
                ?>

                <tr scope="row">
                    <!-- Id -->
                    <td>  <?= $usuario['id']?>  </td>

                    <!-- Foto -->
                    <td>
                        <?php if(!empty($usuario['foto'])){?>
                            <img src="<?= base_url().$usuario['foto']?>" style="width:70px; height: 70px; border-radius: 50%;">
                        <?php } else {?>
                            <img src="<?= base_url()?>public/images/logo/user.png" style="width:70px; height: 70px; border-radius: 50%;">
                        <?php } ?>
                    </td>

                    <!-- Nome -->
                    <td>  <?= $usuario['nome']?>  </td>

                    <!-- Email -->
                    <td>  <?= $usuario['email']?>  </td>

                    <td>
                        <a href="<?php echo base_url();?>editar_usuario/<?php echo $usuario['id'];?>">
                            <button type="button" class="btn btn-warning" style="color: white">
                                <span class="fa fa-pen" aria-hidden="true"></span>
                                <span class="display_none_table">Editar</span>
                            </button>
                        </a>

                        <button type="button" class="btn btn-danger">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                            <span class="display_none_table">Excluir</span>
                        </button>

                    </td>
                </tr>

                <?php
            }
            ?>



            </tbody>
        </table>
    </div>

</div>
