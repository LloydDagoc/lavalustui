<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
*/

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
*/
$autoload['libraries'] = array('database', 'session', 'form_validation', 'Lauth');

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
*/
$autoload['helpers'] = array('url', 'common', 'security');

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
*/
$autoload['models'] = array('QuestionModel');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
*/
$autoload['configs'] = array();
?>
