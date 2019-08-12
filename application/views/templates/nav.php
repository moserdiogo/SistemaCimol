
<style>
    /*/  Para PC  /*/
    @media only screen and (min-device-width: 900px) {

        .select > a{
            color: white;
        }

        .unselect > a{
            cursor: pointer;
            padding-left: 0px;
        }

        .unselect > a{
            color: #343a40;
        }
        .unselect:hover{
            border-left: 5px solid #343a40!important;
        }
        .unselect{
            border-left: 5px solid white!important;
            height: 50px;
        }


        .bgwhite{
            background-color: white;
        }

        .hr{
            border: #707070 0.5px solid;
            width: 45%;
            margin: 0px 0px 10px 20px;
        }
        .labelPerfil{
            margin: 10px 0px 0px 20px;
            color: #707070;
        }

        /*/  Footer bottom perfil  /*/
        #perfil{
            position: absolute;
            bottom: 0px;
            width: 100%;
            background-color: #115e7f !important;
        }
        #perfil > a{
            color: white;
        }

        #navMenu{
            display: block;
            box-shadow: #6f6f6f 0px 10px 30px;
        }

    }

    @media only screen and (max-device-width: 400px){

        nav {
            height: 90%!important;
            width: 50%!important;
        }

        .labelPerfil{
            margin: 30px 0px 0px 20px;
            color: #707070;
            font-size: 50px;
        }

        .hr{
            border: #707070 1.5px solid;
            width: 70%;
            margin: 0px 0px 10px 20px;
        }



        .select > a{
            color: white;
        }

        .unselect > a{
            color: #343a40;
            font-size: 45px!important;
            cursor: pointer;
            padding-left: 0px;
        }

        .unselect:hover{
            border-left: 5px solid #343a40!important;
        }

        .unselect{
            border-left: 5px solid white!important;
            height: 75px;
            padding-left: 2rem!important;
            margin-top: 15px;
        }


        #perfil{
            position: absolute;
            bottom: 0px;
            width: 100%;
            background-color: #115e7f !important;
            height: 100px!important;
        }
        #perfil > a{
            color: white;
            font-size: 45px;
        }

        #navMenu{
            display: none;
            box-shadow: #6f6f6f 0px 20px 50px;
        }

    }


</style>

<?php
    if(!empty($_SESSION['user_data'])){
        $usuario = $_SESSION['user_data'];
        //print_r($usuario);
    }
    else{
        redirect('logout');
    }

    //print_r($usuario);

    if(isset($usuario['permissoes'])){
        $permissoes = $usuario['permissoes']['permissoes']['permissao'];
        if ($permissoes == 'total'){
            $permissoes = 1;
        }
    }
    else{
        $permissoes = 0;
    }


    $perfil = $usuario['perfil'];
?>

<nav id="navMenu" class="nav flex-column bg-white float-left position-fixed"
    style="height: 88%; width: 25%; padding-top: 10px;">

    <?php    /*/  Aba para Administrador  /*/
    if ($permissoes == 1){
        call_user_func('labelTitulo', 'Admin');

        echo '<div id="topico" class="unselect container bgwhite pt-1" style="padding-left: 1rem;">
                <a class="nav-link" href="'.base_url().'usuarios_atuais" id="nav-topico">Usuários atuais</a>
              </div>';

        echo '<div id="topico2" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" id="nav-topico2">Cadastrar</a>
              </div>';
    }

    ?>

    <?php    /*/  aba para professor-coordenador  /*/
    if ($perfil['professor'] >= 1){

        /*/  Aba para Coordenador  /*/
        if($perfil['professor'] == 2){
            call_user_func('labelTitulo', 'Coordenador');

            echo '<div id="armarios" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" href="'.base_url().'armario" id="nav-armarios">Armários</a>
              </div>';

            echo '<div id="armarios" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" href="'.base_url().'patrimonio" id="nav-patrimonio">Patrimônio</a>
              </div>';


        }
        /*/  Aba para Professor  /*/
        call_user_func('labelTitulo', 'Professor');

        echo '<div id="biblioteca" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" href="'.base_url().'biblioteca" id="nav-biblioteca">Biblioteca</a>
              </div>';

        echo '<div id="armarios" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" href="'.base_url().'servicos" id="nav-servicos">Serviços Manutenção</a>
              </div>';
    }

    ?>


    <?php    /*/  aba para servidores  /*/
    if ($perfil['servidor'] != 0){

        /*/  Aba para Servidor  /*/
        call_user_func('labelTitulo', 'Servidor');

        echo '<div id="biblioteca" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" href="'.base_url().'biblioteca" id="nav-biblioteca">Biblioteca</a>
              </div>';

        echo '<div id="armarios" class="unselect container bgwhite pt-1 pl-3">
                <a class="nav-link" href="'.base_url().'servicos" id="nav-servicos">Serviços Manutenção</a>
              </div>';
    }

    ?>


    <!--  Footer bottom 'perfil'  -->
    <footer id="perfil" class="container bgwhite pt-1" style="height: 50px">
        <a class="nav-link" href="<?= base_url()?>perfil/1" id="nav-perfil">Perfil</a>
    </footer>

</nav>




<?php
/*/  Função construtora de elementos html  /*/

function labelTitulo($perfil){
    echo '<div class="labelPerfil">
                <span>'.$perfil.'</span>
              </div>';
    echo '<hr class="hr"/>';
}

?>




<script>

</script>