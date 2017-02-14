<div align="right" style="margin-top: -2%;margin-right: -2%">
    <span class="label label-default">Settings Page</span>
</div>
<?php if ($this->session->userdata('user_type') == 'admin'): ?>
<div class="row" style="margin-bottom: 5%">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" align="center">
        <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_system_name/');">
            <button class="btn btn-primary btn-block">Update website name</button>
        </a>
    </div>
</div>

<div class="row" style="margin: 5% 0">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" align="center">
        <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_update_email/');">
            <button class="btn btn-primary btn-block">Update your email</button>
        </a>
    </div>
</div>

<?php endif; ?>

<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-6" align="center">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Change your Password</h3>
            </div>
            
            <div class="panel-body" id="change_password_body">
                <form id="change_password_form">
                    <div class="form-group">
                        <input autofocus required type="password" name="old_password" class="form-control" 
                            placeholder="Type old Password">
                    </div>
                    <div class="form-group">
                        <input required type="password" name="new_password" class="form-control" 
                            placeholder="Type new Password">
                    </div>
                    <div class="form-group" style="margin-top:10%">
                        <button type="submit" class="btn btn-primary btn-block" id="change_password">Update</button>
                    </div>
                </form>
                <p style="color: black;"><?php echo $this->session->flashdata('password_match'); ?></p>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->userdata('user_type') == 'admin'): ?>
<div class="row" style="margin-top: 4%;">
    <div class="col-lg-3"></div>
    <div class="col-lg-6" align="center">
        <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_system_logo/');">
            <button class="btn btn-primary btn-block">Change website logo</button>
        </a>
    </div>
</div>
<?php endif; ?>

<script type="text/javascript">

    $(document).ready(function() {
        
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
            return false;
            }
        });

        $('form#change_password_form').submit(function(event) {
            event.preventDefault();
            $form = $(this);
            submitPasswordForm($form);
        });
    });

    function submitPasswordForm($form) {
        
        var formdata = new FormData($form[0]);

        var request = new XMLHttpRequest();

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/update_password/<?php echo $this->session->userdata('user_id'); ?>/');
        request.send(formdata);

        setTimeout(function() {
            $('#screen').load('<?php echo base_url(); ?>index.php?desk/settings/' + '.php');
        }, 500);

        request.setRequestHeader("Cache-Control", "no-cache");
        request.setRequestHeader("Pragma", "no-cache");
        request.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
    }

</script>

<style>

	#change_password_body
	{
		padding: 5%;
	}

</style>







