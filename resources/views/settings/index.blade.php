{{-- resources/views/settings/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .alert{
            margin-top:14px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(34,197,94,.35);
            background: rgba(34,197,94,.10);
            color:#bbf7d0;
            font-weight:800;
        }

        .grid-settings{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:14px;
            margin-top:14px;
        }
        @media(max-width: 900px){
            .grid-settings{grid-template-columns: 1fr;}
        }

        .section-title{
            font-weight:900;
            margin-bottom:10px;
            font-size:1.1rem;
        }

        .form-group{margin-top:12px;}
        .label{display:block; font-weight:900; color:var(--muted); font-size:.9rem; margin-bottom:6px;}

        .input, textarea, select{
            width:100%;
            padding:10px 14px;
            border-radius:14px;
            border:1px solid var(--border);
            background:rgba(0,0,0,.18);
            color:var(--text);
            outline:none;
        }
        .input:focus, textarea:focus, select:focus{
            border-color:rgba(124,92,255,.65);
            box-shadow:0 0 0 4px rgba(124,92,255,.18);
        }
        textarea{min-height:110px; resize:vertical;}

        .row{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:12px;
        }
        @media(max-width: 700px){
            .row{grid-template-columns: 1fr;}
        }

        .switch{
            display:flex; align-items:center; gap:10px; margin-top:10px;
            color:var(--text);
        }
        .switch input{width:18px; height:18px;}

        .actions{
            display:flex;
            justify-content:flex-end;
            gap:10px;
            margin-top:14px;
        }

        .btn-primary{
            border:1px solid rgba(124,92,255,.35);
            background:linear-gradient(135deg, rgba(124,92,255,.95), rgba(56,189,248,.70));
            color:white;
            font-weight:900;
            padding:10px 16px;
            border-radius:14px;
            cursor:pointer;
        }
        .btn-outline{
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--text);
            font-weight:900;
            padding:10px 16px;
            border-radius:14px;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
        }
        .btn-outline:hover{background:rgba(255,255,255,.10);}

        .help{color:var(--muted); font-size:.9rem; margin-top:6px;}

        /* Try to darken dropdown list in many browsers */
        select option{
            background: #0b1220;
            color: #e7eefc;
        }
    </style>
</head>
<body>

@include('common.header')

@push('page-content')

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="card" style="margin-top:18px;">
    <h2 style="margin-bottom:6px;">Settings</h2>
    <p style="color:var(--muted); margin:0;">Manage your blog configuration and appearance.</p>

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid-settings">

            {{-- GENERAL --}}
            <div class="card">
                <div class="section-title">General</div>

                <div class="form-group">
                    <label class="label">Site name</label>
                    <input class="input" name="site_name" value="{{ old('site_name', $settings->site_name) }}" required>
                </div>

                <div class="form-group">
                    <label class="label">Tagline</label>
                    <input class="input" name="tagline" value="{{ old('tagline', $settings->tagline) }}" placeholder="Short description">
                </div>
            </div>

            {{-- BRANDING --}}
            <div class="card">
                <div class="section-title">Branding</div>

                <div class="row">
                    <div class="form-group">
                        <label class="label">Accent color</label>
                        <input class="input" name="accent_color" value="{{ old('accent_color', $settings->accent_color) }}">
                        <div class="help">Example: #7c5cff</div>
                    </div>

                    <div class="form-group">
                        <label class="label">Logo</label>
                        <input class="input" type="file" name="logo" accept="image/*">
                        <div class="help">Optional. JPG/PNG/WebP</div>
                    </div>
                </div>
            </div>

            {{-- POSTS --}}
            <div class="card">
                <div class="section-title">Posts</div>

                <div class="row">
                    <div class="form-group">
                        <label class="label">Posts per page</label>
                        <input class="input" type="number" name="posts_per_page" min="1" max="50"
                               value="{{ old('posts_per_page', $settings->posts_per_page) }}">
                    </div>

                    <div class="form-group">
                        <label class="label">Guest posting</label>
                        <div class="switch">
                            <input type="checkbox" name="allow_guest_posts" value="1"
                                   {{ old('allow_guest_posts', $settings->allow_guest_posts) ? 'checked' : '' }}>
                            <span>Allow guests to create posts</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COMMENTS --}}
            <div class="card">
                <div class="section-title">Comments</div>

                <div class="switch">
                    <input type="checkbox" name="comments_enabled" value="1"
                           {{ old('comments_enabled', $settings->comments_enabled) ? 'checked' : '' }}>
                    <span>Enable comments</span>
                </div>

                <div class="switch">
                    <input type="checkbox" name="comments_require_approval" value="1"
                           {{ old('comments_require_approval', $settings->comments_require_approval) ? 'checked' : '' }}>
                    <span>Require approval</span>
                </div>
            </div>

            {{-- SEO --}}
            <div class="card">
                <div class="section-title">SEO</div>

                <div class="form-group">
                    <label class="label">Meta title</label>
                    <input class="input" name="meta_title" value="{{ old('meta_title', $settings->meta_title) }}" maxlength="70">
                </div>

                <div class="form-group">
                    <label class="label">Meta description</label>
                    <textarea name="meta_description" maxlength="200">{{ old('meta_description', $settings->meta_description) }}</textarea>
                    <div class="help">Max 200 characters</div>
                </div>
            </div>

            {{-- SOCIAL LINKS --}}
            <div class="card">
                <div class="section-title">Social Links</div>

                <div class="form-group">
                    <label class="label">Facebook</label>
                    <input class="input" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/...">
                </div>

                <div class="form-group">
                    <label class="label">Instagram</label>
                    <input class="input" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/...">
                </div>

                <div class="form-group">
                    <label class="label">Twitter/X</label>
                    <input class="input" name="twitter_url" value="{{ old('twitter_url', $settings->twitter_url) }}" placeholder="https://x.com/...">
                </div>

                <div class="form-group">
                    <label class="label">YouTube</label>
                    <input class="input" name="youtube_url" value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="https://youtube.com/...">
                </div>
            </div>

        </div>

        <div class="actions">
            <a class="btn-outline" href="{{ url('/dashboard') }}">Cancel</a>
            <button class="btn-primary" type="submit">Save Settings</button>
        </div>
    </form>
</div>

@endpush

@include('common.inner')

</body>
</html>
