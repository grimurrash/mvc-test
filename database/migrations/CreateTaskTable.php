<?php

namespace Migrations;

use Illuminate\Database\Capsule\Manager;

class CreateTaskTable
{
    public static function up(): void
    {
        Manager::schema()->create('orders', function ($table) {
            $table->id();
            $table->string('user_name');
            $table->string('email');
            $table->text('description');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }
}
