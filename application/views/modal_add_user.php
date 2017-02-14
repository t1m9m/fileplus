<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <form action="#">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Please type name of the user" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Please type the email of the user" required>
            </div>

            <div class="form-group">
                <label>Permission</label>
                <div class="checkbox">
                    <label><input type="checkbox" value="d" name="permission[]">d (directory)</label>
                    <label><input type="checkbox" value="r" name="permission[]" checked>r (read)</label>
                    <label><input type="checkbox" value="w" name="permission[]">w (write)</label>
                    <label><input type="checkbox" value="x" name="permission[]">x (execute)</label>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Please type a password for the user" required>
            </div>

            <div class="form-group">
                <label>Group</label>
                <select class="form-control" name="group_id" id="select_group">
                    <option>Please select a group for the user</option>
                <?php 
                    $this->db->not_like('division_id' , '1');
                    $groups = $this->db->get('division')->result_array(); 
                    foreach($groups as $row):
                ?>
                    <option value="<?php echo $row['division_id']; ?>"><?php echo $row['name']; ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="progress" style="margin-top:30px;display:none" id="user_progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" 
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                </div>
            </div>

            <div align="right">
                <button type="submit" class="btn btn-primary" id="add_user">Add</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#add_user').on('click', function(e) {
            $('#user_progress').fadeIn(1000);
        });

        $('#modal_ajax').on('shown.bs.modal', function () {
            $('input[name=name]').focus();
        });
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
            $form.find('.progress-bar').html('New User Successfully Added');       
        });

        request.open('post' , '<?php echo base_url(); ?>index.php?desk/users/add/');
        request.send(formdata);

        setTimeout(function() { 
            $('#modal_ajax').modal('hide');
            setTimeout(function() {
                $('#screen').load('<?php echo base_url(); ?>index.php?desk/users/' + '.php');
            }, 500);
        }, 1000);

        request.setRequestHeader("Cache-Control", "no-cache");
        request.setRequestHeader("Pragma", "no-cache");
        request.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");

    }

</script>