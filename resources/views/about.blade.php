<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About — MyBlog</title>
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

        /* NAVBAR */
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

        .nav-links a:hover{color:white;}

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

        /* PAGE HERO */
        .page-hero{
            max-width:900px;
            margin:90px auto;
            padding:0 20px;
            text-align:center;
        }

        .page-hero h1{
            font-size:3rem;
        }

        .page-hero p{
            margin-top:16px;
            color:var(--muted);
            font-size:1.05rem;
        }

        /* STORY / MISSION */
        .section{
            max-width:1100px;
            margin:120px auto;
            padding:0 20px;
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:50px;
            align-items:center;
        }

        .card{
            background:var(--panel);
            border:1px solid var(--border);
            border-radius:20px;
            padding:28px;
            box-shadow:var(--shadow);
        }

        .card h3{font-size:1.6rem;}
        .card p{margin-top:12px;color:var(--muted);}

        /* VALUES */
        .values{
            max-width:1100px;
            margin:120px auto;
            padding:0 20px;
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:26px;
        }

        .value{
            background:var(--panel);
            border:1px solid var(--border);
            border-radius:18px;
            padding:24px;
            box-shadow:var(--shadow);
        }

        .value h4{font-size:1.25rem;}
        .value p{margin-top:10px;color:var(--muted);}

        /* CTA */
        .cta{
            max-width:900px;
            margin:140px auto;
            padding:50px 30px;
            text-align:center;
            background:linear-gradient(135deg,rgba(124,92,255,.25),rgba(56,189,248,.18));
            border:1px solid var(--border);
            border-radius:26px;
        }

        .cta h2{font-size:2.2rem;}
        .cta p{margin-top:12px;color:var(--muted);}

        footer{
            border-top:1px solid var(--border);
            padding:40px 20px;
            text-align:center;
            color:var(--muted);
        }

        @media(max-width:900px){
            .section{grid-template-columns:1fr;}
            .values{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>

@include('common.header')

{{-- HERO --}}
<section class="page-hero">
    <h1>About MyBlog</h1>
    <p>
        We believe everyone has a story worth sharing.  
        MyBlog exists to empower creators, developers, and thinkers worldwide.
    </p>
</section>

{{-- STORY / MISSION --}}
<section class="section">
    <div class="card">
        <h3>Our Story</h3>
        <p>
            MyBlog began as a small side project among writers who wanted a cleaner,
            faster way to publish meaningful content online.
            Today, it’s a growing community where thousands share tutorials,
            opinions, and insights every day.
        </p>
    </div>

    <div class="card">
        <h3>Our Mission</h3>
        <p>
            Our mission is simple: make publishing accessible, powerful,
            and rewarding for everyone.
            We focus on thoughtful design, performance, and tools that help
            writers grow real audiences.
        </p>
    </div>
</section>

{{-- VALUES --}}
<section class="values">

    <div class="value">
        <h4>🌍 Open Community</h4>
        <p>We welcome writers of all backgrounds and encourage respectful discussion.</p>
    </div>

    <div class="value">
        <h4>⚡ Performance First</h4>
        <p>Fast loading pages, optimized SEO, and clean UI matter to us.</p>
    </div>

    <div class="value">
        <h4>✍️ Creator Tools</h4>
        <p>Drafting, scheduling, analytics, and monetization tools built for growth.</p>
    </div>

</section>

{{-- CTA --}}
<section class="cta">
    <h2>Join the MyBlog community</h2>
    <p>Start publishing today and grow your voice.</p>

    <div style="margin-top:20px;">
        <a class="btn-primary" href="{{ route('register') }}">Create Account</a>
    </div>
</section>

<footer>
    © {{ date('Y') }} MyBlog. Built for creators worldwide.
</footer>

</body>
</html>
