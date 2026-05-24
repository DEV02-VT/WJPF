$(document).ready(function() {

	$('#deleteAssociationModal').on('show.bs.modal', function (association) {
		var button = $(association.relatedTarget);
		var id = button.data('id');
		var name = button.data('name');
		var modal = $(this);
		$('#deleteMsg').html('Do you really want to delete  the association: <b>' + name + '</b>?');
		modal.find('#deleteid').val(id);
		$('#deleteAssociationMsg').html('');
	});

	$('#deleteAssociationModal').modal({
		backdrop: 'static',
		keyboard: true
	});

	$("#deleteAssociationModal").keyup(function (event) {
		if (event.keyCode === 13) {
			$("#deleteAssociation").click();
		}
	});

	$(document).on("click", "#deleteAssociation", function () {
		var deleteid = document.getElementById("deleteid").value;
		var data = {
			deleteid: deleteid,
			Action: 'Delete'
		};
		$('#page_message').html('');
		ShowOverlay('Deleting association...');
		$.ajax({
			type: 'POST',
			url: "set/set_association.php",
			data: data,
			async: true,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#deleteAssociationMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						$('#deleteAssociationModal').modal('hide');
						window.location.href = 'admin_association.php';
					}
				} catch (err) {
					$('#deleteAssociationMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#deleteAssociationMsg').html('<div class="alert alert-danger">Error while deleting the association</div>');
				HideOverlay();
			}
		});
	});

	$(document).on("click", ".edit_association", function () {
		var id = $(this).attr("data-id");
		load_association(id);
	});

	function load_association(id) {
		var data = {
			id: id,
			Action: "Get"
		};
		$('#page_message').html('');
		ShowOverlay('Loading association...');
		$.ajax({
			type: 'POST',
			url: "set/set_association.php",
			data: data,
			async: true,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						edit_association(obj['association']);
					}
				} catch (err) {
					$('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#page_message').html('<div class="alert alert-danger">Error while loading the association</div>');
				HideOverlay();
			}
		});
	}

	function edit_association(association) {
		$('#association_id').val(association.id);
		$('#association_type').val(association.type);
		$('#association_name').val(association.name);
		$('#association_registration_number').val(association.registration_number);
		$('#association_foundation_date').val(association.foundation_date);
		$('#association_tax_id').val(association.tax_id);
		$('#association_nationality_code').val(association.nationality_code);
		$('#association_member_count').val(association.member_count);
		$('#association_street').val(association.street);
		$('#association_house_number').val(association.house_number);
		$('#association_zip').val(association.zip);
		$('#association_town').val(association.town);
		$('#association_country_code').val(association.country_code);
		$('#association_email').val(association.email);
		$('#association_phone').val(association.phone);
		$('#association_begin_of_membership').val(association.begin_of_membership);
		$('#association_end_of_membership').val(association.end_of_membership);
		$('#association_website').val(association.website);
		$('#association_comment').val(association.comment);
		document.getElementById("association_member").checked = association.member == true;
		$('#association_image').val(association.image);
		$('#association_clear_image').val(0);
		document.getElementById('preview').src = association.image;
		$('#association_picture').val('');
		$('#editAssociationMsg').html('');
		$('#editAssociationModal').modal('show');
	}

	$('#editAssociationModal').modal({
		backdrop: 'static',
		keyboard: true
	});

	$("#editAssociationModal").keyup(function (event) {
		if (event.keyCode === 13) {
			$("#saveAssociation").click();
		}
	});

	$(document).on("click", "#saveAssociation", function () {
		var $myForm = $('#formAssociationPage');
		if (!$myForm[0].checkValidity()) {
			$myForm[0].reportValidity();
			return;
		}

		var id = $('#association_id').val();
		var type = $('#association_type').val();
		var name = $('#association_name').val();
		var registration_number = $('#association_registration_number').val();
		var foundation_date = $('#association_foundation_date').val();
		var tax_id = $('#association_tax_id').val();
		var nationality_code = $('#association_nationality_code').val();
		var member_count = $('#association_member_count').val();
		var street = $('#association_street').val();
		var house_number = $('#association_house_number').val();
		var zip = $('#association_zip').val();
		var town = $('#association_town').val();
		var state_code = $('#association_state_code').val();
		var country_code = $('#association_country_code').val();
		var website = $('#association_website').val();
		var email = $('#association_email').val();
		var phone = $('#association_phone').val();
		var begin_of_membership = $('#association_begin_of_membership').val();
		var end_of_membership = $('#association_end_of_membership').val();
		var comment = $('#association_comment').val();
		var member = 0;
		if (document.getElementById("association_member").checked) {
			member = 1;
		}
		var image = $('#association_image').val();
		var clear_image = $('#association_clear_image').val();
		var new_image = '';
		var image_name = $.trim($('#association_picture').val());

		if (image_name != '')
			new_image = document.getElementById('preview').src;

		var data = {
			id: id,
			type: type,
			name: name,
			registration_number: registration_number,
			foundation_date: foundation_date,
			tax_id: tax_id,
			nationality_code: nationality_code,
			member_count: member_count,
			street: street,
			house_number: house_number,
			zip: zip,
			town: town,
			state_code: state_code,
			country_code: country_code,
			website: website,
			email: email,
			phone: phone,
			begin_of_membership: begin_of_membership,
			end_of_membership: end_of_membership,
			comment: comment,
			member: member,
			image_name: image_name,
			new_image: new_image,
			image: image,
			clear_image: clear_image,
			Action: 'Set'
		};
		$('#page_message').html('');
		ShowOverlay('Saving association...');
		$.ajax({
			type: 'POST',
			url: "set/set_association.php",
			data: data,
			async: true,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#editAssociationMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
						HideOverlay();
					} else {
						$('#editAssociationModal').modal('hide');
						window.location.reload();
					}
				} catch (err) {
					$('#editAssociationMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
					HideOverlay();
				}
			},
			error: function () {
				$('#editAssociationMsg').html('<div class="alert alert-danger">Error while saving the association</div>');
				HideOverlay();
			}
		});
	});

	$(document).on("change", "#association_picture", function () {
		const reader = new FileReader();
		const preview = document.getElementById('preview');
		reader.onload = () => {
			preview.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	});

	$(document).on("click", "#resetImage", function () {
		$('#association_picture').val('');
		document.getElementById('preview').src = $('#association_image').val();
	});

	$(document).on("click", "#clearImage", function () {
		$('#association_clear_image').val(1);
		$('#association_picture').val('');
		document.getElementById('preview').src = 'img/boss.png';
	});

	// ── Association Admin Management ────────────────────────────

	$(document).on("click", "#addAdministrator", function () {
		$('#find_email').val('');
		$('#find_first_name').val('');
		$('#find_last_name').val('');
		$('#findUserMsg').html('');
		$('#findUserModal').modal('show');
	});

	$('#findUserModal').modal({ backdrop: 'static', keyboard: true });

	$(document).on("click", "#searchUser", function () {
		var $form = $('#formFindUser');
		if (!$form[0].checkValidity()) { $form[0].reportValidity(); return; }

		var email      = $('#find_email').val();
		var first_name = $('#find_first_name').val();
		var last_name  = $('#find_last_name').val();

		ShowOverlay('Searching...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_admin.php',
			data: { email: email, Action: 'FindUser' },
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#findUserMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						$('#findUserModal').modal('hide');
						if (obj['found']) {
							fill_admin_modal(obj['user'], -1, true);
						} else {
							fill_admin_modal({ id: -1, first_name: first_name, last_name: last_name, email: email,
								phone: '', birthday: '', nationality_code: '', street: '', house_number: '',
								zip: '', town: '', country_code: '', status: 3, image: '' }, -1, false);
						}
					}
				} catch (err) {
					$('#findUserMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#findUserMsg').html('<div class="alert alert-danger">Error while searching for user</div>');
				HideOverlay();
			}
		});
	});

	function fill_admin_modal(user, admin_id, existing) {
		$('#admin_id').val(admin_id);
		$('#admin_user_id').val(user.user_id !== undefined ? user.user_id : user.id);
		$('#admin_association_id').val($('#current_association_id').val());
		$('#admin_first_name').val(user.first_name);
		$('#admin_last_name').val(user.last_name);
		$('#admin_email').val(user.email);
		$('#admin_phone').val(user.phone);
		$('#admin_birthday').val(user.birthday);
		$('#admin_nationality_code').val(user.nationality_code);
		$('#admin_status').val(user.status || 3);
		$('#admin_street').val(user.street);
		$('#admin_house_number').val(user.house_number);
		$('#admin_zip').val(user.zip);
		$('#admin_town').val(user.town);
		$('#admin_country_code').val(user.country_code);
		$('#admin_image').val(user.image);
		$('#admin_clear_image').val(0);
		$('#admin_passport_number').val(user.passport_number || '');
		$('#admin_role').val(user.role || '');
		document.getElementById('admin_contact_person').checked = user.contact_person == true || user.contact_person == 1;
		document.getElementById('admin_preview').src = user.image || 'img/boss.png';
		$('#admin_picture').val('');
		$('#editAdminMsg').html('');
		if (existing) {
			$('#existingUserHint').removeClass('d-none');
		} else {
			$('#existingUserHint').addClass('d-none');
		}
		$('#editAssociationAdminModal').modal('show');
	}

	$(document).on("click", ".edit_admin", function () {
		var id = $(this).attr('data-id');
		ShowOverlay('Loading...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_admin.php',
			data: { id: id, Action: 'Get' },
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						fill_admin_modal(obj['admin'], obj['admin'].id, true);
					}
				} catch (err) {
					$('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#page_message').html('<div class="alert alert-danger">Error while loading administrator</div>');
				HideOverlay();
			}
		});
	});

	$('#editAssociationAdminModal').modal({ backdrop: 'static', keyboard: true });

	$(document).on("click", "#saveAdmin", function () {
		var $form = $('#formAdminPage');
		if (!$form[0].checkValidity()) { $form[0].reportValidity(); return; }

		var image_name = $.trim($('#admin_picture').val());
		var new_image  = image_name != '' ? document.getElementById('admin_preview').src : '';

		var data = {
			Action:          'Set',
			admin_id:        $('#admin_id').val(),
			association_id:  $('#admin_association_id').val(),
			user_id:         $('#admin_user_id').val(),
			first_name:      $('#admin_first_name').val(),
			last_name:       $('#admin_last_name').val(),
			email:           $('#admin_email').val(),
			phone:           $('#admin_phone').val(),
			birthday:        $('#admin_birthday').val(),
			nationality_code:$('#admin_nationality_code').val(),
			status:          $('#admin_status').val(),
			street:          $('#admin_street').val(),
			house_number:    $('#admin_house_number').val(),
			zip:             $('#admin_zip').val(),
			town:            $('#admin_town').val(),
			country_code:    $('#admin_country_code').val(),
			passport_number: $('#admin_passport_number').val(),
			image:           $('#admin_image').val(),
			clear_image:     $('#admin_clear_image').val(),
			new_image:       new_image,
			image_name:      image_name,
			role:            $('#admin_role').val(),
			contact_person:  document.getElementById('admin_contact_person').checked ? 1 : 0
		};

		$('#page_message').html('');
		ShowOverlay('Saving...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_admin.php',
			data: data,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#editAdminMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
						HideOverlay();
					} else {
						$('#editAssociationAdminModal').modal('hide');
						window.location.reload();
					}
				} catch (err) {
					$('#editAdminMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
					HideOverlay();
				}
			},
			error: function () {
				$('#editAdminMsg').html('<div class="alert alert-danger">Error while saving administrator</div>');
				HideOverlay();
			}
		});
	});

	$('#deleteAssociationAdminModal').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget);
		var id   = button.data('id');
		var name = button.data('name');
		$('#deleteAdminConfirmMsg').html('Do you really want to remove <b>' + name + '</b> from this association?');
		$('#delete_admin_id').val(id);
		$('#deleteAdminMsg').html('');
	});

	$('#deleteAssociationAdminModal').modal({ backdrop: 'static', keyboard: true });

	$(document).on("click", "#deleteAdmin", function () {
		var id = $('#delete_admin_id').val();
		ShowOverlay('Removing...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_admin.php',
			data: { id: id, Action: 'Delete' },
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#deleteAdminMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						$('#deleteAssociationAdminModal').modal('hide');
						window.location.reload();
					}
				} catch (err) {
					$('#deleteAdminMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#deleteAdminMsg').html('<div class="alert alert-danger">Error while removing administrator</div>');
				HideOverlay();
			}
		});
	});

	$(document).on("change", "#admin_picture", function () {
		const reader = new FileReader();
		reader.onload = () => { document.getElementById('admin_preview').src = reader.result; };
		reader.readAsDataURL(event.target.files[0]);
	});

	$(document).on("click", "#adminResetImage", function () {
		$('#admin_picture').val('');
		document.getElementById('admin_preview').src = $('#admin_image').val() || 'img/boss.png';
	});

	$(document).on("click", "#adminClearImage", function () {
		$('#admin_clear_image').val(1);
		$('#admin_picture').val('');
		document.getElementById('admin_preview').src = 'img/boss.png';
	});

	// ── Association Link Management ─────────────────────────────

	$(document).on("click", "#addLink", function () {
		$('#link_id').val(-1);
		$('#link_association_id').val($('#current_association_id').val());
		$('#link_type').val('');
		$('#link_url').val('');
		$('#editLinkMsg').html('');
		$('#editLinkModal').modal('show');
	});

	$('#editLinkModal').modal({ backdrop: 'static', keyboard: true });

	$(document).on("click", ".edit_link", function () {
		var id = $(this).attr('data-id');
		ShowOverlay('Loading...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_link.php',
			data: { id: id, Action: 'Get' },
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						var link = obj['link'];
						$('#link_id').val(link.id);
						$('#link_association_id').val(link.association_id);
						$('#link_type').val(link.link_type);
						$('#link_url').val(link.url);
						$('#editLinkMsg').html('');
						$('#editLinkModal').modal('show');
					}
				} catch (err) {
					$('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#page_message').html('<div class="alert alert-danger">Error while loading link</div>');
				HideOverlay();
			}
		});
	});

	$(document).on("click", "#saveLink", function () {
		var $form = $('#formLinkPage');
		if (!$form[0].checkValidity()) { $form[0].reportValidity(); return; }

		var data = {
			Action:         'Set',
			id:             $('#link_id').val(),
			association_id: $('#link_association_id').val(),
			link_type:      $('#link_type').val(),
			url:            $('#link_url').val()
		};

		$('#page_message').html('');
		ShowOverlay('Saving...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_link.php',
			data: data,
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#editLinkMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
						HideOverlay();
					} else {
						$('#editLinkModal').modal('hide');
						window.location.reload();
					}
				} catch (err) {
					$('#editLinkMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
					HideOverlay();
				}
			},
			error: function () {
				$('#editLinkMsg').html('<div class="alert alert-danger">Error while saving link</div>');
				HideOverlay();
			}
		});
	});

	$('#deleteLinkModal').on('show.bs.modal', function (e) {
		var button = $(e.relatedTarget);
		$('#delete_link_id').val(button.data('id'));
		$('#deleteLinkConfirmMsg').html('Do you really want to delete the link: <b>' + button.data('url') + '</b>?');
		$('#deleteLinkMsg').html('');
	});

	$('#deleteLinkModal').modal({ backdrop: 'static', keyboard: true });

	$(document).on("click", "#deleteLink", function () {
		var id = $('#delete_link_id').val();
		ShowOverlay('Deleting...');
		$.ajax({
			type: 'POST',
			url: 'set/set_association_link.php',
			data: { id: id, Action: 'Delete' },
			success: function (retdata) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '') {
						$('#deleteLinkMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					} else {
						$('#deleteLinkModal').modal('hide');
						window.location.reload();
					}
				} catch (err) {
					$('#deleteLinkMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error: function () {
				$('#deleteLinkMsg').html('<div class="alert alert-danger">Error while deleting link</div>');
				HideOverlay();
			}
		});
	});

});
