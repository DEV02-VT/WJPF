<?php
chdir('..');
include_once("includes/init.php");
include_once("includes/functions_news.php");

$action  = decode(filter_input(INPUT_POST, "Action"));

$retdata = array();
$retdata['error'] = '';

if ($action == '') {
    $retdata['error'] = 'Invalid parameter: action';
    echo json_encode($retdata);
    return;
}

switch ($action) {
    case 'Get':
        break;
    default:
        if (!user_is_admin() and !user_is_board_user()) {
            $retdata['error'] = "Unknown user!";
            echo json_encode($retdata);
            return;
        }
}

switch ($action) {
    case 'Get':
        $id = decode(filter_input(INPUT_POST, "id"));
        if ($id == '') {
            $retdata['error'] = 'Invalid parameter: id';
            echo json_encode($retdata);
            return;
        }
        $retdata['news'] = get_news($id);
        break;

    case 'Set':
        $news = array();
        $news['title'] = decode(filter_input(INPUT_POST, "title"));
        if ($news['title'] == '') {
            $retdata['error'] = 'Invalid parameter: title';
            echo json_encode($retdata);
            return;
        }
        $news['content']   = filter_input(INPUT_POST, "content") ?? '';
        $news['news_date'] = decode(filter_input(INPUT_POST, "news_date"));
        $news['status']    = decode(filter_input(INPUT_POST, "status"));
        $news['author_id'] = decode(filter_input(INPUT_POST, "author_id"));
        $news['id']        = decode(filter_input(INPUT_POST, "id"));
        if ($news['id'] > 0) {
            update_news($news);
        } else {
            create_news($news);
        }
        break;

    case 'Delete':
        $deleteid = decode(filter_input(INPUT_POST, "deleteid"));
        if ($deleteid == '') {
            $retdata['error'] = "Invalid delete id!";
            echo json_encode($retdata);
            return;
        }
        delete_news($deleteid);
        break;

    default:
        $retdata['error'] = 'Unknown action: ' . $action;
        break;
}

echo json_encode($retdata);
