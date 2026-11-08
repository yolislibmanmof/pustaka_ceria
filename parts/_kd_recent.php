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
 * KDx Plugin #2 — "Recently Viewed" (v2 — fix anchor injector)
 * v2: selector target dikunci ke main.kd-main-pad (sebelumnya 'main .kd-container'
 *     salah mencocok container navbar setelah adanya wrapper <main id="main-content">).
 * Self-contained inline CSS+JS, prefix scoped "kdx-rv-".
 */
$kdx_rv_l = [
    'title' => __('Recently Viewed'),
    'clear' => __('Clear History'),
];
?>
<style>
/* ===== KDx RECENT v2 — scoped "kdx-rv-" ===== */
.kdx-rv-section{padding:26px 0 4px;text-align:left}
.kdx-rv-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px}
.kdx-rv-head-t{display:inline-flex;align-items:center;gap:8px;font-size:13px;font-weight:800;
  letter-spacing:.04em;text-transform:uppercase;color:var(--kd-blue,#2563eb);white-space:nowrap}
.kdx-rv-head-t i{font-size:12px}
.kdx-rv-clear{border:1px solid var(--kd-border,rgba(0,0,0,.08));background:var(--kd-surface,#fff);
  color:var(--kd-muted,#64748b);font-size:11.5px;font-weight:700;border-radius:999px;padding:6px 14px;
  cursor:pointer;display:inline-flex;align-items:center;gap:6px;font-family:inherit;
  white-space:nowrap;flex-shrink:0;transition:all .2s ease}
.kdx-rv-clear:hover{color:#b91c1c;border-color:#fecaca;background:#fef2f2}
.kdx-rv-row{display:flex;gap:12px;overflow-x:auto;padding-bottom:8px;
  scroll-snap-type:x mandatory;scrollbar-width:thin}
.kdx-rv-card{flex:0 0 148px;scroll-snap-align:start;background:var(--kd-surface,#fff);
  border:1px solid var(--kd-border,rgba(0,0,0,.08));border-radius:16px;padding:10px;
  text-decoration:none!important;display:flex;flex-direction:column;gap:8px;
  transition:transform .25s ease,box-shadow .25s ease,border-color .25s ease;
  animation:kdxRvIn .5s ease backwards}
.kdx-rv-card:hover{transform:translateY(-3px);border-color:var(--kd-blue,#2563eb);
  box-shadow:0 10px 24px rgba(37,99,235,.14)}
.kdx-rv-cover{position:relative;width:100%;height:150px;border-radius:10px;overflow:hidden;
  background:radial-gradient(120% 70% at 50% 0%,rgba(96,165,250,.18),transparent 60%),
             linear-gradient(160deg,#243049,#0f172a 75%);
  display:flex;align-items:center;justify-content:center}
.kdx-rv-cover img{width:100%;height:100%;object-fit:contain;padding:6px;box-sizing:border-box}
.kdx-rv-cover i{color:rgba(255,255,255,.5);font-size:26px}
.kdx-rv-title{font-size:12px;font-weight:700;line-height:1.35;color:var(--kd-text,#0f172a);
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
@keyframes kdxRvIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
@media (prefers-reduced-motion: reduce){.kdx-rv-card{animation:none}}
</style>

<script>
(function () {
    var L = <?= json_encode($kdx_rv_l, JSON_UNESCAPED_UNICODE) ?>;
    var KEY = 'kdx_recent_v1';
    function read() {
        try { var a = JSON.parse(localStorage.getItem(KEY) || '[]'); return Array.isArray(a) ? a : []; }
        catch (e) { return []; }
    }
    function write(a) { try { localStorage.setItem(KEY, JSON.stringify(a.slice(0, 8))); } catch (e) {} }

    var params = new URLSearchParams(location.search);
    var p = params.get('p'), id = params.get('id');

    /* --- Halaman detail: rekam kunjungan --- */
    if (p === 'show_detail' && id) {
        var t = document.querySelector('.kd-detail-title');
        if (t && t.textContent.trim()) {
            var imgEl = document.querySelector('.kd-cover-frame img');
            var saved = read().filter(function (x) { return String(x.id) !== String(id); });
            saved.unshift({
                id: parseInt(id, 10),
                t: t.textContent.trim().slice(0, 90),
                img: imgEl ? (imgEl.getAttribute('src') || '') : ''
            });
            write(saved);
        }
        return;
    }
    /* --- Hanya beranda yang menampilkan carousel --- */
    if (p || params.has('search')) return;

    var items = read();
    if (!items.length) return;

    /* FIX v2: target DIKUNCI ke container konten beranda (.kd-main-pad),
       bukan 'main .kd-container' yang kini bisa mencocok container navbar. */
    var anchor = document.querySelector('main.kd-main-pad > .kd-container') ||
                 document.querySelector('.kd-main-pad > .kd-container') ||
                 document.querySelector('.kd-main-pad .kd-container');
    if (!anchor) return;
    if (anchor.closest('header') || anchor.closest('.c-header')) return; /* guard anti-nyasar */

    var sec = document.createElement('section');
    sec.className = 'kdx-rv-section';

    var head = document.createElement('div'); head.className = 'kdx-rv-head';
    var ht = document.createElement('span'); ht.className = 'kdx-rv-head-t';
    var hi = document.createElement('i'); hi.className = 'fas fa-history'; hi.setAttribute('aria-hidden', 'true');
    ht.appendChild(hi);
    ht.appendChild(document.createTextNode(' ' + L.title));
    var clr = document.createElement('button');
    clr.type = 'button'; clr.className = 'kdx-rv-clear';
    var ci = document.createElement('i'); ci.className = 'fas fa-trash-alt'; ci.setAttribute('aria-hidden', 'true');
    clr.appendChild(ci);
    clr.appendChild(document.createTextNode(' ' + L.clear));
    clr.addEventListener('click', function () { try { localStorage.removeItem(KEY); } catch (e) {} sec.remove(); });
    head.appendChild(ht); head.appendChild(clr);

    var row = document.createElement('div'); row.className = 'kdx-rv-row';
    items.forEach(function (it, n) {
        var a = document.createElement('a');
        a.className = 'kdx-rv-card';
        a.href = 'index.php?p=show_detail&id=' + encodeURIComponent(it.id);
        a.style.animationDelay = (n * 60) + 'ms';
        var cov = document.createElement('span'); cov.className = 'kdx-rv-cover';
        if (it.img) {
            var im = document.createElement('img');
            im.src = it.img; im.alt = ''; im.loading = 'lazy';
            cov.appendChild(im);
        } else {
            var ic = document.createElement('i'); ic.className = 'fas fa-book'; ic.setAttribute('aria-hidden', 'true');
            cov.appendChild(ic);
        }
        var ti = document.createElement('span'); ti.className = 'kdx-rv-title'; ti.textContent = it.t;
        a.appendChild(cov); a.appendChild(ti);
        row.appendChild(a);
    });

    sec.appendChild(head); sec.appendChild(row);
    anchor.insertBefore(sec, anchor.firstChild);
})();
</script>