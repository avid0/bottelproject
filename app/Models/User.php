<?php
namespace Models;

use Bottel\Database\MenuableModel;

class User extends MenuableModel {
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
    ];
}
?>
