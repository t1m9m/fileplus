<div align="right" style="margin-top: -2%;margin-right: -2%;margin-bottom: 1%">
	<span class="label label-default">Files Table</span>
</div>
<?php
	if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,1,1) == 'r'):
		if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,2,1) == 'w'):
?>
<div class="row">
	<div align="center">
		<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_add_file/');" 
			title="Upload a file" data-toggle="tooltip" data-placement="bottom">
			<i class="glyphicon glyphicon-upload function-icon"></i>
		</a>
	</div>
</div>
<?php endif; ?>

<div class="row table-responsive" id="datatable_view">
	<table id="fileTable" class="table table-striped table-bordered dt-responsive nowrap">
	    <thead style="background-color: black">
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>On</th>
	            <th>Size</th>
	            <th>By</th>
	            <th>In</th>
	            <th>Type</th>
	            <?php if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,3,1) == 'x'): ?>
	            <th>Options</th>
	        	<?php endif; ?>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$count = 1;
	    		$this->db->order_by('file_id' , 'desc');
	    		$files = $this->db->get('file')->result_array();
	    		foreach($files as $row):
	    	?>
	        <tr style="text-align:center">
	            <td><?php echo $count ++; ?></td>
	            <td><?php echo $row['name']; ?></td>
	            <td><?php echo date('d M, Y' , $row['timestamp']); ?></td>
	            <td><span class="label label-success"><?php echo formatSizeUnits($row['size']); ?></span></td>
	            <td><?php echo $this->db->get_where('user' , array('user_id' => $row['user_id']))->row()->name; ?></td>
	            <td><?php echo $this->db->get_where('folder' , array('folder_id' => $row['folder_id']))->row()->name; ?></td>
	            <td><span class="label label-primary"><?php echo $row['type']; ?></span></td>
	            <?php if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,3,1) == 'x'): ?>
	            <td>
	            	<a href="uploads/<?php echo $row['name'] . '.' . $row['type'];?>" 
	            		title="Download" download data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-download option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_share_file/<?php echo $row['file_id']; ?>');" 
	            		title="Share with User" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-share option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_file/<?php echo $row['file_id']; ?>');" 
	            		title="Edit" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-edit option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="confirm_modal('<?php echo base_url(); ?>index.php?desk/files/delete/<?php echo $row['file_id']; ?>');" 
	            		title="Delete" data-toggle="tooltip" data-placement="left">
	            		<i class="glyphicon glyphicon-remove option-icon"></i>
	            	</a>
	            </td>
	        	<?php endif; ?>
	        </tr>
	    	<?php endforeach; ?>
	    </tbody>
	</table>
</div>

<?php
	endif;

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}
?>

<script>
	$(document).ready(function() {

		$('[data-toggle="tooltip"]').tooltip();

		$('#fileTable').DataTable({
			bLengthChange: false
		});
		
	});
</script>







