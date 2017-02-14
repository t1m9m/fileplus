<div align="right" style="margin-top: -2%;margin-right: -2%;margin-bottom: 1%">
	<span class="label label-default">Groups Table</span>
</div>
<div class="row">
	<div align="center">
		<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_add_group/');" 
			title="Add new group" data-toggle="tooltip" data-placement="bottom">
			<i class="glyphicon glyphicon-plus-sign function-icon"></i>
		</a>
	</div>
</div>

<div class="row table-responsive" id="datatable_view">
	<table id="groupTable" class="table table-striped table-bordered dt-responsive nowrap">
	    <thead style="background-color: black">
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>Users</th>
	            <th>Description</th>
	            <th>On</th>
	            <th>Options</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$count = 1;
	    		$this->db->order_by('division_id' , 'desc');
	    		$this->db->not_like('name', 'admin');
	    		$groups = $this->db->get('division')->result_array();
	    		foreach($groups as $row):
	    	?>
	        <tr style="text-align:center">
	            <td><?php echo $count ++; ?></td>
	            <td id="users_in_group">
	            	<a href="#" data-target="<?php echo base_url(); ?>index.php?desk/users_in_group/<?php echo $row['division_id']; ?>">
	            		<?php echo $row['name']; ?>
	            	</a>
	            </td>
	            <td><?php echo $this->db->get_where('user' , array('group_id' => $row['division_id']))->num_rows(); ?></td>
	            <td><?php echo $row['description']; ?></td>
	            <td><?php echo date('d M, Y' , $row['timestamp']); ?></td>
	            <td>
	            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_group/<?php echo $row['division_id']; ?>');" 
	            		title="Edit" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-edit option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="confirm_modal('<?php echo base_url(); ?>index.php?desk/groups/delete/<?php echo $row['division_id']; ?>');" 
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

		$('#groupTable').DataTable({
			bLengthChange: false
		});

		var trigger = $('#users_in_group a'),
			container = $('#screen');

		trigger.on('click' , function() {

			var $this = $(this),
				target = $this.data('target');

			container.load(target + '.php');

			return false;

		});
		
	});
</script>



