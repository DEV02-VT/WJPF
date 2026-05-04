<?php

$con = connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);

function connect($host, $user, $password, $db)
{
    $connection =  mysqli_connect($host, $user, $password, $db);
	mysqli_query($connection, "SET NAMES 'utf8'");
	return $connection;
}

function row_count($result)
{
    return mysqli_num_rows($result);
}

function escape($string, $connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}

    return mysqli_real_escape_string($connection, $string);
}

function query($query, $confirm = true, $connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    
    $result = mysqli_query($connection, $query);
    if ($confirm)
    {
        confirm($result, $connection);
    }
    return $result;
}


function query_array($query, $connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    
    $result = mysqli_query($connection, $query);
    confirm($result, $connection);
    $ret = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $ret;
}

function query_row($query, $connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
       
    $result = mysqli_query($connection, $query);
    confirm($result, $connection);
    if (row_count($result) > 0)
    {
        $ret = mysqli_fetch_assoc($result);
    }
    else
    {
        $ret = array();
    }
    mysqli_free_result($result);
    return $ret;
}

function confirm($result, $connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    
    if (!$result)
    {
        throw new Exception("Database query failed " . mysqli_error($connection));
    }

}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}


function sql_begin($connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    return mysqli_begin_transaction($connection);
}


// Finish a transaction
function sql_commit($connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    return mysqli_commit($connection);
}


// Rollback a transaction
function sql_rollback($connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    return mysqli_rollback($connection);
}

function sql_error($connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    return mysqli_error($connection);
}

function sql_insert_id($connection = NULL)
{
    global $con;
	if ($connection == NULL){$connection = $con;}
    return mysqli_insert_id($connection);
}
?>
