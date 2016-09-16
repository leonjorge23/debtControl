<?php
/**
 * Created by PhpStorm.
 * User: jleon
 * Date: 9/9/2016
 * Time: 4:25 PM
 */
$connection = '';
$environment = 'local'; // change to 'production' when you need to push to production.

if ($environment == 'local') {
    $connection = array(
        'database_dsg' => 'mysql:dbname=debt_control;host=localhost',
        'database_user' => 'root',
        'database_pass' => Null
    );
} else {
    $connection = array(
        'database_dsg' => 'mysql:dbname=debt_control;host=localhost',
        'database_user' => 'jladmin',
        'database_pass' => '@15Giancarloaa13'
    );
}

return $connection;