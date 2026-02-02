@php
    $messageText = session('message') ?? 'User logged in successfully';
@endphp

<div id="message-toast" class="message-toast" role="status" aria-live="polite" aria-atomic="true">
    <div class="toast-body">
        <strong class="toast-title">Success</strong>
        <div class="toast-message">{{ $messageText }}</div>
    </div>
    <button class="toast-close" aria-label="Dismiss message" title="Dismiss">×</button>
</div>

<style>
    .message-toast{ position:fixed; right:20px; bottom:20px; z-index:9999; background:#fff; color:#111827; border-radius:8px; padding:12px 14px; box-shadow:0 8px 24px rgba(16,24,40,0.12); display:flex; gap:12px; align-items:flex-start; max-width:320px; transition:opacity .35s, transform .35s; opacity:1; }
    .message-toast.hide{ opacity:0; transform: translateY(8px); }
    .toast-body{ flex:1; }
    .toast-title{ display:block; font-weight:700; margin-bottom:4px; }
    .toast-message{ font-size:0.95rem; }
    .toast-close{ background:none; border:0; font-size:18px; line-height:1; cursor:pointer; color:#6b7280; padding:4px; border-radius:6px; }
    .toast-close:focus{ outline:2px solid #2563eb; }
</style>

<script>
    (function(){
        var toast = document.getElementById('message-toast');
        if (!toast) return;

        var closeBtn = toast.querySelector('.toast-close');
        // Focus the close button for accessibility
        closeBtn.focus();

        function dismiss() {
            toast.classList.add('hide');
            setTimeout(function(){ if (toast && toast.parentNode) toast.parentNode.removeChild(toast); }, 350);
            document.removeEventListener('keydown', onKey);
        }

        closeBtn.addEventListener('click', dismiss);

        function onKey(e){
            if (e.key === 'Escape' || e.key === 'Esc') dismiss();
        }
        document.addEventListener('keydown', onKey);

        // Auto-hide after 5 seconds
        var autoHide = setTimeout(dismiss, 5000);

        // Pause auto-hide on mouseover or focus
        toast.addEventListener('mouseover', function(){ clearTimeout(autoHide); });
        toast.addEventListener('focusin', function(){ clearTimeout(autoHide); });

    })();
</script>