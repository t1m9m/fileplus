<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form id="system_name_form">
            <div class="form-group">
                <label>Name</label>
                <input title="Letters and Numbers Only" pattern="[a-zA-Z0-9+| ]+" value="<?php echo $this->db->get_where('setting' , array('setting_id' => '1'))->row()->value; ?>" type="text" class="form-control" name="name" placeholder="Please type a file name" required>
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="system_name_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="system_name">Update</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#system_name').on('click', function(e) {
            $('#system_name_progress').fadeIn(1000);
        });

        $('#modal_ajax').on('shown.bs.modal', function () {
            $('input[name=name]').focus();
        });

        $('form#system_name_form').submit(function(e) {
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
            $form.find('.progress-bar').html('Webstie Name Successfully Changed');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/settings/change_system_name/');
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
