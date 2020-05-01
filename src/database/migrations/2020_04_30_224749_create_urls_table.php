<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Builder;

class CreateUrlsTable extends Migration
{
    private const TABLE = 'urls';
    
    private Builder $schema;
    
    public function __construct()
    {
        $manager = app(DatabaseManager::class);
        $this->schema = $manager->getSchemaBuilder();
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->string('keyword')->index()->unique();
            $table->boolean('private')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->string('description', 140)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists(self::TABLE);
    }
}
