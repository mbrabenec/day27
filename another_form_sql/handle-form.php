<?php

session_start();
require_once 'DB.php';
require_once 'DB_functions.php';
require_once 'Comment.php';
connect('localhost', 'swars', 'root', '');

$messages = []; // start an array for them

$is_edit = ($_POST['edit'] !== "");  // are we editing an existing comment?

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

//handle data

// FAILS IF EDIT + INVALID ===> NEW 
if(!$is_valid) 
{
    $_SESSION['flashed_data'] = $_POST;
    $_SESSION['flashed_messages'] = $messages;
    header('Location: index.php#form');
    exit;
}





if($is_valid && $is_edit) 
{
    $new = new Comment;
    $new->fillFromArray($_POST);
    $new->id = $_POST['edit'];


    $messages[] = "updated id" . $new->update();
    $_SESSION['flashed_messages'] = $messages;
    header('Location: index.php');
    exit;
}



if($is_valid) 
{
    $comment = new Comment;
    $comment->fillFromArray($_POST);
    $messages[] = "new comment saved as id: " . $comment->insert();
    $_SESSION['flashed_messages'] = $messages;
    header('Location: index.php');
    exit;
}










