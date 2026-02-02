<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | MyBlog</title>
    <style>
        :root{
            --bg:#0b1220; --card:rgba(255,255,255,.06); --border:rgba(255,255,255,.12);
            --text:#e7eefc; --muted:rgba(231,238,252,.70); --brand:#7c5cff;
            --shadow:0 18px 60px rgba(0,0,0,.40);
        }
        *{box-sizing:border-box;}
        body{
            margin:0; min-height:100vh;
            display:grid; place-items:center;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
            background:
              radial-gradient(900px 500px at 10% 0%, rgba(124,92,255,.28), transparent 55%),
              radial-gradient(900px 500px at 90% 20%, rgba(34,197,94,.18), transparent 55%),
              var(--bg);
            color:var(--text);
            padding:20px;
        }
        .wrap{width:min(460px, 100%);}
        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:18px;
            box-shadow:var(--shadow);
            padding:18px;
            backdrop-filter: blur(10px);
        }
        .top{display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:10px;}
        .logo{font-weight:900; letter-spacing:.2px;}
        .sub{color:var(--muted); font-size:.95rem; margin-top:6px;}
        .field{display:flex; flex-direction:column; gap:8px; margin-top:12px;}
        label{font-weight:700; font-size:.9rem; color:var(--muted);}
        input{
            padding:12px 12px;
            border-radius:14px;
            border:1px solid var(--border);
            background: rgba(0,0,0,.18);
            color:var(--text);
            outline:none;
        }
        input:focus{border-color: rgba(124,92,255,.65); box-shadow: 0 0 0 4px rgba(124,92,255,.18);}
        .btn{
            width:100%;
            margin-top:14px;
            padding:12px 14px;
            border:1px solid rgba(124,92,255,.35);
            border-radius:14px;
            background: linear-gradient(135deg, rgba(124,92,255,.95), rgba(56,189,248,.70));
            color:white;
            font-weight:900;
            cursor:pointer;
        }
        .btn:hover{filter:brightness(1.05);}
        .link{color:rgba(231,238,252,.85); text-decoration:none; font-weight:800;}
        .link:hover{text-decoration:underline;}
        .error{
            margin-top:10px;
            padding:10px 12px;
            border-radius:14px;
            border:1px solid rgba(248,113,113,.35);
            background: rgba(248,113,113,.10);
            color:#fecaca;
        }
        .hint{color:var(--muted); font-size:.9rem; margin-top:10px;}
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <div class="top">
            <div>
                <div class="logo">Create account</div>
                <div class="sub">Join MyBlog and start writing posts.</div>
            </div>
            <a class="link" href="{{ url('/') }}">Home</a>
        </div>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="field">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
            </div>

            <div class="field">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Min 6 characters" required>
            </div>

            <div class="field">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Re-enter password" required>
            </div>

            <button class="btn" type="submit">Create account</button>

            <div class="hint">
                Already have an account?
                <a class="link" href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
