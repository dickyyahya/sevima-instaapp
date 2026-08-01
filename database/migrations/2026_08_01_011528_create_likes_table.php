Schema::create('likes', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained();

    $table->foreignId('post_id')->constrained();

    $table->timestamps();
});
