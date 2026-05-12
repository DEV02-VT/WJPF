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
include_once("includes/functions_appointment.php");
/*
require_once "../defines.php";
require_once "../settings/config.php";
require_once "../db.php";
require_once "../functions.php";
require_once "../settings/config.php";
require_once "../functions_appointment.php";
require_once "../functions_member.php";
require_once "../functions_user.php";
*/
/*
$userid = get_login_user_id();
if ($userid == 0)
{
	echo json_encode(array());
	return;
}*/


// DB table to use
//$table = $db_tbl_prefix . 'customer';
$table = 'appointment';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// 
// 
// indexes
$columns = array(       
    array( 'db' => 'begin', 'dt' => 0, 'formatter' => function( $d, $row ) {
		return $d;
	}),
    array( 'db' => 'end', 'dt' => 1, 'formatter' => function( $d, $row ) {
		return $d;
	}),
    array( 'db' => 'author_id', 'dt' => 2, 'formatter' => function( $d, $row ) {
		return get_user_name($d);
	}),
    array( 'db' => 'headline', 'dt' => 3),
    array( 'db' => 'link', 'dt' => 4, 'formatter' => function( $d, $row ) {
		return '<a href="' . $d . ' " target="_blank">' . substr($d, 0, 20) . '</a>';
	}),
    array( 'db' => 'place', 'dt' => 5),
    array( 'db' => 'id', 'dt' => 6 , 'formatter' => function( $d, $row ) {
		$buttons = '<div style="display:flex">';
		$buttons .= '<img class="table_button edit_appointment"  src="img/edit.png  " data-id="' . $d . '" title="Termin bearbeiten">';
		$buttons .= '<img class="table_button delete_appointment"  src="img/trash.png" data-bs-toggle="modal" data-bs-target="#deleteAppointmentModal"  data-id="' . $d . '"  data-name="' . $row[3] . '" title="Termin löschen">';
		$buttons .= '</div>';
		return $buttons;
	} ),
	 array( 'db' => 'id', 'dt' => 8)
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

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require_once( 'includes/scripts/ssp.class.php' );
 
$result = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, $where);

echo json_encode($result);

/*echo json_encode(
    $sql_details
);*/