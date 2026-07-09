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
require_once "includes/functions_association.php";
/*
$associationid = get_login_association_id();
if ($associationid == 0)
{
	echo json_encode(array());
	return;
}*/

$filter = decode(filter_input(INPUT_GET, "filter"));


// DB table to use
//$table = $db_tbl_prefix . 'customer';
$table = 'association';
 
// Table's primary key
$primaryKey = 'ID';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// 
// 
// indexes
$columns = array(       
    array( 'db' => 'nationality_code', 'dt' => 0, 'formatter' => function( $d, $row ) {
        $buttons = '<div style="display:flex">';
        if ($row[13] != '')
            $buttons = $buttons . '<img class="table_button"  src="' . $row[13] . '" >';
		$buttons = $buttons . '</div>';
		return $buttons;
	}),
    array( 'db' => 'nationality_code', 'dt' => 1, 'formatter' => function( $d, $row ) {
        $buttons = '<div style="display:flex">';
        $buttons = $buttons . '<img class="country_flag mt-1" src="img/flags/' . $d . '.png" title="' . get_country_name($d, 'en') . '">';
        $buttons = $buttons . '</div>';
        return $buttons;
    }),
    array( 'db' => 'name', 'dt' => 2),
    array( 'db' => 'email', 'dt' => 3),
    array( 'db' => 'phone', 'dt' => 4),
    array( 'db' => 'street', 'dt' => 5, 'formatter' => function( $d, $row ) {
			return $d . " " . $row[9] . " " . $row[10] . " " . $row[11];
	}),
    array( 'db' => 'website', 'dt' => 6, 'formatter' => function( $d, $row ) {
			return  $d;
	}),
    array( 'db' => 'member', 'dt' => 7, 'formatter' => function( $d, $row ) {
        $buttons = '<div style="display:flex">';
        if ($d)
            $buttons = $buttons . '<img class="table_img mt-1" src="img/yes.png" title="member">';
        else
            $buttons = $buttons . '<img class="table_img mt-1" src="img/minus.png" title="no member">';
        $buttons = $buttons . '</div>';
		return $buttons;
	}),
	array( 'db' => 'id', 'dt' => 8, 'formatter' => function( $d, $row ) {
		$buttons = '<div style="display:flex">';
		$buttons = $buttons . '<a href="admin_association_detail.php?id=' . $d . '"><img class="table_button" src="img/detail.png" title="View details"></a>';
		$buttons = $buttons . '<img class="table_button edit_association"  src="img/edit.png  " data-id="' . $d . '" title="Edit association">';
		if (user_is_admin())
			$buttons = $buttons . '<img class="table_button delete_association"  src="img/trash.png" data-bs-toggle="modal" data-bs-target="#deleteAssociationModal"  data-id="' . $d . '"  data-name="' . $row[2] . '" title="Delete association">';
		$buttons = $buttons . '</div>';
		return $buttons;
	} ),
    array( 'db' => 'house_number', 'dt' => 9),
    array( 'db' => 'ZIP', 'dt' => 10),
    array( 'db' => 'town', 'dt' => 11),
    array( 'db' => 'country_code', 'dt' =>  12),
    array( 'db' => 'image', 'dt' => 13)
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
if ($filter != '-1')
{
    if ($filter == GLB_ASSOCIATION_FILTER_MEMBERS)
        $where = 'member = 1';
    else if ($filter == GLB_ASSOCIATION_FILTER_NON_MEMBERS)
        $where = 'member = 0';
}
// Association admins (neither board nor global admin) only see their own associations.
if (!user_is_admin() && !user_is_board_user())
{
    $ids = get_association_ids_for_user(get_login_user_id());
    $restriction = (count($ids) == 0) ? '0' : ('id IN (' . implode(',', array_map('intval', $ids)) . ')');
    $where = ($where == '') ? $restriction : ('(' . $where . ') AND ' . $restriction);
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