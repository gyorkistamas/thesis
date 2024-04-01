Schema::create('courses', function (Blueprint $table) {
    $table->id();
    $table->string('course_id');
    $table->string('description')->nullable();
    $table->string('subject_id');
    $table->foreign('subject_id')->references('id')->on('subjects')->constrained()->cascadeOnDelete();
    $table->foreignId('term_id')->nullable()->constrained()->nullOnDelete();
    $table->integer('course_limit')->default(20);
    $table->timestamps();
});