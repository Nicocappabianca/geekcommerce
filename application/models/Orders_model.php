<?php
class Orders_model extends CI_Model{

    public function __construct()
    {
        
    }

    public function get($config = array())
    {
        $this->db->select('orders.*, users.first_name, users.last_name');
        $this->db->from('orders'); 
        $this->db->join('users', 'users.id = orders.user_id'); 

        //Si recibo un ID retorno sólo ese registro
        if(!empty($config['id']))
        {
            $this->db->where('orders.id', $config['id']);
        }

        //Si recibo limites retorno sólo los registros indicados
        if(!empty($config['limit']) && isset($config['start']))
        {
            $this->db->limit($config['limit'], $config['start']);    
        }
        
        $this->db->order_by('orders.created_on', 'DESC'); 
        
        $query = $this->db->get();
        
        if(!empty($config['id']))
        {
            return $query->row();
        }

        return $query->result(); 
    }

    public function set($data = array())
    {
        $this->db->insert('orders', $data); 
        return $this->db->insert_id(); 
    }

    public function get_total() 
    {
        return $this->db->count_all("orders");
    }
}


