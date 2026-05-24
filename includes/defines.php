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
$glb_association_type[GLB_ASSOCIATION_TYPE_CONTINENTAL_FEDERATION] = 'Continental federation';
$glb_association_type[GLB_ASSOCIATION_TYPE_CONMPANY] = 'Company';

/*** ASSOCIATION FILTER ***/
const GLB_ASSOCIATION_FILTER_MEMBERS     = 1;
const GLB_ASSOCIATION_FILTER_NON_MEMBERS = 2;

$glb_association_filter[GLB_ASSOCIATION_FILTER_MEMBERS] = 'Members only';
$glb_association_filter[GLB_ASSOCIATION_FILTER_NON_MEMBERS] = 'Non members only';


/*** NEWS STATUS ***/
const GLB_NEWS_STATUS_DRAFT     = 1;
const GLB_NEWS_STATUS_PUBLISHED = 2;
$glb_news_status[GLB_NEWS_STATUS_DRAFT]     = 'Draft';
$glb_news_status[GLB_NEWS_STATUS_PUBLISHED] = 'Published';


/*** APPOINTMENT TYPE ***/
const GLB_APPOINTMENT_TYPE_COMPETITION	 			= 1;

$glb_appointment_types[GLB_APPOINTMENT_TYPE_COMPETITION] = 'Competition';


/*** ASSOCIATION LINK TYPE ***/
const GLB_ASSOCIATION_LINK_TYPE_WEB       = 1;
const GLB_ASSOCIATION_LINK_TYPE_DISCORD   = 2;
const GLB_ASSOCIATION_LINK_TYPE_INSTAGRAM = 3;
const GLB_ASSOCIATION_LINK_TYPE_FACEBOOK  = 4;
const GLB_ASSOCIATION_LINK_TYPE_TWITTER   = 5;
const GLB_ASSOCIATION_LINK_TYPE_TIKTOK    = 6;
const GLB_ASSOCIATION_LINK_TYPE_YOUTUBE   = 7;

$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_WEB]       = 'Web';
$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_DISCORD]   = 'Discord';
$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_INSTAGRAM] = 'Instagram';
$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_FACEBOOK]  = 'Facebook';
$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_TWITTER]   = 'Twitter / X';
$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_TIKTOK]    = 'TikTok';
$glb_association_link_type[GLB_ASSOCIATION_LINK_TYPE_YOUTUBE]   = 'YouTube';


