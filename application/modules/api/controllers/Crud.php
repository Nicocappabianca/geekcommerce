<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Ger
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Crud extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //Load model con nombre base
        $this->load->model('Crud_model', 'Rest_model');
    }

    public function index_get()
    {
        //Obtenemos los parametros de la query
        $config = array(
            'id' => $this->get('id'),
            'fields' => $this->get('fields'),
            'type_id' => $this->get('type_id'),
            'search' => $this->get('search'),
            'limit' => $this->get('limit'),
            'per_page' => $this->get('per_page'),
            'page'  => $this->get('page'),
            'offset'  => $this->get('offset'),
            'order_type' => $this->get('order_type'),
            'order_col' => $this->get('order_col')
        );

        //Validamos los permisos para crear usuarios
        if (!$this->ion_auth->is_admin()) 
        {
            $this->response([
                'status' => FALSE,
                'message' => 'No tenés permisos'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }
        
        //Filtered rows
        $rows = $this->Rest_model->get($config);
        //Obtenemos el total
        $total_rows = $this->Rest_model->total();
        //Obtenemos la cuenta del total
        $count_query = $this->Rest_model->get($config, 1); //El 1 representa obtener el total de la query sin limite

        //Validamos que exista
        if($this->get('id') && empty($rows))
        {
            //Devolvemos un error en caso de que no exista
            $this->response([
                'status' => FALSE,
                'message' => 'El registro no existe'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        //Traemos propiedades del objeto
        if(!empty($this->get('id')) && !empty($rows))
        {
            //$rows->assign = $this->Rest_model->get_assigned($config);
        }

        //Armamos la respuesta
        $response = array(
            'data' => $rows,
            'results' => array(
                'recordsTotal' => $total_rows,
                'recordsFiltered' => $count_query,
                )
            );
        
        //Si tenemos una respuesta con datos la devolvemos.
        if ($response)
        {
            $this->response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            //Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No se encontraron registros'
            ],REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_post()
    {        
        //Obtenemos el ID
        $id = $this->post('id');
        
        //Seteamos las validaciones del formulario en caso de que sean necesarios
        $this->form_validation->set_rules('name','', 'required', array('required' => 'El campo name es obligatorio.'));

        //Validamos los permisos para poder gestionar
        if (!$this->ion_auth->is_admin()) 
        {
            $this->response([
                'status' => FALSE,
                'message' => 'No tenés permisos para'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }

        //Armamos el arreglo de datos
        $data = array(
            'name' => $this->post('name')
            );

        //Validamos el formulario
        if ($this->form_validation->run() == TRUE)
        {
            //Si no se recibe ID es un registro nuevo
            if(empty($id))
            {
                $id = $this->Rest_model->add($data);
            
                //Armamos el mensaje
                $message = 'El registro con el ID:'.$id.' fue creado con éxito';
            }
            else //Si se recibe el ID es una edición
            {
                //Obtenemos el registro
                $row = $this->Rest_model->get(array('id' => $id));
                
                //Validamos que exista
                if(!empty($this->post('id')) && empty($row))
                {
                    //Devolvemos un error en caso de que no exista
                    $this->response([
                        'status' => FALSE,
                        'message' => 'El registro no existe'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
                
                //Actualizamos el registro                
                $this->Rest_model->update($id, $data);
                //Armamos el mensaje
                $message = 'El registro con el ID:'.$id.' fue actualizado con éxito';
            }

            /* Metodo para asignar información a una relación
            if($this->post('comma_separated_rows'))
            {
                $this->assign_data($id, $this->post('comma_separated_rows'));
            }
            */

            //Registro completado
            if ($id)
            {
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => $message
                ], REST_Controller::HTTP_CREATED);

            }
            else
            {
                //Devolvemos un error en caso de que no se haya creado el usuario
                $this->response([
                    'status' => FALSE,
                    'message' => 'no se creo'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else
        {
            //Devolvemos un error en caso de no pasar el formulario.
            $this->response([
                'status' => FALSE,
                'message' => validation_errors()
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        //Obtenemos el id a borrar
        $id = (int) $this->delete('id');

        //Obtenemos el registro
        $row = $this->Rest_model->get(array('id' => $id));
        
        //Validamos que exista
        if(!empty($this->delete('id')) && empty($row))
        {
            //Devolvemos un error en caso de que no exista
            $this->response([
                'status' => FALSE,
                'message' => 'El registro no existe'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
        //Borramos el registro
        $result = $this->Rest_model->delete($id);

        if($result >= 1)
        {
            $this->response([
                'status' => TRUE,
                'message' => 'Registro eliminado con éxito'
            ], REST_Controller::HTTP_OK);
        }

        $this->response([
                'status' => FALSE,
                'message' => 'Ocurrió un error'
            ], REST_Controller::HTTP_BAD_REQUEST);
    }

    public function visible_post()
    {        
        //Obtenemos el ID de usuario si se envio.
        $id = $this->post('id');
        //Estado de visibilidad
        $visible = $this->post('visible');
        
        //Validamos los permisos para crear usuarios
        if (!$this->ion_auth->in_group("administration_view")) 
        {
            $this->response([
                'status' => FALSE,
                'message' => 'No tenés permisos para editar registros'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }

        //Obtenemos el registro
        $row = $this->Rest_model->get(array('id' => $id));
        
        //Validamos que exista
        if(!empty($this->post('id')) && empty($row))
        {
            //Devolvemos un error en caso de que no exista
            $this->response([
                'status' => FALSE,
                'message' => 'El registro no existe'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        //Armamos el arreglo de datos
        $data = array('visible' => $visible);
        //Actualizamos
        $this->Rest_model->update($id, $data);
      
        if($id)
        {
            $this->response([
                'status' => TRUE,
                'id' => $id,
                'message' => 'El registro con el ID:'.$id.' fue actualizado con éxito'
            ], REST_Controller::HTTP_CREATED);

        }
        else
        {
            //Devolvemos un error en caso de que no se haya creado el usuario
            $this->response([
                'status' => FALSE,
                'message' => ''
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    /* ---------------------------------- SIMPLE GETS---------------------------------------*/

    public function simple_get()
    {
        //Obtenemos los parametros de la query
        $config = array(
            'id' => $this->get('id'),
            'limit' => $this->get('limit'),
            'order_type' => $this->get('order_type'),
            'order_col' => $this->get('order_col')
        );

        //Validamos los permisos para crear usuarios
        if (!$this->ion_auth->in_group("administration_view")) 
        {
            $this->response([
                'status' => FALSE,
                'message' => 'No tenés permisos'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }
        
        //Filtered rows
        $rows = $this->Rest_model->simple_get($config);

        //Validamos que exista
        if($this->get('id') && empty($rows))
        {
            //Devolvemos un error en caso de que no exista
            $this->response([
                'status' => FALSE,
                'message' => 'El registro no existe'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        //Armamos la respuesta
        $response = array(
            'data' => $rows
            );
        
        //Si tenemos una respuesta con datos la devolvemos.
        if ($response)
        {
            $this->response($response, REST_Controller::HTTP_OK);
        }
        else
        {
            //Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No se encontraron registros'
            ],REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /* ---------------------------------- ASSIGN DATA TO ROW ---------------------------------------*/

    private function assign_data($id, $data)
    {
        //Configuramos el metodo de asignación
        $assign_table = 'inter_table';
        $assign_field_table = 'table_field_id';
        $assign_field = 'new_relation_id';

        //Si no es un array lo transformo
        if(!is_array($data)) $data = explode(',', $data);
        
        //Limpio la data anterior
        $this->Rest_model->clean_assigned_data($assign_table, $assign_field_table, $id);

        //Asigno la nueva información
        foreach($data as $row)
        {
            $assign[$assign_field] = $row;
            $assign[$assign_field_table] = $id;
            $this->Rest_model->assign_data($assign_table, $assign);    
        }
    }   
}
