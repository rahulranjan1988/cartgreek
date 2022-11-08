<?php 
    $result = $this->db->get_where('product', array('id'=>$param2))->row_array();
?>
    <form role="form" name="frmeditproduct" method="post" action="<?php echo base_url('welcome/editProduct'); ?>">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo urldecode($param3); ?></h4>
        </div>
        <div class="modal-body" style="overflow:auto;">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" name="productName" id="productName" value="<?=$result['product_name']?>" placeholder="Enter Product Name">
                        <input type="hidden" class="form-control" name="productId" id="productId" value="<?=$param2?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="productPrice">Product Price</label>
                        <input type="text" class="form-control" name="productPrice" id="productPrice" value="<?=$result['product_price']?>"   placeholder="Enter Product Price">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="productDescription">Product Description</label>
                        <input type="text" class="form-control" name="productDescription" id="productDescription" value="<?=$result['product_desccription']?>"  placeholder="Enter Product Description">
                    </div>
                </div>
                <div class='row'>
                    <div class="form-group col-lg-12">
                        <label for="productImage">Product Image</label>
                    <?php 
                        $imagearr = explode(',',$result['product_image']);
                        for($i=0;$i<count($imagearr);$i++){
                            ?>
                            <img id="<?='productImage'.$i?>" name="productImage" src="<?=base_url().'/assets/productImage/'.$imagearr[$i]; ?>" />
                            <?php
                        }
                    ?>
                        
                    </div>
                </div>                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" >Update</button>
        </div>
    </form>
