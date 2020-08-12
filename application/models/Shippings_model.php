<?php
class Shippings_model extends CI_Model{

    public function __construct()
    {
        
    }

    public function get_countries()
    {
        $this->db->select('*');
        $this->db->from('countries'); 

        //Si recibo un ID retorno sólo ese registro
        if(!empty($config['id']))
        {
            $this->db->where('id', $config['id']);
        }
                
        $query = $this->db->get();
        
        if(!empty($config['id']))
        {
            return $query->row();
        }
        
        return $query->result(); 
    }

    public function set_shipping($data = array())
    {
        return $this->db->insert('shippings', $data); 
    }

    public function get_shipping($config = array())
    {
        $this->db->select('*');
        $this->db->from('shippings'); 
        
        //Si recibo un ID retorno sólo ese registro
        if(!empty($config['id']))
        {
            $this->db->where('shippings.order_id', $config['id']);
        }
        
        $query = $this->db->get();
        
        if(!empty($config['id']))
        {
            return $query->row();
        }
        
        return $query->result(); 
    
    }
}


