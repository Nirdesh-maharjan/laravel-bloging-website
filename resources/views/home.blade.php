<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyBlog — Write. Share. Inspire.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root{
            --bg:#0b1220;
            --panel:rgba(255,255,255,.06);
            --border:rgba(255,255,255,.12);
            --text:#e7eefc;
            --muted:rgba(231,238,252,.7);
            --brand:#7c5cff;
            --brand2:#22c55e;
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

        /* ================= NAVBAR ================= */
        .home-nav{
            position:sticky;
            top:0;
            z-index:1000;
            background:rgba(11,18,32,.8);
            backdrop-filter:blur(10px);
            border-bottom:1px solid var(--border);
        }

        .nav-inner{
            max-width:1200px;
            margin:0 auto;
            padding:14px 20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-size:1.4rem;
            font-weight:900;
            letter-spacing:.3px;
            background:linear-gradient(135deg,var(--brand),#38bdf8);
            -webkit-background-clip:text;
            color:transparent;
        }

        .nav-links{
            display:flex;
            gap:20px;
            list-style:none;
        }

        .nav-links a{
            color:var(--muted);
            font-weight:600;
            transition:.2s;
        }

        .nav-links a:hover{
            color:white;
        }

        .btn-outline{
            border:1px solid var(--border);
            padding:8px 14px;
            border-radius:12px;
        }

        .btn-primary{
            background:linear-gradient(135deg,var(--brand),#38bdf8);
            padding:9px 16px;
            border-radius:14px;
            font-weight:800;
        }

        /* ================= HERO ================= */
        .hero{
            max-width:1200px;
            margin:80px auto;
            padding:0 20px;
            display:grid;
            grid-template-columns:1.2fr .8fr;
            gap:40px;
            align-items:center;
        }

        .hero h1{
            font-size:3rem;
            line-height:1.15;
        }

        .hero p{
            margin-top:16px;
            color:var(--muted);
            font-size:1.05rem;
        }

        .hero-actions{
            margin-top:26px;
            display:flex;
            gap:14px;
        }

        /* ================= FOUR IDEAS ================= */
        .ideas{
            max-width:1200px;
            margin:120px auto;
            padding:0 20px;
            display:grid;
            gap:40px;
        }

        .idea-row{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:30px;
            align-items:center;
        }

        .idea-card{
            background:var(--panel);
            border:1px solid var(--border);
            border-radius:20px;
            padding:28px;
            box-shadow:var(--shadow);
        }

        .idea-card h3{
            font-size:1.5rem;
        }

        .idea-card p{
            margin-top:10px;
            color:var(--muted);
        }

        .idea-tag{
            display:inline-block;
            margin-bottom:8px;
            font-size:.8rem;
            letter-spacing:.12em;
            text-transform:uppercase;
            opacity:.8;
        }

        /* ================= FOOTER ================= */
        footer{
            border-top:1px solid var(--border);
            margin-top:120px;
            padding:40px 20px;
            text-align:center;
            color:var(--muted);
        }

        @media(max-width:900px){
            .hero{grid-template-columns:1fr;}
            .idea-row{grid-template-columns:1fr;}
        }
    </style>
</head>

<body>

{{-- ================= NAVBAR ================= --}}
<nav class="home-nav">
    <div class="nav-inner">
        <a class="logo" href="{{ url('/') }}">MyBlog</a>

        <ul class="nav-links">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/') }}">Blog</a></li>
            <li><a class="btn-outline" href="{{ route('login') }}">Login</a></li>
            <li><a class="btn-primary" href="{{ route('register') }}">Sign Up</a></li>
        </ul>
    </div>
</nav>

{{-- ================= HERO ================= --}}
<section class="hero">
    <div>
        <h1>Write stories that matter.<br>Build your audience.</h1>
        <p>
            MyBlog is a modern publishing platform where writers, developers,
            and creators share ideas, tutorials, and inspiration.
        </p>

        <div class="hero-actions">
            <a class="btn-primary" href="{{ route('register') }}">Start Writing</a>
            <a class="btn-outline" href="{{ url('/blog') }}">Explore Posts</a>
        </div>
    </div>

    <div class="idea-card">
        <h3>🔥 Trending This Week</h3>
        <p>Laravel productivity hacks · Writing viral headlines · SEO basics · Monetizing blogs</p>
    </div>
</section>

{{-- ================= FOUR IDEAS ================= --}}
<section class="ideas">

    <div class="idea-row">
        <div class="idea-card">
            <span class="idea-tag">Create</span>
            <h3>Write & Publish Instantly</h3>
            <p>Powerful editor, drafts, scheduling, and markdown support — everything to publish fast.</p>
        </div>
        <div class="idea-card">
            <span class="idea-tag">Grow</span>
            <h3>Reach Thousands of Readers</h3>
            <p>Built-in SEO tools, analytics, and featured posts help your writing travel far.</p>
        </div>
    </div>

    <div class="idea-row">
        <div class="idea-card">
            <span class="idea-tag">Connect</span>
            <h3>Engage With Community</h3>
            <p>Comments, likes, bookmarks, and followers help you build loyal fans.</p>
        </div>
        <div class="idea-card">
            <span class="idea-tag">Earn</span>
            <h3>Monetize Your Content</h3>
            <p>Subscriptions, sponsorships, and premium posts give creators sustainable income.</p>
        </div>
    </div>

</section>

{{-- ================= FOOTER ================= --}}
<footer>
    © {{ date('Y') }} MyBlog. Built for creators worldwide.
</footer>

</body>
</html>
