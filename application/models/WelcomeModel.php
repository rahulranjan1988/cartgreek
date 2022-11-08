<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WelcomeModel extends CI_Model {
    
    function addProduct($pName,$pPrice,$pDescription,$pImage){
        $qry = array('product_name'=>$pName,'product_price'=>$pPrice,'product_desccription'=>$pDescription,'product_image'=>$pImage);
        $result= $this->db->insert('product',$qry);
        return $result;
    }
    function getProductDetails(){
        $resp = $this->db->get('product')->result_array();
        return $resp;
    }
    function addProductImage($images){
        $config["upload_path"] = './assets/productImage/';
        $config["allowed_types"] = 'gif|jpg|png';
        $config["file_name"] = random_string('alnum', 16);
        $config["overwrite"] = FALSE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $totalNoOfImage= count($_FILES['productImage']['name']);
        for($i=0;$i<$totalNoOfImage; $i++){
            $_FILES['userfile']['name']     = $_FILES['productImage']['name'][$i];
            $_FILES['userfile']['type']     = $_FILES['productImage']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['productImage']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $_FILES['productImage']['error'][$i];
            $_FILES['userfile']['size']     = $_FILES['productImage']['size'][$i];

            if($this->upload->do_upload('userfile')){
                $filename = $this->upload->data();
                $images = array('status'=>'success','data' => $filename['file_name']);
                $fileName[] = $filename['file_name'];
            }
            else{
                $error = array('error' => $this->upload->display_errors());
                $images = array(
                    'errors'=> $error
                );//saving arrors in the array
            }    
        }
        $fileNameStr = implode(',',$fileName);
        return $fileNameStr;
    }
    function editProduct($pid='', $pName='',$pPrice='',$pDescription=''){
        $id = $pid;
        $product_name =$pName;
        $product_price = $pPrice;
        $product_desccription = $pDescription;
        $data = array('product_name' =>$product_name, 'product_price' => $product_price,'product_desccription'=>$product_desccription);
        $res = $this->db->where(array('id'=>$id))->update('product',$data);
        return $res;
    }
    function deleteProduct(){
        
    }
}
