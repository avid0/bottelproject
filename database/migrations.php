<?php
require_once "../vendor/autoload.php";
require_once "../config/boot.php";

use Illuminate\Database\Capsule\Manager as Capsule;

if((isset($argv[1]) && $argv[1] == 'migrate') || (isset($_GET['cmd']) && $_GET['cmd'] == 'migrate')){
    $schema = Capsule::schema();
    
    $schema->dropIfExists('users');
    $schema->create('users', function($table){
        $table->bigInteger('id')->primary();
        $table->string('first_name');
        $table->string('last_name')->nullable();
        $table->string('username')->nullable();
        $table->string('step')->nullable();
        $table->string('lang')->default('en');
        $table->timestamps();
    });
    
    $schema->dropIfExists('groups');
    $schema->create('groups', function($table){
        $table->bigInteger('id')->primary();
        $table->string('title');
        $table->string('step')->nullable();
        $table->string('lang')->default('en');
        $table->timestamps();
    });

    $schema->dropIfExists('caches');
    $schema->create('caches', function($table){
        $table->id();
        $table->string('key');
        $table->longText('value');
        $table->string('for')->nullable();
        $table->datetime('expiry_time')->nullable();
        $table->timestamps();
    });

    $schema->dropIfExists('callbackcaches');
    $schema->create('callbackcaches', function($table){
        $table->id();
        $table->string('step')->nullable(); // user step identify
        $table->string('type');             // callback|text|step
        $table->string('text')->nullable(); // text|data|null
        $table->string('for')->nullable();
        $table->longText('callback');
        $table->timestamps();
    });

    $schema->dropIfExists('langcaches');
    $schema->create('langcaches', function($table){
        $table->id();
        $table->string('key');
        $table->longText('value');
        $table->string('lang');
        $table->timestamps();
    });
    
    print "Migration successfully runned" . PHP_EOL;
}


?>