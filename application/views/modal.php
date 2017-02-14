<script type="text/javascript">
	
	function showAjaxModal(url)
	{
		// LOADING MODAL WITH THE HELP OF AJAX
		$('#modal_ajax').modal({backdrop: 'static' , keyboard: false});

		// SHOWING AJAX RESPONSE ON REQUEST
		$.ajax({
			url: url,
			success: function(response)
			{
				$('#modal_ajax .modal-body').html(response);
			}
		});
	}

</script>

<!-- AJAX MODAL -->
<div class="modal fade" id="modal_ajax">
	<div class="modal-dialog">
		<div class="modal-content" style="margin-top:22%">
			
			<div class="modal-header" style="background-color: black;color: white;">
				<button style="color: white;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title" align="center"><b>File +</b></i></h4>
			</div>

			<div class="modal-body" style="height:100%; overflow:auto;">
			
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">
	
	function confirm_modal(delete_url)
	{
		$('#modal_delete').modal({backdrop: 'static' , keyboard: false});

		$('#delete_link').on('click' , function(e) {
			e.preventDefault();

			var request = new XMLHttpRequest();

			request.open('get' , delete_url);
        	request.send();

        	setTimeout(function() { 
	            $('#modal_delete').modal('hide');
	            setTimeout(function() {
	                $('#screen').load(delete_url);
	            }, 1000);
	        }, 500);

	        return false;
		});
	} 

</script>

<!-- Delete modal -->
<div class="modal fade" id="modal_delete">
	<div class="modal-dialog">
		<div class="modal-content" style="margin-top: 44%">

			<div class="modal-header">
				<button style="color: white;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
				<h4 class="modal-title" style="text-align:center;">Are you sure you want to delete this information ?</h4>
			</div>

			<div class="modal-footer" style="margin:0px; bordet-top:0px; text-align:center;">
				<a href="#" class="btn btn-danger" id="delete_link">Delete</a>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			</div>
			
		</div>
	</div>
</div>











