{{-- resources/views/common/inner.blade.php --}}
<div class="dash" id="dash">

    {{-- SIDEBAR --}}
    <aside class="sidebar is-hidden" id="sidebar">
        <nav class="side-nav" aria-label="Dashboard navigation">
            <a class="side-item {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                <span class="i">🏠</span> <span class="txt">Dashboard</span>
            </a>

            <div class="side-group">
                <div class="side-title">Content</div>
                <a class="side-item {{ request()->is('posts*') ? 'active' : '' }}" href="{{ url('/posts') }}">
                    <span class="i">📝</span> <span class="txt">Posts</span>
                </a>
                <a class="side-item {{ request()->is('categories*') ? 'active' : '' }}" href="{{ url('/categories') }}">
                    <span class="i">🏷️</span> <span class="txt">Categories</span>
                </a>
                <a class="side-item {{ request()->is('media*') ? 'active' : '' }}" href="{{ route('media.index') }}">
                    <span class="i">🖼️</span> <span class="txt">Media</span>
                </a>

            </div>

            <div class="side-group">
                <div class="side-title">Team</div>
                <a class="side-item {{ request()->is('my-posts*') ? 'active' : '' }}" href="{{ route('posts.mine') }}">
    <span class="i">👤</span> <span class="txt">Users Posts</span>
</a>

            </div>

            <div class="side-group">
                <div class="side-title">System</div>
                <a class="side-item {{ request()->is('settings*') ? 'active' : '' }}" href="{{ route('settings') }}">
                    <span class="i">⚙️</span> <span class="txt">Settings</span>
                </a>

            </div>
        </nav>
    </aside>

    {{-- MOBILE OVERLAY --}}
    <div class="overlay" id="overlay" hidden></div>

    {{-- MAIN --}}
    <main class="main">
        <header class="topbar">
            <div class="top-left">
                <button class="icon-btn" id="sidebarToggle" type="button" aria-label="Toggle sidebar" aria-expanded="false">
                    ☰
                </button>

                <div class="crumbs">
                    <span class="crumb">Dashboard</span>
                    <span class="sep">/</span>
                    <span class="crumb strong">Overview</span>
                </div>
            </div>

            <div class="top-right">

                <a class="btn btn-primary" href="{{ url('/posts/create') }}">+ New Post</a>
<div class="notif-wrap">
    <button class="icon-btn" id="notifBtn" type="button" title="Notifications" aria-expanded="false">
        🔔
        <span class="notif-badge" id="notifBadge" hidden></span>
    </button>

    <div class="notif-dd" id="notifDropdown" hidden>
        <div class="notif-head">
            <div class="notif-title">Notifications</div>
            <button class="notif-link" id="notifReadAll" type="button">Mark all read</button>
        </div>

        <div class="notif-list" id="notifList">
            <div class="notif-empty">Loading…</div>
        </div>

        <div class="notif-foot">
            <span class="notif-muted">Latest 10</span>
        </div>
    </div>
</div>
            </div>
        </header>

            <section class="content">
                @stack('page-content')
            </section>


    </main>
</div>

<style>
:root{
    --bg:#0b1220;
    --panel:rgba(255,255,255,.06);
    --border:rgba(255,255,255,.10);
    --text:#e7eefc;
    --muted:rgba(231,238,252,.72);
    --brand:#7c5cff;
    --shadow:0 18px 50px rgba(0,0,0,.35);
}

*{box-sizing:border-box;}
html,body{height:100%;}
body{
    margin:0;
    background:
      radial-gradient(900px 500px at 10% 0%, rgba(124,92,255,.25), transparent 55%),
      radial-gradient(900px 500px at 90% 20%, rgba(34,197,94,.18), transparent 55%),
      var(--bg);
    color:var(--text);
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
}

/* --- MAIN LAYOUT GRID --- */
.dash{
    min-height:100vh;
    display:grid;
    grid-template-columns: 280px 1fr;
    transition: grid-template-columns .22s ease;
}

/* Desktop collapsed state */
.dash.collapsed{
    grid-template-columns: 80px 1fr;
}
.dash.collapsed .txt,
.dash.collapsed .pill,
.dash.collapsed .side-title{
    display:none;
}
.dash.collapsed .side-item{
    justify-content:center;
}

/* --- SIDEBAR --- */
.sidebar{
    height:100vh;
    position:sticky;
    top:0;
    padding:18px 14px;
    border-right:1px solid var(--border);
    background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
    backdrop-filter:blur(10px);
}

