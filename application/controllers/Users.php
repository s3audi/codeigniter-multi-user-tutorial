<?php

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model("user_model");
    }

    public function index(){

        echo "hoppala";

    }

    public function login(){


        $this->load->library("form_validation");

        $this->form_validation->set_rules("eposta", "E-posta", "required|trim|valid_email");
        $this->form_validation->set_rules("sifre", "Şifre", "required|trim");

        $this->form_validation->set_message(array(
            "required"      => "<b>{field}</b> alanını boş bırakamazsınız",
            "valid_email"   => "Lütfen geçerli bir <b>e-posta</b> adresi giriniz"
        ));

        if($this->form_validation->run() === FALSE){

            $viewData = new stdClass();
            $viewData->form_error = true;

            $this->load->view("login_v", $viewData);

        } else {

            $user = $this->user_model->get(
                array(
                    "email" => $this->input->post("eposta"),
                    "password"  => md5($this->input->post("sifre"))
                )
            );

            print_r($user);


        }


//        $this->load->view("homepage_v");
    }

    public function login_form(){

        $this->load->view("login_v");
    }







}
