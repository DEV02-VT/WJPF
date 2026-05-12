<?php 
chdir('..');
include_once("includes/init.php");
include_once("includes/functions_user.php");
include_once("includes/functions_appointment.php");
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
	default:
		if (!logged_in())
		{
			$retdata['error'] =  "Unknown user!";
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
			$retdata['error'] = 'Ungültiger Parameter id';
			echo json_encode($retdata);
			return;
		}
		$retdata['appointment'] = get_appointment($id);
        break;
	case 'Set':
		$appointment = array();
        $appointment['type']  = decode(filter_input(INPUT_POST, "type"));
        if ($appointment['type'] == '')
        {
            $retdata['error'] = 'Ungültiger Parameter: type';
            echo json_encode($retdata);
            return;
        }
        $appointment['headline']  = decode(filter_input(INPUT_POST, "headline"));
        if ($appointment['headline'] == '')
        {
            $retdata['error'] = 'Ungültiger Parameter: headline';
            echo json_encode($retdata);
            return;
        }
		$appointment['link']  = filter_input(INPUT_POST, "link");
		$appointment['begin']  = decode(filter_input(INPUT_POST, "begin"));
		if ($appointment['begin'] == '')
		{
			$retdata['error'] = 'Ungültiger Parameter: begin';
			echo json_encode($retdata);
			return;
		}
		$appointment['end']  = decode(filter_input(INPUT_POST, "end"));
		$appointment['place']  = decode(filter_input(INPUT_POST, "place"));
		$appointment['author_id']  = decode(filter_input(INPUT_POST, "author_id"));
		if ($appointment['author_id'] == '')
		{
			$retdata['error'] = 'Ungültiger Parameter: author_id';
			echo json_encode($retdata);
			return;
		}
        $appointment['id']  = decode(filter_input(INPUT_POST, "id"));
        $appointment['street']  = decode(filter_input(INPUT_POST, "street"));
        $appointment['house_number']  = decode(filter_input(INPUT_POST, "house_number"));
        $appointment['zip']  = decode(filter_input(INPUT_POST, "zip"));
        $appointment['town']  = decode(filter_input(INPUT_POST, "town"));
        $appointment['country_code']  = decode(filter_input(INPUT_POST, "country_code"));
        $appointment['latitude']  = decode(filter_input(INPUT_POST, "latitude"));
        $appointment['longitude']  = decode(filter_input(INPUT_POST, "longitude"));
		if ($appointment['id'] > 0)
		{
			update_appointment($appointment);
		}
		else
		{
			create_appointment($appointment);
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
		delete_appointment($deleteid);
        break;
	default:
        $retdata['error'] = 'Unbekannte Aktion ' . $action;
        break;
        
}

echo json_encode($retdata);