.side-nav{display:flex; flex-direction:column; gap:6px; padding:0 6px;}
.side-group{margin-top:14px;}
.side-title{
    font-size:.75rem;
    letter-spacing:.12em;
    text-transform:uppercase;
    color:var(--muted);
    margin:0 8px 8px;
}
.side-item{
    display:flex; align-items:center; gap:10px;
    padding:10px 10px;
    border-radius:12px;
    text-decoration:none;
    color:var(--muted);
    border:1px solid transparent;
    transition:.15s;
}
.side-item .i{width:22px; text-align:center; opacity:.9;}
.side-item:hover{
    background:var(--panel);
    border-color:var(--border);
    color:var(--text);
    transform:translateY(-1px);
}
.side-item.active{
    background:linear-gradient(135deg, rgba(124,92,255,.22), rgba(56,189,248,.10));
    border-color:rgba(124,92,255,.35);
    color:var(--text);
}
.pill{
    margin-left:auto;
    font-size:.75rem;
    padding:3px 8px;
    border-radius:999px;
    background:rgba(255,255,255,.08);
    border:1px solid var(--border);
}

/* --- MAIN --- */
.main{padding:18px 18px 40px;}
.topbar{
    display:flex; align-items:center; justify-content:space-between;
    padding:14px 16px;
    border-radius:16px;
    background:var(--panel);
    border:1px solid var(--border);
    box-shadow:var(--shadow);
}
.top-left{display:flex; align-items:center; gap:12px;}
.crumbs{display:flex; align-items:center; gap:10px; color:var(--muted);}
.crumb.strong{color:var(--text); font-weight:700;}
.sep{opacity:.55;}

.top-right{display:flex; align-items:center; gap:10px;}
.search{
    width:min(420px, 45vw);
    display:flex; align-items:center; gap:10px;
    padding:10px 12px;
    border-radius:14px;
    background:rgba(0,0,0,.18);
    border:1px solid var(--border);
}
.search input{
    width:100%;
    background:transparent;
    border:0;
    outline:0;
    color:var(--text);
    font-size:.95rem;
}

.btn{
    border:1px solid var(--border);
    background:rgba(255,255,255,.06);
    color:var(--text);
    padding:10px 12px;
    border-radius:14px;
    font-weight:800;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}
.btn-primary{
    background:linear-gradient(135deg, rgba(124,92,255,.95), rgba(56,189,248,.70));
    border-color:rgba(124,92,255,.40);
}

.icon-btn{
    border:1px solid var(--border);
    background:rgba(255,255,255,.05);
    color:var(--text);
    width:42px; height:42px;
    border-radius:14px;
    cursor:pointer;
    display:grid;
    place-items:center;
}

/* --- OVERLAY (mobile) --- */
.overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
    z-index:1500;
}

/* Dashboard cards + table */
.content{ margin-top:18px; }

.card{
    background:var(--panel);
    border:1px solid var(--border);
    border-radius:18px;
    padding:18px;
    box-shadow:var(--shadow);
}

.alert{
    margin-bottom:14px;
    padding:12px 14px;
    border-radius:14px;
    border:1px solid rgba(34,197,94,.35);
    background: rgba(34,197,94,.10);
    color:#bbf7d0;
    font-weight:800;
}

.table{ display:flex; flex-direction:column; gap:10px; }
.t-head, .t-row{
    display:grid;
    grid-template-columns: 1fr 120px 140px;
    gap:12px;
    padding:12px 14px;
    border-radius:14px;
    border:1px solid var(--border);
    background:rgba(0,0,0,.18);
}
.t-head{
    font-weight:900;
    color:var(--muted);
    background:rgba(255,255,255,.04);
}
.t-title{ font-weight:900; }
.t-muted{ color:var(--muted); }

.status{
    display:inline-block;
    padding:5px 10px;
    border-radius:999px;
    font-size:.85rem;
    border:1px solid var(--border);
}
.status.draft{
    background:rgba(251,191,36,.12);
    border-color:rgba(251,191,36,.35);
}
.status.published{
    background:rgba(34,197,94,.12);
    border-color:rgba(34,197,94,.35);
}
.t-empty{
    padding:14px;
    border-radius:14px;
    border:1px dashed var(--border);
    color:var(--muted);
    text-align:center;
}

/* --- NOTIFICATIONS --- */
.notif-wrap{ position:relative; }

