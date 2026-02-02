<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile — MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root{
            --bg:#0b1220;
            --panel:rgba(255,255,255,.06);
            --border:rgba(255,255,255,.12);
            --text:#e7eefc;
            --muted:rgba(231,238,252,.72);
            --brand:#7c5cff;
            --shadow:0 18px 60px rgba(0,0,0,.4);
        }

        *{box-sizing:border-box;margin:0;padding:0;}
        body{
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
            background:
              radial-gradient(900px 500px at 10% 0%, rgba(124,92,255,.25), transparent 55%),
              radial-gradient(900px 500px at 90% 20%, rgba(34,197,94,.18), transparent 55%),
              var(--bg);
            color:var(--text);
        }
        a{color:inherit;text-decoration:none;}

        /* PAGE */
        .wrap{max-width:1100px; margin:70px auto; padding:0 20px;}
        .hero{
            max-width:900px;
            margin:0 auto 26px;
        }
        .hero h1{font-size:2.6rem; line-height:1.15;}
        .hero p{margin-top:12px; color:var(--muted); font-size:1.05rem;}

        .grid{
            display:grid;
            grid-template-columns: 1.1fr .9fr;
            gap:18px;
            align-items:start;
        }

        .card{
            background:var(--panel);
            border:1px solid var(--border);
            border-radius:20px;
            padding:22px;
            box-shadow:var(--shadow);
        }

        .card h2{font-size:1.35rem;}
        .card p{color:var(--muted); margin-top:8px;}

        /* FLASH + ERRORS */
        .alert{
            margin-top:14px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(34,197,94,.35);
            background: rgba(34,197,94,.10);
            color:#bbf7d0;
            font-weight:800;
        }
        .errors{
            margin-top:14px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(239,68,68,.35);
            background: rgba(239,68,68,.10);
            color:#fecaca;
        }
        .errors ul{margin-left:18px; margin-top:6px;}
        .errors li{margin:4px 0;}

        /* PROFILE HEADER */
        .profile-head{
            display:flex;
            gap:14px;
            align-items:center;
            padding:14px;
            border-radius:18px;
            border:1px solid var(--border);
            background:rgba(0,0,0,.18);
        }
        .avatar{
            width:58px; height:58px;
            border-radius:999px;
            display:flex;
            align-items:center; justify-content:center;
            font-weight:900;
            color:#0b1220;
            background: linear-gradient(135deg, rgba(124,92,255,.95), rgba(56,189,248,.75));
            box-shadow:0 10px 30px rgba(0,0,0,.35);
            flex:0 0 auto;
        }
        .who h3{
            font-size:1.2rem;
            font-weight:900;
        }
        .who .meta{
            margin-top:6px;
            color:var(--muted);
            font-size:.95rem;
        }
        .badge{
            display:inline-block;
            margin-top:8px;
            padding:6px 10px;
            border-radius:999px;
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--muted);
            font-size:.85rem;
        }

        /* FORM */
        .form{margin-top:14px; display:flex; flex-direction:column; gap:12px;}
        .row{display:grid; grid-template-columns:1fr 1fr; gap:12px;}
        label{font-size:.9rem; font-weight:800; color:var(--muted);}

        .input{
            width:100%;
            margin-top:6px;
            padding:12px 12px;
            border-radius:14px;
            border:1px solid var(--border);
            background:rgba(0,0,0,.18);
            color:var(--text);
            outline:none;
        }
        .input:focus{
            border-color:rgba(124,92,255,.65);
            box-shadow:0 0 0 4px rgba(124,92,255,.18);
        }

        .help{
            color:var(--muted);
            font-size:.92rem;
            margin-top:6px;
            line-height:1.4;
        }

        .actions{
            display:flex;
            gap:10px;
            align-items:center;
            margin-top:6px;
            justify-content:flex-end;
        }

        .btn{
            border:1px solid rgba(124,92,255,.35);
            background:linear-gradient(135deg, rgba(124,92,255,.95), rgba(56,189,248,.70));
            color:white;
            font-weight:900;
            padding:12px 14px;
            border-radius:14px;
            cursor:pointer;
        }
        .btn:hover{filter:brightness(1.05);}

        .btn-outline{
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--text);
            font-weight:900;
            padding:12px 14px;
            border-radius:14px;
            cursor:pointer;
        }
        .btn-outline:hover{background:rgba(255,255,255,.10);}

        /* SIDE INFO */
        .info{display:flex; flex-direction:column; gap:12px; margin-top:14px;}
        .info-item{
            padding:14px;
            border-radius:16px;
            border:1px solid var(--border);
            background:rgba(0,0,0,.18);
        }
        .info-item .title{font-weight:900;}
        .info-item .sub{color:var(--muted); margin-top:6px; line-height:1.4;}

        @media (max-width: 900px){
            .grid{grid-template-columns:1fr;}
            .row{grid-template-columns:1fr;}
            .hero h1{font-size:2.2rem;}
            .actions{justify-content:stretch;}
            .actions .btn, .actions .btn-outline{width:100%;}
        }
    </style>
