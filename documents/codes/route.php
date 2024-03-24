Route::middleware(['auth', 'studentorteacher'])->group(function () {
    Route::get('timetable', [Controller::class, 'getTimetable'])
		->name('timetable');
});