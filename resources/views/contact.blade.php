<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact — MyBlog</title>
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

        /* NAV */
        .home-nav{
            position:sticky; top:0; z-index:1000;
            background:rgba(11,18,32,.82);
            backdrop-filter:blur(10px);
            border-bottom:1px solid var(--border);
        }
        .nav-inner{
            max-width:1200px; margin:0 auto;
            padding:14px 20px;
            display:flex; align-items:center; justify-content:space-between;
        }
        .logo{
            font-size:1.4rem; font-weight:900;
            background:linear-gradient(135deg,var(--brand),#38bdf8);
            -webkit-background-clip:text; color:transparent;
        }
        .nav-links{display:flex; gap:18px; list-style:none; align-items:center;}
        .nav-links a{color:var(--muted); font-weight:700; transition:.2s; padding:6px 10px; border-radius:10px;}
        .nav-links a:hover{color:#fff; background:rgba(255,255,255,.06);}
        .btn-outline{border:1px solid var(--border);}
        .btn-primary{
            background:linear-gradient(135deg,var(--brand),#38bdf8);
            color:white !important;
        }

        /* PAGE */
        .wrap{max-width:1100px; margin:80px auto; padding:0 20px;}
        .hero{
            text-align:center;
            max-width:760px;
            margin:0 auto 40px;
        }
        .hero h1{font-size:3rem; line-height:1.1;}
        .hero p{margin-top:14px; color:var(--muted); font-size:1.05rem;}

        .grid{
            display:grid;
            grid-template-columns: 1.2fr .8fr;
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

        .card h2{font-size:1.4rem;}
        .card p{color:var(--muted); margin-top:8px;}

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
        .input:focus{border-color:rgba(124,92,255,.65); box-shadow:0 0 0 4px rgba(124,92,255,.18);}
        textarea.input{min-height:140px; resize:vertical;}

        .actions{display:flex; gap:10px; align-items:center; margin-top:6px;}
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
        .hint{color:var(--muted); font-size:.92rem;}

        /* INFO BOX */
        .info{display:flex; flex-direction:column; gap:12px; margin-top:14px;}
        .info-item{
            padding:14px;
            border-radius:16px;
            border:1px solid var(--border);
            background:rgba(0,0,0,.18);
        }
        .info-item .title{font-weight:900;}
        .info-item .sub{color:var(--muted); margin-top:6px; line-height:1.4;}

        .badge{
            display:inline-block;
            margin-top:10px;
            padding:6px 10px;
            border-radius:999px;
            border:1px solid var(--border);
            background:rgba(255,255,255,.06);
            color:var(--muted);
            font-size:.85rem;
        }

        /* FLASH */
        .alert{
            margin-top:14px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(34,197,94,.35);
            background: rgba(34,197,94,.10);
            color:#bbf7d0;
            font-weight:800;
        }

        footer{
            border-top:1px solid var(--border);
            margin-top:90px;
            padding:35px 20px;
            text-align:center;
            color:var(--muted);
        }

        @media (max-width: 900px){
            .grid{grid-template-columns:1fr;}
            .row{grid-template-columns:1fr;}
            .hero h1{font-size:2.4rem;}
        }
    </style>
</head>
<body>
@include('common.header')

<div class="wrap">
    <div class="hero">
        <h1>Contact Us</h1>
        <p>
            Have a question, feedback, or want to work together?
            Send us a message — we usually reply within 24–48 hours.
        </p>
    </div>

    <div class="grid">
        {{-- CONTACT FORM --}}
        <div class="card">
            <h2>Send a message</h2>
            <p>Fill the form below and we’ll get back to you.</p>

            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <form class="form" method="POST" action="{{ url('/contact') }}">
                @csrf

                <div class="row">
                    <div>
                        <label>Full Name
                            <input class="input" type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required>
                        </label>
                    </div>
                    <div>
                        <label>Email
                            <input class="input" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                        </label>
                    </div>
                </div>

                <div>
                    <label>Subject
                        <input class="input" type="text" name="subject" value="{{ old('subject') }}" placeholder="What is this about?" required>
                    </label>
                </div>

                <div>
                    <label>Message
                        <textarea class="input" name="message" placeholder="Write your message..." required>{{ old('message') }}</textarea>
                    </label>
                </div>

                <div class="actions">
                    <button class="btn" type="submit">Send Message</button>
                    <span class="hint">We never share your email.</span>
                </div>
            </form>
        </div>

        {{-- CONTACT INFO --}}
        <div class="card">
            <h2>Quick Info</h2>
            <p>Other ways to reach us.</p>

            <div class="info">
                <div class="info-item">
                    <div class="title">📩 Email</div>
                    <div class="sub">support@myblog.com</div>
                    <span class="badge">Response: 24–48 hrs</span>
                </div>

                <div class="info-item">
                    <div class="title">💼 Business</div>
                    <div class="sub">Partnerships, ads, and collaborations.</div>
                    <span class="badge">business@myblog.com</span>
                </div>

                <div class="info-item">
                    <div class="title">📍 Location</div>
                    <div class="sub">Remote-first team. Available worldwide.</div>
                    <span class="badge">Mon–Fri</span>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    © {{ date('Y') }} MyBlog. Built for creators worldwide.
</footer>

</body>
</html>
