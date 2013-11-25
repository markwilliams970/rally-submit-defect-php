rally-submit-defect-php
=======================

## SECURITY WARNING ##
The PHP script includes embedded Rally credentials. While PHP masks the source code of the script from the browser end-user, this is fundamentally NOT secure. STRONGLY RECOMMEND USING THIS EXAMPLE FOR EXAMPLE REFERENCE ONLY. 

## Example ##

A very simple example of an HTML form submitted to a PHP script that creates a Defect in Rally using a slightly modified version of:

-  [Yahoo's PHP Rally Connector](https://github.com/stjohnjohnson/php-rally-connector). 

The only modification was to no longer throw an Exception for Warnings returned by WSAPI - due to down-level versioning - every 1.x WSAPI request will generate a warning.

## Usage ##
Configure the following variables in `rally-submit-defect.php`:

    $base_url = "https://rally1.rallydev.com";
    $rally_username = "user@company.com";
    $rally_password = "topsecret";
    $my_workspace   = "/workspace/12345678910";
    $my_project    = "/project/12345678911";
	$relative_url_path = "/rally-submit-defect";
    

To match your environment. Place the PHP, HTML, and styles directory within the location on your PHP-enabled webserver denoted by `$relative_url_path`. Default access to the page:

`https://mywebserver/rally-submit-defect/rally-submit-defect.php`

You'll need to configure the virtual directory on the webserver per the directions for your particular web hosting application.

## Tested On ##

Requires PHP 5.3+ with JSON and CuRL support installed.

