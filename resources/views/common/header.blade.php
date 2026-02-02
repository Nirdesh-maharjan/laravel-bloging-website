<meta name="csrf-token" content="{{ csrf_token() }}">
<nav class="site-nav" aria-label="Main navigation">
    <div class="container nav-inner">
        <a class="logo" href="{{ url('/dashboard') }}">BLOGING</a>

        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" onclick="document.getElementById('nav-links').classList.toggle('open'); this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true')">
            ☰
        </button>

        <ul id="nav-links" class="nav-links">
            <li><a href="{{ url('/dashboard') }}">Blog</a></li>
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>

        <div class="profile" id="profile">
    <button id="profile-btn"
            class="profile-btn"
            type="button"
            aria-haspopup="true"
            aria-expanded="false"
            aria-controls="profile-menu">
        <span class="avatar" aria-hidden="true">{{ strtoupper(substr(Auth::user()->name ?? 'U',0,1)) }}</span>
        <span class="profile-name">{{ Auth::user()->name ?? '' }}</span>
        <svg class="chevron" width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>

    <div id="profile-menu" class="profile-menu" role="menu" aria-labelledby="profile-btn" hidden>
        <a href="{{ url('/profile') }}" role="menuitem">Profile</a>

        <form method="POST" action="{{ route('logout') }}" role="none">
            @csrf
            <button type="submit" role="menuitem">Logout</button>
        </form>
    </div>
</div>


    </div>
</nav>

<style>
/* ===============================
   ROOT VARIABLES
================================ */
:root {
    --nav-bg: rgba(255,255,255,0.9);
    --nav-border: #e5e7eb;
    --nav-text: #1f2933;
    --nav-muted: #6b7280;
    --nav-accent: #2563eb;
    --nav-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body { margin: 0; }

/* ===============================
   NAVBAR CONTAINER
================================ */
.site-nav {
    position: sticky;
    top: 0;
    z-index: 1000;

    background: var(--nav-bg);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    border-bottom: 1px solid var(--nav-border);
    transition: background 0.25s ease, box-shadow 0.25s ease;
}

.site-nav.scrolled { box-shadow: var(--nav-shadow); }

/* ===============================
   INNER WRAPPER
================================ */
.nav-inner {
    max-width: 1200px;
    margin: 0 auto;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 14px 20px;
}

/* ===============================
   LOGO
================================ */
.logo {
    font-size: 1.35rem;
    font-weight: 800;
    letter-spacing: 0.3px;

    text-decoration: none;
    color: var(--nav-text);

    transition: transform 0.2s ease, color 0.2s ease;
}

.logo:hover {
    color: var(--nav-accent);
    transform: translateY(-1px);
}

/* If you use image logo */
.logo img{
    height: 34px;
    width: auto;
    display:block;
}

/* ===============================
   LINKS
================================ */
.nav-links {
    list-style: none;
    display: flex;
    gap: 18px;
    margin: 0;
    padding: 0;
}

.nav-links a {
    position: relative;
    font-weight: 500;
    color: var(--nav-muted);
    text-decoration: none;
    padding: 8px 6px;
    transition: color 0.2s ease;
}

/* underline animation */
.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 2px;
    background: var(--nav-accent);
    transition: width 0.25s ease;
}

.nav-links a:hover { color: var(--nav-text); }
.nav-links a:hover::after { width: 100%; }

/* Active state */
.nav-links a.active { color: var(--nav-accent); font-weight: 600; }
.nav-links a.active::after { width: 100%; }

/* ===============================
   TOGGLE BUTTON
================================ */
.nav-toggle {
    display: none;
    background: none;
    border: 0;
    font-size: 1.4rem;
    cursor: pointer;
    color: var(--nav-text);
    transition: transform 0.2s ease;
}
.nav-toggle:hover { transform: scale(1.1); }

/* ===============================
   NAV ACTIONS / PROFILE
================================ */
.nav-actions{
    display:flex;
    align-items:center;
    gap:12px;
    position:relative;
}

.auth-links a{
    color:var(--nav-muted);
    text-decoration:none;
    padding:6px 10px;
    border-radius:6px;
}
.auth-links .signup{
    font-weight:700;
    color:var(--nav-text);
    border:1px solid var(--nav-border);
    padding:6px 10px;
    border-radius:8px;
}

.profile{ position:relative; }

