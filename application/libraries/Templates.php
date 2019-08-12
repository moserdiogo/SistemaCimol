<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Templates{

    public function loadTemplates(){
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
    }


}