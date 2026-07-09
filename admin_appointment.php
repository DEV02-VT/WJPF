<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");
include_once("includes/functions_appointment.php");
include_once("includes/functions_association_admin.php");

CheckBoardAdminOrAssociationAdmin();
$lang = get_language();
?>
   
<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
      <h1>Appointments</h1>
    </div>
</div>
   
 <div class="container">
	<div class="row  justify-content-center">
		<div class="col-8 justify-content-center text-center" id="page_message">
		<?php 
			display_message();
		?>
		</div>
	</div>
	</div>
<input type="text" readonly class="invisible" hidden id="user_id" value="<?php echo get_login_user_id(); ?>">
</div>

 <div class="full_container">
     <button type="button" name="newAppointment" id="newAppointment" class="btn btn-dark mt-3 mb-3">Create new appointment</button>
     <table id="appointment_table" class="table desktop_table">
         <thead>
         <th>Start</th>
         <th>End</th>
         <th>Author</th>
         <th>Association</th>
         <th>Titel</th>
         <th>Link</th>
         <th>Place</th>
         <th></th>
         </thead>
     </table>
 </div>
</div>

<div class="modal fade" id="editAppointmentModal" role="dialog" aria-labelledby="editAppointmentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit appointment</h5>
                <button type="button" class="close btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="editAppointmentMsg"></div>
                </div>
                <div>
                    <form id="formAppointmentPage" method="post" role="form" autocomplete="on">
                        <div class="row justify-content-left">
                            <div class="col-12 col-lg-4 mb-2" id="appointment-type-frame">
                                <label for="appointment-type">Type</label>
                                <?php create_appointment_type_select('appointment-type', 'form-select', 1, true); ?>
                            </div>
                            <div class="col-12 col-lg-8 mb-2" id="appointment-association-frame">
                                <label for="appointment-association_id">Association *</label>
                                <?php create_association_select('appointment-association_id', 'form-select', get_appointment_associations_for_current_user(), '', true); ?>
                            </div>
                            <div class="col-12 col-md-4 mb-3" id="appointment-begin-frame">
                                <label for="appointment-begin">Start *</label>
                                <input type="date" name="appointment-begin" id="appointment-begin" class="form-control" required  autofocus>
                            </div>
                            <div class="col-12 col-md-4 mb-3" id="appointment-end-frame">
                                <label for="appointment-end">End (optional)</label>
                                <input type="date" name="appointment-end" id="appointment-end" class="form-control" >
                            </div>
                            <div class="col-12 mb-3" id="appointment-headline-frame">
                                <label for="appointment-headline">Titel *</label>
                                <input type="text" name="appointment-headline" id="appointment-headline" class="form-control" maxlength="255" required>
                            </div>
                            <div class="col-12  mb-3" id="appointment-link-frame">
                                <label for="appointment-link" class="form-label">Link</label>
                                <input type="url" name="appointment-link" id="appointment-link" class="form-control" >
                            </div>
                            <div class="col-12 mb-3" id="appointment-place-frame">
                                <label for="appointment-place">Place</label>
                                <input type="text" name="appointment-place" id="appointment-place" class="form-control" maxlength="255" >
                            </div>
                            <div class="col-12 block-titel">Address</div>
                            <div class="col-9 col-lg-4 mb-2" id="appointment-street_frame">
                                <label for="appointment-street">Street</label>
                                <input type="text" name="appointment-street" id="appointment-street" class="form-control" maxlength="100">
                            </div>
                            <div class="col-3 col-lg-2 mb-2" id="appointment-house_number-frame">
                                <label for="appointment-house_number">Number</label>
                                <input type="text" name="appointment-house_number" id="appointment-house_number" class="form-control" maxlength="20">
                            </div>
                            <div class="col-3 col-lg-2 mb-2" id="appointment-zip-frame">
                                <label for="appointment-zip">ZIP</label>
                                <input type="text" name="appointment-zip" id="appointment-zip" class="form-control" maxlength="10">
                            </div>
                            <div class="col-9 col-lg-4 mb-2" id="appointment-town-frame">
                                <label for="appointment-town">Town</label>
                                <input type="text" name="appointment-town" id="appointment-town" class="form-control" maxlength="100">
                            </div>
                            <div class="col-12 col-lg-6 mb-2" id="appointment-country-code-frame">
                                <label for="appointment-country_code">Country</label>
                                <?php create_country_select('appointment-country_code', 'form-select', true); ?>
                            </div>
                            <div class="col-12 col-lg-3 mb-2" id="appointment-latitude_frame">
                                <label for="appointment-latitude">Latitude</label>
                                <input type="text" name="appointment-latitude" id="appointment-latitude" class="form-control" maxlength="30" disabled>
                            </div>
                            <div class="col-12 col-lg-3 mb-2" id=appointment-longitude_frame">
                                <label for="appointment-longitude">Longitude</label>
                                <input type="text" name="appointment-longitude" id="appointment-longitude" class="form-control" maxlength="30" disabled>
                            </div>

                        </div>
                        <input type="text" readonly class="form-control invisible" hidden id="appointment-id">
                        <input type="text" readonly class="form-control invisible" hidden id="appointment-author_id">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="saveAppointment" id="saveAppointment" class="btn btn-dark">Save</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAppointmentModal" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete appointment</h5>
                <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="deleteAppointmentMsg"></div>
                </div>
                <form id="modal-details" method="post" role="form" >
                    <div id="deleteMsg" class="alert alert-warning"></div>
                    <input type="text" readonly class="form-control invisible" id="deleteid">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" name="deleteAppointment" id="deleteAppointment" form="modal-details" class="btn btn-dark">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>


<?php include_once("includes/footer.php") ?>
<script src="js/appointment.js"></script>
