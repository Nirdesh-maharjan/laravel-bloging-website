{{-- resources/views/users/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

@include('common.header')

@push('page-content')
<div class="card" style="margin-top:18px;">
    <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; align-items:center;">
        <div>
            <h2 style="margin-bottom:6px;">Users</h2>
            <p style="color:var(--muted); margin:0;">All registered users and their post count.</p>
        </div>
    </div>

    <div class="table" style="margin-top:14px;">
        <div class="t-head">
            <div>Name</div>
            <div>Email</div>
            <div>Posts</div>
            <div>Joined</div>
        </div>

        @forelse($users as $user)
            <div class="t-row">
                <div class="t-title">{{ $user->name }}</div>
                <div class="t-muted">{{ $user->email }}</div>
                <div>
                    <span class="pill">{{ $user->posts_count }}</span>
                </div>
                <div class="t-muted">{{ $user->created_at->format('Y-m-d') }}</div>
            </div>
        @empty
            <div class="t-empty">No users found.</div>
        @endforelse
    </div>

    <div style="margin-top:14px;">
        {{ $users->links() }}
    </div>
</div>
@endpush

@include('common.inner')

</body>
</html>
