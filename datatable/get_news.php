<?php

chdir('..');
require_once "includes/init.php";
require_once "includes/functions_news.php";

$table      = 'news';
$primaryKey = 'id';

$columns = array(
    array('db' => 'status', 'dt' => 0, 'formatter' => function ($d, $row) {
        global $glb_news_status;
        $label = $glb_news_status[$d] ?? $d;
        $class = ($d == GLB_NEWS_STATUS_PUBLISHED) ? 'badge bg-success' : 'badge bg-secondary';
        return '<span class="' . $class . '">' . $label . '</span>';
    }),
    array('db' => 'title', 'dt' => 1),
    array('db' => 'news_date', 'dt' => 2, 'formatter' => function ($d, $row) {
        return $d ? date('d.m.Y', strtotime($d)) : '';
    }),
    array('db' => 'updated_at', 'dt' => 3, 'formatter' => function ($d, $row) {
        return $d ? date('d.m.Y', strtotime($d)) : '';
    }),
    array('db' => 'id', 'dt' => 4, 'formatter' => function ($d, $row) {
        $buttons  = '<div style="display:flex">';
        $buttons .= '<img class="table_button edit_news" src="img/edit.png" data-id="' . $d . '" title="Edit news">';
        $buttons .= '<img class="table_button delete_news" src="img/trash.png" data-bs-toggle="modal" data-bs-target="#deleteNewsModal" data-id="' . $d . '" data-title="' . htmlspecialchars($row[1]) . '" title="Delete news">';
        $buttons .= '</div>';
        return $buttons;
    }),
);

$sql_details = array(
    'user'    => Config::DB_USER,
    'pass'    => Config::DB_PASSWORD,
    'db'      => Config::DB_NAME,
    'host'    => Config::DB_HOST,
    'charset' => 'utf8'
);

require_once('includes/scripts/ssp.class.php');

$result = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, null);

echo json_encode($result);
