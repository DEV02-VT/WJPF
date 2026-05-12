<?php
include_once("includes/header.php");
?>
<?php
include_once("includes/nav_base.php");
?>

<div class="bgimg_2 parallax">
    <div class="caption">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-center">
                <span class="capital">Board</span>
            </div>
        </div>
    </div>
</div>

<div class="text-block"  id="board">
    <div class="row justify-content-center text-center">
        <div class="col-11 col-sm-9  col-md-7">
            <p>The WJPF is managed by a board of 9 people who were elected at the General Assembly by the representatives of each member association. You can contact each member of the board directly or via the central E-Mail <a href="mailto:board@wjpf.org">board@wjpf.org</img></a></p>
        </div>
    </div>

    <div class="board-user-grid">
        <?php
            display_board_users();
        ?>

    </div>
</div>


<?php
include_once("includes/footer.php");
?>

