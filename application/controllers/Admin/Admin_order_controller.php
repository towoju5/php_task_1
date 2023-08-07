<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Order Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_order_controller extends Admin_controller
{
    protected $_model_file = 'order_model';
    public $_page_name = 'Order';

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('school_model');
        $this->load->model('professor_model');
        $this->load->model('textbook_model');
        $this->load->model('classes_model');
        $this->load->model('user_model');
        $this->load->model('payout_model');
        
    }

    

        public function index($page)
    {
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Order_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;

        $this->_data['view_model'] = new Order_admin_list_paginate_view_model(
            $this->order_model,
            $this->pagination,
            '/admin/order/0');
        $this->_data['view_model']->set_heading('Order');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
        $this->_data['view_model']->set_purchase_user_id(($this->input->get('purchase_user_id', TRUE) != NULL) ? $this->input->get('purchase_user_id', TRUE) : NULL);
        $this->_data['view_model']->set_sale_user_id(($this->input->get('sale_user_id', TRUE) != NULL) ? $this->input->get('sale_user_id', TRUE) : NULL);
        $this->_data['view_model']->set_inventory_id(($this->input->get('inventory_id', TRUE) != NULL) ? $this->input->get('inventory_id', TRUE) : NULL);
        $this->_data['view_model']->set_order_date(($this->input->get('order_date', TRUE) != NULL) ? $this->input->get('order_date', TRUE) : NULL);
        $this->_data['view_model']->set_order_time(($this->input->get('order_time', TRUE) != NULL) ? $this->input->get('order_time', TRUE) : NULL);
        $this->_data['view_model']->set_subtotal(($this->input->get('subtotal', TRUE) != NULL) ? $this->input->get('subtotal', TRUE) : NULL);
        $this->_data['view_model']->set_tax(($this->input->get('tax', TRUE) != NULL) ? $this->input->get('tax', TRUE) : NULL);
        $this->_data['view_model']->set_discount(($this->input->get('discount', TRUE) != NULL) ? $this->input->get('discount', TRUE) : NULL);
        $this->_data['view_model']->set_total(($this->input->get('total', TRUE) != NULL) ? $this->input->get('total', TRUE) : NULL);
        $this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
        
        $where = [
            'id' => $this->_data['view_model']->get_id(),
            'purchase_user_id' => $this->_data['view_model']->get_purchase_user_id(),
            'sale_user_id' => $this->_data['view_model']->get_sale_user_id(),
            'inventory_id' => $this->_data['view_model']->get_inventory_id(),
            'order_date' => $this->_data['view_model']->get_order_date(),
            'order_time' => $this->_data['view_model']->get_order_time(),
            'subtotal' => $this->_data['view_model']->get_subtotal(),
            'tax' => $this->_data['view_model']->get_tax(),
            'discount' => $this->_data['view_model']->get_discount(),
            'total' => $this->_data['view_model']->get_total(),
            'status' => $this->_data['view_model']->get_status(),
            
            
        ];

        $this->_data['view_model']->set_total_rows($this->order_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/order/0');
        $this->_data['view_model']->set_page($page);
        $this->_data['view_model']->set_list($this->order_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));
        
         // load data
    $schools    = $this->school_model->get_all(['status' => 1]);
    $professors = $this->professor_model->get_all(['status' => 1]);
    $textbooks  = $this->db->select('isbn')->from('inventory')->get()->result_array();
    $classes    = $this->classes_model->get_all(['status' => 1]);
    
    $inventory_data = $this->db->select('i.*,p.name as professor,s.name as school')->from('inventory i')
    ->join('school s','s.id=i.school_id')
    ->join('professor p','p.id=i.professor_id')
    ->get()->result_array();

    $user_id_array = $this->user_model->get_all();
    $this->_data['users'] = $user_id_array;
    if($user_id_array){
        $user_id_array = array_column($user_id_array,'first_name','id');
    }
           
    
    if( $this->_data['view_model']->get_list()){   

        foreach ( $this->_data['view_model']->get_list() as $key => &$value) {
            $value->school_id = '';
            $value->professor_id = '';
            $value->isbn = '';
            $value->purchase_user_id = $user_id_array[$value->purchase_user_id] ?? '';
            foreach ($inventory_data as $ke=> $v) {
                # code...
                if($v['id']==$value->inventory_id){
                    $value->school_id = $v['school'];
                    $value->professor_id = $v['professor'];
                    $value->isbn = $v['isbn'];
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

        return $this->render('Admin/Order', $this->_data);
    }

    

    

        public function view($id)
    {
        $model = $this->order_model->get($id);

        if (!$model)
        {
            $this->error('Error');
            return redirect('/admin/order/0');
        }


        include_once __DIR__ . '/../../view_models/Order_admin_view_view_model.php';
        $this->_data['view_model'] = new Order_admin_view_view_model($this->order_model);
        $this->_data['view_model']->set_heading('Order');
        $this->_data['view_model']->set_model($model);
        
        
        return $this->render('Admin/OrderView', $this->_data);
    }
    public function refund($id){

        $this->order_model->update('order', [ 'status' => 2 ],['id' => $id ]); 
        $this->payout_model->update('payout',[ 'status'=>3 ],['order_id' => $id ] );
        $order_data = $this->db->select('*')->from('order')->where('id',$id)->get()->row_array();

        //create setup intent
        $stripe = new \Stripe\StripeClient(     
            $this->config->item('stripe_secret_key')
        );   

        $refund = $stripe->refunds->create([
            'charge' => $order_data['stripe_charge_id'],
        ]);
        
        if ($refund) 
        { 
            $this->success('Order Refunded successfully.'); 
        }
            
        return redirect('admin/order/0','refresh');
    }
    
    

    

    

    

    

    

    
}