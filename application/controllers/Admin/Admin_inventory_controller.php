<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'Admin_controller.php';
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
/**
 * Inventory Controller
 * @copyright 2019 Manaknightdigital Inc.
 * @link https://manaknightdigital.com
 * @license Proprietary Software licensing
 * @author Ryan Wong
 *
 */
class Admin_inventory_controller extends Admin_controller
{
    protected $_model_file = 'inventory_model';
    public $_page_name = 'Inventory';

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('school_model');
        $this->load->model('professor_model');
        $this->load->model('textbook_model');
        $this->load->model('classes_model');
        $this->load->model('user_model');
        $this->load->model('credential_model');
        
    }

    

    public function index($page)
    {
    
        $this->load->library('pagination');
        include_once __DIR__ . '/../../view_models/Inventory_admin_list_paginate_view_model.php';
        $session = $this->get_session();
        $format = $this->input->get('format', TRUE) ?? 'view';
        $order_by = $this->input->get('order_by', TRUE) ?? '';
        $direction = $this->input->get('direction', TRUE) ?? 'ASC';
        $per_page_sort = $this->input->get('per_page_sort', TRUE) ?? 25;
        $previews = $this->input->get('previews', TRUE) ?? "";

        $this->_data['view_model'] = new Inventory_admin_list_paginate_view_model(
            $this->inventory_model,
            $this->pagination,
            '/admin/inventory/0');
        $this->_data['view_model']->set_heading('Inventory');
        $this->_data['view_model']->set_id(($this->input->get('id', TRUE) != NULL) ? $this->input->get('id', TRUE) : NULL);
        $this->_data['view_model']->set_title(($this->input->get('title', TRUE) != NULL) ? $this->input->get('title', TRUE) : NULL);
        $this->_data['view_model']->set_school_id(($this->input->get('school_id', TRUE) != NULL) ? $this->input->get('school_id', TRUE) : NULL);
        $this->_data['view_model']->set_professor_id(($this->input->get('professor_id', TRUE) != NULL) ? $this->input->get('professor_id', TRUE) : NULL);
        $this->_data['view_model']->set_class_id(($this->input->get('class_id', TRUE) != NULL) ? $this->input->get('class_id', TRUE) : NULL);
        $this->_data['view_model']->set_textbook_id(($this->input->get('textbook_id', TRUE) != NULL) ? $this->input->get('textbook_id', TRUE) : NULL);
        $this->_data['view_model']->set_word_count(($this->input->get('word_count', TRUE) != NULL) ? $this->input->get('word_count', TRUE) : NULL);
        $this->_data['view_model']->set_year(($this->input->get('year', TRUE) != NULL) ? $this->input->get('year', TRUE) : NULL);
        $this->_data['view_model']->set_status(($this->input->get('status', TRUE) != NULL) ? $this->input->get('status', TRUE) : NULL);
        $this->_data['email']  = ( $this->input->get('email', TRUE) != NULL ) ? $this->input->get('email', TRUE) : NULL;
        
        $where = [
            'inventory.id'           => $this->_data['view_model']->get_id(),
            'inventory.title'        => $this->_data['view_model']->get_title(),
            'inventory.school_id'    => $this->_data['view_model']->get_school_id(),
            'inventory.professor_id' => $this->_data['view_model']->get_professor_id(),
            'inventory.class_id'     => $this->_data['view_model']->get_class_id(),
            'inventory.isbn'         => ($_GET['isbn'] ?? ''),
            'inventory.word_count'   => $this->_data['view_model']->get_word_count(),
            'inventory.year'         => $this->_data['view_model']->get_year(),
            'inventory.status'       => $this->_data['view_model']->get_status(), 
            'credential.email'        => $this->_data['email'], 
        ];

        if ($previews == 2) 
        {
            $this->db->group_start();
            $this->db->where('  feature_image = ""  AND   feature_image2 = ""   AND feature_image3 = ""  '); 
            $this->db->group_end();
        }elseif ($previews == 1) 
        {
            $this->db->group_start();
            $this->db->where('  feature_image != ""  OR   feature_image2 != ""    OR feature_image3 != ""  '); 
            $this->db->group_end();
        }

        $this->_data['view_model']->set_total_rows($this->inventory_model->count($where));

        $this->_data['view_model']->set_format_layout($this->_data['layout_clean_mode']);
        $this->_data['view_model']->set_per_page($per_page_sort);
        $this->_data['view_model']->set_order_by($order_by);
        $this->_data['view_model']->set_sort($direction);
        $this->_data['view_model']->set_sort_base_url('/admin/inventory/0');
        $this->_data['view_model']->set_page($page);

        if ($previews == 2) 
        {
            $this->db->group_start();
            $this->db->where(' feature_image = ""   AND feature_image2 = ""  AND  feature_image3 = ""  '); 
            $this->db->group_end();
        }elseif ($previews == 1) 
        {
            $this->db->group_start();
            $this->db->where('  feature_image != ""  OR   feature_image2 != ""    OR feature_image3 != ""  '); 
            $this->db->group_end();
        }

        $this->_data['view_model']->set_list($this->inventory_model->get_paginated(
            $this->_data['view_model']->get_page(),
            $this->_data['view_model']->get_per_page(),
            $where,
            $order_by,
            $direction));



        
        if ($this->input->get('school_id', TRUE)) 
        {
            $schools  = $this->school_model->get_all(['status' => 1, 'id' => $this->input->get('school_id') ]);
        }


        if ($this->input->get('professor_id', TRUE)) 
        {
            $professors  = $this->professor_model->get_all(['status' => 1, 'id' => $this->input->get('professor_id') ]);
        }


        if ($this->input->get('class_id', TRUE)) 
        {
            $classes  = $this->classes_model->get_all(['status' => 1, 'id' => $this->input->get('class_id') ]);
        }


        if ($this->input->get('isbn', TRUE)) 
        {
            $is_bn = $this->input->get('isbn', TRUE);
            $textbooks  = $this->db->select('isbn')->from('inventory')->where('isbn', $is_bn)->get()->result_array();
        }
 
        
       
        
        if( $this->_data['view_model']->get_list())
        {
            
            foreach ( $this->_data['view_model']->get_list() as $key => &$value) 
            {
                $school_data      = $this->school_model->get($value->school_id);
                $professor_data   = $this->professor_model->get($value->professor_id);
                $classes_data     = $this->classes_model->get($value->class_id); 
                $user_data        = $this->user_model->get($value->user_id);
                $user_data2       = $this->credential_model->get_by_fields(['user_id' => $user_data->id]);

                $value->school_id    = isset($school_data->name) ? $school_data->name : '';
                $value->professor_id = isset($professor_data->name) ? $professor_data->name : ''; 
                $value->class_id     = isset($classes_data->name) ? $classes_data->name : ''; 
                $value->user_id      = isset($user_data->first_name) ? $user_data->first_name . " " . $user_data->last_name : ''; 
                $value->email     = isset($user_data2->email) ? $user_data2->email  : ''; 
            } 
        }
        

        if ($format == 'csv')
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');

            echo $this->_data['view_model']->to_csv();
            exit();
        }

        $this->_data['previews'] = $previews;
        if (!empty($schools))
        {
          $this->_data['schools'] = $schools; 
        }

        if (!empty($professors))
        {
          $this->_data['professors'] = $professors;
        }

        if (isset($textbooks) && !empty($textbooks))
        {
          $this->_data['textbooks'] = $textbooks;
        }

        if (!empty($classes))
        {
          $this->_data['classes'] = $classes;
        }

        if ($format != 'view')
        {
            return $this->output->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->_data['view_model']->to_json()));
        }

        return $this->render('Admin/Inventory', $this->_data);
    }

    public function add()
    {
        include_once __DIR__ . '/../../view_models/Inventory_admin_add_view_model.php';
        $session = $this->get_session();
        $this->form_validation = $this->inventory_model->set_form_validation(
        $this->form_validation, $this->inventory_model->get_all_validation_rule());
        $this->_data['view_model'] = new Inventory_admin_add_view_model($this->inventory_model);
        $this->_data['view_model']->set_heading('Inventory');
        
        $this->load->model('image_model');
        $gallery_images = $this->image_model->get_all();
        foreach ($gallery_images as $key => $image) {
            if($image->type == 4){
                $image->show_url =  $image->url;
            }else
        {
            $image->show_url = $image->url;
        }$image->type = $this->image_model->type_mapping()[$image->type];
        }
        $this->_data['gallery_images'] = $gallery_images;
        
        

        
        if ($this->form_validation->run() === FALSE)
        {
            return $this->render('Admin/InventoryAdd', $this->_data);
        }

        $title = $this->input->post('title', TRUE);
        $school_id = $this->input->post('school_id', TRUE);
        $professor_id = $this->input->post('professor_id', TRUE);
        $class_id = $this->input->post('class_id', TRUE);
        $textbook_id = $this->input->post('textbook_id', TRUE);
        $word_count = $this->input->post('word_count', TRUE);
        $year = $this->input->post('year', TRUE);
        $isbn = $this->input->post('isbn', TRUE);
        $paypal_email = $this->input->post('paypal_email', TRUE);
        $file = $this->input->post('file', TRUE);
        $file_id = $this->input->post('file_id', TRUE);
        $feature_image = $this->input->post('feature_image', TRUE);
        $feature_image_id = $this->input->post('feature_image_id', TRUE);
        $note_type = $this->input->post('note_type', TRUE);
        $description = $this->input->post('description', TRUE);
        $inventory_note = $this->input->post('inventory_note', TRUE);
        $pin_to_top = $this->input->post('pin_to_top', TRUE);
        $approve = $this->input->post('approve', TRUE);
        $status = $this->input->post('status', TRUE);
        
        $result = $this->inventory_model->create([
            'title' => $title,
            'school_id' => $school_id,
            'professor_id' => $professor_id,
            'class_id' => $class_id,
            'textbook_id' => $textbook_id,
            'word_count' => $word_count,
            'year' => $year,
            'isbn' => $isbn,
            'paypal_email' => $paypal_email,
            'file' => $file,
            'file_id' => $file_id,
            'feature_image' => $feature_image,
            'feature_image_id' => $feature_image_id,
            'note_type' => $note_type,
            'description' => $description,
            'inventory_note' => $inventory_note,
            'pin_to_top' => $pin_to_top,
            'approve' => $approve,
            'status' => $status,
            
        ]);

        if ($result)
        {
            
            $this->success('Data has been added successfully.');
            return $this->redirect('/admin/inventory/0?order_by=id&direction=DESC', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/InventoryAdd', $this->_data);
    }

    public function edit($id)
    {
        $model = $this->inventory_model->get($id);
        $session = $this->get_session();
        if (!$model)
        {
            $this->error('Error');
            return redirect('/admin/inventory/0');
        }

        include_once __DIR__ . '/../../view_models/Inventory_admin_edit_view_model.php';
        $this->form_validation = $this->inventory_model->set_form_validation(
        $this->form_validation, $this->inventory_model->get_all_edit_validation_rule());
        $this->_data['view_model'] = new Inventory_admin_edit_view_model($this->inventory_model);
        $this->_data['view_model']->set_model($model);
        $this->_data['view_model']->set_heading('Inventory');
        
        $this->load->model('image_model');
        $gallery_images = $this->image_model->get_all();
        foreach ($gallery_images as $key => $image) {
            if($image->type == 4){
                $image->show_url = $image->url;
            }else
        {
            $image->show_url = $image->url;
        }$image->type = $this->image_model->type_mapping()[$image->type];
        }
        $this->_data['gallery_images'] = $gallery_images;
        
        
        $this->_data['schools']    = $this->school_model->get_all(['status' => 1 , 'id' => $model->school_id]);
        $this->_data['professors'] = $this->professor_model->get_all(['status' => 1, 'id' => $model->professor_id]); 
        $this->_data['classes']    = $this->classes_model->get_all(['status' => 1, 'id' => $model->class_id]);
 
        
        if ($this->form_validation->run() === FALSE)
        {
            return $this->render('Admin/InventoryEdit', $this->_data);
        }


        $school_id    = $this->input->post('school_id', TRUE);
        $professor_id = $this->input->post('professor_id', TRUE);
        $class_id     = $this->input->post('class_id', TRUE);
        $word_count   = $this->input->post('word_count', TRUE);
        $year         = $this->input->post('year', TRUE);
        $isbn         = $this->input->post('isbn', TRUE);
        $note_type    = $this->input->post('note_type', TRUE);
        $feature_image3    = $this->input->post('feature_image3', TRUE);
        $feature_image2    = $this->input->post('feature_image2', TRUE);
        $feature_image     = $this->input->post('feature_image', TRUE);
         
        
        $result = $this->inventory_model->edit([ 
            'school_id'      => $school_id,
            'professor_id'   => $professor_id,
            'class_id'       => $class_id, 
            'word_count'     => $word_count,
            'year'           => $year,
            'isbn'           => $isbn, 
            'note_type'      => $note_type,  
            'feature_image'  => $feature_image,  
            'feature_image3' => $feature_image3,  
            'feature_image2' => $feature_image2,  
        ], $id);

        if ($result)
        {  
            $this->success('Data has been updated successfully.');
            return $this->redirect('/admin/inventory/0?order_by=id&direction=DESC', 'refresh');
        }

        $this->_data['error'] = 'Error';
        return $this->render('Admin/InventoryEdit', $this->_data);
    }

  //    public function view($id)
    // {
  //       $model = $this->inventory_model->get($id);

    //  if (!$model)
    //  {
    //      $this->error('Error');
    //      return redirect('/admin/inventory/0');
    //  }


  //       include_once __DIR__ . '/../../view_models/Inventory_admin_view_view_model.php';
    //  $this->_data['view_model'] = new Inventory_admin_view_view_model($this->inventory_model);
    //  $this->_data['view_model']->set_heading('Inventory');
  //       $this->_data['view_model']->set_model($model);
        
        
    //  return $this->render('Admin/InventoryView', $this->_data);
    // }
  public function view($id)
  {
    $model = $this->inventory_model->get($id);

    if (!$model)
    {
      $this->error('Error');
      return redirect('/admin/inventory/0');
    }

    include_once __DIR__ . '/../../view_models/Inventory_admin_view_view_model.php';
    $this->_data['view_model'] = new Inventory_admin_view_view_model($this->inventory_model);
    $this->_data['view_model']->set_heading('Inventory');
    $this->_data['view_model']->set_model($model);

       //get all school data
       $this->_data['school_data']  = array_column($this->school_model->get_all(['status' => 1]),'name','id');
       //get all professor data
       $this->_data['professor_data']  = array_column($this->professor_model->get_all(['status' => 1]),'name','id');
       //get all classes data
       $this->_data['classes_data']  = array_column($this->classes_model->get_all(['status' => 1]),'name','id');
       //get all textbook data
       $this->_data['textbook_data']  = array_column($this->textbook_model->get_all(['status' => 1]),'isbn','id');

    $this->_data['view_model']->set_school_id( $this->_data['school_data'][$this->_data['view_model']->get_school_id()]);
    $this->_data['view_model']->set_professor_id( $this->_data['professor_data'][$this->_data['view_model']->get_professor_id()]);
    $this->_data['view_model']->set_class_id( $this->_data['classes_data'][$this->_data['view_model']->get_class_id()]);
    // $this->_data['view_model']->set_textbook_id( $this->_data['textbook_data'][$this->_data['view_model']->get_textbook_id()]);
    // print_r($this->_data);
    // exit;

    return $this->render('Admin/InventoryView', $this->_data);
  }

    public function delete()
    {
        $id = $this->input->post('id', TRUE);

        if (!empty($id))
        {
          $model = $this->inventory_model->get($id);

          if (!$model)
          {
            $output['error']  = TRUE;
            $output['status'] = 404;
            $output['msg']    = 'Error! Data not found.';
            echo json_encode($output);
            exit();
          }
          else
          {
            $result = $this->inventory_model->real_delete($id);

            if ($result)
            {
              $output['success'] = TRUE;
              $output['status']  = 200;
              $output['msg']     = 'Deleted successfully.';
              echo json_encode($output);
              exit();
            }
            else
            {
              $output['error']  = TRUE;
              $output['status'] = 500;
              $output['msg']    = 'Error! Please try again later.';
              echo json_encode($output);
              exit();
            }
          }
        }
        else
        {
          $output['error']  = TRUE;
          $output['status'] = 0;
          $output['msg']    = 'Error! ID not found.';
          echo json_encode($output);
          exit();
        }
    }

    

    

    

    

    

    
}