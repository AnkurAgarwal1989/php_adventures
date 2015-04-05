<?php

//Function used to redirect to a required page
function redirect_to($new_location) {
    //No HTML Tags, empty lines or anything the browser can send
    header("Location: " . $new_location);
    exit;
}

//Function to prepare mySQL query.
function mysql_prep($string) {
    global $connection;
    //Escape special characters...to prevent injection attacks
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

//Function confirms if returned query from SQL is not null...
//if NULL..dies with an error message
function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}

//display errors in form filling
function form_errors($errors = array()) {
    $output = "";
    //If there are errors
    if (!empty($errors)) {
        $output .= "<div class=\"error\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach ($errors as $key => $error) {
            $output .= "<li>";
            $output .= htmlentities($error);
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

// Get all subjects from the Table subjects
//If public is true...get only visible entries
function find_all_subjects($public = true) {
    global $connection;
    // 2. Perform database query
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    if ($public) {
        $query .= "WHERE visible = 1 ";
    }
    $query .= "ORDER BY position ASC";
    $subject_set = mysqli_query($connection, $query);
    // Test if there was a query error
    //function in function.php
    confirm_query($subject_set);

    return $subject_set;
}

//Find pages for a subject
//If public is true...get only visible entries
function find_pages_for_subject($subject_id, $public = true) {
    global $connection;
    //check for sql injection
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    // 2. Perform database query
    // 2. Perform database query
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE subject_id = {$safe_subject_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "ORDER BY position ASC";
    $page_set = mysqli_query($connection, $query);
    // Test if there was a query error
    //function in function.php
    confirm_query($page_set);

    return $page_set;
}

//Find full row of subject from table given ID
//Uses associative query
//If public is true...get only visible entries
function find_subject_by_id($subject_id, $public = true) {
    global $connection;
    //check for sql injection
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    // 2. Perform database query

    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "LIMIT 1";
    $subject_set = mysqli_query($connection, $query);
    // Test if there was a query error
    //function in function.php
    confirm_query($subject_set);
    if ($subject = mysqli_fetch_assoc($subject_set)) {
        return $subject;
    } else {
        return null;
    }
}

//Find full row of page from table given ID
//Uses associative query
//If public is true...get only visible entries
function find_page_by_id($page_id, $public = true) {
    global $connection;
    //check for sql injection
    $safe_page_id = mysqli_real_escape_string($connection, $page_id);
    // 2. Perform database query

    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id = {$safe_page_id} ";
    if ($public) {
        $query .= "AND visible = 1 ";
    }
    $query .= "LIMIT 1";
    $page_set = mysqli_query($connection, $query);
    // Test if there was a query error
    //function in function.php
    confirm_query($page_set);
    if ($page = mysqli_fetch_assoc($page_set)) {
        return $page;
    } else {
        return null;
    }
}

//Find what page needs to be highlighted/opened when user clicks.
//If user clicks a page, find its parent subject
//If a subject is selected...highlight default page
//no args required as it uses the global var $_GET
function find_selected_page($public = false) {
    global $curr_subject;
    global $curr_page;
    if (isset($_GET["subject"])) {
        $curr_subject = find_subject_by_id($_GET["subject"], $public);
        if ($curr_subject && $public) {
            $curr_page = find_default_page_for_subject($curr_subject["id"]);
        } else {
            $curr_page = null;
        }
    } elseif (isset($_GET["page"])) {
        $curr_page = find_page_by_id($_GET["page"], $public);
        $curr_subject = null;
    } else {
        $curr_subject = null;
        $curr_page = null;
    }
}

//Returns the default page for the subject
function find_default_page_for_subject($subject_id) {
    $page_set = find_pages_for_subject($subject_id);
    if ($first_page = mysqli_fetch_assoc($page_set)) {
        return $first_page;
    } else {
        return null;
    }
}


//Function to display navigation links in sidebar 1 for admin
//Takes 2 args:
// Current subject array or null;
// Current page array or null;
function navigation($subject_array, $page_array) {

    $output = "<a href=\"admin.php\">&laquo; Main Menu</a> <br />";
    $output .= "<ul class = \"subjects\">";
    $subject_set = find_all_subjects(false);
    //output data from each row -->
    while ($subject = mysqli_fetch_assoc($subject_set)) {
        $output .= "<li";
        if ($subject_array && $subject["id"] == $subject_array["id"]) {
            $output .= " class =\"selected\"";
        }
        $output .= ">";

        $output .= "<a href =\"manage_content.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= htmlentities($subject["menu_name"]);
        $output .= "</a>";


        $page_set = find_pages_for_subject($subject["id"], false);
        $output .= "<ul class = \"pages\">";
        while ($page = mysqli_fetch_assoc($page_set)) {
            $output .= "<li";

            if ($page_array && $page["id"] == $page_array["id"]) {
                $output .= " class =\"selected\"";
            }
            $output .= ">";

            $output .= "<a href =\"manage_content.php?page=";
            $output .= urlencode($page["id"]);
            $output .= "\">";
            $output .= htmlentities($page["menu_name"]);
            $output .= "</a>";

            $output .= "</li>";
        }

        mysqli_free_result($page_set);
        $output .= "</ul>";
        $output .= "</li>";
    }

    mysqli_free_result($subject_set);
    $output .= "</ul>";
    return $output;
}

//Function to display navigation links in sidebar 1 for non-admin
//args:
    //Current subject array or null
    //Current page array or null
function public_navigation($subject_array, $page_array) {

    $output = "<ul class = \"subjects\">";
    $subject_set = find_all_subjects();
    //output data from each row -->
    while ($subject = mysqli_fetch_assoc($subject_set)) {
        $output .= "<li";
        if ($subject_array && $subject["id"] == $subject_array["id"]) {
            $output .= " class =\"selected\"";
        }
        $output .= ">";
        
        $output .= "<a href =\"index.php?subject=";
        $output .= urlencode($subject["id"]);
        $output .= "\">";
        $output .= htmlentities($subject["menu_name"]);
        $output .= "</a>";

        if ($subject_array["id"] == $subject["id"] || $page_array["subject_id"] == $subject["id"]) {
            $page_set = find_pages_for_subject($subject["id"]);
            $output .= "<ul class = \"pages\">";
            while ($page = mysqli_fetch_assoc($page_set)) {
                $output .= "<li";

                if ($page_array && $page["id"] == $page_array["id"]) {
                    $output .= " class =\"selected\"";
                }
                $output .= ">";

                $output .= "<a href =\"index.php?page=";
                $output .= urlencode($page["id"]);
                $output .= "\">";
                $output .= htmlentities($page["menu_name"]);
                $output .= "</a>";
                $output .= "</li>";
            }
            $output .= "</ul>";  //end of page list
            mysqli_free_result($page_set);
        }
        $output .= "</li>";   // end of subject list item
    }

    mysqli_free_result($subject_set);
    $output .= "</ul>";  //end of subject list
    return $output;
}

?>