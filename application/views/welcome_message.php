<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Welcome to CodeIgniter</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugin/DataTables/datatables.min.css" >
    <link rel="stylesheet" href="<?=base_url();?>assets/plugin/font-awesome/css/font-awesome.min.css">

<style>   
Body {  
  font-family: Calibri, Helvetica, sans-serif;  
  background-color: pink;  
}  
button {   
       background-color: #4CAF50;   
       width: 100%;  
        color: orange;   
        padding: 15px;   
        margin: 10px 0px;   
        border: none;   
        cursor: pointer;   
         }   
 form {   
        border: 3px solid #f1f1f1;   
    }   
 input[type=text], input[type=password] {   
        width: 100%;   
        margin: 8px 0;  
        padding: 12px 20px;   
        display: inline-block;   
        border: 2px solid green;   
        box-sizing: border-box;   
    }  
 button:hover {   
        opacity: 0.7;   
    }   
  .cancelbtn {   
        width: auto;   
        padding: 10px 18px;  
        margin: 10px 5px;  
    }   
        
     
 .container {   
        padding: 25px;   
        background-color: lightblue;  
    }   
</style>   

<body class="container-fluid">
    <div class="login-wrapper">
        <center> <h1> Add Product </h1> </center>   
        <form class="form-horizontal" action="<?=base_url('Welcome/addProduct');?>" method="post" name="addProduct" enctype="multipart/form-data">  
            <div class="container">   
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name">
                </div>
                <div class="form-group">
                    <label for="productPrice">Product Price</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Product Price">
                </div>
                <div class="form-group">
                    <label for="productDesccription">Product Desccription</label>
                    <textarea class="form-control" rows="3" id="productDescription" name="productDesccription" placeholder="Product Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <input type="file" id="productImage" multiple="" name="productImage[]">
                    <div class="filearray">  </div>
                </div>
                <button type="submit" id="addProduct">Add Product</button>   
            </div>   
        </form> 
    </div>  
    <div class="login-wrapper">
      <center> <h1> View Product Details</h1> </center>   
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($result as $resultVal){
        ?>
            <tr>
                <td><?=$resultVal['product_name']?></td>
                <td><?=$resultVal['product_price']?></td>
                <td><?=$resultVal['product_desccription']?></td>
                <td>
                    <?php 
                        $imagearr = explode(',',$resultVal['product_image']);
                        for($i=0;$i<count($imagearr);$i++){
                            ?>
                            <img id="<?='img'.$i?>" src="<?=base_url().'/assets/productImage/'.$imagearr[$i]; ?>" />
                            <?php
                        }
                    ?>
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary" onclick="showAjaxModal('<?php echo base_url('modal/popup/model_edit_product/'.$resultVal['id'].'/Edit Product');?>');"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="confirm_modal('<?php echo base_url('Welcome/deleteProduct/delete/' . $resultVal['id']);?>');"><i class="fa fa-trash"></i></a>                                                    
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>action</th>
            </tr>
        </tfoot>
    </table>       
    </div>   
<script src="<?=base_url()?>assets/js/jquery-3.6.1.min.js" ></script>
        <!-- Latest compiled and minified JavaScript -->
<script src="<?=base_url()?>assets/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script></head>
<script src="<?=base_url()?>assets/plugin/DataTables/datatables.min.js" ></script></head>
<script src="<?=base_url()?>assets/plugin/DataTables/datatables.min.js" ></script></head>
<script>
 $(document).ready(function () {
    $('#example').DataTable();
});   
 $("#productImage").on('change',function(){
      $(".filearray").empty();//you can remove this code if you want previous user input
        for(let i=0;i<this.files.length;++i){
            let filereader = new FileReader();
            let $img=jQuery.parseHTML("<img src=''>");
            filereader.onload = function(){
                $img[0].src=this.result;
            };
            filereader.readAsDataURL(this.files[i]);
            $(".filearray").append($img);
        }
    });    
$('#addProduct').submit(function(event){
    event.preventDefault();
    $.ajax({
        url:$(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response){
            if(response){
                alert('status :' +response.status);
            }
            window.location.href="<?=base_url('Welcome')?>";
            console.log(response.status);

        }
    });
});
$('#addEdit').submit(function(event){
    event.preventDefault();
    $.ajax({
        url:$(this).attr('action'),
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response){
            if(response){
                alert('status :' +response.status);
            }
            window.location.href="<?=base_url('Welcome')?>";
            console.log(response.status);

        }
    });
});
</script>
</body>
</html>
