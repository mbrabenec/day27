<?php

class Computer
{
    public $model = null;
    public $operating_system = null;
    public $is_portable = false;
    public $status = 'off';

    public function toggleSwitch() 
    {
        $this->status = ($this->status === "on") ? "off" : "on"; 
    }

}

$my_computer = new Computer;

$my_computer->model = "Apple";
$my_computer->operating_system = "OSX";
$my_computer->is_portable = false;
$my_computer->status = "on";


$my_computer->toggleSwitch()
;?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>My computer</h1>
<table>
    <tr><th>Model:</th><td><?= $my_computer->model ?></td></tr>
    <tr><th>OS:</th><td><?= $my_computer->operating_system ?></td></tr>
    <tr><th>Portable:</th><td><?= ($my_computer->is_portable) ? "yes" : "no" ?></td></tr>
    <tr><th>Status:</th><td>switched <?= $my_computer->status ?></td></tr>
</table>

</body>
</html>











