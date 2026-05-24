<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");
include_once("includes/functions_association_admin.php");

CheckBoardUserOrAdmin();

$id = intval(filter_input(INPUT_GET, 'id'));
$association = get_association($id);

if (empty($association)) {
    header('Location: admin_association.php');
    exit;
}

global $glb_association_type;
$type_label = $glb_association_type[$association['type']] ?? '';

$admins = get_association_admins($id);
$contact_person = null;
foreach ($admins as $a) {
    if ($a['contact_person']) { $contact_person = $a; break; }
}
?>

<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
        <h1>Association</h1>
    </div>
</div>

<div class="container mt-4 mb-5">

    <div class="row justify-content-center">
        <div class="col-8 justify-content-center text-center" id="page_message"></div>
    </div>

    <!-- Header: Logo, Name, Flag -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-12 col-md-2 text-center mb-3 mb-md-0">
                    <?php if ($association['image'] != ''): ?>
                        <img src="<?php echo $association['image']; ?>" class="img-fluid" style="max-height:120px;">
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-10">
                    <h2 class="mb-1"><?php echo htmlspecialchars($association['name']); ?></h2>
                    <div class="d-flex align-items-center gap-3 flex-wrap mt-2">
                        <img class="country_flag" src="img/flags/<?php echo $association['nationality_code']; ?>.png" title="<?php echo htmlspecialchars($association['country']); ?>">
                        <span><?php echo htmlspecialchars($association['country']); ?></span>
                        <span class="text-muted">|</span>
                        <span><?php echo htmlspecialchars($type_label); ?></span>
                        <span class="text-muted">|</span>
                        <?php if ($association['member']): ?>
                            <img class="table_img" src="img/yes.png" title="Federation member"> Federation member
                        <?php else: ?>
                            <img class="table_img" src="img/minus.png" title="No federation member"> No federation member
                        <?php endif; ?>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-dark edit_association" data-id="<?php echo $association['id']; ?>">Edit association</button>
                        <?php if (user_is_admin()): ?>
                        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteAssociationModal" data-id="<?php echo $association['id']; ?>" data-name="<?php echo htmlspecialchars($association['name']); ?>">Delete association</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Contact -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header"><strong>Contact</strong></div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">
                            <?php if ($association['email'] != ''): ?>
                                <a href="mailto:<?php echo htmlspecialchars($association['email']); ?>"><?php echo htmlspecialchars($association['email']); ?></a>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </dd>
                        <dt class="col-sm-4">Phone</dt>
                        <dd class="col-sm-8"><?php echo $association['phone'] != '' ? htmlspecialchars($association['phone']) : '<span class="text-muted">—</span>'; ?></dd>
                        <dt class="col-sm-4">Website</dt>
                        <dd class="col-sm-8">
                            <?php if ($association['website'] != ''): ?>
                                <a href="<?php echo htmlspecialchars($association['website']); ?>" target="_blank"><?php echo htmlspecialchars($association['website']); ?></a>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header"><strong>Address</strong></div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Street</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($association['street'] . ' ' . $association['house_number']); ?></dd>
                        <dt class="col-sm-4">ZIP / Town</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($association['zip'] . ' ' . $association['town']); ?></dd>
                        <dt class="col-sm-4">Country</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars(get_country_name($association['country_code'], get_language())); ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Organisation -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header"><strong>Organisation</strong></div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Registration Nr.</dt>
                        <dd class="col-sm-7"><?php echo $association['registration_number'] != '' ? htmlspecialchars($association['registration_number']) : '<span class="text-muted">—</span>'; ?></dd>
                        <dt class="col-sm-5">Foundation date</dt>
                        <dd class="col-sm-7"><?php echo $association['foundation_date'] != '' && $association['foundation_date'] != '0000-00-00' ? htmlspecialchars($association['foundation_date']) : '<span class="text-muted">—</span>'; ?></dd>
                        <dt class="col-sm-5">Tax ID</dt>
                        <dd class="col-sm-7"><?php echo $association['tax_id'] != '' ? htmlspecialchars($association['tax_id']) : '<span class="text-muted">—</span>'; ?></dd>
                        <dt class="col-sm-5">Member count</dt>
                        <dd class="col-sm-7"><?php echo intval($association['member_count']); ?></dd>
                        <dt class="col-sm-5">Nationality</dt>
                        <dd class="col-sm-7">
                            <img class="country_flag" src="img/flags/<?php echo $association['nationality_code']; ?>.png" title="<?php echo htmlspecialchars($association['nationality_code']); ?>">
                            <?php echo htmlspecialchars($association['nationality_code']); ?>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Membership -->
        <div class="col-12 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header"><strong>Membership</strong></div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Federation member</dt>
                        <dd class="col-sm-7">
                            <?php if ($association['member']): ?>
                                <img class="table_img" src="img/yes.png" title="Yes">
                            <?php else: ?>
                                <img class="table_img" src="img/minus.png" title="No">
                            <?php endif; ?>
                        </dd>
                        <dt class="col-sm-5">Begin</dt>
                        <dd class="col-sm-7"><?php echo $association['begin_of_membership'] != '' && $association['begin_of_membership'] != '0000-00-00' ? htmlspecialchars($association['begin_of_membership']) : '<span class="text-muted">—</span>'; ?></dd>
                        <dt class="col-sm-5">End</dt>
                        <dd class="col-sm-7"><?php echo $association['end_of_membership'] != '' && $association['end_of_membership'] != '0000-00-00' ? htmlspecialchars($association['end_of_membership']) : '<span class="text-muted">—</span>'; ?></dd>
                        <dt class="col-sm-5">Comment</dt>
                        <dd class="col-sm-7"><?php echo $association['comment'] != '' ? nl2br(htmlspecialchars($association['comment'])) : '<span class="text-muted">—</span>'; ?></dd>
                    </dl>
                </div>
            </div>
        </div>

    </div><!-- /row -->

    <!-- Contact Person -->
    <div class="card mb-4">
        <div class="card-header"><strong>Contact Person</strong></div>
        <div class="card-body">
        <?php if ($contact_person): ?>
            <div class="row align-items-start">
                <div class="col-12 col-md-2 text-center mb-3 mb-md-0">
                    <img src="<?php echo htmlspecialchars($contact_person['image']); ?>" class="img-fluid rounded" style="max-height:100px;">
                    <?php if ($contact_person['nationality_code'] != ''): ?>
                    <div class="mt-2">
                        <img class="country_flag" src="img/flags/<?php echo $contact_person['nationality_code']; ?>.png"
                             title="<?php echo htmlspecialchars(get_country_name($contact_person['nationality_code'], get_language())); ?>">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">Name</dt>
                                <dd class="col-sm-8"><strong><?php echo htmlspecialchars($contact_person['first_name'] . ' ' . $contact_person['last_name']); ?></strong></dd>
                                <dt class="col-sm-4">Role</dt>
                                <dd class="col-sm-8"><?php echo $contact_person['role'] != '' ? htmlspecialchars($contact_person['role']) : '<span class="text-muted">—</span>'; ?></dd>
                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">
                                    <?php if ($contact_person['email'] != ''): ?>
                                        <a href="mailto:<?php echo htmlspecialchars($contact_person['email']); ?>"><?php echo htmlspecialchars($contact_person['email']); ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </dd>
                                <dt class="col-sm-4">Phone</dt>
                                <dd class="col-sm-8"><?php echo $contact_person['phone'] != '' ? htmlspecialchars($contact_person['phone']) : '<span class="text-muted">—</span>'; ?></dd>
                                <dt class="col-sm-4">Birthday</dt>
                                <dd class="col-sm-8"><?php echo $contact_person['birthday'] != '' && $contact_person['birthday'] != '0000-00-00' ? htmlspecialchars($contact_person['birthday']) : '<span class="text-muted">—</span>'; ?></dd>
                                <dt class="col-sm-4">Passport Nr.</dt>
                                <dd class="col-sm-8"><?php echo $contact_person['passport_number'] != '' ? htmlspecialchars($contact_person['passport_number']) : '<span class="text-muted">—</span>'; ?></dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">Street</dt>
                                <dd class="col-sm-8"><?php echo htmlspecialchars(trim($contact_person['street'] . ' ' . $contact_person['house_number'])); ?></dd>
                                <dt class="col-sm-4">ZIP / Town</dt>
                                <dd class="col-sm-8"><?php echo htmlspecialchars(trim($contact_person['zip'] . ' ' . $contact_person['town'])); ?></dd>
                                <dt class="col-sm-4">Country</dt>
                                <dd class="col-sm-8"><?php echo $contact_person['country_code'] != '' ? htmlspecialchars(get_country_name($contact_person['country_code'], get_language())) : '<span class="text-muted">—</span>'; ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted mb-0">No contact person assigned. Set the <em>Contact person</em> flag on one of the administrators.</p>
        <?php endif; ?>
        </div>
    </div>

    <!-- Administrators -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Administrators</strong>
            <button type="button" class="btn btn-dark btn-sm" id="addAdministrator">Add administrator</button>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Contact person</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($admins as $admin):
                ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($admin['image']); ?>" class="table_button" style="max-height:32px;"></td>
                    <td><?php echo htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                    <td><?php echo htmlspecialchars($admin['role']); ?></td>
                    <td>
                        <?php if ($admin['contact_person']): ?>
                            <img class="table_img" src="img/yes.png" title="Contact person">
                        <?php else: ?>
                            <img class="table_img" src="img/minus.png" title="">
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="display:flex">
                            <img class="table_button edit_admin" src="img/edit.png" data-id="<?php echo $admin['id']; ?>" title="Edit">
                            <img class="table_button delete_admin" src="img/trash.png"
                                 data-bs-toggle="modal" data-bs-target="#deleteAssociationAdminModal"
                                 data-id="<?php echo $admin['id']; ?>"
                                 data-name="<?php echo htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']); ?>"
                                 title="Remove from association">
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" id="current_association_id" value="<?php echo $id; ?>">

    <div class="mt-2">
        <a href="admin_association.php" class="btn btn-dark">Back to associations</a>
    </div>

