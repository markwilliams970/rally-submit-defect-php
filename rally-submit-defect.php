<?php

    $filepath = realpath (dirname(__FILE__));
    use Yahoo\Connectors\Rally;
    require_once $filepath.'/Rally.class.php';
    $err = null;

    $base_url = "https://rally1.rallydev.com";
    $rally_username = "user@company.com";
    $rally_password = "topsecret";
    $my_workspace   = "/workspace/12345678910";
    $my_project    = "/project/12345678911";
	$relative_url_path = "/rally-submit-defect";
    
    // Instantiate Rally API
    $rally = new Yahoo\Connectors\Rally($rally_username, $rally_password);
    $rally->setWorkspace($my_workspace);

    // Process the form
    
    if(!empty($_POST)) {
    
        // VALIDATION SECTION
        if (!$_POST['name']) {
            $err .= "Please enter a name for the Defect.<br>";
        }       
        if (!$_POST['description']) {
            $err .= "Please enter a Description<br>";
        }
        
        if ($err == null) {
            $name = $_POST['name'];
            $priority = $_POST['priority'];
            $severity = $_POST['severity'];
            $description = $_POST['description'];
            echo $_POST['name'];
            $fields = array('Name' => $name, 'Priority' => $priority,
                'Severity' => $severity, 'Description' => $description, 'Project' => $my_project);
            $create_result = $rally->create('defect', $fields);
            $defect_oid = $create_result['ObjectID'];
            $defect_formatted_id = $create_result['FormattedID'];
            $detail_url = $base_url."/#/detail/defect/".$defect_oid;

            echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            echo '<HEAD>';
            echo '<style type="text/css">';
            echo 'BODY { background-color:#444444; color: #dddddd; font-family: Arial; font-weight: normal; font-style: normal; font-variant: ; font-size: small; }';
            echo '.light-text { color: #555555; font-family: Arial; font-weight: normal; font-style: normal; font-variant: ; font-size: small; }';
            echo '.bold-underline  { font-family: Arial; font-weight: bold; font-style: normal; text-decoration: underline; font-variant: ; font-size: medium; }';
            echo '</style>';
            echo '</HEAD>';

            echo '<title>Defect Successfully Created in Rally</title>';
            echo '<body>';
            echo '<center>';
            echo '<h2><u>Defect Successfully Created.</u></h2>';
            echo '<br>';
            echo '<br>';
            echo '<a href="'.$detail_url.'">'.$defect_formatted_id.'</a>';
            echo '</center>';
            echo '</body>';
            echo '</html>';
        }
        
        elseif($err)
        {           
            echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            echo '<HEAD>';
            echo '<style type="text/css">';
            echo 'BODY { background-color:#444444; color: #dddddd; font-family: Arial; font-weight: normal; font-style: normal; font-variant: ; font-size: small; }';
            echo '.light-text { color: #555555; font-family: Arial; font-weight: normal; font-style: normal; font-variant: ; font-size: small; }';
            echo '.bold-underline  { font-family: Arial; font-weight: bold; font-style: normal; text-decoration: underline; font-variant: ; font-size: medium; }';
            echo '</style>';
            echo '</HEAD>';

            echo '<title>Defect Not created in Rally</title>';
            echo '<body>';
            echo '<center>';
            echo '<h2><u>Defect Submission Failed: there were input errors.</u></h2>';
            echo '<br>';
            echo $err;
            echo '<br>';
            echo '<br>';
            echo '<a href="'.$relative_url_path.'/rally-submit-defect.php" style="color: #CC0000">Return to Defect Form</a>';
            echo '</center>';
            echo '</body>';
            echo '</html>';
        }
    }
    
    // Displays HTML form if not called via form POST
    else {
        $htmlContentFile="rally-submit-defect.html";
        readfile($htmlContentFile);
    }
?>
