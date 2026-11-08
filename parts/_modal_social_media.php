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
 * Social media share modal - Pustaka Ceria theme (v2 — Cinematic)
 * Menampilkan preview + 6 platform share + tombol copy link dengan feedback.
 */
?>
<div class="modal fade kd-share-modal" id="mediaSocialModal" tabindex="-1" role="dialog" aria-labelledby="kdShareTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content kd-modal-surface">
            <div class="kd-modal-head">
                <div class="kd-modal-head-left">
                    <span class="kd-modal-icon" style="background:linear-gradient(135deg,#2563eb,#7c3aed)">
                        <i class="fas fa-share-alt"></i>
                    </span>
                    <div>
                        <h5 class="kd-modal-title" id="kdShareTitle"><?= __('Share this collection'); ?></h5>
                        <p class="kd-modal-sub"><?= __('Choose how you want to share'); ?></p>
                    </div>
                </div>
                <button type="button" class="kd-modal-x" data-dismiss="modal" aria-label="<?= __('Close'); ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="kd-modal-body kd-share-body">
                <!-- Preview link -->
                <div class="kd-share-preview" id="kd-share-preview">
                    <div class="kd-share-preview-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="kd-share-preview-info">
                        <strong id="kd-share-title">—</strong>
                        <code id="kd-share-url" class="kd-share-url-code">—</code>
                    </div>
                </div>

                <!-- Platform grid -->
                <div class="kd-share-grid">
                    <a class="kd-share-btn kd-share-fb" href="#" data-platform="facebook" target="_blank" rel="noopener" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a class="kd-share-btn kd-share-tw" href="#" data-platform="twitter" target="_blank" rel="noopener" title="X / Twitter">
                        <i class="fab fa-x-twitter"></i>
                        <span>Twitter</span>
                    </a>
                    <a class="kd-share-btn kd-share-wa" href="#" data-platform="whatsapp" target="_blank" rel="noopener" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                    <a class="kd-share-btn kd-share-li" href="#" data-platform="linkedin" target="_blank" rel="noopener" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                        <span>LinkedIn</span>
                    </a>
                    <a class="kd-share-btn kd-share-tg" href="#" data-platform="telegram" target="_blank" rel="noopener" title="Telegram">
                        <i class="fab fa-telegram-plane"></i>
                        <span>Telegram</span>
                    </a>
                    <a class="kd-share-btn kd-share-em" href="#" data-platform="email" title="Email">
                        <i class="fas fa-envelope"></i>
                        <span>Email</span>
                    </a>
                </div>

                <!-- Copy link -->
                <div class="kd-share-copy">
                    <input type="text" id="kd-share-input" readonly class="kd-share-input" value="">
                    <button type="button" class="kd-share-copy-btn" id="kd-share-copy-btn" aria-label="<?= __('Copy link'); ?>">
                        <i class="fas fa-copy"></i>
                        <span><?= __('Copy link'); ?></span>
                    </button>
                </div>

                <!-- Feedback toast -->
                <div class="kd-share-toast" id="kd-share-toast" aria-live="polite">
                    <i class="fas fa-check-circle"></i>
                    <span><?= __('Link copied!'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    var modal = document.getElementById('mediaSocialModal');
    if (!modal) return;

    var titleEl = document.getElementById('kd-share-title');
    var urlEl   = document.getElementById('kd-share-url');
    var input   = document.getElementById('kd-share-input');
    var copyBtn = document.getElementById('kd-share-copy-btn');
    var toast   = document.getElementById('kd-share-toast');
    var toastTimer = null;

    // Triggered via Bootstrap modal event (fired by buttons with data-toggle="modal" data-target="#mediaSocialModal")
    $(modal).on('show.bs.modal', function (event) {
        var btn = event.relatedTarget;
        var title = (btn && btn.getAttribute('data-title')) || document.title;
        var url = window.location.href;
        titleEl.textContent = title.length > 80 ? title.slice(0, 77) + '...' : title;
        urlEl.textContent = url;
        input.value = url;

        // Build share URLs
        var encUrl = encodeURIComponent(url);
        var encTitle = encodeURIComponent(title);
        modal.querySelectorAll('.kd-share-btn').forEach(function (a) {
            var p = a.getAttribute('data-platform');
            var href = '#';
            if (p === 'facebook') href = 'https://www.facebook.com/sharer/sharer.php?u=' + encUrl;
            else if (p === 'twitter') href = 'https://twitter.com/intent/tweet?url=' + encUrl + '&text=' + encTitle;
            else if (p === 'whatsapp') href = 'https://wa.me/?text=' + encTitle + '%20' + encUrl;
            else if (p === 'linkedin') href = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encUrl;
            else if (p === 'telegram') href = 'https://t.me/share/url?url=' + encUrl + '&text=' + encTitle;
            else if (p === 'email') href = 'mailto:?subject=' + encTitle + '&body=' + encUrl;
            a.setAttribute('href', href);
        });
    });

    // Copy link dengan fallback
    copyBtn.addEventListener('click', function () {
        input.select();
        input.setSelectionRange(0, 99999);
        var ok = false;
        try {
            ok = document.execCommand('copy');
        } catch (e) { ok = false; }
        if (!ok && navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(input.value).then(function () { ok = true; });
        }
        if (ok) {
            toast.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(function () { toast.classList.remove('show'); }, 2200);
        }
    });
})();
</script>