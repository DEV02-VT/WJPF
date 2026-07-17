// Bootstrap's modal focus trap steals focus from TinyMCE dialogs (e.g. the
// link dialog), making their inputs untypable. Let focus events targeting
// TinyMCE UI pass before Bootstrap's focusin handler sees them.
document.addEventListener('focusin', function (e) {
    if (e.target.closest('.tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root') !== null) {
        e.stopImmediatePropagation();
    }
});

$(document).ready(function () {

    var pendingContent = '';

    $('#editNewsModal').on('shown.bs.modal', function () {
        tinymce.init({
            selector: '#news_content',
            plugins: 'lists link code advlist autolink image charmap preview anchor searchreplace visualblocks fullscreen' +
                ' insertdatetime media table help wordcount emoticons',
            toolbar: 'undo redo | bold italic underline | bullist numlist checklist | link | code| removeformat | a11ycheck code table help emoticons',
            link_default_target: '_blank',
            height: 320,
            menubar: false,
            emoticons_database: 'emojiimages',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(pendingContent);
                });
            }
        });

    });

    $('#editNewsModal').on('hidden.bs.modal', function () {
        tinymce.remove('#news_content');
    });

    var news_table = $('#news_table').DataTable({
        "iDisplayLength": 25,
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "bPaginate": true,
        "bStateSave": true,
        "sPaginationType": "full_numbers",
        "serverSide": true,
        "responsive": true,
        "autoWidth": false,
        "dom": 'Bfrtilp',
        "buttons": [
            {"extend": "excelHtml5", "exportOptions": {"columns": ":visible"}},
            {"extend": "csvHtml5", "bom": true, "fieldSeparator": ";", "exportOptions": {"columns": ":visible"}}
        ],
        "order": [[2, "desc"]],
        "columnDefs": [
            {"targets": [4], "orderable": false},
            {responsivePriority: 1, targets: [1, 4]},
            {responsivePriority: 2, targets: [0]}
        ],
        "ajax": {
            "url": "./datatable/get_news.php",
            "type": "GET"
        }
    });

    $('#deleteNewsModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var title = button.data('title');
        $('#deleteMsg').html('Do you really want to delete the news: <b>' + title + '</b>?');
        $('#deleteid').val(id);
        $('#deleteNewsMsg').html('');
    });

    $('#deleteNewsModal').modal({backdrop: 'static', keyboard: true});

    $("#deleteNewsModal").keyup(function (event) {
        if (event.keyCode === 13) {
            $("#deleteNews").click();
        }
    });

    $(document).on("click", "#deleteNews", function () {
        var deleteid = $('#deleteid').val();
        var data = {deleteid: deleteid, Action: 'Delete'};
        $('#page_message').html('');
        ShowOverlay('Deleting...');
        $.ajax({
            type: 'POST',
            url: "set/set_news.php",
            data: data,
            success: function (retdata) {
                try {
                    var obj = JSON.parse(retdata);
                    if (obj['error'] !== '') {
                        $('#deleteNewsMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
                    } else {
                        news_table.ajax.reload(null, false);
                        $('#page_message').html('<div class="alert alert-success">The news entry was deleted.</div>');
                        $('#deleteNewsModal').modal('hide');
                    }
                } catch (err) {
                    $('#deleteNewsMsg').html('<div class="alert alert-danger">' + retdata + '</div>');
                }
                HideOverlay();
            },
            error: function () {
                $('#deleteNewsMsg').html('<div class="alert alert-danger">Error while deleting</div>');
                HideOverlay();
            }
        });
    });

    $(document).on("click", "#newNews", function () {
        var today = new Date().toISOString().split('T')[0];
        edit_news({id: -1, title: '', content: '', news_date: today, status: 1, author_id: $('#news_author_id').val()});
    });

    $(document).on("click", ".edit_news", function () {
        var id = $(this).attr("data-id");
        load_news(id);
    });

    function load_news(id) {
        var data = {id: id, Action: "Get"};
        $('#page_message').html('');
        ShowOverlay('Loading...');
        $.ajax({
            type: 'POST',
            url: "set/set_news.php",
            data: data,
            success: function (retdata) {
                try {
                    var obj = JSON.parse(retdata);
                    if (obj['error'] !== '') {
                        $('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
                    } else {
                        edit_news(obj['news']);
                    }
                } catch (err) {
                    $('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
                }
                HideOverlay();
            },
            error: function () {
                $('#page_message').html('<div class="alert alert-danger">Error while loading</div>');
                HideOverlay();
            }
        });
    }

    function edit_news(news) {
        $('#news_id').val(news.id);
        $('#news_title').val(news.title);
        pendingContent = news.content || '';
        $('#news_date').val(news.news_date);
        $('#news_status').val(news.status);
        $('#news_author_id').val(news.author_id);
        $('#editNewsMsg').html('');
        $('#editNewsModal').modal('show');
    }

    $('#editNewsModal').modal({backdrop: 'static', keyboard: true});

    $("#editNewsModal").keyup(function (event) {
        if (event.keyCode === 13 && event.target.tagName !== 'TEXTAREA') {
            $("#saveNews").click();
        }
    });

    $(document).on("click", "#saveNews", function () {
        var $myForm = $('#formNewsPage');
        if (!$myForm[0].checkValidity()) {
            $myForm[0].reportValidity();
            return;
        }
        var data = {
            id:        $('#news_id').val(),
            title:     $('#news_title').val(),
            content:   tinymce.get('news_content') ? tinymce.get('news_content').getContent() : $('#news_content').val(),
            news_date: $('#news_date').val(),
            status:    $('#news_status').val(),
            author_id: $('#news_author_id').val(),
            Action:    'Set'
        };
        $('#page_message').html('');
        ShowOverlay('Saving...');
        $.ajax({
            type: 'POST',
            url: "set/set_news.php",
            data: data,
            success: function (retdata) {
                try {
                    var obj = JSON.parse(retdata);
                    if (obj['error'] !== '') {
                        $('#editNewsMsg').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
                    } else {
                        news_table.ajax.reload(null, false);
                        $('#page_message').html('<div class="alert alert-success">News saved.</div>');
                        $('#editNewsModal').modal('hide');
                    }
                } catch (err) {
                    $('#editNewsMsg').html('<div class="alert alert-danger">' + err + retdata + '</div>');
                }
                HideOverlay();
            },
            error: function () {
                $('#editNewsMsg').html('<div class="alert alert-danger">Error while saving</div>');
                HideOverlay();
            }
        });
    });
});
