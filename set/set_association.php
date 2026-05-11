<?php 
chdir('..');
include_once("includes/init.php");
include_once("includes/functions_association.php");
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
        if (!user_is_admin() && !user_is_board_association() && $id != get_login_user_id())
        {
            $retdata['error'] = 'No rights!';
            echo json_encode($retdata);
            return;
        }
        $retdata['association'] = get_association($id);
        break;
    case 'Set':
        $association = array();
        $retdata['error'] = get_association_input_data($association);
        $retdata['association'] = $association;
        if ($retdata['error'] != '')
        {
            echo json_encode($retdata);
            return;
        }

        $new_filename = '';
        if ($association['new_image'] != '')
        {
            $retdata['error'] = add_image(GLB_IMAGE_TYPE_ASSOCIATION, 1, $association['new_image'], $association['image_name'], $new_filename);
            if ($retdata['error'] != '')
            {
                echo json_encode($retdata);
                return;
            }
        }
        if ($new_filename != '')
        {
            if ($association['image'] != '')
                unlink_image($association['image']);
            $association['image'] =$new_filename;
        }
        else if ($association['clear_image'])
        {
            if ($association['image'] != '')
                unlink_image($association['image']);
            $association['image'] ='';
        }

        if ($association['id'] > 0)
        {
            $old = get_association($association['id']);
            if ($old['name'] != $association['name'])
            {
                if (count(get_associations_by_name($association['name'])) > 0)
                {
                    $retdata['error'] =  "Association already used";
                    echo json_encode($retdata);
                    return;
                }
            }
            update_association($association);
        }
        else
        {
            $old = get_associations_by_name($association['name']);
            if (count($old) > 0)
            {
                $retdata['error'] =  "Association already stored";
                echo json_encode($retdata);
                return;
            }
            create_association($association);
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
		delete_association($deleteid);
        break;
    default:
        $retdata['error'] = 'Unbekannte Aktion ' . $action;
        break;
        
}

echo json_encode($retdata);

function get_association_input_data(&$association) : string
{
    $association = array();
    $association['type']  = decode(filter_input(INPUT_POST, "type"));
    if ($association['type'] == '')
    {
        return 'Invalid parameter: type';
    }
    $association['name']  = decode(filter_input(INPUT_POST, "name"));
    if ($association['name'] == '')
    {
        return 'Invalid parameter: name';
    }
    $association['nationality_code']  = decode(filter_input(INPUT_POST, "nationality_code"));
    if ($association['nationality_code'] == '')
    {
        return 'Invalid parameter: nationality_code';
    }
    $association['email']  = decode(filter_input(INPUT_POST, "email"));
    $association['id']  = decode(filter_input(INPUT_POST, "id"));
    $association['registration_number']  = decode(filter_input(INPUT_POST, "registration_number"));
    $association['foundation_date']  = decode(filter_input(INPUT_POST, "foundation_date"));
    $association['tax_id']  = decode(filter_input(INPUT_POST, "tax_id"));
    $association['member_count']  = decode(filter_input(INPUT_POST, "member_count"));
    $association['street']  = decode(filter_input(INPUT_POST, "street"));
    $association['house_number']  = decode(filter_input(INPUT_POST, "house_number"));
    $association['zip']  = decode(filter_input(INPUT_POST, "zip"));
    $association['town']  = decode(filter_input(INPUT_POST, "town"));
    $association['country_code']  = decode(filter_input(INPUT_POST, "country_code"));
    $association['website']  = decode(filter_input(INPUT_POST, "website"));
    $association['phone']  = decode(filter_input(INPUT_POST, "phone"));
    $association['begin_of_membership']  = decode(filter_input(INPUT_POST, "begin_of_membership"));
    $association['end_of_membership']  = decode(filter_input(INPUT_POST, "end_of_membership"));
    $association['comment']  = decode(filter_input(INPUT_POST, "comment"));
    $association['member']  = decode(filter_input(INPUT_POST, "member"));
    $association['image']  = decode(filter_input(INPUT_POST, "image"));
    $association['new_image']  = decode(filter_input(INPUT_POST, "new_image"));
    $association['image_name']  = decode(filter_input(INPUT_POST, "image_name"));
    $association['clear_image']  = decode(filter_input(INPUT_POST, "clear_image"));
    return '';
}
