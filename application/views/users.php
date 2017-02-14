<div align="right" style="margin-top: -2%;margin-right: -2%;margin-bottom: 1%">
	<span class="label label-default">Users Table</span>
</div>
<div class="row">
	<div align="center">
		<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_add_user/');" 
			title="Add new user" data-toggle="tooltip" data-placement="bottom">
			<i class="glyphicon glyphicon-plus-sign function-icon"></i>
		</a>
	</div>
</div>

<div class="row table-responsive" id="datatable_view">
	<table id="userTable" class="table table-striped table-bordered dt-responsive nowrap">
	    <thead style="background-color: black">
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>Permission</th>
	            <th>On</th>
	            <th>Email</th>
	            <th>Password</th>
	            <th>Group</th>
	            <th>Options</th>
	        </tr>
	    </thead>
	    <tbody>
    	<?php
    		$count = 1;
    		$this->db->order_by('user_id' , 'desc');
    		$users = $this->db->get_where('user' , array('type' => 'user'))->result_array();
    		foreach($users as $row):
    	?>
	        <tr style="text-align:center">
	            <td><?php echo $count++; ?></td>
	            <td><?php echo $row['name']; ?></td>
	            <td><?php echo $row['permission']; ?></td>
	            <td><?php echo date('d M, Y' , $row['timestamp']); ?></td>
	            <td><?php echo $row['email']; ?></td>
	            <td><?php echo $row['password']; ?></td>
	            <td><?php echo $this->db->get_where('division' , array('division_id' => $row['group_id']))->row()->name; ?></td>
	            <td>
	            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_user/<?php echo $row['user_id']; ?>');" 
	            		title="Edit" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-edit option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="confirm_modal('<?php echo base_url(); ?>index.php?desk/users/delete/<?php echo $row['user_id']; ?>');" 
	            		title="Delete" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-remove option-icon"></i>
	            	</a>
	            </td>
	        </tr>
	    <?php endforeach; ?>
	    </tbody>
	</table>
</div>

<script>
	$(document).ready(function() {

		$('[data-toggle="tooltip"]').tooltip();

		$('#userTable').DataTable({
			bLengthChange: false
		});
		
	});
</script>






