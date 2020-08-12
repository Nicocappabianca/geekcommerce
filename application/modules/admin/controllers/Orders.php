<?php
class Orders extends CI_Controller{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Orders_model'); 
        $this->load->model('Shippings_model'); 

        // Verifico si esta logueado 
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login'); 
        }

        // Verifico si es admin 
        if(!$this->ion_auth->is_admin())
        {
            $this->session->set_flashdata('message', 'No tienes permiso para acceder');
            redirect('auth/login'); 
        }
    }

    public function index($page = 0)
    {
        // Variables para paginado
        $config_page = array(); 
        $config_page["base_url"] = base_url() . "admin/orders/index";
        $config_page["total_rows"] = $this->Orders_model->get_total();
        $config_page["per_page"] = 10;
        $config_page["uri_segment"] = 4;
        $config_page['prev_link'] = 'Anterior';
        $config_page['next_link'] = 'Siguiente';
        $config_page['display_pages'] = FALSE;

        //Paso de variables para inicializar la paginación 
        $this->pagination->initialize($config_page);

        //Recibo los links para recorrer las páginas
        $data["links"] = $this->pagination->create_links();

        // Variables para Orders_model
        $config = array(); 
        $config["start"] = $page; 
        $config["limit"] = 10;

        $data['orders'] = $this->Orders_model->get($config);
        
        $template = front_template(); 
        $template['custom_title'] = 'Pedidos'; 
        $template['section'] = $this->load->view('admin/orders/index_view', $data, TRUE);
        $this->load->view("themes/main_view", $template);  
    }

    public function view_order($id = NULL)
    {
        $config = array(); 
        $config['id'] = $id; 

        $data['order'] = $this->Orders_model->get($config);
        $data['shipping'] = $this->Shippings_model->get_shipping($config); 

        if(empty($data['order']) || empty($data['shipping']))
        {
            $this->session->set_flashdata('message', 'Error: El pedido no existe'); 
            redirect('admin/products');  
        }

        $template = front_template(); 
        $template['custom_title'] = 'Orden #'. $id; 
        $template['section'] = $this->load->view('admin/orders/order_view', $data, TRUE); 
        $this->load->view("themes/main_view", $template);  
    }
}