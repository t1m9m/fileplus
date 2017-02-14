<div align="right" style="margin-top: -2%;margin-right: -2%;margin-bottom: 1%">
	<span class="label label-default">Users in Group Table</span>
</div>
<div class="row">
	<div align="center" id="back_to_groups">
		<a href="#" data-target="<?php echo base_url(); ?>index.php?desk/groups/" title="Back to Groups">
			<i class="glyphicon glyphicon-menu-left function-icon"></i>
		</a>
	</div>
</div>

<div class="row table-responsive" id="datatable_view">
	<table id="userInGroupTable" class="table table-striped table-bordered dt-responsive nowrap">
	    <thead style="background-color: black">
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>Permission</th>
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
    		$users = $this->db->get_where('user' , array('group_id' => $group_id))->result_array();
    		foreach($users as $row):
    	?>
	        <tr style="text-align:center">
	            <td><?php echo $count++; ?></td>
	            <td><?php echo $row['name']; ?></td>
	            <td><?php echo $row['permission']; ?></td>
	            <td><?php echo $row['email']; ?></td>
	            <td><?php echo $row['password']; ?></td>
	            <td><?php echo $this->db->get_where('division' , array('division_id' => $row['group_id']))->row()->name; ?></td>
	            <td>
	            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_user/<?php echo $row['user_id']; ?>');" title="Edit">
	            		<i class="glyphicon glyphicon-edit option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="confirm_modal('<?php echo base_url(); ?>index.php?desk/users/delete/<?php echo $row['user_id']; ?>');" title="Delete">
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

		$('#userInGroupTable').DataTable({
			bLengthChange: false
		});

		var trigger = $('#back_to_groups a'),
			container = $('#screen');

		trigger.on('click' , function() {

			var $this = $(this),
				target = $this.data('target');

			container.load(target + '.php');

			return false;

		});
		
	});
</script>






