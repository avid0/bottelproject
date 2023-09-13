<?php
use Dotenv\Dotenv;
use Bottel\Api;
use Illuminate\Database\Capsule\Manager as Capsule;
use Bottel\Keyboard;

// config
Dotenv::createImmutable(dirname(__DIR__))->load();

// Api
$bot = new Api;
$bot->owner = config("BOT_OWNER");
$update = $bot->update();
$bot->dateout(10);
$bot->bootAsGlobal();

// Models
$capsule = new Capsule;
$capsule->addConnection([
    "driver" => env("DB_CONNECTION"),
    "host" => env("DB_HOST"),
    "database" => env("DB_DATABASE"),
    "username" => env("DB_USERNAME"),
    "password" => env("DB_PASSWORD"),
    "charset" => "utf8mb4",
    "collation" => "utf8mb4_persian_ci",
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// resources
$bot->keyboard->setAsGlobal();
$keyboards = glob("../resources/keyboard/*.php");
$menus = glob("../resources/menu/*.php");
foreach($keyboards as $file){
    $base = basename($file);
    $name = basename($base);
    $type = pathinfo($base, PATHINFO_EXTENSION);
    $keyboard = include $file;
    if(is_array($keyboard)){
        switch(strtolower($type)){
            case 'keyboard':
                Keyboard::keyboard($name, $keyboard);
            break;
            case 'inline_keyboard':
                Keyboard::inlineKeyboard($name, $keyboard);
            break;
            case 'row':
                Keyboard::row($name, $keyboard);
            break;
            case 'text_button':
                Keyboard::textButton($name, $keyboard);
            break;
        }
    }
}
foreach($menus as $file){
    $name = basename($file);
    $menu = include $file;
    if(is_array($menu)){
        Keyboard::menu($name, $menu);
    }
}

?>