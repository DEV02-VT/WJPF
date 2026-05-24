<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");

CheckBoardUserOrAdmin();

$id = intval(filter_input(INPUT_GET, 'id'));
$association = get_association($id);

if (empty($association)) {
    header('Location: admin_association.php');
    exit;
}

global $glb_association_type;
$type_label = $glb_association_type[$association['type']] ?? '';
?>

<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
        <h1>Association</h1>
    </div>
</div>

<div class="container mt-4 mb-5">

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

    <div class="mt-2">
        <a href="admin_association.php" class="btn btn-dark">Back to associations</a>
    </div>

</div>

<?php include_once("includes/footer.php"); ?>
