<div align="right" style="margin-top: -2%;margin-right: -2%;margin-bottom: 1%">
	<span class="label label-default">Folders Table</span>
</div>
<?php
	if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,1,1) == 'r'):
		if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,0,1) == 'd'):
?>
<div class="row">
	<div align="center">
		<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_add_folder/');" 
			title="Create a folder" data-toggle="tooltip" data-placement="bottom">
			<i class="glyphicon glyphicon-plus-sign function-icon"></i>
		</a>
	</div>
</div>
<?php endif; ?>

<div class="row table-responsive" id="datatable_view">
	<table id="folderTable" class="table table-striped table-bordered dt-responsive nowrap">
	    <thead style="background-color: black">
	        <tr>
	            <th>#</th>
	            <th>Name</th>
	            <th>Files</th>
	            <th>On</th>
	            <th>Size</th>
	            <?php if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,3,1) == 'x'): ?>
	            <th>Options</th>
	        	<?php endif; ?>
	        </tr>
	    </thead>
	    <tbody>
	    <?php
	    	$count = 1;
	    	$this->db->order_by('folder_id' , 'asec');
	    	$folders = $this->db->get('folder')->result_array();
	    	foreach ($folders as $row):
	    ?>
	        <tr style="text-align:center">
	            <td><?php echo $count++; ?></td>
	            <td id="files_in_folder">
	            	<a href="#" data-target="<?php echo base_url(); ?>index.php?desk/files_in_folder/<?php echo $row['folder_id']; ?>">
	            		<?php echo $row['name']; ?>
	            	</a>
	            </td>
	            <td><?php echo $this->db->get_where('file' , array('folder_id' => $row['folder_id']))->num_rows(); ?></td>
	            <td><?php echo date('d M, Y' , $row['timestamp']); ?></td>
	            <td>
	            	<span class="label label-success">
	            		<?php
	            			$sizes = $this->db->get_where('file' , array('folder_id' => $row['folder_id']))->result_array(); 
	            			$total_size = 0;
	            			foreach ($sizes as $row1) {
	            				$total_size += $row1['size'];
	            			}
	            			echo formatSizeUnits($total_size);
	            		?>
	            	</span>
	            </td>
	            <?php if (substr($this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->permission,3,1) == 'x'): ?>
	            <td>
	            	<?php
	            		$query =  $this->db->get_where('file' , array('folder_id' => $row['folder_id']));
						if ($query->num_rows() > 0):
	            	?>
	            	<a href="<?php echo base_url(); ?>index.php?desk/zip/<?php echo $row['folder_id']; ?>" 
	            		title="Download as zip" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-download-alt option-icon"></i>
	            	</a>
	            	<?php endif; ?>
	            	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_folder/<?php echo $row['folder_id']; ?>');" 
	            		title="Edit" data-toggle="tooltip" data-placement="bottom">
	            		<i class="glyphicon glyphicon-edit option-icon"></i>
	            	</a>
	            	<a href="javascript:;" onclick="confirm_modal('<?php echo base_url(); ?>index.php?desk/folders/delete/<?php echo $row['folder_id']; ?>');" 
	            		title="Delete" data-toggle="tooltip" data-placement="bottom">
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

		$('#folderTable').DataTable({
			bLengthChange: false
		});

		var trigger = $('#files_in_folder a'),
			container = $('#screen');

		trigger.on('click' , function() {

			var $this = $(this),
				target = $this.data('target');

			container.load(target + '.php');

			return false;

		});

	});
</script>






