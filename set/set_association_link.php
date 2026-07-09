<?php
chdir('..');
include_once("includes/init.php");

$action = decode(filter_input(INPUT_POST, "Action"));

$retdata = array();
$retdata['error'] = '';

if ($action == '') {
    $retdata['error'] = 'Invalid parameter action';
    echo json_encode($retdata);
    return;
}

if (!user_is_admin() && !user_is_board_user() && !user_is_association_admin()) {
    $retdata['error'] = 'No rights!';
    echo json_encode($retdata);
    return;
}

switch ($action) {

    case 'Get':
        $id = decode(filter_input(INPUT_POST, "id"));
        if ($id == '') {
            $retdata['error'] = 'Invalid parameter: id';
            echo json_encode($retdata);
            return;
        }
        $link = get_association_link($id);
        if (empty($link) || !user_can_edit_association($link['association_id'])) {
            $retdata['error'] = 'No rights!';
            echo json_encode($retdata);
            return;
        }
        $retdata['link'] = $link;
        break;

    case 'Set':
        $error = get_link_input_data($data);
        if ($error != '') {
            $retdata['error'] = $error;
            echo json_encode($retdata);
            return;
        }
        // Association admins may only manage links of their own associations.
        if (!user_can_edit_association($data['association_id'])) {
            $retdata['error'] = 'No rights!';
            echo json_encode($retdata);
            return;
        }
        if ($data['id'] == -1) {
            create_association_link($data);
        } else {
            $existing_link = get_association_link($data['id']);
            if (empty($existing_link) || !user_can_edit_association($existing_link['association_id'])) {
                $retdata['error'] = 'No rights!';
                echo json_encode($retdata);
                return;
            }
            update_association_link($data);
        }
        break;

    case 'Delete':
        $id = decode(filter_input(INPUT_POST, "id"));
        if ($id == '') {
            $retdata['error'] = 'Invalid parameter: id';
            echo json_encode($retdata);
            return;
        }
        $link = get_association_link($id);
        if (empty($link) || !user_can_edit_association($link['association_id'])) {
            $retdata['error'] = 'No rights!';
            echo json_encode($retdata);
            return;
        }
        delete_association_link($id);
        break;

    default:
        $retdata['error'] = 'Unknown action: ' . $action;
        break;
}

echo json_encode($retdata);


function get_link_input_data(&$data)
{
    $data = array();
    $data['id']             = decode(filter_input(INPUT_POST, "id"));
    $data['association_id'] = decode(filter_input(INPUT_POST, "association_id"));
    $data['link_type']      = decode(filter_input(INPUT_POST, "link_type"));
    $data['url']            = decode(filter_input(INPUT_POST, "url"));

    if ($data['association_id'] == '') return 'Invalid parameter: association_id';
    if ($data['link_type']      == '') return 'Invalid parameter: link_type';
    if ($data['url']            == '') return 'Invalid parameter: url';
    return '';
}
