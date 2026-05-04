<?php

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

// create a log channel
$log = new Logger('errorlog');
$log->pushHandler(new RotatingFileHandler('log/error.log', Logger::DEBUG));


function log_emergency($message, array $context = array())
{
    global $log;
	$log->emergency($message, $context);
}

function log_alert($message, array $context = array())
{
    global $log;
	$log->alert($message, $context);
}

function log_critical($message, array $context = array())
{
    global $log;
	$log->critical($message, $context);
}

function log_error($message, array $context = array())
{
    global $log;
	$log->error($message, $context);
}

function log_warning($message, array $context = array())
{
    global $log;
	$log->warning($message, $context);
}

function log_notice($message, array $context = array())
{
    global $log;
	$log->notice($message, $context);
}

function log_info($message, array $context = array())
{
    global $log;
	$log->info($message, $context);
}

function log_debug($message, array $context = array())
{
    global $log;
	$log->debug($message, $context);
}