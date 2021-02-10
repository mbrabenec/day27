<?php

class Comment
{
    public $id = null;
    public $author = null;
    public $text = null;
    public $created_at = null;

    public function fillFromArray($array)
    {
        $this->author = $array['author'];
        $this->text = $array['text'];
    }

    public function insert() 
    {
        $query = "
        INSERT
        INTO `comments`
        (`author`, `text`, `created_at`)
        VALUES
        (?, ?, ?)
        ";

        insert($query, [
            $this->author,
            $this->text,
            $this->created_at = date('Y-m-d H:i:s')

        ]);

        $this->id = last_insert_id();
        return $this->id;

    }

    public function update() 
    {
        $query = "
        UPDATE `comments`
        SET     `author` = ?, 
                `text` = ?,
                `created_at` = ?
        WHERE `id` = $this->id
        ";

        update($query, [
            $this->author,
            $this->text,
            $this->created_at = date('Y-m-d H:i:s')

        ]);

        return $this->id;

    }









}
