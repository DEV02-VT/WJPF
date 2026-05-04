<?php 
chdir('..');
include_once("includes/init.php");
//header("Access-Control-Allow-Origin: *");

$action  = decode(filter_input(INPUT_POST, "Action"));

$retdata = array();
$retdata['error'] = '';

//print_r($_POST);


if ($action == '')
{
    $retdata['error'] = 'Ungültiger Parameter' . ' action';
	echo json_encode($retdata);
    return;
}

switch ($action)
{
    case 'ResetPassword':
        break;
    case 'Delete':
    case 'Set':
        if (!user_is_admin() and !user_is_board_user())
        {
            $retdata['error'] = 'No rights!';
            echo json_encode($retdata);
            return;
        }
        break;
	default:
		if (!logged_in())
		{
			$retdata['error'] =  "No rights!";
			echo json_encode($retdata);
			return;
		}
}

switch ($action)
{
    case 'Get':
		$id  = decode(filter_input(INPUT_POST, "id"));
		if ($id == '')
		{
			$retdata['error'] = 'Invalid parameter id';
			echo json_encode($retdata);
			return;
		}
        if (!user_is_admin() && !user_is_board_user() && $id != get_login_user_id())
        {
            $retdata['error'] = 'No rights!';
            echo json_encode($retdata);
            return;
        }
        $retdata['user'] = get_user_data($id);
        break;
    case 'Set':
        $user = array();
        $retdata['error'] = get_user_input_data($user);
        $retdata['user'] = $user;
        if ($retdata['error'] != '')
        {
            echo json_encode($retdata);
            return;
        }

        $new_filename = '';
        if ($user['new_image'] != '')
        {
            $retdata['error'] = add_image(GLB_IMAGE_TYPE_USER, 1, $user['new_image'], $user['image_name'], $new_filename);
            if ($retdata['error'] != '')
            {
                echo json_encode($retdata);
                return;
            }
        }
        if ($new_filename != '')
        {
            if ($user['image'] != '')
                unlink_image($user['image']);
            $user['image'] =$new_filename;
        }
        else if ($user['clear_image'])
        {
            if ($user['image'] != '')
                unlink_image($user['image']);
            $user['image'] ='';
        }

        if ($user['id'] > 0)
        {
            $old = get_user($user['id']);
            if ($old['email'] != $user['email'])
            {
                if (count(get_user_by_email($user['email'])) > 0)
                {
                    $retdata['error'] =  "Email already used";
                    echo json_encode($retdata);
                    return;
                }
            }
            if ($old['first_name'] != $user['first_name'] || $old['last_name'] != $user['last_name'] || $old['birthday'] != $user['birthday'] || $old['nationality_code'] != $user['nationality_code'])
            {
                $found = get_user_by_data($user['first_name'], $user['last_name'], $user['birthday'], $user['nationality_code']);
                if (count($found) > 0 && $found['id'] != $user['id'])
                {
                    $retdata['error'] =  "Person already stored";
                    echo json_encode($retdata);
                    return;
                }
            }
            update_user($user);
        }
        else
        {
            $old = get_user_by_email($user['email']);
            if (count($old) == 0)
            {
                $old = get_user_by_data($user['first_name'], $user['last_name'], $user['birthday'], $user['nationality_code']);
            }
            if (count($old) > 0)
            {
                $retdata['error'] =  "Person already stored";
                echo json_encode($retdata);
                return;
            }
            $retdata['error'] =  create_user($user);
        }
        break;
	case 'Delete':
		$deleteid  = decode(filter_input(INPUT_POST, "deleteid"));
		if ($deleteid == '')
		{
			$retdata['error'] =  "Invalid delete id!";
			echo json_encode($retdata);
			return;
		}
		delete_user($deleteid);
        break;
    case 'ResetPassword':
		$email  = decode(filter_input(INPUT_POST, "email"));
		if ($email == '')
		{
			$retdata['error'] = 'Ungültiger Parameter: email';
			echo json_encode($retdata);
			return;
		}
		$password  = decode(filter_input(INPUT_POST, "password"));
		if ($password == '')
		{
			$retdata['error'] = 'Ungültiger Parameter: password';
			echo json_encode($retdata);
			return;
		}
		$request_key  = decode(filter_input(INPUT_POST, "request_key"));
		if ($request_key == '')
		{
			$retdata['error'] = 'Ungültiger Parameter: request_key';
			echo json_encode($retdata);
			return;
		}
		$token = decode(filter_input(INPUT_POST, "token"));
		if ($token == '')
		{
			$retdata['error'] = 'Ungültiger Parameter: token';
			echo json_encode($retdata);
			return;
		}

		$retdata['error'] = password_reset($email, $request_key, $password, $token);
        break;
    default:
        $retdata['error'] = 'Unbekannte Aktion ' . $action;
        break;
        
}

echo json_encode($retdata);
function get_user_input_data(&$user) : string
{
    $user = array();
    $user['first_name']  = decode(filter_input(INPUT_POST, "first_name"));
    if ($user['first_name'] == '')
    {
        return 'Invalid parameter: first_name';
    }
    $user['last_name']  = decode(filter_input(INPUT_POST, "last_name"));
    if ($user['last_name'] == '')
    {
        return 'Invalid parameter: last_name';
    }
    $user['status']  = decode(filter_input(INPUT_POST, "status"));
    if ($user['status'] == '')
    {
        return 'Invalid parameter: status';
    }
    $user['nationality_code']  = decode(filter_input(INPUT_POST, "nationality_code"));
    if ($user['nationality_code'] == '')
    {
        return 'Invalid parameter: nationality_code';
    }
    $user['board_role']  = decode(filter_input(INPUT_POST, "board_role"));
    if ($user['board_role'] == '')
    {
        return 'Invalid parameter: board_role';
    }
    $user['id']  = decode(filter_input(INPUT_POST, "id"));
    $user['birthday']  = decode(filter_input(INPUT_POST, "birthday"));
    $user['email']  = decode(filter_input(INPUT_POST, "email"));
    $user['phone']  = decode(filter_input(INPUT_POST, "phone"));
    $user['street']  = decode(filter_input(INPUT_POST, "street"));
    $user['house_number']  = decode(filter_input(INPUT_POST, "house_number"));
    $user['zip']  = decode(filter_input(INPUT_POST, "zip"));
    $user['town']  = decode(filter_input(INPUT_POST, "town"));
    $user['country_code']  = decode(filter_input(INPUT_POST, "country_code"));
    $user['administrator']  = decode(filter_input(INPUT_POST, "administrator"));
    $user['administrator']  = decode(filter_input(INPUT_POST, "administrator"));
    $user['image']  = decode(filter_input(INPUT_POST, "image"));
    $user['new_image']  = decode(filter_input(INPUT_POST, "new_image"));
    $user['wjpf_email']  = decode(filter_input(INPUT_POST, "wjpf_email"));
    $user['image_name']  = decode(filter_input(INPUT_POST, "image_name"));
    $user['clear_image']  = decode(filter_input(INPUT_POST, "clear_image"));
    return '';
}