/* button */
.profile-btn{
    display:flex;
    align-items:center;
    gap:8px;
    background:none;
    border:1px solid var(--nav-border);
    cursor:pointer;
    padding:6px 10px;
    border-radius:12px;
    color: var(--nav-text);
}
.profile-btn:focus{ outline:2px solid var(--nav-accent); outline-offset:2px; }

.profile-btn .chevron{
    width:16px;
    height:16px;
    display:inline-block;
    transition:transform .2s ease, color .2s ease;
    color:var(--nav-muted);
    margin-left:4px;
}
.profile-btn[aria-expanded="true"] .chevron{
    transform:rotate(180deg);
    color:var(--nav-accent);
}

.avatar{
    width:36px;
    height:36px;
    border-radius:9999px;
    background:#e5e7eb;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:#374151;
    font-weight:700;
}

.profile-name{
    display:inline-block;
    font-weight:600;
    color:var(--nav-text);
}

/* menu */
.profile-menu{
    position:absolute;
    right:0;
    top: calc(100% + 10px);
    min-width:180px;
    background:rgba(255,255,255,0.98);
    border:1px solid var(--nav-border);
    border-radius:12px;
    padding:8px;
    box-shadow:var(--nav-shadow);
    display:flex;
    flex-direction:column;
    gap:6px;
    z-index:1200;
}

/* IMPORTANT: hidden means hidden */
.profile-menu[hidden]{ display:none !important; }

.profile-menu a,
.profile-menu button{
    text-align:left;
    padding:9px 10px;
    border-radius:10px;
    background:none;
    border:0;
    color:var(--nav-text);
    text-decoration:none;
    cursor:pointer;
    font-weight:600;
}

.profile-menu a:hover,
.profile-menu button:hover{
    background:#f3f4f6;
}

/* ===============================
   MOBILE MENU
================================ */
@media (max-width: 768px) {

    .nav-toggle { display: block; }

    .nav-links {
        position: absolute;
        top: 72px;
        right: 20px;
        width: 220px;

        background: white;
        border: 1px solid var(--nav-border);
        border-radius: 12px;

        padding: 10px;

        box-shadow: var(--nav-shadow);

        flex-direction: column;
        gap: 6px;

        opacity: 0;
        transform: translateY(-10px) scale(0.98);
        pointer-events: none;

        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .nav-links.open {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    .nav-links a {
        padding: 10px 12px;
        border-radius: 8px;
    }

    .nav-links a:hover { background: #f3f4f6; }

    .nav-actions{ gap:8px; }
    .profile-name{ display:none; }

    .profile-menu{
        right:0;
        top: calc(100% + 10px);
    }
}

/* ===============================
   DARK MODE READY
================================ */
@media (prefers-color-scheme: dark) {
    :root {
        --nav-bg: rgba(17,24,39,0.9);
        --nav-border: #374151;
        --nav-text: #f9fafb;
        --nav-muted: #9ca3af;
    }

    .nav-links { background: transparent; }

    .nav-links a:hover { background: rgba(255,255,255,0.06); }

    .profile-menu{
        background: rgba(17,24,39,0.98);
    }

    .profile-menu a:hover,
    .profile-menu button:hover{
        background: rgba(255,255,255,0.06);
    }

    .avatar{
        background: rgba(255,255,255,0.10);
        color: #e5e7eb;
        border: 1px solid rgba(255,255,255,0.12);
    }
}
</style>

<script>
/* Profile dropdown: open ONLY on click, close on outside click + ESC */
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('profile-btn');
    const menu = document.getElementById('profile-menu');
    const wrap = document.getElementById('profile');

    if (!btn || !menu || !wrap) return;

    const openMenu = () => {
        menu.hidden = false;
        btn.setAttribute('aria-expanded', 'true');
    };

    const closeMenu = () => {
        menu.hidden = true;
        btn.setAttribute('aria-expanded', 'false');
    };

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (menu.hidden) openMenu();
        else closeMenu();
    });

    // close when clicking outside
    document.addEventListener('click', (e) => {
        if (!wrap.contains(e.target)) closeMenu();
    });

    // close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
});

/* Optional: navbar shadow on scroll */
window.addEventListener("scroll", () => {
    const nav = document.querySelector(".site-nav");
    if (!nav) return;
    nav.classList.toggle("scrolled", window.scrollY > 10);
});
</script>
