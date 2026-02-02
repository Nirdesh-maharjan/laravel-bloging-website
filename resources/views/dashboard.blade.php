{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

@include('common.header')

@push('page-content')
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="card" style="margin-top:18px;">
        <h2 style="margin-bottom:12px;">Latest Posts</h2>

        <div class="table">
            <div class="t-head">
                <div>Title</div>
                <div>Status</div>
                <div>Created</div>
            </div>

            @forelse($posts as $post)
                <div class="t-row">
                    <div class="t-title">{{ $post->title }}</div>
                    <div>
                        <span class="status {{ $post->status }}">{{ ucfirst($post->status) }}</span>
                    </div>
                    <div class="t-muted">{{ $post->created_at->format('Y-m-d') }}</div>
                </div>
            @empty
                <div class="t-empty">No posts yet.</div>
            @endforelse
        </div>
    </div>
@endpush

{{-- IMPORTANT: include inner AFTER push --}}
@include('common.inner')

</body>
</html>
