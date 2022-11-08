<script type="text/javascript">
        function showAjaxModal(url)
	{
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-content').html(response);
			}
		});
	}
	</script>

    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">

                



                
            </div>
        </div>
    </div>




    <script type="text/javascript">
    
	function confirm_modal(delete_url, modal_type)
	{
            if (modal_type === 'generic_confirmation') 
            {
                jQuery('#modal-generic_confirmation').modal('show', {backdrop: 'static'});
                
    		document.getElementById('update_link').setAttribute('href' , delete_url);
            }
            else
            {
                jQuery('#modal-4').modal('show', {backdrop: 'static'});
    		document.getElementById('delete_link').setAttribute('href' , delete_url);
            }
	}
        function couponstatusupdate(url,modal_type)
	{
            if (modal_type === 'generic_confirmation') 
            {
                jQuery('#modal-generic_confirmation').modal('show', {backdrop: 'static'});
    		document.getElementById('update_link').setAttribute('href' , url);
            }else{
                jQuery('#modal-7').modal('show', {backdrop: 'static'});
    		document.getElementById('updateCouponStatus').setAttribute('href' , url);
            }
	}

	</script>

    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>


                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- (generic_confirmation Modal)-->
    
   
