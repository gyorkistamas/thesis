public function Courses(): HasMany
{
    return $this->hasMany(Course::class);
}