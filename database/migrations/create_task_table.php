<?php

use Illuminate\Database\Capsule\Manager;

class CreateTaskTable
{
    public static function up(): void
    {
        Manager::schema()->create('orders', function ($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}
