<?php
class Pages extends CI_Controller{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Products_model'); 
    }

    public function home()
    {
        $config = array(); 
        $config["limit"] = 3;
        $config["start"] = 0;
        $config["visible"] = 1; 

        $data['products'] = $this->Products_model->get($config);

        $config_swiper = array(); 
        $config_swiper["limit"] = 6;
        $config_swiper["start"] = 3;
        $config_swiper["visible"] = 1; 

        $data['swiper'] = $this->Products_model->get($config_swiper);

        $config_bottom = array(); 
        $config_bottom["limit"] = 5;
        $config_bottom["start"] = 8;
        $config_bottom["visible"] = 1; 

        $data['bottom'] = $this->Products_model->get($config_bottom);

        $template = front_template(); 
        $template['custom_title'] = 'Home'; 
        $template['section'] = $this->load->view('pages/home_view', $data, TRUE);
        $this->load->view("themes/main_view", $template); 
    }

    public function suscribe()
    {
        $this->session->set_flashdata('message', 'Gracias por suscribirte!');
        redirect('home'); 
    }

    public function help()
    {
        $template = front_template(); 
        $template['custom_title'] = 'Ayuda'; 
        $template['section'] = $this->load->view('pages/help_view', NULL, TRUE);
        $this->load->view("themes/main_view", $template); 
    }
}