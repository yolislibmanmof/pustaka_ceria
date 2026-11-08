<?php
/**
 * Template by          : Tutorial SLiMS
 * Template description : Integrated library catalog search theme for SLiMS 9.8.0 (ID/EN)
 * Email                : tutorialslims@gmail.com
 * Instagram            : https://instagram.com/tutorial_slims (@tutorial_slims)
 * Copyright            : (c) Tutorial SLiMS. Licensed under GPLv3.
 * Template ini merupakan ide dari Hendro Wicaksono | Email : hendro.wicaksono@gmail.com
 */
/**
 * KDx Plugin #1 — Command Palette (Ctrl+K / Cmd+K) + tombol kilat.
 * Self-contained: CSS & JS inline di file ini, prefix scoped "kdx-".
 * Sync: 1 baris include di footer.php. Tidak menyentuh file css/js lain.
 */
$kdx_l = [
    'placeholder' => __('Type to search collections or commands…'),
    'g_books'     => __('Collections'),
    'g_actions'   => __('Quick Actions'),
    'none'        => __('No results found'),
    'a_home'      => __('Home'),
    'a_index'     => __('Index'),
    'a_adv'       => __('Advanced Search'),
    'a_ddc'       => __('Browse DDC Classification'),
    'a_member'    => __('Member Area'),
    'a_visitor'   => __('Visitor Counter'),
    'a_theme'     => __('Toggle theme'),
    'a_copy'      => __('Copy link'),
    'a_top'       => __('Back to top'),
    'copied'      => __('Link copied!'),
    'fab'         => __('Quick Jump'),
    'f_nav'       => __('navigate'),
    'f_sel'       => __('select'),
    'f_close'     => __('close'),
];
?>
<button type="button" id="kdx-fab" aria-label="<?= htmlspecialchars($kdx_l['fab']) ?>" title="<?= htmlspecialchars($kdx_l['fab']) ?> (Ctrl+K)">
    <i class="fas fa-bolt" aria-hidden="true"></i>
</button>

<div id="kdx-cmdk" hidden>
    <div class="kdx-backdrop" data-kdx-close></div>
    <div class="kdx-panel" role="dialog" aria-modal="true" aria-label="<?= htmlspecialchars($kdx_l['fab']) ?>">
        <div class="kdx-bar">
            <i class="fas fa-bolt kdx-bar-ico" aria-hidden="true"></i>
            <input id="kdx-q" type="text" autocomplete="off" spellcheck="false"
                   placeholder="<?= htmlspecialchars($kdx_l['placeholder']) ?>">
            <kbd class="kdx-kbd">ESC</kbd>
        </div>
        <div class="kdx-list" id="kdx-list"></div>
        <div class="kdx-foot">
            <span><kbd class="kdx-kbd">↑↓</kbd> <?= htmlspecialchars($kdx_l['f_nav']) ?></span>
            <span><kbd class="kdx-kbd">↵</kbd> <?= htmlspecialchars($kdx_l['f_sel']) ?></span>
            <span><kbd class="kdx-kbd">ESC</kbd> <?= htmlspecialchars($kdx_l['f_close']) ?></span>
            <span class="kdx-toast" id="kdx-toast" role="status"></span>
        </div>
    </div>
</div>

<style>
/* ===== KDx CMD+K — scoped, semua rule di bawah #kdx-cmdk / #kdx-fab ===== */
#kdx-fab{position:fixed;left:18px;bottom:18px;z-index:900;width:46px;height:46px;border:0;border-radius:14px;
  background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff;font-size:16px;cursor:pointer;
  box-shadow:0 10px 26px rgba(37,99,235,.4);display:inline-flex;align-items:center;justify-content:center;
  transition:transform .2s ease,box-shadow .2s ease}
#kdx-fab:hover{transform:translateY(-3px) scale(1.04);box-shadow:0 14px 30px rgba(37,99,235,.5)}
#kdx-cmdk{position:fixed;inset:0;z-index:12000;display:flex;align-items:flex-start;justify-content:center;
  padding:10vh 16px 16px;font-family:inherit}
#kdx-cmdk[hidden]{display:none}
#kdx-cmdk .kdx-backdrop{position:absolute;inset:0;background:rgba(2,6,23,.55);
  backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);opacity:0;transition:opacity .25s ease}
#kdx-cmdk .kdx-panel{position:relative;width:100%;max-width:620px;background:var(--kd-surface,#fff);
  border:1px solid var(--kd-border,rgba(0,0,0,.08));border-radius:20px;overflow:hidden;
  box-shadow:0 30px 80px rgba(2,6,23,.45);transform:translateY(14px) scale(.98);opacity:0;
  transition:transform .28s cubic-bezier(.22,1,.36,1),opacity .28s ease}
#kdx-cmdk.on .kdx-backdrop{opacity:1}
#kdx-cmdk.on .kdx-panel{transform:none;opacity:1}
#kdx-cmdk .kdx-bar{display:flex;align-items:center;gap:10px;padding:14px 16px;
  border-bottom:1px solid var(--kd-border,rgba(0,0,0,.08))}
