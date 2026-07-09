<?php
include_once("includes/header.php");
?>
<?php
include_once("includes/nav_base.php");
?>

<div class="bgimg_3 parallax">
	<div class="caption">
		<div class="row justify-content-center">
			<div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-center">
				<span class="capital">Members</span>
			</div>
		</div>
	</div>
</div>
<div class="text-block" id="members">

    <div class="board-user-grid">
        <?php
            display_federation_associations();
        ?>
    </div>

	<div class="row text-center mt-5">
		<h3>Your country is not represented here and you have a not-for-profit JPA? You can download our <a target="_blank" href="documents/IJPA Official Membership Application Form.pdf">Membership Application Form</a> to become a member.</h3>
	</div>
</div>


<?php
include_once("includes/footer.php");
?>

