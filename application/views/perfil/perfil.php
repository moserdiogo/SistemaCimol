<style>
    .foto{
        height: 150px;
        width: 150px;
    }
    @media only screen and (max-device-width: 400px){

        main{
            width: 100%!important;
        }
        main div{
            width:75%!important;
            margin-top: 8rem!important;
        }

        .foto {
            height: 350px;
            width: 350px;
        }

        main div div {
            margin-left: 10%!important;
            margin-right: 10%!important;
            width: 80%!important;
        }

        main div div h2{
            font-size: 3.7rem;
        }
        main div div h4{
            font-size: 3.2rem;
        }

        hr {
            border-top: 5px solid rgba(0,0,0,.1);
        }

        main div button{
            font-size: 3rem!important;
        }

    }

</style>
<?php
    $usuario = $_SESSION['user_data']['perfil'];

    if($usuario['professor']>0){
        if($usuario['professor']==2){
            $funcao = 'Coordenador';
        }
        else{
            $funcao = 'Professor';
        }
    }
    elseif ($usuario['servidor'] != 0){

        $funcao = 'Servidor';

    }


?>
<main class="float-right d-flex justify-content-center" style="width: 75%">
    <div class="bg-white h-75 p-4" style="width: 50%; margin: 3rem;">
        <img src="<?php if($usuario['foto'] != ''){ echo base_url().$usuario['foto']; }else{ echo base_url().'public/images/logo/user.png'; }?>" class="bg-info rounded-circle foto d-flex justify-content-center align-items-center m-auto">
            <h3 class="text-white">foto</h3>
        </img>
        <div class="mt-4" style="margin-left: auto">
            <h2 class="text-center text-dark"><?= $usuario['nome']?></h2>
            <h4 class="text-center text-secondary"><?php if($funcao){echo $funcao;}?></h4>
        </div>
        <hr />
        <div class="mt-2" style="margin-left: auto">
            <h4 class="text-center text-dark"><?= $usuario['email']?></h4>
        </div>
        <button type="button" class="btn float-right mt-3" style="background-color: #115e7f; color:white;">Editar</button>
    </div>
</main>
