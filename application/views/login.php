<?php
$last = $this->uri->total_segments();
$tentativa = $this->uri->segment($last);
?>

<style>

    @media only screen and (max-device-width: 400px){

        form{
            height: 100%;
        }

        form h2{
            font-size: 4rem;
        }

        hr {
            border-top: 5px solid rgba(0,0,0,.1);
        }

        main > div{
            width: 75%!important;
            margin-top: 8rem!important;
        }

        .input-group-text{
            font-size: 3rem;
        }

        .input-group-prepend{
            width: 100%!important;
        }

        .form-control{
            font-size: 3rem;
        }

        input{
            margin-top: 25px;
        }

        button{
            font-size: 3rem!important;
            margin-top: 100px!important;
        }


    }

</style>

<main>
    <div class="container bg-white p-5 h-50" style="width: 50%; margin-top: 3rem">
        <form action="<?= base_url()?>usuario/autenticar" method="POST" >
            <?php 
                echo base_url();

             ?>

            <h2 class="text-dark">Login</h2>
            <hr class="mb-5"/>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                </div>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Senha</span>
                </div>
                <input type="password" class="form-control" name="senha" placeholder="Senha">
            </div>

            <button type="submit" class="btn btn-info float-right mb-3">Pronto!</button>

        </form>
        <?php
        if($tentativa == 1){
            echo '<div id="message" class="alert alert-danger alert-dismissible">
                <strong>Email</strong> ou <strong>senha</strong> incorretos.
              </div>';
        }
        ?>
    </div>


</main>
<script>
    setTimeout(function(){
        $('#message').fadeOut();
    }, 2000)
</script>