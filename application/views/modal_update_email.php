<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form id="update_email_form">
            <div class="form-group">
                <label>Name</label>
                <input value="<?php echo $this->db->get_where('user' , array('user_id' => '1'))->row()->email; ?>" type="email" class="form-control" name="email" placeholder="Please type youe email" required>
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="update_email_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="update_email">Update</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#update_email').on('click', function(e) {
            $('#update_email_progress').fadeIn(1000);
        });

        $('#modal_ajax').on('shown.bs.modal', function () {
            $('input[name=email]').focus();
        });

        $('form#update_email_form').submit(function(e) {
            e.preventDefault();
            $form = $(this);
            submitNameForm($form);
        });
    });

    function submitNameForm($form) {
        
        var formdata = new FormData($form[0]);

        var request = new XMLHttpRequest();

        request.upload.addEventListener('progress' , function(e) {
            percent = Math.round(e.loaded/e.total * 100);

            $form.find('.progress-bar').width(percent + '%').html(percent + '%');
        });

        request.addEventListener('load' , function(e) {
            $form.find('.progress-bar').html('Email address successfully updated');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/update_email/');
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