.notif-badge{
    position:absolute;
    top:6px; right:6px;
    min-width:18px; height:18px;
    padding:0 6px;
    border-radius:999px;
    display:grid;
    place-items:center;
    font-size:.72rem;
    font-weight:900;
    color:white;
    background: rgba(239,68,68,.95);
    border:1px solid rgba(255,255,255,.18);
}

.notif-dd{
    position:absolute;
    right:0;
    top:56px;
    width:min(360px, 86vw);
    border-radius:18px;
    border:1px solid var(--border);
    background: rgba(15,23,42,.82);
    backdrop-filter: blur(12px);
    box-shadow: var(--shadow);
    overflow:hidden;
    z-index:2500;
}

.notif-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 14px;
    border-bottom:1px solid var(--border);
    background: rgba(255,255,255,.04);
}

.notif-title{ font-weight:900; }
.notif-link{
    border:0;
    background:transparent;
    color: rgba(231,238,252,.85);
    font-weight:800;
    cursor:pointer;
}
.notif-link:hover{ text-decoration:underline; }

.notif-list{
    max-height: 320px;
    overflow:auto;
}

.notif-item{
    display:flex;
    gap:10px;
    padding:12px 14px;
    border-bottom:1px solid rgba(255,255,255,.06);
    cursor:pointer;
}
.notif-item:hover{ background: rgba(255,255,255,.05); }

.notif-dot{
    width:10px; height:10px;
    border-radius:999px;
    margin-top:6px;
    background: rgba(124,92,255,.95);
    box-shadow: 0 0 0 4px rgba(124,92,255,.18);
}
.notif-dot.read{ background: rgba(148,163,184,.5); box-shadow:none; }

.notif-text{ flex:1; min-width:0; }
.notif-item-title{ font-weight:900; }
.notif-item-msg{ color: var(--muted); font-size:.9rem; margin-top:2px; }
.notif-time{ color: rgba(231,238,252,.55); font-size:.8rem; margin-top:6px; }

.notif-empty{
    padding:16px 14px;
    color: var(--muted);
}

.notif-foot{
    padding:10px 14px;
    background: rgba(255,255,255,.03);
}
.notif-muted{ color: rgba(231,238,252,.55); font-size:.85rem; }

@media(max-width: 600px){
    .t-head, .t-row{
        grid-template-columns:1fr;
    }
}


/* --- MOBILE BEHAVIOR --- */
@media (max-width: 860px){
    .dash{ grid-template-columns: 1fr; }

    .sidebar{
        position:fixed;
        left:0; top:0;
        width:280px;
        z-index:2000;
        transform: translateX(-110%);
        transition: transform .22s ease;
    }

    .sidebar.is-hidden{ transform: translateX(-110%); }
    .sidebar.is-open{ transform: translateX(0); }

    /* On mobile we should NOT use desktop collapsed push */
    .dash.collapsed{ grid-template-columns: 1fr; }
}

/* Prevent accidental horizontal scroll */
html, body {
    overflow-x: hidden;
}

/* Small phones */
@media (max-width: 520px){

    .topbar{
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }

    .top-left,
    .top-right{
        width: 100%;
    }

    .top-right{
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 10px;
    }

    .search{
        width: 100%;
    }

    .search input{
        min-width: 0;
    }

    .btn.btn-primary{
        flex: 1;
        justify-content: center;
        white-space: nowrap;
    }

    /* Hide breadcrumbs to save space */
    .crumbs{
        display: none;
    }
}

</style>

<script>
(function(){
    const btn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const dash = document.getElementById('dash');
    const overlay = document.getElementById('overlay');

    if (!btn || !sidebar || !dash || !overlay) return;

    function isMobile(){ return window.innerWidth <= 860; }

    function openMobile(){
        sidebar.classList.remove('is-hidden');
        sidebar.classList.add('is-open');
        overlay.hidden = false;
        btn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden'; // prevent content behind scroll
    }

    function closeMobile(){
        sidebar.classList.remove('is-open');
        sidebar.classList.add('is-hidden');
        overlay.hidden = true;
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    function toggleDesktop(){
        dash.classList.toggle('collapsed');
        // On desktop, aria-expanded = whether sidebar is expanded (not collapsed)
        btn.setAttribute('aria-expanded', dash.classList.contains('collapsed') ? 'false' : 'true');
    }

    function toggle(){
        if (isMobile()){
            if (sidebar.classList.contains('is-open')) closeMobile();
            else openMobile();
        } else {
            closeMobile(); // safety if resized
            toggleDesktop();
        }
    }

    // initial state + resize behavior
    function sync(){
        if (isMobile()){
            // Mobile: always start closed, BUT do NOT wipe desktop collapsed state.
            closeMobile();
            // ❗ removed: dash.classList.remove('collapsed');
            // CSS @media already neutralizes collapsed layout on mobile.
        } else {
            // Desktop: sidebar is always visible (not sliding), respect collapsed state.
            overlay.hidden = true;
            document.body.style.overflow = '';
            sidebar.classList.remove('is-open', 'is-hidden');
            btn.setAttribute('aria-expanded', dash.classList.contains('collapsed') ? 'false' : 'true');
        }
    }

    btn.addEventListener('click', toggle);
    overlay.addEventListener('click', closeMobile);
    window.addEventListener('resize', sync);
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isMobile() && !overlay.hidden) closeMobile();
    });

    sync();
})();
</script>

