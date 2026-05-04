<?php

/*** USER STATUS ***/
const GLB_USER_STATUS_NEW		 		= 1;
const GLB_USER_STATUS_CONFIRMATION	= 2;
const GLB_USER_STATUS_ACTIVE		 	= 3;
const GLB_USER_STATUS_INACTIVE		= 4;
$glb_user_status[GLB_USER_STATUS_NEW] = 'E-Mail validation missing';
$glb_user_status[GLB_USER_STATUS_CONFIRMATION] = 'Confirmation pending';
$glb_user_status[GLB_USER_STATUS_ACTIVE] = 'Active';
$glb_user_status[GLB_USER_STATUS_INACTIVE] = 'Inactive';

/*** USER BOARD ROLE ***/
const GLB_USER_BOARD_ROLE_NO_MEMBER		 		= 1;
const GLB_USER_BOARD_ROLE_PRESIDENT		 	    = 2;
const GLB_USER_BOARD_ROLE_VICE_PRESIDENT 		= 3;
const GLB_USER_BOARD_ROLE_SECRETARY 		    = 4;
const GLB_USER_BOARD_ROLE_TREASURER 		    = 5;
const GLB_USER_BOARD_ROLE_MEMBER	            = 6;
$glb_board_role[GLB_USER_BOARD_ROLE_NO_MEMBER] = 'No board member';
$glb_board_role[GLB_USER_BOARD_ROLE_PRESIDENT] = 'President';
$glb_board_role[GLB_USER_BOARD_ROLE_VICE_PRESIDENT] = 'Vice president';
$glb_board_role[GLB_USER_BOARD_ROLE_SECRETARY] = 'Secretary';
$glb_board_role[GLB_USER_BOARD_ROLE_TREASURER] = 'Treasurer';
$glb_board_role[GLB_USER_BOARD_ROLE_MEMBER] = 'Board member';


/*** USER BOARD ROLE ***/
const GLB_IMAGE_TYPE_ASSOCIATION = 1;
const GLB_IMAGE_TYPE_USER       = 2;

const GLB_IMAGE_SIZE_ARTICLE_THUMB		= 64;
const GLB_IMAGE_SIZE_ARTICLE_MEDIUM		= 320;
const GLB_IMAGE_SIZE_ARTICLE_LARGE		= 640;
const GLB_IMAGE_SIZE_ARTICLE_EXTRA_LARGE = 1280;

/*** ASSOCIATION TYPE ***/
const GLB_ASSOCIATION_TYPE_NATIONAL_ASSOCIATION     = 1;
const GLB_ASSOCIATION_TYPE_WORLD_FEDERATION 		= 2;
const GLB_ASSOCIATION_TYPE_CONTINENTAL_FEDERATION 	= 3;
const GLB_ASSOCIATION_TYPE_CONMPANY              	= 4;
$glb_association_type[GLB_ASSOCIATION_TYPE_NATIONAL_ASSOCIATION] = 'National association';
$glb_association_type[GLB_ASSOCIATION_TYPE_WORLD_FEDERATION] = 'World federation';
$glb_association_type[GLB_USER_STATUS_ACTIVE] = 'Continental federation';
$glb_association_type[GLB_USER_STATUS_INACTIVE] = 'Company';

/*** ASSOCIATION FILTER ***/
const GLB_ASSOCIATION_FILTER_MEMBERS     = 1;
const GLB_ASSOCIATION_FILTER_NON_MEMBERS = 2;

$glb_association_filter[GLB_ASSOCIATION_FILTER_MEMBERS] = 'Members only';
$glb_association_filter[GLB_ASSOCIATION_FILTER_NON_MEMBERS] = 'Non members only';


