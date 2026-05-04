<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

chdir('..');
require_once "includes/init.php";
require_once "includes/functions_user.php";
/*
$userid = get_login_user_id();
if ($userid == 0)
{
	echo json_encode(array());
	return;
}*/

$status = decode(filter_input(INPUT_GET, "status"));
$show_only_board_users = decode(filter_input(INPUT_GET, "show_only_board_users"));


// DB table to use
//$table = $db_tbl_prefix . 'customer';
$table = 'user';
 
// Table's primary key
$primaryKey = 'ID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// 
// 
// indexes
$columns = array(       
    array( 'db' => 'status', 'dt' => 0, 'formatter' => function( $d, $row ) {
		global $glb_user_status;
		$buttons = '<div style="display:flex">';
        switch ($d)
        {
            case GLB_USER_STATUS_CONFIRMATION:
                $buttons = $buttons . '<img class="table_button"  src="img/bestaetigung.png" title="' . $glb_user_status[GLB_USER_STATUS_CONFIRMATION] . '">';
                break;
            case GLB_USER_STATUS_NEW:
                $buttons = $buttons . '<img class="table_button"  src="img/neu.png" title="' . $glb_user_status[GLB_USER_STATUS_NEW] . '">';
                break;
            case GLB_USER_STATUS_ACTIVE:
                $buttons = $buttons . '<img class="table_button"  src="img/aktiv.png" title="' . $glb_user_status[GLB_USER_STATUS_ACTIVE] . '">';
                break;
            case GLB_USER_STATUS_INACTIVE:
                $buttons = $buttons . '<img class="table_button"  src="img/inaktiv.png" title="' . $glb_user_status[GLB_USER_STATUS_INACTIVE] . '">';
                break;
        }
        if ($row[14] != '')
            $buttons = $buttons . '<img class="table_button"  src="' . $row[14] . '" >';
		$buttons = $buttons . '</div>';
		return $buttons;
	}),
    array( 'db' => 'first_name', 'dt' => 1, 'formatter' => function( $d, $row ) {
        return get_user_name($row[7]);
    }),
    array( 'db' => 'email', 'dt' => 2, 'formatter' => function( $d, $row ) {
        $ret = $d;
        if ($row[15] != '')
            $ret .= ', ' . $row[15];
        return $ret;
    }),
    array( 'db' => 'phone', 'dt' => 3),
    array( 'db' => 'street', 'dt' => 4, 'formatter' => function( $d, $row ) {
			return $d . " " . $row[9] . " " . $row[10] . " " . $row[11];
	}),
    array( 'db' => 'birthday', 'dt' => 5, 'formatter' => function( $d, $row ) {
			return  display_german_date($d);
	}),
    array( 'db' => 'board_role', 'dt' => 6, 'formatter' => function( $d, $row ) {
        global $glb_board_role;
		return $glb_board_role[$d];
	}),
	array( 'db' => 'id', 'dt' => 7 , 'formatter' => function( $d, $row ) {
		$buttons = '<div style="display:flex">';
		$buttons = $buttons . '<img class="table_button edit_user"  src="img/edit.png  " data-id="' . $d . '" title="Edit user">';
		if ($row[0] == GLB_USER_STATUS_INACTIVE)
		{
			$buttons = $buttons . '<img class="table_button delete_user"  src="img/trash.png" data-bs-toggle="modal" data-bs-target="#deleteUserModal"  data-id="' . $d . '"  data-name="' . $row[1] . " " . $row[8] . '" title="Delete user">';
		}
		$buttons = $buttons . '</div>';
		return $buttons;
	} ),
    array( 'db' => 'last_name', 'dt' => 8),
    array( 'db' => 'house_number', 'dt' => 9),
    array( 'db' => 'ZIP', 'dt' => 10),
    array( 'db' => 'town', 'dt' => 11),
    array( 'db' => 'country_code', 'dt' =>  12),
    array( 'db' => 'administrator', 'dt' => 13),
    array( 'db' => 'image', 'dt' => 14),
    array( 'db' => 'wjpf_email', 'dt' => 15)
);
 
// SQL server connection information
$sql_details = array(
    'user' => Config::DB_USER,
    'pass' => Config::DB_PASSWORD,
    'db'   => Config::DB_NAME,
    'host' => Config::DB_HOST,
    'charset' => 'utf8'
);
 
$where = '';
if ($status != '-1')
{
	$where .= "status = '$status'";
}


if ($show_only_board_users == 1)
{
    if ($where != '')
        $where .= " AND ";
    $where .= " board_role > 1";
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require_once('includes/scripts/ssp.class.php');
 
$result = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, $where);

echo json_encode($result);

/*echo json_encode(
    $sql_details
);*/