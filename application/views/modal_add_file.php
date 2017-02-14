<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form>
            <div class="form-group">
                <label>Name</label>
                <input title="Letters and Numbers Only" pattern="[a-zA-Z0-9_ ]+" type="text" class="form-control" name="name" placeholder="Please type a file name" required>
            </div>
            
            <div class="form-group">
                <label>File</label>
                <input type="file" name="file">
            </div>

            <div class="form-group">
                <label>Folder</label>
                <select class="form-control" name="folder_id" id="select_folder">
                    <option value="1">Please select a folder to upload file</option>
                <?php 
                    $folders = $this->db->get('folder')->result_array(); 
                    foreach($folders as $row):
                ?>
                    <option value="<?php echo $row['folder_id']; ?>"><?php echo $row['name']; ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="file_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="submit_file">Upload</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#submit_file').on('click', function(e) {
            $('#file_progress').fadeIn(1000);
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
            $form.find('.progress-bar').html('New File Successfully Uploaded');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/files/add/');
        request.send(formdata);

        setTimeout(function() { 
            $('#modal_ajax').modal('hide');
            setTimeout(function() {
                $('#screen').load('<?php echo base_url(); ?>index.php?desk/files/' + '.php');
            }, 500);
        }, 1000);

        request.setRequestHeader("Cache-Control", "no-cache");
        request.setRequestHeader("Pragma", "no-cache");
        request.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");

    }

</script>
