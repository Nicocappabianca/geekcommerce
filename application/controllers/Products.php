<?php
class Products extends CI_Controller{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Products_model'); 
    }

    public function index($page = 0)
    {
        // Variables para paginado
        $config_page = array(); 
        $config_page["base_url"] = base_url() . "products";
        $config_page["total_rows"] = $this->Products_model->get_total_visibles();
        $config_page["per_page"] = 6;
        $config_page["uri_segment"] = 2;
        $config_page['prev_link'] = 'Anterior';
        $config_page['next_link'] = 'Siguiente';
        $config_page['display_pages'] = FALSE;

        //Paso de variables para inicializar la paginación 
        $this->pagination->initialize($config_page);

        //Recibo los links para recorrer las páginas
        $data["links"] = $this->pagination->create_links();

        // Variables para Products_model
        $config = array(); 
        $config["start"] = $page; 
        $config["limit"] = 6;
        $config["visible"] = 1; 

        $data['products'] = $this->Products_model->get($config);
 
        $template = front_template(); 
        $template['custom_title'] = 'Productos'; 
        $template['section'] = $this->load->view('products/list_view', $data, TRUE);
        $this->load->view("themes/main_view", $template); 
    } 

    public function view($id = NULL)
    {   
        $config = array('id' => $id); 

        $data['products'] = $this->Products_model->get($config);  

        if(empty($data['products']))
        {
            $this->session->set_flashdata('message', 'El producto no existe'); 
            redirect('products');  
        }
        
        $config_bottom = array(); 
        $config_bottom["start"] = 4; 
        $config_bottom["limit"] = 3;
        $config_bottom["visible"] = 1; 

        $data['bottom'] = $this->Products_model->get($config_bottom);

        $template = front_template(); 
        $template['custom_title'] = $data['products']->title;
        $template['section'] = $this->load->view('products/product_view', $data, TRUE);
        $this->load->view("themes/main_view", $template); 
    }
}

