<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

<style>
    body{
        background-color: #dfdfdf!important;
    }

    @media only screen and (min-device-width: 992px){
        header{
            height: 12%
        }
        #CIMOL, #LOG{
            width: 25%!important;
        }
        #CIMOL > div, #LOG > div{
            font-size: 2rem;
        }
        #menuHeader{
            display: none;
        }

    }

    @media only screen and (max-device-width: 400px){
        header{
             height: 10% !important;
        }

        #CIMOL{
            width: 25%;
        }
        #cimolHeader{
            display: none!important;
        }
        #menuHeader{
            display: block;
            height: 55px;
            width: 55px;
        }
        #menuHeader a{
            font-size: 70px;
            color: white;
        }

        #LOG{
            width: 25%;
            font-size: 50px!important;
        }


    }


</style>


<script>
$(document).ready(function(){
    let menu = 0;
    $('#abreMenu').click(function () {
        if(menu == 0){
            $('#CIMOL').animate({ width: "50%" }, "slow" );
            $('#navMenu').show('left');
            menu = 1;
        }
        else if(menu == 1){
            $('#CIMOL').animate({ width: "25%" }, "slow" );
            $('#navMenu').hide('left');
            menu = 0;
        }

    });
});
</script>


<header class="bg-white justify-content-around align-items-center shadow">
    <div id="CIMOL" class="float-left d-flex justify-content-center align-items-center position-fixed"
        style="background-color: #115E7F; height: inherit ">
        <div id="cimolHeader" class="text-white">CIMOL</div>
        <div id="menuHeader">
            <a id="abreMenu" class="fas fa-bars"></a>
        </div>
    </div>
    <div id="LOG" class="float-right h-100 d-flex justify-content-center align-items-center">
    <?php
        if(!empty($_SESSION['user_data'])){
            echo '<div><a class="text-dark " href="'.base_url().'logout/Tchau">SAIR</a></div>';
        }
        else{
            echo '<div><a class="text-dark " href="'.base_url().'login/0">LOGIN</a></div>';
        }
    ?>
    </div>
</header>

<body>