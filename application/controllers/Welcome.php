<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function index(){
        $data['title'] = 'Product';
        $resp['result'] = $this->WelcomeModel->getProductDetails();
        $this->load->view('welcome_message',$resp);
        $this->load->view('modal.php', $data);
    }
    public function addProduct(){
        $productName = $this->input->post('productName');
        $productPrice = $this->input->post('productPrice');
        $productDescription = $this->input->post('productDesccription');
        $productImage = $this->WelcomeModel->addProductImage($productImage='productImage');
        $this->WelcomeModel->addProduct($productName,$productPrice,$productDescription,$productImage);
        redirect('welcome', 'refresh');                    
    }
    public function deleteProduct($param1 = '' , $param2 = '',$param3 =''){
        if ($param1 == 'delete'){
            $resp = $this->db->where(array('id'=>$param2))->get('product')->row_array();
            $imgArr = explode(',',$resp['product_image']);
            $path= substr(base_url('assets/productImage/'),strlen(base_url()));
            for($i=0;$i<count(explode(',',$resp['product_image']));$i++){
                unlink($path.$imgArr[$i]);
            }
            $this->db->where('id',$param2);
            $res=$this->db->delete('product');                
            if($res == 1){
                redirect('welcome', 'refresh');                    
            }else {
                redirect('welcome', 'refresh');                                        
            }
        }
    }
    public function editProduct(){
        $productName = $this->input->post('productName');
        $productId = $this->input->post('productId');
        $productPrice = $this->input->post('productPrice');
        $productDescription = $this->input->post('productDescription');
        $resp = $this->WelcomeModel->editProduct($productId,$productName,$productPrice,$productDescription);
        if($resp === 1){
            redirect('welcome', 'refresh');                    
        } 
        echo $res;
    }
}
