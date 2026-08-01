Schema::create('posts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->text('caption');

    $table->string('image');

    $table->timestamps();
});
