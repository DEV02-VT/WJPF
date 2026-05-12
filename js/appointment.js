$(document).ready(function() {

	var appointment_table = $('#appointment_table').DataTable( {
        "iDisplayLength" : 25,
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Alle"]],
        "bPaginate" : true,
        "bStateSave" : true,
        "sPaginationType" : "full_numbers",
        "serverSide": true,
        "responsive": true,
        "autoWidth": false,
		"order": [[0, "desc"]],
		"columnDefs": [
		  {
			"targets": [1, 2, 3, 4, 5, 6],
			"orderable": false
		  },
			{ responsivePriority: 1, targets: [3,6]},		
			{ responsivePriority: 2, targets: -1 }
		],
//		"scrollX": true,
		"buttons": [
        ],
        "dom": 'Bfrtilp',
		"ajax": {
            "url" : "./datatable/get_appointment.php",
            "type": "GET",
            "data" : function(d) {
            }
        },
	} );

	$('#deleteAppointmentModal').on('show.bs.modal', function (appointment) {
        var button = $(appointment.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var name = button.data('name'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        $('#deleteMsg').html('Dou you want to delete the appointment: <br><br><b>' + name + '</b>?');
        modal.find('#deleteid').val(id);
		$('#deleteAppointmentMsg').html('');		
    });

	//to prevent from closing when clicking outside the modal
	$('#deleteAppointmentModal').modal({
	  backdrop: 'static',
	  keyboard: true
	});
	
	$("#deleteAppointmentModal").keyup(function(event) {
		if (event.keyCode === 13) {
			$("#deleteAppointment").click();
		}
	});
	$(document).on("click", "#deleteAppointment", function() {
		var deleteid = document.getElementById("deleteid").value;
		var data = {
		   deleteid : deleteid,
		   Action: 'Delete'
		};
		$('#page_message').html('');
		ShowOverlay('Delete appointment...');
		$.ajax({
			type: 'POST',
			url: "set/set_appointment.php",
			data: data,
			async: true,
			success : function( retdata ) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '')
					{
						$('#deleteAppointmentMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					}
					else
					{
						appointment_table.ajax.reload( null, false);
						$('#page_message').html('<div class="alert alert-success">The appointment was deleted</div>');
						$('#deleteAppointmentModal').modal('hide');
					}
				}
				catch(err)
				{
					$('#deleteAppointmentMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error : function() {
				$('#deleteAppointmentMsg').html('<div class="alert alert-danger">Error deleting appointment</div>');
				HideOverlay();
			}
		});   
	});


	$(document).on("click", "#newAppointment", function() {
		var appointment = {
			id : -1,
			headline : '',
			link : '',
			place : '',
			begin : '',
			end : '',
			author_id: document.getElementById("user_id").value,
			type : 1,
			street : '',
			house_number : '',
			zip : '',
			town : '',
			country_code : '',
			latitude : '',
			longitude : ''
        };
		edit_appointment(appointment);
	});
	
	$(document).on("click", ".edit_appointment", function() {
			var id =  $(this).attr("data-id");
			load_appointment(id); 
	});

	function load_appointment(id)
	{	 
        var data = {
			id : id,
			Action : "Get"
        };
//		alert(JSON.stringify(data));
		$('#page_message').html('');
		ShowOverlay('Loading appointemnt...');
        $.ajax({
            type: 'POST',
            url: "set/set_appointment.php",
            data: data,
            async: true,
            success : function( retdata ) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '')
					{
						$('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					}
					else
					{
						edit_appointment(obj['appointment']);	
					}
				}
				catch(err)
				{
					$('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error : function() {
				$('#page_message').html('<div class="alert alert-danger">Error while loading appointment</div>');
				HideOverlay();
			}
        });   
	}
	
	function edit_appointment(appointment)
	{
		$('#appointment-id').val(appointment.id);
		$('#appointment-headline').val(appointment.headline);
		$('#appointment-link').val(appointment.link);
		$('#appointment-place').val(appointment.place);
		$('#appointment-begin').val(appointment.begin);
		$('#appointment-end').val(appointment.end);
		$('#appointment-author_id').val(appointment.author_id);
		$('#appointment-type').val(appointment.type);
		$('#appointment-street').val(appointment.street);
		$('#appointment-house_number').val(appointment.house_number);
		$('#appointment-zip').val(appointment.zip);
		$('#appointment-town').val(appointment.town);
		$('#appointment-country_code').val(appointment.country_code);
		$('#appointment-latitude').val(appointment.latitude);
		$('#appointment-longitude').val(appointment.longitude);

		$('#editAppointmentMsg').html('');
 	    $('#editAppointmentModal').modal('show');
	}
	//to prevent from closing when clicking outside the modal
	$('#editAppointmentModal').modal({
	  backdrop: 'static',
	  keyboard: true
	});
	
	$("#editAppointmentModal").keyup(function(event) {
		if (event.keyCode === 13) {
			$("#saveAppointment").click();
		}
	});

	$(document).on("click", "#saveAppointment", function() {
		var $myForm = $('#formAppointmentPage');
		if (!$myForm[0].checkValidity()) {
			$myForm[0].reportValidity();
			return;
		}
		var id = $('#appointment-id').val();
		var headline = $('#appointment-headline').val().trim();
		var link = $('#appointment-link').val().trim();
		var place = $('#appointment-place').val().trim();
		var begin = $('#appointment-begin').val();
		var end = $('#appointment-end').val();
		var author_id = $('#appointment-author_id').val();
		var type = $('#appointment-type').val();
		var street = $('#appointment-street').val();
		var house_number = $('#appointment-house_number').val();
		var zip = $('#appointment-zip').val();
		var town = $('#appointment-town').val();
		var country_code = $('#appointment-country_code').val();
		var latitude = $('#appointment-latitude').val();
		var longitude = $('#appointment-longitude').val();

		var data = {
		   	id : id,
		   	headline : headline,
		   	link : link,
		   	place : place,
		   	begin : begin,
		   	end : end,
		   	author_id : author_id,
			type :type,
			street : street,
			house_number : house_number,
			zip : zip,
			town : town,
			country_code : country_code,
			latitude : latitude,
			longitude : longitude,
		   	Action: 'Set'
		};
//		alert(JSON.stringify(data));
		$('#page_message').html('');
		ShowOverlay('Saving appointemnt...');
		$.ajax({
			type: 'POST',
			url: "set/set_appointment.php",
			data: data,
			async: true,
			success : function( retdata ) {
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '')
					{
						$('#editAppointmentMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					}
					else
					{
						appointment_table.ajax.reload( null, false);
						$('#page_message').html('<div class="alert alert-success">The appointment was saved</div>');
						$('#editAppointmentModal').modal('hide');
					}
				}
				catch(err)
				{
					$('#editAppointmentMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
				}
				HideOverlay();
			},
			error : function() {
				$('#editAppointmentMsg').html('<div class="alert alert-danger">Error while saving the appointment</div>');
				HideOverlay();
			}
		});   
	});



	$(document).on('change', "#appointment-street", function (){
		check_address_coordinates();
	});

	$(document).on('change', "#appointment-house_number", function (){
		check_address_coordinates();
	});
	$(document).on('change', "#appointment-zip", function (){
		check_address_coordinates();
	});

	$(document).on('change', "#appointment-town", function (){
		check_address_coordinates();
	});

	$(document).on('change', "#appointment-country_code", function (){
		check_address_coordinates();
	});

	function check_address_coordinates()
	{
		var street = $('#appointment-street').val();
		var house_number = $('#appointment-house_number').val();
		var postalcode = $('#appointment-zip').val();
		var city = $('#appointment-town').val();
		var country = $('#appointment-country_code option:selected').text();
		var country_code = $('#appointment-country_code').val();

		var data = {
			street : street + ' ' + house_number,
			postalcode : postalcode,
			city : city,
			country : country_code,
			format: 'json'
		};
//		alert(JSON.stringify(data));
		$('#editAppointmentMsg').html('');
		$.ajax({
			type: 'GET',
			url: "https://nominatim.openstreetmap.org/search",
			data: data,
			async: true,
			success : function( retdata ) {

				try {
//					alert(JSON.stringify(retdata[0]));
					if (retdata.length > 0)
					{
						$('#appointment-latitude').val(retdata[0].lat);
						$('#appointment-longitude').val(retdata[0].lon);
					}
				}
				catch(err)
				{
					$('#editAppointmentMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
				}
			},
			error : function() {
				$('#editAppointmentMsg').html('<div class="alert alert-danger">Error while loading the coordinates</div>');
			}
		});
	}

} );


