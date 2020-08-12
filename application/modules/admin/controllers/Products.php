<?php
class Products extends CI_Controller{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Products_model'); 
        

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
        $config_page["base_url"] = base_url() . "admin/products";
        $config_page["total_rows"] = $this->Products_model->get_total();
        $config_page["per_page"] = 8;
        $config_page["uri_segment"] = 3;
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
        $config["limit"] = 8;

        $data['products'] = $this->Products_model->get($config);
        
        $template = front_template(); 
        $template['custom_title'] = 'Mis productos'; 
        $template['section'] = $this->load->view('admin/products/index_view', $data, TRUE);
        $this->load->view("themes/main_view", $template); 
    } 

    public function view($id = NULL)
    {   
        $config = array('id' => $id); 

        $data['products'] = $this->Products_model->get($config);  

        if(empty($data['products']))
        {
            $this->session->set_flashdata('message', 'El producto no existe'); 
            redirect('admin/products');  
        }
        
        $template = front_template(); 
        $template['custom_title'] = $data['products']->title; 
        $template['section'] = $this->load->view('admin/products/product_view', $data, TRUE);
        $this->load->view("themes/main_view", $template); 
    }

    public function create()
    {    
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');        
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if($this->form_validation->run() === FALSE)
        {
            $data['error'] = validation_errors(); //Guardo los errores para pasarlos a la vista
        }
        else
        {

            $slug = url_title($this->input->post('title'), 'dash', TRUE); //Genero la URL con el título 
        
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug, 
                'description' => $this->input->post('description'),
                'stock' => $this->input->post('stock'),
                'price' => $this->input->post('price') ,
            );

            if(!empty($_FILES['userfile']['name']))
            {
                $img_path = $this->do_upload($_FILES); 
                $data['img'] = base_url('assets/uploads/'.$img_path['file_name']); 
            }

            $this->Products_model->set($data); 
            $this->session->set_flashdata('message', 'El producto se guardó correctamente'); 
            redirect('admin/products'); 
        }

        $template = front_template(); 
        $template['custom_title'] = 'Nuevo Producto'; 
        $template['section'] = $this->load->view('admin/products/create_view', $data, TRUE); 
        $this->load->view("themes/main_view", $template);         
    }

    public function delete($id = NULL)
    {
        //Verifico si recibí algun id, si no redirijo al listado de productos. 
        if(empty($id))
        {
            redirect('admin/products');  
        }

        $config = array('id' => $id);   

        $data['products_item'] = $this->Products_model->get($config); 

        if(empty($data['products_item']))
        {
            $this->session->set_flashdata('message', 'Error: No fue posible eliminar el producto');   
        }
        else
        {
            $this->Products_model->delete($id); 
            $this->session->set_flashdata('message', 'El producto se eliminó correctamente');  
        }
        
        redirect('admin/products');
    }

    public function update_form($id)
    {   
        $config = array('id' => $id);   

        $data['products_item'] = $this->Products_model->get($config); 
    
        $template = front_template(); 
        $template['custom_title'] = $data['products_item']->title; 
        $template['section'] = $this->load->view('admin/products/update_form_view', $data, TRUE); 
        $this->load->view("themes/main_view", $template); 
    }

    public function update()
    {
        
        //Verifico si recibí algun post, si no redirijo al listado de productos. 
        if(empty($this->input->post())) 
        {
            redirect('admin/products');  
        }
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');        
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if($this->form_validation->run() === FALSE)
        {
            $this->session->set_flashdata('message', 'Por favor complete todos los campos'); 
            $this->update_form(); 
        }
        else
        {
            $id = $this->input->post('id'); 
            
            $config = array('id' => $id);   

            $data_product['products_item'] = $this->Products_model->get($config); 

            if(empty($data_product['products_item']))
            {
                $this->session->set_flashdata('message', 'Error: No fue posible modificar el producto');   
            }
            else
            {
                $slug = url_title($this->input->post('title'), 'dash', TRUE); 

                $data = array(
                    'title' => $this->input->post('title'),
                    'slug' => $slug,
                    'description' => $this->input->post('description'),
                    'stock' => $this->input->post('stock'),
                    'price' => $this->input->post('price'),
                    'visible' => $this->input->post('visible')  
                );

                if(!empty($_FILES['userfile']['name']))
                {
                    $img_path = $this->do_upload($_FILES); 
                    $data['img'] = base_url('assets/uploads/'.$img_path['file_name']); 
                }

                $this->Products_model->update($id, $data); 
                $this->session->set_flashdata('message', 'Se guardaron los cambios');
            }
             
            redirect('admin/products'); 
        }
    }

    private function do_upload($file)
    {
        $config['upload_path']          = 'assets/uploads';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_width']            = 1200;
        $config['max_height']           = 1200;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            show_error($this->upload->display_errors()); 
        }
        else
        {
            return $this->upload->data(); 
        }
    }
}