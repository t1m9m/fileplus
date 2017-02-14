<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form id="system_logo_form">
            <div class="form-group">
                <label>Logo (Please select a image within 400 * 400 and Allowed Types: PNG, JPEG, JPG, GIF, BMP)</label>
                <input type="file" name="logo" accept="image/*">
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="logo_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="submit_logo">Upload</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#submit_logo').on('click', function(e) {
            $('#logo_progress').fadeIn(1000);
        });

        $('form#system_logo_form').submit(function(e) {
            e.preventDefault();
            $form = $(this);
            submitLogoForm($form);
        });
    });

    function submitLogoForm($form) {
        
        var formdata = new FormData($form[0]);

        var request = new XMLHttpRequest();

        request.upload.addEventListener('progress' , function(e) {
            percent = Math.round(e.loaded/e.total * 100);

            $form.find('.progress-bar').width(percent + '%').html(percent + '%');
        });

        request.addEventListener('load' , function(e) {
            $form.find('.progress-bar').html('New Logo Successfully Uploaded');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/settings/update_system_logo/');
        request.send(formdata);

        setTimeout(function() { 
            $('#modal_ajax').modal('hide');
            setTimeout(function() {
                location.reload();
            }, 500);
        }, 1000);

        request.setRequestHeader("Cache-Control", "no-cache");
        request.setRequestHeader("Pragma", "no-cache");
        request.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");

    }

</script>
