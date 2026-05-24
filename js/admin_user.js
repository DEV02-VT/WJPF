$(document).ready(function() {

	var user_table = $('#user_table').DataTable({
		"iDisplayLength": 25,
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Alle"]],
		"bPaginate": true,
		"bStateSave": true,
		"sPaginationType": "full_numbers",
		"serverSide": true,
		"responsive": true,
		"autoWidth": false,
//		"scrollX": true,
		"dom": 'Bfrtilp',
		"buttons": [
			{
				"extend": "excelHtml5",
				"exportOptions": {
					"columns": ":visible"
				}
			},
			{
				"extend": "csvHtml5",
				"bom": true,
				"fieldSeparator": ";",
				"exportOptions": {
					"columns": ":visible"
				}
			}
		],
		"order": [[1, "asc"]],
		"columnDefs": [
			//zusätzliche Spalten ausblenden. Trotzdem kann nach ihnen gesucht werden
			{"targets": [8, 9, 10, 11, 12, 13, 14, 15], "visible": false},
			{"targets": [0, 7], "orderable": false},
			{responsivePriority: 1, targets: [0, 1, 7]},
			{responsivePriority: 2, targets: -1}
		],
		"ajax": {
			"url": "./datatable/get_user.php",
			"type": "GET",
			"data": function (d) {
				d.status = document.getElementById("select_user_status").value;
				d.show_only_board_users = 0;
				if (document.getElementById("show_only_board_users").checked) {
					d.show_only_board_users = 1
				}
				;
			}
		},
	});

	$(document).on('change', "#select_user_status", function () {
		user_table.ajax.reload(null, true);
	});

	$(document).on('change', "#show_only_board_users", function () {
		user_table.ajax.reload(null, true);
	});


	$('#deleteUserModal').on('show.bs.modal', function (user) {
		var button = $(user.relatedTarget); // Button that triggered the modal
		var id = button.data('id'); // Extract info from data-* attributes
		var name = button.data('name'); // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		$('#deleteMsg').html('Do you really want to delete  the user: <b>' + name + '</b>?');
		modal.find('#deleteid').val(id);
		$('#deleteUserMsg').html('');
	});

	//to prevent from closing when clicking outside the modal
	$('#deleteUserModal').modal({
		backdrop: 'static',
		keyboard: true
	});

	$("#deleteUserModal").keyup(function (event) {
		if (event.keyCode === 13) {
			$("#deleteUser").click();
		}
	});
	$(document).on("click", "#deleteUser", function () {
		var deleteid = document.getElementById("deleteid").value;
		var data = {
			deleteid: deleteid,
			Action: 'Delete'
		};
		$('#page_message').html('');
		ShowOverlay('Deleting user...');
		$.ajax({
			type: 'POST',
			url: "set/set_user.php",
			data: data,
			async: true,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#deleteUserMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						user_table.ajax.reload(null, false);
						$('#page_message').html('<div class="alert alert-success">The user was deleted.</div>');
						$('#deleteUserModal').modal('hide');
					}
				} catch (err) {
					$('#deleteUserMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#deleteUserMsg').html('<div class="alert alert-danger">Error while deleting the user</div>');
				HideOverlay();
			}
		});
	});


	$(document).on("click", "#newUser", function () {
		var user = {
			id: -1,
			first_name: '',
			last_name: '',
			birthday: '',
			age: '',
			nationality_code: '',
			phone: '',
			email: '',
			street: '',
			house_number: '',
			zip: '',
			town: '',
			country_code: '',
			status: 3,
			administrator: '',
			board_role: 1,
			image: '',
			preview: 'img/boss.png',
			wjpf_email: '',
			passport_number: ''
		};
		edit_user(user);
	});

	$(document).on("click", ".edit_user", function () {
		var id = $(this).attr("data-id");
		load_user(id);
	});

	function load_user(id) {
		var data = {
			id: id,
			Action: "Get"
		};
//		alert(JSON.stringify(data));
		$('#page_message').html('');
		ShowOverlay('Loading user...');
		$.ajax({
			type: 'POST',
			url: "set/set_user.php",
			data: data,
			async: true,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						edit_user(obj['user']);
					}
				} catch (err) {
					$('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#page_message').html('<div class="alert alert-danger">Error while loading the user</div>');
				HideOverlay();
			}
		});
	}

	function edit_user(user) {
//		alert(JSON.stringify(user));

		$('#user_id').val(user.id);
		$('#user_first_name').val(user.first_name);
		$('#user_last_name').val(user.last_name);
		$('#user_birthday').val(user.birthday);
		if (user.age != '') {
			$('#user_age_frame').html('<br>' + user.age + ' years');
		} else {
			$('#user_age_frame').html('');
		}
		$('#user_nationality_code').val(user.nationality_code);
		$('#user_phone').val(user.phone);
		$('#user_email').val(user.email);
		$('#user_street').val(user.street);
		$('#user_house_number').val(user.house_number);
		$('#user_zip').val(user.zip);
		$('#user_town').val(user.town);
		$('#user_country_code').val(user.country_code);
		$('#user_status').val(user.status);
		document.getElementById("user_administrator").checked = user.administrator == true;
		$('#user_board_role').val(user.board_role);
		$('#user_image').val(user.image);
		$('#user_clear_image').val(0);
		$('#user_wjpf_email').val(user.wjpf_email);
		$('#user_passport_number').val(user.passport_number || '');
		document.getElementById('preview').src = user.image;
		$('#user_picture').val('');
		$('#editUserMsg').html('');
		$('#editUserModal').modal('show');
	}

	//to prevent from closing when clicking outside the modal
	$('#editUserModal').modal({
		backdrop: 'static',
		keyboard: true
	});

	$("#editUserModal").keyup(function (event) {
		if (event.keyCode === 13) {
			$("#saveUser").click();
		}
	});

	$(document).on("click", "#saveUser", function () {
		var $myForm = $('#formUserPage');
		if (!$myForm[0].checkValidity()) {
			$myForm[0].reportValidity();
			return;
		}
		var id = $('#user_id').val();
		var first_name = $('#user_first_name').val();
		var last_name = $('#user_last_name').val();
		var birthday = $('#user_birthday').val();
		var nationality_code = $('#user_nationality_code').val();
		var phone = $('#user_phone').val();
		var email = $('#user_email').val();
		var street = $('#user_street').val();
		var house_number = $('#user_house_number').val();
		var zip = $('#user_zip').val();
		var town = $('#user_town').val();
		var state_code = $('#user_state_code').val();
		var country_code = $('#user_country_code').val();
		var status = $('#user_status').val();
		var administrator = 0;
		if (document.getElementById("user_administrator").checked) {
			administrator = 1
		}
		var board_role = $('#user_board_role').val();
		var wjpf_email = $('#user_wjpf_email').val();
		var passport_number = $('#user_passport_number').val();
		var image = $('#user_image').val();
		var clear_image = $('#user_clear_image').val();
		var new_image = '';
		var image_name = $.trim( $('#user_picture').val());

		if (image_name != '')
			new_image = document.getElementById('preview').src;

		var data = {
			id: id,
			first_name: first_name,
			last_name: last_name,
			birthday: birthday,
			nationality_code: nationality_code,
			phone: phone,
			email: email,
			status: status,
			street: street,
			house_number: house_number,
			zip: zip,
			town: town,
			state_code: state_code,
			country_code: country_code,
			administrator: administrator,
			board_role: board_role,
			wjpf_email: wjpf_email,
			passport_number: passport_number,
			image_name: image_name,
			new_image: new_image,
			image: image,
			clear_image: clear_image,
			Action: 'Set'
		};
//		alert(JSON.stringify(data));
		$('#page_message').html('');
		ShowOverlay('Saving user...');
		$.ajax({
			type: 'POST',
			url: "set/set_user.php",
			data: data,
			async: true,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#editUserMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						user_table.ajax.reload(null, false);
						$('#page_message').html('<div class="alert alert-success">The user was saved</div>');
						$('#editUserModal').modal('hide');
					}
				} catch (err) {
					$('#editUserMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#editUserMsg').html('<div class="alert alert-danger">Error while saving the user</div>');
				HideOverlay();
			}
		});
	});

	$(document).on("change", "#user_picture", function () {
		const reader = new FileReader();
		const preview = document.getElementById('preview');
		reader.onload = () => {
			preview.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	});

	$(document).on("click", "#resetImage", function () {
		$('#user_picture').val('');
		document.getElementById('preview').src = $('#user_image').val();

	});

	$(document).on("click", "#clearImage", function () {
		$('#user_clear_image').val(1);
		$('#user_picture').val('');
		document.getElementById('preview').src = 'img/boss.png';
	});
});


