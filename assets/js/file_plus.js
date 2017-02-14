$(document).ready(function() {

	$('[data-toggle="tooltip"]').tooltip();

	$('#fileTable').DataTable({
		responsive: true,
		bLengthChange: false
	});

	// FILE ICON IN MENU ON HOVER

	$('#file').mouseover(function() {
		$('#file').fadeOut(function() {
			$('#file_text').fadeIn();
			$('#file_text').css('margin-top' , '3%');
		});
	});

	$('#file_text').mouseleave(function() {
		$('#file_text').fadeOut(function(){
			$('#file').fadeIn();
		});
	});

	// FOLDER ICON IN MENU ON HOVER

	$('#folder').mouseover(function() {
		$('#folder').fadeOut(function() {
			$('#folder_text').fadeIn();
			$('#folder_text').css('margin-top' , '3%');
		});
	});

	$('#folder_text').mouseleave(function() {
		$('#folder_text').fadeOut(function(){
			$('#folder').fadeIn();
		});
	});

	// USER ICON IN MENU ON HOVER

	$('#user').mouseover(function() {
		$('#user').fadeOut(function() {
			$('#user_text').fadeIn();
			$('#user_text').css('margin-top' , '3%');
		});
	});

	$('#user_text').mouseleave(function() {
		$('#user_text').fadeOut(function(){
			$('#user').fadeIn();
		});
	});

	// GROUP ICON IN MENU ON HOVER

	$('#group').mouseover(function() {
		$('#group').fadeOut(function() {
			$('#group_text').fadeIn();
			$('#group_text').css('margin-top' , '3%');
		});
	});

	$('#group_text').mouseleave(function() {
		$('#group_text').fadeOut(function(){
			$('#group').fadeIn();
		});
	});

	// GROUP ICON IN MENU ON HOVER

	$('#setting').mouseover(function() {
		$('#setting').fadeOut(function() {
			$('#setting_text').fadeIn();
			$('#setting_text').css('margin-top' , '3%');
		});
	});

	$('#setting_text').mouseleave(function() {
		$('#setting_text').fadeOut(function(){
			$('#setting').fadeIn();
		});
	});

	// LOGOUT ICON IN MENU ON HOVER

	$('#logout').mouseover(function() {
		$('#logout').fadeOut(function() {
			$('#logout_text').fadeIn();
			$('#logout_text').css('margin-top' , '3%');
		});
	});

	$('#logout_text').mouseleave(function() {
		$('#logout_text').fadeOut(function(){
			$('#logout').fadeIn();
		});
	});

	// LOGGING OUT OF THE SYSTEM

	$('#menu a #logout').on('click' , function() {
		window.location.replace('index.php?login/signout/');
	});

	$('#menu a #logout_text').on('click' , function() {
		window.location.replace('index.php?login/signout/');
	});

	// LOADS MENU ITEMS WITH jQuery
		
	var trigger = $('#menu a'),
		container = $('#screen');

	trigger.on('click' , function() {

		var $this = $(this),
			target = $this.data('target');

		container.load(target + '.php');

		return false;

	});

});

