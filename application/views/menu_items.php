<ul class="nav nav-pills nav-stacked">
    <li style="margin: 10% 0">
        <img width="44%" src="assets/system_images/<?php echo $this->db->get_where('setting' , array('setting_id' => '2'))->row()->value; ?>" class="img-circle"/>    
    </li>

    <li>
        <a href="#" data-target="<?php echo base_url(); ?>index.php?desk/files/">
            <i class="glyphicon glyphicon-file menu-icon" id="file"></i>
            <img width="30%" style="display:none" src="assets/menu_images/files.png" id="file_text" class="img-circle"> 
        </a>
    </li>

    <li>
        <a href="#" data-target="<?php echo base_url(); ?>index.php?desk/folders/">
            <i class="glyphicon glyphicon-folder-close menu-icon" id="folder"></i>
            <img width="30%" style="display:none" src="assets/menu_images/folders.png" id="folder_text" class="img-circle">
        </a>
    </li>

    <?php if ($this->session->userdata('user_type') != 'user'): ?>
    <li>
        <a href="#" data-target="<?php echo base_url(); ?>index.php?desk/users/">
            <i class="glyphicon glyphicon-user menu-icon" id="user"></i>
            <img width="30%" style="display:none" src="assets/menu_images/users.png" id="user_text" class="img-circle">
        </a>
    </li>

    <li>
        <a href="#" data-target="<?php echo base_url(); ?>index.php?desk/groups/">
            <i class="glyphicon glyphicon-tree-deciduous menu-icon" id="group"></i>
            <img width="30%" style="display:none" src="assets/menu_images/groups.png" id="group_text" class="img-circle">
        </a>
    </li>
    <?php endif; ?>

    <li>
        <a href="#" data-target="<?php echo base_url(); ?>index.php?desk/settings/">
            <i class="glyphicon glyphicon-cog menu-icon" id="setting"></i>
            <img width="30%" style="display:none" src="assets/menu_images/settings.png" id="setting_text" class="img-circle">
        </a>
    </li>

    <li>
        <a href="#">
            <i class="glyphicon glyphicon-log-out menu-icon" id="logout"></i>
            <img width="30%" style="display:none" src="assets/menu_images/logout.png" id="logout_text" class="img-circle">
        </a>
    </li>

    <?php if ($this->session->userdata('user_type') == 'user'): ?>
    <li style="font-size: 66%;margin-top: 122%">
        <a target="_blank" href="http://www.tahsinalam.com">
            LIGHTs
        </a> <strong style="color:#bdc3c7">&copy 2016-2017</strong>
    </li>
    <?php endif; ?>

    <?php if ($this->session->userdata('user_type') == 'admin'): ?>
    <li style="font-size: 66%;margin-top: 33%">
        <a target="_blank" href="http://www.tahsinalam.com">
            LIGHTs
        </a> <strong style="color:#bdc3c7">&copy 2016-2017</strong>
    </li>
    <?php endif; ?>
</ul>



