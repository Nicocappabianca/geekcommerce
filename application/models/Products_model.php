<?php
class Products_model extends CI_Model{

    public function __construct()
    {
        
    }

    public function get($config = array())
    {
        $this->db->select('*');
        $this->db->from('products'); 

        //Si recibo un ID retorno sólo ese registro
        if(!empty($config['id']))
        {
            $this->db->where('id', $config['id']);
        }

        //Si recibo el parámetro 'visible', solo retorno esos registros
        if(!empty($config['visible']))
        {
            $this->db->where('visible', 1); 
        }

        //Si recibo limites retorno sólo los registros indicados
        if(!empty($config['limit']) && isset($config['start']))
        {
            $this->db->limit($config['limit'], $config['start']);    
        }
        
        $this->db->order_by('id', 'DESC'); 
        
        $query = $this->db->get();
        
        if(!empty($config['id']))
        {
            return $query->row();
        }
        
        //Si no recibí ID ni limites, retorno todos los registros
        return $query->result(); 
    }

    public function set($data = array())
    {
        return $this->db->insert('products', $data); 
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('products');
    } 

    public function update($id, $data)
    { 
        $this->db->where('id', $id);
        $this->db->update('products', $data);
    }

    public function get_total() 
    {
        return $this->db->count_all("products");
    }

    public function get_total_visibles() 
    {
        $this->db->where('visible', 1); 
        return $this->db->count_all_results("products");
    }
}


