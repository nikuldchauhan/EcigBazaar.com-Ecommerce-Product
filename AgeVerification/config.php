<?php
/* 
* Opencart - Age Verification by chad_dev [i_b_dns@yahoo.com]
* --SETTINGS--
* Edit the values below to match the requirements of your Store.
*/

// Minimum age required to enter your Store
$config['required_age'] = '21';

// Type of product requiring age verification
$config['product_restriction'] = 'Tobacco';

// Number of days for age verified viewers to keep cookie before seeing the popup again
$config['c_life'] = '1';

// [Optional] URL to redirect to if user does not meet minimum age requirement (leave empty to disable redirect and simply display an alert box)
// Example:  $config['redir'] = 'http://www.google.com';
$config['redir'] = '';
?>