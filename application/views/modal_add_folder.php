<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form action="#">
            <div class="form-group">
                <label>Name</label>
                <input title="Letters and Numbers Only" pattern="[a-zA-Z0-9_ ]+" type="text" class="form-control" name="name" placeholder="Please type a name for the folder" required>
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="folder_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="add_folder">Add</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#add_folder').on('click', function(e) {
            $('#folder_progress').fadeIn(1000);
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
            $form.find('.progress-bar').html('New Folder Successfully Added');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/folders/add/');
        request.send(formdata);

        setTimeout(function() { 
            $('#modal_ajax').modal('hide');
            setTimeout(function() {
                $('#screen').load('<?php echo base_url(); ?>index.php?desk/folders/' + '.php');
            }, 500);
        }, 1000);

        request.setRequestHeader("Cache-Control", "no-cache");
        request.setRequestHeader("Pragma", "no-cache");
        request.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");

    }

</script>




