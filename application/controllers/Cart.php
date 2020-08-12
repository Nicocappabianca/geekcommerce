<?php
class Cart extends CI_Controller{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Orders_model'); 
        $this->load->model('Shippings_model'); 
    }

    public function add_to_cart()
    {
        $data = array(
            'id'    => $this->input->post('id'), 
            'qty'   => $this->input->post('qty'),
            'price' => $this->input->post('price'),
            'name'  => $this->input->post('name'),
            'description'   => $this->input->post('description'),
            'img'   => $this->input->post('img'),
        ); 

        $this->cart->insert($data);        
        $this->session->set_flashdata('message', 'Se agregó al carrito');
        redirect('Cart/view','refresh');
    }

    public function view(){

        $template = front_template(); 
        $template['custom_title'] = 'Checkout'; 
        $template['section'] = $this->load->view('cart/cart_view', $this->cart->contents(), TRUE); 
        $this->load->view("themes/main_view", $template); 
    }

    private function generate_detail($items = array())
    {
        $detail = $detail .$items['qty'] .' | ' .$items['name'] .' | ' .'$' .$items['price'] .' | ' .'$' .$items['subtotal'] .'<br><br>';

        return $detail; 
    }

    private function checkout()
    {
        if(!empty($this->cart->contents()))
        {
            $data = array(); 
            $data['user_id'] =  $this->ion_auth->get_user_id(); 
            $data['detail'] = NULL;   
            
            //Cargo el string 'detail' con todos los detalles del pedido (productos, cantidad, subtotal, y total)
            foreach($this->cart->contents() as $items)
            {
                $data['detail'] = $data['detail'] .$this->generate_detail($items); 
            }

            $data['detail'] = $data['detail'] .'TOTAL: $' .$this->cart->total(); 

            $id = $this->Orders_model->set($data); 
            $this->cart->destroy(); 
            return $id; 
        }
        else
        {
            return FALSE; 
        }
    }
    
    public function shipping_form()
    {    
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('province', 'Province', 'required');        
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if($this->form_validation->run() === FALSE)
        {
            $data['error'] = validation_errors(); //Guardo los errores para pasarlos a la vista
        }
        else //si no hay errores en el formulario continúo la ejecución
        {
            $id = $this->checkout(); //ejecuto checkout y guardo el ID del pedido
            if(!empty($id))
            {
                $this->shipping($id); //ejecuto shipping() enviandole el id del pedido, para guardar los datos del form
                                    // una vez ejecutado, el metodo shipping() hace un redirect a la página de productos
                                    //indicando que el pedido se envió correctamente. 
            }
            
            $this->session->set_flashdata('message', 'Su pedido no fue enviado, hubo un error'); 
            redirect('products');
        }
        
        $template['custom_title'] = 'Envío';
        $data['countries'] = $this->Shippings_model->get_countries();

        $template = front_template(); 
        $template['custom_title'] = 'Envío';
        $template['section'] = $this->load->view('cart/shipping_form_view', $data, TRUE); 
        $this->load->view("themes/main_view", $template); 
    }

    private function shipping($id)
    {
        $data = array( 
            'order_id'  => $id, 
            'country'   => $this->input->post('country'),
            'province'  => $this->input->post('province'),
            'city'      => $this->input->post('city'),
            'address'   => $this->input->post('address'), 
        ); 

        $this->Shippings_model->set_shipping($data); 

        $this->session->set_flashdata('message', 'Su pedido fue enviado!'); 
        redirect('products');
    }

    public function cancel(){
        $this->cart->destroy(); 
        redirect('Cart/view','refresh'); 
    }
}