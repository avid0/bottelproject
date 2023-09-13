<?php
namespace Models;

use Bottel\Database\MenuableModel;

class Group extends MenuableModel {
    protected $fillable = [
        'id',
        'title',
    ];
}
?>