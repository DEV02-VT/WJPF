<?php
chdir('..');
include_once("includes/init.php");
include_once("includes/functions_association_admin.php");

$action = decode(filter_input(INPUT_POST, "Action"));

$retdata = array();
$retdata['error'] = '';

if ($action == '') {
    $retdata['error'] = 'Invalid parameter action';
    echo json_encode($retdata);
    return;
}

if (!user_is_admin() && !user_is_board_user()) {
    $retdata['error'] = 'No rights!';
    echo json_encode($retdata);
    return;
}

switch ($action) {

    case 'FindUser':
        $email = decode(filter_input(INPUT_POST, "email"));
        if ($email == '') {
            $retdata['error'] = 'Invalid parameter: email';
            echo json_encode($retdata);
            return;
        }
        $user = get_user_by_email($email);
        if (!empty($user)) {
            if ($user['image'] == '') $user['image'] = 'img/boss.png';
            unset($user['password'], $user['password_reset_key'], $user['password_reset_time']);
            $retdata['found'] = true;
            $retdata['user']  = $user;
        } else {
            $retdata['found'] = false;
            $retdata['user']  = array();
        }
        break;

    case 'Get':
        $id = decode(filter_input(INPUT_POST, "id"));
        if ($id == '') {
            $retdata['error'] = 'Invalid parameter: id';
            echo json_encode($retdata);
            return;
        }
        $retdata['admin'] = get_association_admin($id);
        break;

    case 'Set':
        $error = get_admin_input_data($data);
        if ($error != '') {
            $retdata['error'] = $error;
            echo json_encode($retdata);
            return;
        }

        $user_id = $data['user_id'];

        // Image handling
        $new_filename = '';
        if ($data['new_image'] != '') {
            $retdata['error'] = add_image(GLB_IMAGE_TYPE_USER, 1, $data['new_image'], $data['image_name'], $new_filename);
            if ($retdata['error'] != '') {
                echo json_encode($retdata);
                return;
            }
        }

        $user = array(
            'id'               => $user_id,
            'first_name'       => $data['first_name'],
            'last_name'        => $data['last_name'],
            'email'            => $data['email'],
            'status'           => $data['status'],
            'phone'            => $data['phone'],
            'birthday'         => $data['birthday'],
            'nationality_code' => $data['nationality_code'],
            'street'           => $data['street'],
            'house_number'     => $data['house_number'],
            'zip'              => $data['zip'],
            'town'             => $data['town'],
            'country_code'     => $data['country_code'],
            'passport_number'  => $data['passport_number'],
            'image'            => $new_filename != '' ? $new_filename : ($data['clear_image'] ? '' : $data['image']),
        );

        if ($new_filename != '' && $data['image'] != '')
            unlink_image($data['image']);
        if ($data['clear_image'] && $data['image'] != '')
            unlink_image($data['image']);

        if ($user_id == -1) {
            // New user — preserve admin/board fields at default
            $user['administrator'] = 0;
            $user['board_role']    = GLB_USER_BOARD_ROLE_NO_MEMBER;
            $user['wjpf_email']    = '';
            $user_id = create_user($user);
        } else {
            // Existing user — preserve admin/board fields from DB
            $existing = get_user($user_id);
            $user['administrator'] = $existing['administrator'];
            $user['board_role']    = $existing['board_role'];
            $user['wjpf_email']    = $existing['wjpf_email'];
            update_user($user);
        }

        $admin = array(
            'id'             => $data['admin_id'],
            'association_id' => $data['association_id'],
            'user_id'        => $user_id,
            'role'           => $data['role'],
            'contact_person' => $data['contact_person'],
        );

        if ($data['admin_id'] == -1) {
            // Check duplicate
            if (!empty(find_association_admin_by_user($user_id, $data['association_id']))) {
                $retdata['error'] = 'This user is already an administrator of this association.';
                echo json_encode($retdata);
                return;
            }
            $new_admin_id = create_association_admin($admin);
            if ($data['contact_person']) {
                set_contact_person($data['association_id'], $new_admin_id);
            }
        } else {
            update_association_admin($admin);
            if ($data['contact_person']) {
                set_contact_person($data['association_id'], $data['admin_id']);
            }
        }
        break;

    case 'Delete':
        $id = decode(filter_input(INPUT_POST, "id"));
        if ($id == '') {
            $retdata['error'] = 'Invalid parameter: id';
            echo json_encode($retdata);
            return;
        }
        delete_association_admin($id);
        break;

    default:
        $retdata['error'] = 'Unknown action: ' . $action;
        break;
}

echo json_encode($retdata);


function get_admin_input_data(&$data)
{
    $data = array();
    $data['admin_id']        = decode(filter_input(INPUT_POST, "admin_id"));
    $data['association_id']  = decode(filter_input(INPUT_POST, "association_id"));
    $data['user_id']         = decode(filter_input(INPUT_POST, "user_id"));
    $data['role']            = decode(filter_input(INPUT_POST, "role"));
    $data['contact_person']  = decode(filter_input(INPUT_POST, "contact_person")) ? 1 : 0;

    $data['first_name']      = decode(filter_input(INPUT_POST, "first_name"));
    $data['last_name']       = decode(filter_input(INPUT_POST, "last_name"));
    $data['email']           = decode(filter_input(INPUT_POST, "email"));
    $data['status']          = decode(filter_input(INPUT_POST, "status")) ?: GLB_USER_STATUS_ACTIVE;
    $data['phone']           = decode(filter_input(INPUT_POST, "phone"));
    $data['birthday']        = decode(filter_input(INPUT_POST, "birthday"));
    $data['nationality_code']= decode(filter_input(INPUT_POST, "nationality_code"));
    $data['street']          = decode(filter_input(INPUT_POST, "street"));
    $data['house_number']    = decode(filter_input(INPUT_POST, "house_number"));
    $data['zip']             = decode(filter_input(INPUT_POST, "zip"));
    $data['town']            = decode(filter_input(INPUT_POST, "town"));
    $data['country_code']    = decode(filter_input(INPUT_POST, "country_code"));
    $data['passport_number'] = decode(filter_input(INPUT_POST, "passport_number"));
    $data['image']           = decode(filter_input(INPUT_POST, "image"));
    $data['new_image']       = decode(filter_input(INPUT_POST, "new_image"));
    $data['image_name']      = decode(filter_input(INPUT_POST, "image_name"));
    $data['clear_image']     = decode(filter_input(INPUT_POST, "clear_image")) ? 1 : 0;

    if ($data['first_name'] == '') return 'Invalid parameter: first_name';
    if ($data['last_name']  == '') return 'Invalid parameter: last_name';
    if ($data['email']      == '') return 'Invalid parameter: email';
    if ($data['association_id'] == '') return 'Invalid parameter: association_id';
    return '';
}