</div>

<!-- Find User Modal (Step 1 for Add Administrator) -->
<div class="modal fade" id="findUserModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Administrator</h5>
                <button type="button" class="close btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="findUserMsg"></div>
                <p class="text-muted">Enter the email address. If the user already exists, their data will be used.</p>
                <form id="formFindUser" autocomplete="on">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="find_email">Email *</label>
                            <input type="email" id="find_email" class="form-control" maxlength="70" required autofocus>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="find_first_name">First name *</label>
                            <input type="text" id="find_first_name" class="form-control" maxlength="70" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="find_last_name">Last name *</label>
                            <input type="text" id="find_last_name" class="form-control" maxlength="70" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="searchUser" class="btn btn-dark">Continue</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Association Admin Modal -->
<div class="modal fade" id="editAssociationAdminModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Administrator</h5>
                <button type="button" class="close btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="editAdminMsg"></div>
                <div id="existingUserHint" class="alert alert-info d-none">
                    Existing user — personal data can be updated.
                </div>
                <form id="formAdminPage" method="post" role="form" autocomplete="on">
                    <div class="row justify-content-left">
                        <div class="col-12 block-titel">Personal Data</div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="admin_first_name">First name *</label>
                                    <input type="text" id="admin_first_name" name="admin_first_name" class="form-control" maxlength="70" required>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="admin_last_name">Last name *</label>
                                    <input type="text" id="admin_last_name" name="admin_last_name" class="form-control" maxlength="70" required>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="admin_birthday">Birthday</label>
                                    <input type="date" id="admin_birthday" name="admin_birthday" class="form-control" max="<?= date('Y-m-d'); ?>">
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="admin_nationality_code">Nationality *</label>
                                    <?php create_country_select('admin_nationality_code', 'form-select', true); ?>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="admin_passport_number">Passport number</label>
                                    <input type="text" id="admin_passport_number" name="admin_passport_number" class="form-control" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row justify-content-center">
                                <div class="col-8 text-center">
                                    <img id="admin_preview" class="preview_image"/>
                                </div>
                                <div class="col-4 text-center">
                                    <button type="button" id="adminResetImage" class="btn btn-dark preview_image_btn">Reset</button><br>
                                    <button type="button" id="adminClearImage" class="btn btn-dark mt-2 preview_image_btn">Clear</button>
                                    <input type="text" readonly class="form-control invisible" hidden id="admin_image">
                                    <input type="number" readonly class="form-control invisible" hidden id="admin_clear_image">
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="file" id="admin_picture" name="admin_picture[]" accept="image/*"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-3">
                            <label for="admin_email">Email *</label>
                            <input type="email" id="admin_email" name="admin_email" class="form-control" maxlength="70" required>
                        </div>
                        <div class="col-12 col-lg-4 mb-3">
                            <label for="admin_phone">Phone</label>
                            <input type="phone" id="admin_phone" name="admin_phone" class="form-control" maxlength="40">
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <label for="admin_status">Status *</label>
                            <?php create_user_status_select('admin_status', 'form-select', GLB_USER_STATUS_ACTIVE, true); ?>
                        </div>
                        <div class="col-12 block-titel">Address</div>
                        <div class="col-9 col-lg-4 mb-2">
                            <label for="admin_street">Street</label>
                            <input type="text" id="admin_street" name="admin_street" class="form-control" maxlength="100">
                        </div>
                        <div class="col-3 col-lg-2 mb-2">
                            <label for="admin_house_number">Number</label>
                            <input type="text" id="admin_house_number" name="admin_house_number" class="form-control" maxlength="20">
                        </div>
                        <div class="col-3 col-lg-2 mb-2">
                            <label for="admin_zip">ZIP</label>
                            <input type="text" id="admin_zip" name="admin_zip" class="form-control" maxlength="10">
                        </div>
                        <div class="col-9 col-lg-4 mb-2">
                            <label for="admin_town">Town</label>
                            <input type="text" id="admin_town" name="admin_town" class="form-control" maxlength="100">
                        </div>
                        <div class="col-12 col-lg-4 mb-2">
                            <label for="admin_country_code">Country</label>
                            <?php create_country_select('admin_country_code', 'form-select', false); ?>
                        </div>
                        <div class="col-12 block-titel">Association Role</div>
                        <div class="col-12 col-lg-8 mb-3">
                            <label for="admin_role">Role in association</label>
                            <input type="text" id="admin_role" name="admin_role" class="form-control" maxlength="255">
                        </div>
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-1 mt-3 mb-3 justify-content-center text-center largercheckbox">
                                    <input type="checkbox" id="admin_contact_person" name="admin_contact_person">
                                </div>
                                <div class="col-10 mt-3 mb-3">
                                    <label for="admin_contact_person">Contact person</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" readonly class="form-control invisible" hidden id="admin_id">
                    <input type="text" readonly class="form-control invisible" hidden id="admin_user_id">
                    <input type="text" readonly class="form-control invisible" hidden id="admin_association_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveAdmin" class="btn btn-dark">Save</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Association Admin Modal -->
<div class="modal fade" id="deleteAssociationAdminModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove administrator</h5>
                <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="deleteAdminMsg"></div>
                <div id="deleteAdminConfirmMsg" class="alert alert-warning"></div>
                <input type="text" readonly class="form-control invisible" hidden id="delete_admin_id">
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteAdmin" class="btn btn-dark">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
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

<?php include_once("includes/footer.php"); ?>
<script src="js/admin_association_detail.js"></script>
