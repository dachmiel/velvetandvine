<?php

namespace VelvetAndVine\Models;

class Top
{
    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($id, $name, $description, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}
