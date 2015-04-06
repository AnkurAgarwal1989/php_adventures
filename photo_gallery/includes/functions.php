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

?>