</head>
<body>

@include('common.header')

<div class="wrap">
    <div class="hero">
        <h1>Your Profile</h1>
        <p>Update your personal details and keep your account secure.</p>
    </div>

    <div class="grid">
        {{-- LEFT: PROFILE + EDIT --}}
        <div class="card">
            <h2>Profile Details</h2>
            <p>Your public name and account info.</p>

            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="errors">
                    <strong>Please fix these errors:</strong>
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="profile-head" style="margin-top:14px;">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="who">
                    <h3>{{ Auth::user()->name ?? 'User' }}</h3>
                    <div class="meta">{{ Auth::user()->email ?? '' }}</div>
                    <span class="badge">Member</span>
                </div>
            </div>

            <form class="form" method="POST" action="{{ url('/profile') }}">
                @csrf

                <div class="row">
                    <div>
                        <label>Full Name
                            <input class="input" type="text" name="name"
                                   value="{{ old('name', Auth::user()->name ?? '') }}"
                                   placeholder="Your name" required>
                        </label>
                    </div>
                    <div>
                        <label>Email
                            <input class="input" type="email" name="email"
                                   value="{{ old('email', Auth::user()->email ?? '') }}"
                                   placeholder="you@example.com" required>
                        </label>
                    </div>
                </div>

                <div>
                    <label>Bio (optional)
                        <input class="input" type="text" name="bio"
                               value="{{ old('bio', Auth::user()->bio ?? '') }}"
                               placeholder="Short bio about you...">
                    </label>
                    <div class="help">Example: “Writer • Laravel learner • Tech enthusiast”</div>
                </div>

                <div class="actions">
                    <a class="btn-outline" href="{{ url('/dashboard') }}">Back to Dashboard</a>
                    <button class="btn" type="submit">Save Changes</button>
                </div>
            </form>
        </div>

        {{-- RIGHT: SECURITY --}}
        <div class="card">
            <h2>Security</h2>
            <p>Change your password and keep your account safe.</p>

            <form class="form" method="POST" action="{{ url('/profile/password') }}">
                @csrf

                <div>
                    <label>Current Password
                        <input class="input" type="password" name="current_password" placeholder="••••••••" required>
                    </label>
                </div>

                <div class="row">
                    <div>
                        <label>New Password
                            <input class="input" type="password" name="password" placeholder="New password" required>
                        </label>
                    </div>
                    <div>
                        <label>Confirm New Password
                            <input class="input" type="password" name="password_confirmation" placeholder="Confirm" required>
                        </label>
                    </div>
                </div>

                <div class="help">Use 8+ characters with numbers and symbols for stronger security.</div>

                <div class="actions">
                    <button class="btn" type="submit">Update Password</button>
                </div>
            </form>

            <div class="info">
                <div class="info-item">
                    <div class="title">🔒 Tip</div>
                    <div class="sub">Never reuse passwords from other websites.</div>
                </div>
                <div class="info-item">
                    <div class="title">✅ Recommended</div>
                    <div class="sub">Turn on “remember me” only on your own devices.</div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
