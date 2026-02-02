<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post — MyBlog</title>
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
            max-width:820px;
            margin:0 auto 26px;
        }
        .hero h1{font-size:2.6rem; line-height:1.15;}
        .hero p{margin-top:12px; color:var(--muted); font-size:1.05rem;}

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
        textarea.input{min-height:180px; resize:vertical;}

        /* file input nicer */
        input[type="file"].input{
            padding:10px;
        }

        .help{
            color:var(--muted);
            font-size:.92rem;
            margin-top:6px;
        }

        /* ACTIONS */
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
        /* ====== SELECT (Category + Status) ====== */

select.input {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    background:
        linear-gradient(135deg, rgba(124,92,255,.12), rgba(56,189,248,.06)),
        rgba(0,0,0,.18);

    border: 1px solid var(--border);
    color: var(--text);
    cursor: pointer;

    padding-right: 40px;

    background-image:
        url("data:image/svg+xml;utf8,<svg fill='white' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 14px center;
}

/* Dropdown options */
select.input option {
    background-color: #0b1220;
    color: #e7eefc;
}

/* Hover / focus */
select.input:focus {
    border-color: rgba(124,92,255,.65);
    box-shadow: 0 0 0 4px rgba(124,92,255,.18);
}

/* Placeholder option */
select.input option[value=""] {
    color: rgba(231,238,252,.55);
}


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

{{-- Use your dashboard header --}}
@include('common.header')

<div class="wrap">
    <div class="hero">
        <h1>Create New Blog Post</h1>
        <p>Write something useful. Publish it now, or save it as a draft.</p>
    </div>

    <div class="grid">
        {{-- FORM --}}
        <div class="card">
            <h2>Post Details</h2>
            <p>Fill out the fields below to create your blog post.</p>

            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="errors">
                    <strong>Please fix these errors:</strong>
                    <ul>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                             {{ $cat->name }}
                            </option>
                        @endforeach

                    </ul>
                </div>  
            @endif

            <form class="form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label>Post Title
                        <input class="input" type="text" name="title" value="{{ old('title') }}" placeholder="Enter blog title..." required>
                    </label>
                </div>

                <div>
                    <label>Slug
                        <input class="input" type="text" name="slug" value="{{ old('slug') }}" placeholder="auto-generated (optional)">
                    </label>
                    <div class="help">Example URL: /blog/your-post-slug</div>
                </div>

                <div class="row">
                    <div>
                        <label>Category
                            <select class="input" name="category_id">
                                <option value="">Select category</option>
                                @foreach($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div>
                        <label>Status
                            <select class="input" name="status" required>
                                <option value="draft" {{ old('status')=='draft' ? 'selected':'' }}>Draft</option>
                                <option value="published" {{ old('status')=='published' ? 'selected':'' }}>Publish</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div>
                    <label>Featured Image
                        <input class="input" type="file" name="image" accept="image/*">
                    </label>
                    <div class="help">Optional. Recommended: 1200×630.</div>
                </div>

                <div>
                    <label>Content
                        <textarea class="input" name="content" placeholder="Write your blog content here..." required>{{ old('content') }}</textarea>
                    </label>
                </div>

                <div class="actions">
                    <a class="btn-outline" href="{{ url('/dashboard') }}">Cancel</a>
                    <button class="btn" type="submit">Save Post</button>
                </div>
            </form>
        </div>

        {{-- SIDE CARD --}}
        <div class="card">
            <h2>Publishing Tips</h2>
            <p>Quick checklist before you publish.</p>

            <div class="info">
                <div class="info-item">
                    <div class="title">✅ Title that hooks</div>
                    <div class="sub">Keep it short, clear, and curiosity-driven.</div>
                    <span class="badge">Best: 50–70 chars</span>
                </div>

                <div class="info-item">
                    <div class="title">🧠 Value first</div>
                    <div class="sub">Explain the “why” and give real steps people can follow.</div>
                    <span class="badge">Add examples</span>
                </div>

                <div class="info-item">
                    <div class="title">📌 Strong ending</div>
                    <div class="sub">Finish with a summary + next action (comment, share, follow).</div>
                    <span class="badge">CTA matters</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
