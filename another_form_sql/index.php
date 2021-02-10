<?php

session_start();
require_once 'DB.php';
require_once 'DB_functions.php';
require_once 'Comment.php';
connect('localhost', 'swars', 'root', '');

// empty data object

$comment = new Comment;

// get and reset flashed messages + data

if (isset($_SESSION['flashed_data'])) {
    $comment->fillFromArray($_SESSION['flashed_data']);
    unset($_SESSION['flashed_data']);
}

$flashed_messages = [];

if (isset($_SESSION['flashed_messages']) && count($_SESSION['flashed_messages']) > 0) {
    $flashed_messages = $_SESSION['flashed_messages'];
    unset($_SESSION['flashed_messages']);
}


//if editing previous comment

$prev_id = "";

if(isset($_GET['id'])) {

    //get info for pre-filling form with old info

    $prev_id = $_GET['id'];
    $prev_comment = select_one(
        "SELECT *
        FROM `comments`
        WHERE `id` = $prev_id"
    );
    $comment->fillFromArray(['text' => $prev_comment->text, 'author' => $prev_comment->author]);
    
    //get hidden form attribute to existing ID


}


// retrieve stored comments

$results = select(
    "SELECT *
    FROM `comments`
    ORDER BY `id` DESC"
);

var_dump($results);






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Disney buys Star Wars maker Lucasfilm from George Lucas | BBC News</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <article>

        <div class="img">
            <img src="img/article.jpg" alt="Disney buys Star Wars maker Lucasfilm from George Lucas">
        </div>

        <h1>Disney buys Star Wars maker Lucasfilm from George Lucas</h1>

        <p class="story">Disney is buying Lucasfilm, the company behind the Star Wars films, from its chairman and founder George Lucas for $4.05bn (£2.5bn).</p>

        <p>Mr Lucas said: "It's now time for me to pass Star Wars on to a new generation of film-makers."</p>

        <p>In a statement announcing the purchase, Disney said it planned to release a new Star Wars film, episode seven, in 2015.</p>

        <p>That will be followed by episodes eight and nine and then one new movie every two or three years, the company said.</p>

    </article>

    <div class="comments">

        <h2>Comment below:</h2>


        <form id="form" class="form" action="handle-form.php" method="post">

            <div class="flashed">
                <?php

                foreach ($flashed_messages as $msg) {
                    echo "<div><strong>" . $msg . "</strong></div>";
                }

                ?>
            </div>

            <input type="hidden" name="edit" value=<?= $prev_id ?>>
            <label for="">Author</label><input type="text" name="author" value=<?= $comment->author ?>>
            <label for="">Comment text</label>
            <textarea name="text" id="" cols="30" rows="10"><?= $comment->text ?></textarea>
            <input type="submit" value="submit">
        </form>

    </div>

    <?php foreach($results as $msg) :  ?> 

    <div class="comment">
        <div class="poster">
            <p>author: <?= $msg->author ?></p>
            <p>posted at: <?= $msg->created_at ?></p>
        </div>
        <div class="post">
            <p><?= $msg->text ?></p>
        </div>
        <div class="edit">
            <a href="index.php?id=<?= $msg->id ?>#form"><button>edit</button></a>
        </div>
    </div>

    <?php endforeach; ?>



</body>

</html>