<script>
(function(){
    const btn = document.getElementById('notifBtn');
    const dd  = document.getElementById('notifDropdown');
    const list = document.getElementById('notifList');
    const badge = document.getElementById('notifBadge');
    const readAllBtn = document.getElementById('notifReadAll');

    if(!btn || !dd || !list || !badge || !readAllBtn) return;

    function csrf(){
        // Laravel puts CSRF token into meta in layouts usually.
        // If you don't have it, add: <meta name="csrf-token" content="{{ csrf_token() }}">
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    }

    function timeAgo(iso){
        const d = new Date(iso);
        const diff = Math.floor((Date.now() - d.getTime())/1000);
        if(diff < 60) return diff + "s ago";
        if(diff < 3600) return Math.floor(diff/60) + "m ago";
        if(diff < 86400) return Math.floor(diff/3600) + "h ago";
        return Math.floor(diff/86400) + "d ago";
    }

    async function fetchNotifs(){
        const res = await fetch("{{ route('notifications.index') }}", {
            headers: { "Accept":"application/json" }
        });
        const data = await res.json();

        // badge
        if(data.unreadCount > 0){
            badge.hidden = false;
            badge.textContent = data.unreadCount > 99 ? "99+" : data.unreadCount;
        }else{
            badge.hidden = true;
        }

        // list
        if(!data.notifications.length){
            list.innerHTML = `<div class="notif-empty">🎉 You’re all caught up!</div>`;
            return;
        }

        list.innerHTML = data.notifications.map(n => {
            const isRead = n.read_at !== null;
            const title = n.data?.title ?? "Notification";
            const msg = n.data?.message ?? "";
            const url = n.data?.url ?? null;

            return `
                <div class="notif-item" data-id="${n.id}" data-url="${url ?? ''}">
                    <div class="notif-dot ${isRead ? 'read' : ''}"></div>
                    <div class="notif-text">
                        <div class="notif-item-title">${escapeHtml(title)}</div>
                        <div class="notif-item-msg">${escapeHtml(msg)}</div>
                        <div class="notif-time">${timeAgo(n.created_at)}</div>
                    </div>
                </div>
            `;
        }).join("");
    }

    function escapeHtml(str){
        return String(str)
            .replaceAll("&","&amp;")
            .replaceAll("<","&lt;")
            .replaceAll(">","&gt;")
            .replaceAll('"',"&quot;")
            .replaceAll("'","&#039;");
    }

    async function markAllRead(){
        await fetch("{{ route('notifications.readAll') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf(),
                "Accept":"application/json"
            }
        });
        await fetchNotifs();
    }

    async function markRead(id){
        await fetch(`/notifications/${id}/read`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf(),
                "Accept":"application/json"
            }
        });
    }

    function open(){
        dd.hidden = false;
        btn.setAttribute("aria-expanded","true");
        fetchNotifs();
    }
    function close(){
        dd.hidden = true;
        btn.setAttribute("aria-expanded","false");
    }
    function toggle(){
        if(dd.hidden) open();
        else close();
    }

    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        toggle();
    });

    readAllBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        await markAllRead();
    });

    list.addEventListener("click", async (e) => {
        const item = e.target.closest(".notif-item");
        if(!item) return;

        const id = item.dataset.id;
        const url = item.dataset.url;

        await markRead(id);
        await fetchNotifs();

        if(url) window.location.href = url;
    });

    document.addEventListener("click", () => {
        if(!dd.hidden) close();
    });
})();
</script>
