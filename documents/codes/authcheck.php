if (Auth::user()->cannot('create', Subject::class)) {
    toast()->danger(__('general.noPermission', __('general.error')))->push();

    return;
}