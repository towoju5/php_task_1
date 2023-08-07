<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Member_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Purchases Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Member_purchases_controller extends Member_controller
{
    protected $_model_file = 'order_model';
    public $_page_name = 'Purchases';

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('school_model');
        $this->load->model('professor_model');
        $this->load->model('classes_model');
        $this->load->model('textbook_model');
    
        $this->load->model('inventory_model');
    
        $this->load->library('helpers_service');
        $this->load->library('names_helper_service');
        
    }

    

        public function index($page)
    {

    // load data
    $schools    = $this->school_model->get_all(['status' => 1]);
    $professors = $this->professor_model->get_all(['status' => 1]);
    
    if (!empty($schools))
    {
      $this->_data['schools'] = $schools;
    }

    if (!empty($professors))
    {
      $this->_data['professors'] = $professors;
    }

   

        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Purchases_member_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Purchases_member_list_paginate_view_model(
            $this->order_model,
            $this->pagination,
            '/member/purchases/0');
        $this->_data['view_model']->set_heading('Purchases');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
        $this->_data['view_model']->set_purchase_user_id(($this->input->get('purchase_user_id', TRUE) != NULL) ? $this->input->get('purchase_user_id', TRUE) : NULL);
        $this->_data['view_model']->set_sale_user_id(($this->input->get('sale_user_id', TRUE) != NULL) ? $this->input->get('sale_user_id', TRUE) : NULL);
        $this->_data['view_model']->set_inventory_id(($this->input->get('inventory_id', TRUE) != NULL) ? $this->input->get('inventory_id', TRUE) : NULL);
        $this->_data['view_model']->set_order_date(($this->input->get('order_date', TRUE) != NULL) ? $this->input->get('order_date', TRUE) : NULL);
        $this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
        
    $where = ['purchase_user_id' => $this->session->userdata('user_id')];

    if (!empty($_GET['school_id']))
    {  
      $inventory = $this->inventory_model->get_all(['school_id' => $_GET['school_id']]);
      
      if ($inventory)
      {
        $where[] = "inventory_id in (" . implode(',',array_column($inventory,'id')) . " ) ";
      }
      else
      {
        $where[] = "inventory_id = 0";
      }
    }

    if (!empty($_GET['professor_id']))
    {
      $inventory = $this->inventory_model->get_all(['professor_id' => $_GET['professor_id']]);     
      if ($inventory)
      {
        $where[] = "inventory_id in (" . implode(',',array_column($inventory,'id')) . " ) ";
      }
      else
      {
        $where[] = "inventory_id = 0";
      }
     
    }
    if (!empty($_GET['year']))
    {
      $inventory = $this->inventory_model->get_all(['year' => $_GET['year']]);     
      if ($inventory)
      {
        $where[] = "inventory_id in (" . implode(',',array_column($inventory,'id')) . " ) ";
      }
      else
      {
        $where[] = "inventory_id = 0";
      }
     
    }

    if ($this->_data['view_model']->get_id())
    {
      $where[] = "id = " . $this->_data['view_model']->get_id();
    }

    if ($this->_data['view_model']->get_inventory_id())
    {
      $where[] = "inventory_id = " . $this->_data['view_model']->get_inventory_id();
    }

    if ($this->_data['view_model']->get_order_date())
    {
      $where[] = "order_date = " . $this->_data['view_model']->get_order_date();
    }

    if ($this->_data['view_model']->get_status() || $this->_data['view_model']->get_status() == '0')
    {
      $where[] = "status = " . $this->_data['view_model']->get_status();
    }

      //   $where = [
      //       'id' => $this->_data['view_model']->get_id(),
            // 'purchase_user_id' => $this->_data['view_model']->get_purchase_user_id(),
            // 'sale_user_id' => $this->_data['view_model']->get_sale_user_id(),
            // 'inventory_id' => $this->_data['view_model']->get_inventory_id(),
            // 'order_date' => $this->_data['view_model']->get_order_date(),
            // 'status' => $this->_data['view_model']->get_status(),
            
            
      //   ];

        $this->_data['view_model']->set_total_rows($this->order_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/member/purchases/0');
        $this->_data['view_model']->set_page($page);
            $this->_data['view_model']->set_list($this->order_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));
        
        if( $this->_data['view_model']->get_list())
        {

            $invetory_ids = array_column($this->_data['view_model']->get_list(),'inventory_id');
            if($invetory_ids)
            {
                $inventory_data  = $this->db->select('i.*,s.name as school,p.name as professor')->from('inventory i')->join('school s','s.id=i.school_id')->join('professor p','p.id=i.professor_id')->where_in('i.id',$invetory_ids,true)->get()->result_array();
                
                $review_given = $this->db->select('*')->from('review')->where('user_id',$this->session->userdata('user_id'))->get()->result_array();
                if($review_given)
                {
                    $review_given = array_column($review_given,'inventory_id');
                }
            
                $dispute_given = $this->db->select('*')->from('ticket')->where('user_id',$this->session->userdata('user_id'))->get()->result_array();
                if($dispute_given){
                    $dispute_given = array_column($dispute_given,'order_id');
                }
                foreach ($this->_data['view_model']->get_list() as $data) 
                {

                    $data->review_given = 0;
                    if(in_array($data->inventory_id,$review_given))
                    {
                        $data->review_given = 1;
                    }
                    $data->dispute_given = 0;
                    if(in_array($data->id,$dispute_given))
                    {
                        $data->dispute_given = 1;
                    }


                    foreach ($inventory_data as $key => $value) 
                    {
                        if($data->inventory_id == $value['id'])
                        {
                            $data->school     = $value['school'];
                            $data->year       = $value['year'];
                            $data->file_src   = base_url().$value['file'];
                            $data->professor  = $value['professor'];
                            $data->word_count = $value['word_count'];
                        } 
                    } 

                    if (!isset($data->school)) 
                    {
                        $data->school     = "";
                        $data->year       = "";
                        $data->file_src   = "";
                        $data->professor  = "";
                        $data->word_count = ""; 
                    }
                } 
            } 
        }
        

        if ($format == 'csv')
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');

            echo $this->_data['view_model']->to_csv();
            exit();
        }

        if ($format != 'view')
        {
            return $this->output->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->_data['view_model']->to_json()));
        }

        return $this->render('Member/Purchases', $this->_data);
    }

    

    

        public function view($id)
    {
        $model = $this->order_model->get($id);

        if (!$model)
        {
            $this->error('Error');
            return redirect('/member/purchases/0');
        }


        include_once __DIR__ . '/../../view_models/Purchases_member_view_view_model.php';
        $this->_data['view_model'] = new Purchases_member_view_view_model($this->order_model);
        $this->_data['view_model']->set_heading('Purchases');
        $this->_data['view_model']->set_model($model);
        
        
        return $this->render('Member/PurchasesView', $this->_data);
    }

    

    

    

    

    

    

    
}