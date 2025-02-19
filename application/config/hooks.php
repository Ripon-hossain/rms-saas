<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
// Enable hooks
$hook['pre_controller'][] = array(
    'class'    => 'DatabaseHook',
    'function' => 'switchDatabase',
    'filename' => 'DatabaseHook.php',
    'filepath' => 'hooks'
);


