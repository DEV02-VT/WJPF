<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");

CheckBoardAdminOrAssociationAdmin();
$lang = get_language();
?>
   
<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
      <h1>Association</h1>
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
					<label for="select_association_filter">Filter: </label>
					<?php  echo create_association_filter_select('select_association_filter', 'form-select', '', false); ?>
				</div>
			</div>
		</div>
	</div>
</div>

 <div class="full_container">
     <?php if (user_is_admin() || user_is_board_user()){ ?>
     <button type="button" name="newAssociation" id="newAssociation" class="btn btn-dark mt-3 mb-3">Create new association</button>
     <button type="button" name="showMemberMaillist" id="showMemberMaillist" class="btn btn-dark mt-3 mb-3">Show member mail list</button>
     <button type="button" name="showNonMemberMaillist" id="showNonMemberMaillist" class="btn btn-dark mt-3 mb-3">Show non member mail list</button>
     <button type="button" name="showAllAssociationslist" id="showAllAssociationslist" class="btn btn-dark mt-3 mb-3">Show all associations mail list</button>
     <?php } ?>
    <table id="association_table" class="table desktop_table">
    <thead>
        <th></th>
        <th></th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Website</th>
        <th>Member</th>
        <th></th>
    </thead>
    </table>
</div>

<div class="modal fade" id="editAssociationModal" role="dialog" aria-labelledby="editAssociationModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Association: </h5>
          <h5><b class="modal-title" id="association_number"></b></h5>
          <button type="button" class="close btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">X</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">  
              <div id="editAssociationMsg"></div>
            </div>
           <div>
				<form id="formAssociationPage" method="post" role="form" autocomplete="on">
					<div class="row justify-content-left">
						<div class="col-12 block-titel">Personal Data</div>
                            <div class="col-6">
                                <div class="row justify-content-left">
                                    <div class="col-12 col-md-6 col-lg-6 mb-2" id="association_type_frame">
                                        <label for="association_type">Type *</label>
                                        <?php create_association_type_select('association_type', 'form-select', 1, true); ?>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mb-2" id="association_nationality_code_frame">
                                        <label for="association_nationality_code">Country *</label>
                                        <?php create_country_select('association_nationality_code', 'form-select', true); ?>
                                    </div>
						            <div class="col-12 mb-2" id="association_name_frame">
                                        <label for="association_name">Name *</label>
                                        <input type="text" name="association_name" id="association_name" class="form-control" maxlength="70" required  autofocus>
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
                                        <input type="text" readonly class="form-control invisible" hidden id="association_image">
                                        <input type="number" readonly class="form-control invisible" hidden id="association_clear_image">
                                    </div>
                                    <div class="col-6 mt-2">
                                        <input type="file" id="association_picture" name="association_picture[]" accept="image/*"/>
                                    </div>
                                </div>
                            </div>
						<div class="col-12 col-lg-4 mb-3" id="association_email_frame">
							<label for="association_email">Email</label>
							<input type="email" name="association_email" id="association_email" class="form-control" maxlength="70">
						</div>
                        <div class="col-12 col-lg-4 mb-3" id="association_phone_frame">
                            <label for="association_phone">Phone</label>
                            <input type="phone" name="association_phone" id="association_phone" class="form-control" maxlength="40" >
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="association_registration_number_frame">
                            <label for="association_registration_number">Registration number</label>
                            <input type="text" name="association_registration_number" id="association_registration_number" class="form-control" maxlength="40" >
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="association_foundation_date_frame">
                            <label for="association_foundation_date">Foundation date</label>
                            <input type="date" name="association_foundation_date" id="association_foundation_date" class="form-control">
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="association_tax_id_frame">
                            <label for="association_tax_id">Tax id</label>
                            <input type="text" name="association_tax_id" id="association_tax_id" class="form-control" maxlength="40" >
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="association_member_count_frame">
                            <label for="association_member_count">Member count</label>
                            <input type="number" name="association_member_count" id="association_member_count" class="form-control" min="0" >
                        </div>
						<div class="col-12 block-titel">Address</div>
						<div class="col-9 col-lg-4 mb-2" id="association_street_frame">
							<label for="association_street">Street</label>
							<input type="text" name="association_street" id="association_street" class="form-control" maxlength="100" >
						</div>
						<div class="col-3 col-lg-2 mb-2" id="association_house_number_frame">
							<label for="association_house_number">Number</label>
							<input type="text" name="association_house_number" id="association_house_number" class="form-control" maxlength="20">
						</div>
						<div class="col-3 col-lg-2 mb-2" id="association_zip_frame">
							<label for="association_zip">ZIP</label>
							<input type="text" name="association_zip" id="association_zip" class="form-control" maxlength="10">
						</div>
						<div class="col-9 col-lg-4 mb-2" id="association_town_frame">
							<label for="association_town">Town</label>
							<input type="text" name="association_town" id="association_town" class="form-control" maxlength="100">
						</div>
						<div class="col-12 col-lg-4 mb-2" id="association_country_code_frame">
							<label for="association_country_code">Land</label>
							<?php create_country_select('association_country_code', 'form-select', false); ?>
						</div>
                        <div class="col-9 col-lg-4 mb-2" id="association_website_frame">
                            <label for="association_website">Website</label>
                            <input type="url" name="association_website" id="association_website" class="form-control" maxlength="255">
                        </div>
                        <div class="col-12 block-titel">Positions in federation</div>
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-1 mt-3 mb-3 justify-content-center text-center largercheckbox">
                                    <input type="checkbox" id="association_member" name="association_member">
                                </div>
                                <div class="col-10 mt-3  mb-3"><label for="association_member">Federation member</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="association_begin_of_membership_frame">
                            <label for="association_begin_of_membership">Begin of Membership</label>
                            <input type="date" name="association_begin_of_membership" id="association_begin_of_membership" class="form-control">
                        </div>
                        <div class="col-12 col-lg-4 mb-3" id="association_end_of_membership_frame">
                            <label for="association_end_of_membership">End of Membership</label>
                            <input type="date" name="association_end_of_membership" id="association_end_of_membership" class="form-control">
                        </div>
                        <div class="col-12 mb-3" id="association_comment_frame">
                            <label for="association_comment">Comment</label>
                            <textarea class="form-control" name="association_comment" id="association_comment" rows="3"></textarea>
                        </div>
					</div>
					<input type="text" readonly class="form-control invisible" hidden id="association_id">
				</form>
			</div>
		</div>
        <div class="modal-footer">
          <button type="button" name="saveAssociation" id="saveAssociation" class="btn btn-dark">Save</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="deleteAssociationModal" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-small" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete association</h5>
          <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="container">  
             <div id="deleteAssociationMsg"></div>
           </div>
          <form id="modal-details" method="post" role="form" >
              <div id="deleteMsg" class="alert alert-warning"></div>
              <input type="text" readonly class="form-control invisible" id="deleteid">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" name="deleteAssociation" id="deleteAssociation" form="modal-details" class="btn btn-dark">Yes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="maillistMemberModal" role="dialog" aria-labelledby="maillistMemberModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Member Association E-Mails</h5>
                <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="maillistMemberMsg"></div>
                </div>
                <div >
                    <textarea class="form-control" name="member-maillist" id="member-maillist" rows="15" readonly ><?php echo get_member_associations_emails();?></textarea>
                </div><br>
            </div>
            <div class="modal-footer">
                <a href="mailto:board@internationalpuzzle.org?bcc=<?php echo get_member_associations_emails();?>"><button type="button" form="modal-details" class="btn btn-dark">Open Bcc Email</button></a>
                <button type="button" name="copyMemberMaillist" id="copyMemberMaillist" form="modal-details" class="btn btn-dark">Copy to clipboard</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="maillistNonMemberModal" role="dialog" aria-labelledby="maillistNonMemberModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Non member Association E-Mails</h5>
                <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="nonMaillistMemberMsg"></div>
                </div>
                <div >
                    <textarea class="form-control" name="non-member-maillist" id="non-member-maillist" rows="15" readonly ><?php echo get_non_member_associations_emails();?></textarea>
                </div><br>
            </div>
            <div class="modal-footer">
                <a href="mailto:board@internationalpuzzle.org?bcc=<?php echo get_non_member_associations_emails();?>"><button type="button" form="modal-details" class="btn btn-dark">Open Bcc Email</button></a>
                <button type="button" name="copyNonMemberMaillist" id="copyNonMemberMaillist" form="modal-details" class="btn btn-dark">Copy to clipboard</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="maillistAllAssociationsModal" role="dialog" aria-labelledby="maillistAllAssociationsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">All Association E-Mails</h5>
                <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="allAssociationsMsg"></div>
                </div>
                <div >
                    <textarea class="form-control" name="all-associations-maillist" id="all-associations-maillist" rows="15" readonly ><?php echo get_all_associations_emails();?></textarea>
                </div><br>
            </div>
            <div class="modal-footer">
                <a href="mailto:board@internationalpuzzle.org?bcc=<?php echo get_all_associations_emails();?>"><button type="button" form="modal-details" class="btn btn-dark">Open Bcc Email</button></a>
                <button type="button" name="copyAllAssociationsMaillist" id="copyAllAssociationsMaillist" form="modal-details" class="btn btn-dark">Copy to clipboard</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<?php include_once("includes/footer.php") ?>	
<script src="js/admin_association.js"></script>