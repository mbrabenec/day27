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

        if (array_key_exists('created_at', $array)) {
            $this->created_at = $array['created_at'];
        }
    }

    public function save() 
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->id = insert($this);  //DBBox!!!!!!!!!!
        return $this->id;

    }
}
