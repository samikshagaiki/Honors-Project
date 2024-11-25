<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskMgmtTableV2 extends Migration
{
    
    public function up()
    {
        Schema::create('task_mgmt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User reference
            $table->string('title'); // Title field
            $table->text('description')->nullable(); // Optional description
            $table->date('due_date'); // Due date
            $table->enum('priority', ['Low', 'Medium', 'High']); // Priority levels
            $table->boolean('is_completed')->default(false); // Completion status
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('task_mgmt');
    }
}
