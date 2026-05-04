$(document).ready(function() {

	var association_table = $('#association_table').DataTable({
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
		"order": [[2, "asc"]],
		"columnDefs": [
			//zusätzliche Spalten ausblenden. Trotzdem kann nach ihnen gesucht werden
			{"targets": [9, 10, 11, 12, 13], "visible": false},
			{"targets": [0, 1, 8], "orderable": false},
			{responsivePriority: 1, targets: [0, 2, 8]},
			{responsivePriority: 2, targets: -1}
		],
		"ajax": {
			"url": "./datatable/get_association.php",
			"type": "GET",
			"data": function (d) {
				d.filter = document.getElementById("select_association_filter").value;
			}
		},
	});

	$(document).on('change', "#select_association_filter", function () {
		association_table.ajax.reload(null, true);
	});

	$('#deleteAssociationModal').on('show.bs.modal', function (association) {
		var button = $(association.relatedTarget); // Button that triggered the modal
		var id = button.data('id'); // Extract info from data-* attributes
		var name = button.data('name'); // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		$('#deleteMsg').html('Do you really want to delete  the association: <b>' + name + '</b>?');
		modal.find('#deleteid').val(id);
		$('#deleteAssociationMsg').html('');
	});

	//to prevent from closing when clicking outside the modal
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
						association_table.ajax.reload(null, false);
						$('#page_message').html('<div class="alert alert-success">The association was deleted.</div>');
						$('#deleteAssociationModal').modal('hide');
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


	$(document).on("click", "#newAssociation", function () {
		var association = {
			id: -1,
			type: 1,
			name: '',
			registration_number: '',
			foundation_date: '',
			tax_id: '',
			nationality_code: '',
			member_count: '',
			street: '',
			house_number: '',
			zip: '',
			town: '',
			country_code: '',
			website: '',
			email: '',
			phone: '',
			begin_of_membership: '',
			end_of_membership: '',
			image: '',
			preview: '',
			comment: '',
			member: 0
		};
		edit_association(association);
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
//		alert(JSON.stringify(data));
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
//		alert(JSON.stringify(association));

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

	//to prevent from closing when clicking outside the modal
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
			member = 1
		}
		var image = $('#association_image').val();
		var clear_image = $('#association_clear_image').val();
		var new_image = '';
		var image_name = $.trim( $('#association_picture').val());

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
//		alert(JSON.stringify(data));
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
					} else {
						association_table.ajax.reload(null, false);
						$('#page_message').html('<div class="alert alert-success">The association was saved</div>');
						$('#editAssociationModal').modal('hide');
					}
				} catch (err) {
					$('#editAssociationMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
				}
				HideOverlay();
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
});


