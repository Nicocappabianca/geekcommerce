<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    protected $table = 'crud';
    protected $category_table = 'crud_categories';

    function __construct()
    {
        parent::__construct();

    }
    
    function get($config = array(), $nolimit = null)
    {
        //Campos de busqueda
        $sFields = array('name','name', 'name');

        //Si el usuario solicito campos especificos.
        if(!empty($config['fields']))
        {
            //Parseamos y comprobamos los campos solicitados por el usuario
            $select = $this->api_handler->fields($this->table, $config['fields']);
        }
        else
        {
            //Solicitamos todos los campos.
            $select = $this->table.'.*';
        }
        
        //Permite contar el total de la query sin limites
        if(!empty($nolimit)) $select = 'COUNT(*) as total_rows';

        //Ejecutamos el Select
        $this->db->select($select); // Agregar ', otros campos que se requieran del JOIN' ,files.url as image_url
        $this->db->from($this->table);

        //Linkeamos un JOIN
        //$this->db->join('table', 'new_table.table_id = '.$this->table.'.id', 'left');
        //$this->db->join('files', 'files.id = table.image_id', 'left');

        //Search
        if(!empty($config['search']))
        {
            $this->db->where("(
            $this->table.$sFields[0] like '%" . $this->db->escape_str($config['search']) . "%' OR 
            $this->table.$sFields[1] like '%" . $this->db->escape_str($config['search']) . "%' OR 
            $this->table.$sFields[2] like '"  . $this->db->escape_str($config['search']) . "%')");
        }

        if (empty($nolimit)) 
        {
            //Pagination
            if(!empty($config["per_page"]) && isset($config["offset"]))
            {
                $this->db->limit($config["per_page"], $config["offset"]);
            }
            else if(!empty($config['per_page']))
            {
                $this->db->limit($config['per_page']);
            }
        }

        if(empty($nolimit))
        {
            //Limit
            if(!empty($config['limit'])) $this->db->limit($config['limit']);
        }
        
        // Order by [column] [asc/desc] 
        if(!empty($config['order_type']) && !empty($config['order_col']))
        {
            $this->db->order_by($config['order_col'], $config['order_type']);
        }
        
        //ID Where
        if(!empty($config['id'])) $this->db->where($this->table.'.id', $config['id']);
        
        //Hacemos la consulta
        $query = $this->db->get();
        
        //Si la consulta genero resultados
        if ($this->db->affected_rows())
        {
            //Devolvemos el total de registros de la consulta sin limite
            if(!empty($nolimit))
            {
                return (int)$query->row('total_rows');
            }
            
            //Devolvemos el registro con su id solo
            if(!empty($config['id']))
            {
                return $query->row();
            }

            //Devolvemos todos los registros
            return $query->result();
        }
        else
        {
            return array();
        }
    }

    function add($data)
    {
        $this->db->insert($this->table, $data);
        
        return $this->db->insert_id();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);

        return $this->db->affected_rows();
    }

    function total()
    {
        return $this->db->count_all_results($this->table);
    }

    /* ---------------------------------- SIMPLE GET---------------------------------------*/

    function simple_get($config = array(), $nolimit)
    {
        $this->db->select($this->category_table.'.*');
        $this->db->from($this->category_table);

        if(!empty($config['id']))
        {
            $this->db->where($this->category_table.'.id', $config['id']);
        }

        if(!empty($config['limit']))
        {
            $this->db->limit($config['limit']);
        }

        if(!empty($config['order_type']) && !empty($config['order_col']))
        {
            $this->db->order_by($config['order_col'], $config['order_type']);
        }

        $query = $this->db->get();

        if($this->db->affected_rows())
        {
            //Devolvemos el registro con su id solo
            if(!empty($config['id']))
            {
                return $query->row();
            }
            
            return $query->result();
        }
    }

    /* ---------------------------------- ASSIGNED DATA---------------------------------------*/

    function get_assigned($config = array())
    {
        $assigned_table = 'table_assigned';

        $this->db->select($assigned_table.'.*, table.name');
        $this->db->from($assigned_table);

        $this->db->join('table', 'table.id = table_assigned.row_id', 'LEFT');
        
        if(!empty($config['id']))
        {
            $this->db->where($assigned_table.'.row_id', $config['id']);
        }

        if(!empty($config['limit']))
        {
            $this->db->limit($config['limit']);
        }

        if(!empty($config['order_type']) && !empty($config['order_col']))
        {
            $this->db->order_by($config['order_col'], $config['order_type']);
        }

        $query = $this->db->get();

        if($this->db->affected_rows())
        {            
            return $query->result();
        }
    }

    function clean_assigned_data($table, $field, $id)
    {
        $this->db->where($field, $id);
        $this->db->delete($table);

        return $this->db->affected_rows();
    }

    function assign_data($table, $data)
    {
        $this->db->insert($table, $data);

        return $this->db->affected_rows();
    }

}