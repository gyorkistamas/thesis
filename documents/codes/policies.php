public function before()
{
    if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
        return true;
    }
    return null;
}

public function viewAny(User $user): bool
{
    return true;
}

public function create(User $user): bool
{
    return false;
}