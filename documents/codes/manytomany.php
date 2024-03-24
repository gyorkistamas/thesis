public function Students(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'course_students');
}