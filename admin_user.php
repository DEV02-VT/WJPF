<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");

CheckBoardUserOrAdmin();	
$lang = get_language();
?>
   
<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
      <h1>User</h1>
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


	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="row justify-content-center">
				<div class="col-4 col-lg-3 mb-3">
					<label for="select_user_status">Status: </label>
					<?php  echo create_user_status_select('select_user_status', 'form-select', '', false); ?>
				</div>
                <div class="col-4 col-lg-3 mt-3 mb-3">
                    <div class="row">
                        <div class="col-1 mt-3 mb-3 justify-content-center text-center largercheckbox">
                            <input type="checkbox" id="show_only_board_users" name="show_only_board_users">
                        </div>
                        <div class="col-10 mt-3  mb-3"><label for="show_only_board_users">show only board users</label><br>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

 <div class="full_container">
    <table id="user_table" class="table desktop_table">
    <thead>
        <th></th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Birthday</th>
        <th>Board role</th>
        <th></th>
    </thead>
    </table>
	<button type="button" name="newUser" id="newUser" class="btn btn-dark mb-3">Create new user</button>
</div>

<div class="modal fade" id="editUserModal" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User: </h5>
          <h5><b class="modal-title" id="user_number"></b></h5>
          <button type="button" class="close btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">X</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">  
              <div id="editUserMsg"></div>
            </div>
           <div>  
				<form id="formUserPage" method="post" role="form" autocomplete="on">
					<div class="row justify-content-left">
						<div class="col-12 block-titel">Personal Data</div>
                            <div class="col-6">
                                <div class="row justify-content-left">
						            <div class="col-12 col-lg-6 mb-2" id="user_first_name_frame">
                                        <label for="user_first_name">First name *</label>
                                        <input type="text" name="user_first_name" id="user_first_name" class="form-control" maxlength="70" required  autofocus>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-2" id="user_last_name_frame">
                                        <label for="user_last_name">Last name *</label>
                                        <input type="text" name="user_last_name" id="user_last_name" class="form-control" maxlength="70" required >
                                    </div>
                                    <div class="col-12  col-md-4 col-lg-4 mb-2" id="user_birthday_frame">
                                        <label for="user_birthday">Birthday</label>
                                        <input type="date" name="user_birthday" id="user_birthday" class="form-control" max="<?= date('Y-m-d'); ?>"  >
                                    </div>
                                    <div class="col-12  col-md-2 mb-2" id="user_age_frame">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mb-2" id="user_nationality_code_frame">
                                        <label for="user_nationality_code">Nationality *</label>
                                        <?php create_country_select('user_nationality_code', 'form-select', true); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row justify-content-center">
                                    <div class="col-8  text-center">
                                        <img id="preview" class="preview_image"/>
                                    </div>
                                    <div class="col-4 text-center">
                                        <button type="button" name="reset_image" id="resetImage" class="btn btn-dark preview_image_btn">Reset</button><br>
                                        <button type="button" name="empty_image" id="clearImage" class="btn btn-dark mt-2 preview_image_btn">Clear</button>
                                        <input type="text" readonly class="form-control invisible" hidden id="user_image">
                                        <input type="number" readonly class="form-control invisible" hidden id="user_clear_image">
                                    </div>
                                    <div class="col-6 mt-2">
                                        <input type="file" id="user_picture" name="user_picture[]" accept="image/*"/>
                                    </div>
                                </div>
                            </div>
						<div class="col-12 col-lg-4 mb-3" id="user_phone_frame">
							<label for="user_phone">Phone</label>
							<input type="phone" name="user_phone" id="user_phone" class="form-control" maxlength="40" >
						</div>
						<div class="col-12 col-lg-4 mb-3" id="user_email_frame">
							<label for="user_email">Email*</label>
							<input type="email" name="user_email" id="user_email" class="form-control" maxlength="70" required>
						</div>
                        <div class="col-12 col-lg-4 mb-2" id="user_status_frame">
                            <label for="user_status">Status *</label>
                            <?php create_user_status_select('user_status', 'form-select', 3, true); ?>
                        </div>
						<div class="col-12 block-titel">Address</div>
						<div class="col-9 col-lg-4 mb-2" id="user_street_frame">
							<label for="user_street">Street</label>
							<input type="text" name="user_street" id="user_street" class="form-control" maxlength="100" >
						</div>
						<div class="col-3 col-lg-2 mb-2" id="user_house_number_frame">
							<label for="user_house_number">Number</label>
							<input type="text" name="user_house_number" id="user_house_number" class="form-control" maxlength="20">
						</div>
						<div class="col-3 col-lg-2 mb-2" id="user_zip_frame">
							<label for="user_zip">ZIP</label>
							<input type="text" name="user_zip" id="user_zip" class="form-control" maxlength="10">
						</div>
						<div class="col-9 col-lg-4 mb-2" id="user_town_frame">
							<label for="user_town">Town</label>
							<input type="text" name="user_town" id="user_town" class="form-control" maxlength="100">
						</div>
						<div class="col-12 col-lg-4 mb-2" id="user_country_code_frame">
							<label for="user_country_code">Land</label>
							<?php create_country_select('user_country_code', 'form-select', false); ?>
						</div>
                        <div class="col-12 block-titel">Positions in federation</div>
                        <div class="col-12 col-lg-4 mb-2" id="user_board_role_frame">
                            <label for="user_board_role">Board role *</label>
                            <?php create_user_board_role_select('user_board_role', 'form-select', 1, true); ?>
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="user_wjpf_email_frame">
                            <label for="user_wjpf_email">WJPF Email</label>
                            <input type="email" name="user_wjpf_email" id="user_wjpf_email" class="form-control" maxlength="70">
                        </div>
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-1 mt-3 mb-3 justify-content-center text-center largercheckbox">
                                    <input type="checkbox" id="user_administrator" name="user_administrator">
                                </div>
                                <div class="col-10 mt-3  mb-3"><label for="user_administrator">Admin</label><br>
                                </div>
                            </div>
                        </div>
					</div>
					<input type="text" readonly class="form-control invisible" hidden id="user_id">
				</form>
			</div>
		</div>
        <div class="modal-footer">
          <button type="button" name="saveUser" id="saveUser" class="btn btn-dark">Save</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-small" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="container">  
             <div id="deleteUserMsg"></div>
           </div>
          <form id="modal-details" method="post" role="form" >
              <div id="deleteMsg" class="alert alert-warning"></div>
              <input type="text" readonly class="form-control invisible" id="deleteid">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" name="deleteUser" id="deleteUser" form="modal-details" class="btn btn-dark">Yes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
</div>


<?php include_once("includes/footer.php") ?>	
<script src="js/admin_user.js"></script>