#kdx-cmdk .kdx-bar-ico{color:var(--kd-blue,#2563eb);font-size:15px}
#kdx-cmdk #kdx-q{flex:1;min-width:0;border:0;outline:none;background:transparent;
  color:var(--kd-text,#0f172a);font-size:15px;font-family:inherit}
#kdx-cmdk .kdx-kbd{font:700 10px/1 'JetBrains Mono',Consolas,monospace;color:var(--kd-muted,#64748b);
  background:var(--kd-surface-2,#f1f5f9);border:1px solid var(--kd-border,#e5e7eb);border-radius:6px;
  padding:4px 7px;letter-spacing:.06em}
#kdx-cmdk .kdx-list{max-height:46vh;overflow-y:auto;padding:8px;scrollbar-width:thin}
#kdx-cmdk .kdx-group{font-size:10.5px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;
  color:var(--kd-muted,#64748b);padding:10px 10px 6px}
#kdx-cmdk .kdx-item{display:flex;align-items:center;gap:10px;width:100%;text-align:left;border:0;
  background:transparent;color:var(--kd-text,#0f172a);padding:10px;border-radius:12px;cursor:pointer;
  font-size:14px;font-family:inherit;text-decoration:none}
#kdx-cmdk .kdx-ico{flex:0 0 32px;height:32px;border-radius:9px;background:var(--kd-blue-soft,#dbeafe);
  color:var(--kd-blue,#2563eb);display:inline-flex;align-items:center;justify-content:center;font-size:13px}
#kdx-cmdk .kdx-main{min-width:0;flex:1}
#kdx-cmdk .kdx-main strong{display:block;font-weight:700;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
#kdx-cmdk .kdx-main small{display:block;font-size:11.5px;color:var(--kd-muted,#64748b);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
#kdx-cmdk .kdx-item.sel,#kdx-cmdk .kdx-item:hover{background:var(--kd-surface-2,#f1f5f9)}
#kdx-cmdk .kdx-item.sel .kdx-ico{background:var(--kd-blue,#2563eb);color:#fff}
#kdx-cmdk .kdx-empty{padding:22px;text-align:center;color:var(--kd-muted,#64748b);font-size:13px}
#kdx-cmdk .kdx-foot{display:flex;align-items:center;gap:14px;padding:10px 16px;font-size:11px;
  color:var(--kd-muted,#64748b);border-top:1px solid var(--kd-border,rgba(0,0,0,.08))}
#kdx-cmdk .kdx-toast{margin-left:auto;font-weight:700;color:#15803d;opacity:0;transition:opacity .2s ease}
#kdx-cmdk .kdx-toast.show{opacity:1}
@media (prefers-reduced-motion: reduce){
  #kdx-cmdk .kdx-panel,#kdx-cmdk .kdx-backdrop,#kdx-fab{transition:none}
}
</style>

<script>
(function () {
    var L = <?= json_encode($kdx_l, JSON_UNESCAPED_UNICODE) ?>;
    var ENDPOINT = <?= json_encode(CURRENT_TEMPLATE_DIR . 'suggest.php') ?>;
    var root = document.getElementById('kdx-cmdk');
    var fab = document.getElementById('kdx-fab');
    if (!root || !fab) return;
    var input = document.getElementById('kdx-q');
    var list = document.getElementById('kdx-list');
    var toast = document.getElementById('kdx-toast');
    var lastFocus = null, cur = [], sel = 0, seq = 0, timer = null, toastTimer = null;

    function actions() {
        return [
            { ico: 'fa-home',       label: L.a_home,    run: function () { location.href = 'index.php'; } },
            { ico: 'fa-list',       label: L.a_index,   run: function () { location.href = 'index.php?keywords=&search=search'; } },
            { ico: 'fa-sliders-h',  label: L.a_adv,     run: function () { openModal('#adv-modal'); } },
            { ico: 'fa-th-large',   label: L.a_ddc,     run: function () { openModal('#exampleModal'); } },
            { ico: 'fa-user',       label: L.a_member,  run: function () { location.href = 'index.php?p=member'; } },
            { ico: 'fa-user-clock', label: L.a_visitor, run: function () { location.href = 'index.php?p=visitor'; } },
            { ico: 'fa-moon',       label: L.a_theme,   run: function () { var b = document.getElementById('kd-theme-toggle'); if (b) b.click(); } },
            { ico: 'fa-link',       label: L.a_copy,    run: function () { copyText(location.href, function () { say(L.copied); }); } },
            { ico: 'fa-arrow-up',   label: L.a_top,     run: function () { window.scrollTo({ top: 0, behavior: 'smooth' }); } }
        ];
    }
    function openModal(target) {
        close();
        if (window.jQuery && jQuery(target).length) { jQuery(target).modal('show'); return; }
        var t = document.querySelector('[data-target="' + target + '"]');
        if (t) t.click();
    }
    function copyText(t, cb) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(t).then(cb, function () { legacyCopy(t); cb(); });
            return;
        }
        legacyCopy(t); cb();
    }
    function legacyCopy(t) {
        var ta = document.createElement('textarea');
        ta.value = t; ta.style.position = 'fixed'; ta.style.opacity = '0';
        document.body.appendChild(ta); ta.select();
        try { document.execCommand('copy'); } catch (e) {}
        document.body.removeChild(ta);
    }
    function say(msg) {
        toast.textContent = msg; toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () { toast.classList.remove('show'); }, 1600);
    }
    function open() {
        lastFocus = document.activeElement;
        root.hidden = false;
        root.style.pointerEvents = '';
        requestAnimationFrame(function () { root.classList.add('on'); });
        input.value = '';
        render('', []);
        input.focus();
        document.documentElement.style.overflow = 'hidden';
    }
    function close() {
        root.classList.remove('on');
        root.style.pointerEvents = 'none';
        document.documentElement.style.overflow = '';
        setTimeout(function () { root.hidden = true; }, 220);
        if (lastFocus && lastFocus.focus) lastFocus.focus();
    }
    function itemEl(it, idx) {
        var b = document.createElement('button');
        b.type = 'button';
        b.className = 'kdx-item' + (idx === sel ? ' sel' : '');
        var ico = document.createElement('span'); ico.className = 'kdx-ico';
        var i = document.createElement('i'); i.className = 'fas ' + it.ico; i.setAttribute('aria-hidden', 'true');
        ico.appendChild(i);
        var main = document.createElement('span'); main.className = 'kdx-main';
        var st = document.createElement('strong'); st.textContent = it.label; main.appendChild(st);
        if (it.sub) { var sm = document.createElement('small'); sm.textContent = it.sub; main.appendChild(sm); }
        b.appendChild(ico); b.appendChild(main);
        b.addEventListener('click', function () { choose(it); });
        b.addEventListener('mouseenter', function () { setSel(idx); });
        return b;
    }
    function render(q, books) {
        list.innerHTML = '';
        cur = [];
        var acts = actions().filter(function (a) { return !q || a.label.toLowerCase().indexOf(q) > -1; });
        var blocks = [];
        if (books && books.length) {
            blocks.push([L.g_books, books.map(function (b) {
                return {
                    ico: 'fa-book',
                    label: b.title,
                    sub: (b.authors || '-') + (b.year ? ' · ' + b.year : ''),
                    run: (function (bid) { return function () { location.href = 'index.php?p=show_detail&id=' + bid; }; })(b.id)
                };
            })]);
        }
        if (acts.length) blocks.push([L.g_actions, acts]);
        if (!blocks.length) {
            var e = document.createElement('div');
            e.className = 'kdx-empty'; e.textContent = L.none;
            list.appendChild(e);
            return;
        }
        blocks.forEach(function (blk) {
            var g = document.createElement('div');
            g.className = 'kdx-group'; g.textContent = blk[0];
            list.appendChild(g);
            blk[1].forEach(function (it) {
                var idx = cur.length;
                cur.push(it);
                list.appendChild(itemEl(it, idx));
            });
        });
        if (sel >= cur.length) sel = 0;
        markSel();
    }
    function markSel() {
        var els = list.querySelectorAll('.kdx-item');
        els.forEach(function (el, i) { el.classList.toggle('sel', i === sel); });
        if (els[sel]) els[sel].scrollIntoView({ block: 'nearest' });
    }
    function setSel(i) { sel = i; markSel(); }
    function choose(it) { close(); if (it && it.run) it.run(); }
    function fetchBooks(q) {
        var my = ++seq;
        fetch(ENDPOINT + '?q=' + encodeURIComponent(q) + '&field=keywords', { credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (rows) { if (my === seq) render(q.toLowerCase(), Array.isArray(rows) ? rows.slice(0, 6) : []); })
            .catch(function () { if (my === seq) render(q.toLowerCase(), []); });
    }

    input.addEventListener('input', function () {
        var q = input.value.trim();
        clearTimeout(timer);
        seq++;
        if (q.length < 2) { render('', []); return; }
        timer = setTimeout(function () { fetchBooks(q); }, 180);
    });
    document.addEventListener('keydown', function (e) {
        if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
            e.preventDefault();
            root.hidden ? open() : close();
            return;
        }
        if (root.hidden) return;
        if (e.key === 'Escape') { e.preventDefault(); close(); }
        else if (e.key === 'ArrowDown') { e.preventDefault(); if (cur.length) setSel((sel + 1) % cur.length); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); if (cur.length) setSel((sel - 1 + cur.length) % cur.length); }
        else if (e.key === 'Enter') { e.preventDefault(); if (cur[sel]) choose(cur[sel]); }
    });
    root.querySelector('[data-kdx-close]').addEventListener('click', close);
    fab.addEventListener('click', open);
})();
</script>