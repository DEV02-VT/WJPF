<?php

include_once("functions_member.php");
include_once("includes/functions_association_admin.php");
include_once("includes/functions_meeting_admin.php");
include_once("includes/functions_storage_admin.php");

function CheckLogin() // checks if a user or a participant is logged in otherwise redirects to login
{
    if (logged_in())
    {
		$_SESSION['link_to'] = '';
    }
	else
	{
		$_SESSION['link_to'] = $_SERVER['REQUEST_URI'];
		redirect("login.php");
		exit;
	}
}



function CheckAdmin() // checks if a user is admin or redirects to index.php
{
	CheckMemberLogin();
    if (!user_is_admin())
    {
		set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
		redirect("index.php");
		exit;
    }
}




function CheckBoardMemberOrAdminOrPress() // checks if a user is admin or redirects to index.php
{
    CheckMemberLogin();
    if (!user_is_admin() and !user_is_board_member() and !user_is_press_representative())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
        redirect("index.php");
        exit;
    }
}

function CheckBoardMemberOrAdminOrSponsoring() // checks if a user is admin or redirects to index.php
{
    CheckMemberLogin();
    if (!user_is_admin() and !user_is_board_member() and !user_is_sponsoring_team())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
        redirect("index.php");
        exit;
    }
}


function CheckAssociationAdminOrAdmin() // checks if a user is admin or redirects to index.php
{
    CheckLogin();
    if (!user_is_admin() and !user_is_association_admin())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
        redirect("index.php");
        exit;
    }
}

function CheckEventAdminOrAdmin() // checks if a user is admin or redirects to index.php
{
    CheckLogin();
    if (!user_is_admin() and !user_is_event_admin())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
        redirect("index.php");
        exit;
    }
}
function CheckBoardMemberOrAdminOrStorageAdmin() // checks if a user is admin or redirects to index.php
{
    CheckLogin();
    if (!user_is_admin() and !user_is_board_member() and !user_is_storage_admin())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
        redirect("index.php");
        exit;
    }
}

function CheckMeetingAdminOrAdmin() // checks if a user is admin or redirects to index.php
{
    CheckLogin();
    if (!user_is_admin() and !user_is_board_member() and !user_is_meeting_admin())
    {
        set_message('<div class="alert alert-danger text-center" role="alert">Du hast keine Berechtigung diese Seite aufzufrufen!</div>');
        redirect("index.php");
        exit;
    }
}





function validate_user_login()
{
    if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == 'POST')
    {
        $user_name          = decode(filter_input(INPUT_POST, "user_name"));
        $password           = decode(filter_input(INPUT_POST, "password"));
        $link_to            = decode(filter_input(INPUT_POST, "link_to"));

		$user = get_member_by_email($user_name);
		if (count($user) > 0 && password_verify($password, $user['password']) && ($user['status'] == GLB_MEMBER_STATUS_ACTIVE || $user['status'] == GLB_MEMBER_STATUS_CONFIRMATION))
        {
			set_member_last_login($user['id']);
			$_SESSION['user'] = $user['id'];
			$_SESSION['language'] = $user['language_code'];
			if (!isset($link_to) || $link_to == '')
			{
				$link_to = 'index.php';
			}
			redirect($link_to);
        }
        else
        {
			echo '<div class="alert alert-danger text-center" role="alert">Ungültige Login-Daten. Bitte prüfen sie die E-Mail-Adresse und das Passwort.</div>';
        }
    }
}









 
