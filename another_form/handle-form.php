<?php

session_start();

require_once 'lib/DBBlackboxV2.php';
require_once 'Comment.php';

$messages = [];
$is_edit = ($_POST["edit_id" > 0]);

// validation

$is_valid = true;

if (empty($_POST['author'])) {
    $is_valid = false;
    $messages[] = "please provide your name";
}

if ($_POST['text'] == null) {
    $is_valid = false;
    $messages[] = "please leave a comment";
}

// invalid data ****** FAILS IF EDIT + INVALID ===> NEW 

if(!$is_valid) 
{
    $_SESSION['flashed_data'] = $_POST;
    $_SESSION['flashed_messages'] = $messages;
    header('Location: index.php');
    exit;
}



if($is_valid && !$is_edit) 
{
    $new = new Comment;
    $new->fillFromArray($_POST);
    $messages[] = "saved as id: " . $new->save();
    $_SESSION['flashed_messages'] = $messages;
    header('Location: index.php');
}


if($is_valid && $is_edit) 
{
    $new = new Comment;
    $new->fillFromArray($_POST);
    $new->id = $_POST['edit_id'];
    $messages[] = "updated ";
    update($_POST['edit_id'], $new);
    $_SESSION['flashed_messages'] = $messages;
    header('Location: index.php');
}







