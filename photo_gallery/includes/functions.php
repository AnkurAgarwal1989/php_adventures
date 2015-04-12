<?php

//Remove zeros from dates: eg 01/05/2005 -> 1/5/2005
function strip_zeros_from_date($marked_string = ""){
    //first remove marked zeros
    $no_zeros = str_replace("*0", "", $marked_string);
    //remove remaining marks
    $cleaned_string = str_replace("*", "", $no_zeros);
    return $cleaned_string;
}

//Function used to redirect to a required page
function redirect_to($new_location = NULL) {
    //No HTML Tags, empty lines or anything the browser can send
    if ($new_location != NULL){
        header("Location: " . $new_location);
        exit;
    }
}

//Give out a message in a paragraph
function output_message($message = "") {
    if(!empty($message)){
        return "<p class = \"message\">{$message}</p>";
    } else {
        return "";
    }
}

function __autoload($class_name){
    $class_name = strtolower($class_name);
    $path = "../includes/{$class_name}.php";
    if(file_exists($path)){
        require_once($path);
    }
    else{
        die("The class {$class_name} could not be found...");
    }
}

function include_layout_template($template = "") {
    if (isset($template)) {
        include(SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template);
    }
}

function log_action($action, $msg="") {
    //Check if the dir exists
    if (!file_exists (SITE_ROOT.DS."logs")){
        echo "Dir logs does not exist. <br/>";
        mkdir(SITE_ROOT.DS."logs", 0777);
        echo "logs dir created. <br/>";
    }
    $log_line = "";
    $log_line .= strftime("%c", time());
    $log_line .= " | ";
    $log_line .= "{$action}: ";
    $log_line .= "{$msg}\n";
    $written = file_put_contents(SITE_ROOT.DS."logs".DS."log.txt", $log_line, LOCK_EX|FILE_APPEND);
    
    if(! ($written > 0) ){
        echo "Could not write to log file";
    }
}

?>