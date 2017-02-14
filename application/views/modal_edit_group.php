<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form action="#">
        <?php
            $groups = $this->db->get_where('division' , array('division_id' => $param2))->result_array();
            foreach ($groups as $row):
        ?>
            <div class="form-group">
                <label>Name</label>
                <input value="<?php echo $row['name']; ?>" type="text" class="form-control" name="name" placeholder="Please type a name for the group" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea  type="text" name="description" class="form-control" required><?php echo $row['description']; ?></textarea>
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="edited_group_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="edit_group">Update</button>
            </div>
        <?php endforeach;?>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#edit_group').on('click', function(e) {
            $('#edited_group_progress').fadeIn(1000);
        });

        $('#modal_ajax').on('shown.bs.modal', function () {
            $('input[name=name]').focus();
        })
    });

    $(document).on('submit' , 'form' , function(e) {
        
        e.preventDefault();

        $form = $(this);

        submitForm($form);

    });

    function submitForm($form) {
        
        var formdata = new FormData($form[0]);

        var request = new XMLHttpRequest();

        request.upload.addEventListener('progress' , function(e) {
            percent = Math.round(e.loaded/e.total * 100);

            $form.find('.progress-bar').width(percent + '%').html(percent + '%');
        });

        request.addEventListener('load' , function(e) {
            $form.find('.progress-bar').html('Group Successfully Edited');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/groups/edit/<?php echo $param2; ?>');
        request.send(formdata);

        setTimeout(function() { 
            $('#modal_ajax').modal('hide');
            setTimeout(function() {
                $('#screen').load('<?php echo base_url(); ?>index.php?desk/groups/' + '.php');
            }, 500);
        }, 1000);

        request.setRequestHeader("Cache-Control", "no-cache");
        request.setRequestHeader("Pragma", "no-cache");
        request.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");

    }

</script>




