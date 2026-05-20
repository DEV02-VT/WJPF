<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");

CheckBoardUserOrAdmin();
$current_user_id = get_login_user_id();
?>

<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
        <h1>News</h1>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 justify-content-center text-center" id="page_message">
            <?php display_message(); ?>
        </div>
    </div>
</div>

<div class="full_container">
    <button type="button" id="newNews" class="btn btn-dark mb-3">Create new news</button>
    <table id="news_table" class="table desktop_table">
        <thead>
            <th>Status</th>
            <th>Title</th>
            <th>Date</th>
            <th>Updated</th>
            <th></th>
        </thead>
    </table>
</div>

<div class="modal fade" id="editNewsModal" role="dialog" aria-labelledby="editNewsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">News</h5>
                <button type="button" class="close btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="editNewsMsg"></div>
                <form id="formNewsPage" method="post" role="form">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="news_title">Title *</label>
                            <input type="text" name="news_title" id="news_title" class="form-control" maxlength="255" required>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="news_content">Content</label>
                            <textarea name="news_content" id="news_content" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label for="news_date">Date</label>
                            <input type="date" name="news_date" id="news_date" class="form-control">
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label for="news_status">Status *</label>
                            <?php create_news_status_select('news_status', 'form-select', GLB_NEWS_STATUS_DRAFT, true); ?>
                        </div>
                    </div>
                    <input type="hidden" id="news_id" value="">
                    <input type="hidden" id="news_author_id" value="<?= $current_user_id ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveNews" class="btn btn-dark">Save</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteNewsModal" role="dialog" aria-labelledby="deleteNewsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete News</h5>
                <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="deleteNewsMsg"></div>
                <div id="deleteMsg" class="alert alert-warning"></div>
                <input type="hidden" id="deleteid">
            </div>
            <div class="modal-footer">
                <button type="button" id="deleteNews" class="btn btn-dark">Yes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php") ?>
<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/admin_news.js"></script>
