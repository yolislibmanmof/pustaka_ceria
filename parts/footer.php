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
 * Footer - Pustaka Ceria theme (v2 — Rich Footer)
 * Catatan: marker kredit (data-kd-credit + email + @tutorial_slims) dipindah
 * ke kolom "Contact & Support" agar guard _credit.php & kd-credit.js tetap lolos.
 */
?>

<footer class="kd-footer kd-footer-v2">
    <div class="kd-footer-glow" aria-hidden="true"></div>

    <div class="kd-container kd-footer-grid">
        <!-- Kolom 1: Brand -->
        <div class="kd-f-col kd-f-brand">
            <?php
            if (isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && $imagesDisk->isExists($path = 'default/' . $sysconf['logo_image'])) {
              echo '<img src="' . SWB . 'lib/minigalnano/createthumb.php?filename=images/' . $path . '&width=350" alt="logo">';
            } elseif (file_exists(__DIR__ . '/../assets/images/logo.png')) {
              echo '<img src="' . assets('images/logo.png') . '" alt="logo">';
            }
            ?>
            <div class="kd-f-name">
                <strong><?= htmlspecialchars($sysconf['library_name']); ?></strong>
                <small><?= htmlspecialchars($sysconf['library_subname'] ?? ''); ?></small>
            </div>
            <p class="kd-f-tagline"><?= __('One-stop search for school library collections'); ?></p>
            <div class="kd-f-social">
                <a href="mailto:tutorialslims@gmail.com" title="Email" aria-label="Email"><i class="fas fa-envelope"></i></a>
                <a href="https://instagram.com/tutorial_slims" target="_blank" rel="noopener" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://slims.web.id" target="_blank" rel="noopener" title="SLiMS" aria-label="SLiMS"><i class="fas fa-globe"></i></a>
            </div>
        </div>

        <!-- Kolom 2: Navigasi -->
        <div class="kd-f-col">
            <h4 class="kd-f-title"><?= __('Main Menu'); ?></h4>
            <ul class="kd-f-links">
                <li><a href="index.php"><?= __('Home'); ?></a></li>
                <li><a href="index.php?keywords=&search=search"><?= __('Index'); ?></a></li>
                <li><a href="index.php?p=libinfo"><?= __('Information'); ?></a></li>
                <li><a href="index.php?p=news"><?= __('News'); ?></a></li>
                <li><a href="index.php?p=help"><?= __('Help'); ?></a></li>
                <li><a href="index.php?p=librarian"><?= __('Librarian'); ?></a></li>
            </ul>
        </div>

        <!-- Kolom 3: Akses Cepat -->
        <div class="kd-f-col">
            <h4 class="kd-f-title"><?= __('Quick Access'); ?></h4>
            <ul class="kd-f-links">
                <li><a href="index.php?keywords=&search=search"><?= __('View All Collections'); ?></a></li>
                <li><a href="#" data-toggle="modal" data-target="#adv-modal"><?= __('Advanced Search'); ?></a></li>
                <li><a href="#" data-toggle="modal" data-target="#exampleModal"><?= __('Browse DDC Classification'); ?></a></li>
                <li><a href="index.php?p=member"><?= __('Member Area'); ?></a></li>
                <li><a href="index.php?p=visitor"><?= __('Visitor Counter'); ?></a></li>
            </ul>
        </div>

        <!-- Kolom 4: Kontak & Dukungan (memuat marker kredit untuk guard) -->
        <div class="kd-f-col kd-f-contact" data-kd-credit="1">
            <h4 class="kd-f-title"><?= __('Contact & Support'); ?></h4>
            <ul class="kd-f-contact-list">
                <li>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:tutorialslims@gmail.com">tutorialslims@gmail.com</a>
                </li>
                <li>
                    <i class="fab fa-instagram"></i>
                    <a href="https://instagram.com/tutorial_slims" target="_blank" rel="noopener">@tutorial_slims</a>
                </li>
                <li>
                    <i class="fas fa-headset"></i>
                    <span><?= __('Librarian'); ?> <?= htmlspecialchars($sysconf['library_name']); ?></span>
                </li>
            </ul>
        </div>
    </div>

    <div class="kd-footer-bottom">
        <div class="kd-container kd-footer-bottom-in">
            <span>&copy; <?= date('Y'); ?> <?= htmlspecialchars($sysconf['library_name']); ?></span>
            <span class="kd-f-powered">
                <?= __('Powered by '); ?><a target="_blank" rel="noopener" href="https://slims.web.id">SLiMS</a>
                &middot; <?= __('Template by'); ?> <strong>Tutorial SLiMS & Yolis Libman</strong>
            </span>
        </div>
    </div>
</footer>
<?php require_once __DIR__ . '/_credit.php'; /* fungsi guard dimuat; marker kredit ada di kolom kontak */ ?>
<script src="<?= assets('js/kd-credit.js'); ?>"></script>

<?php if ($sysconf['chat_system']['enabled'] && $sysconf['chat_system']['opac']) : ?>
    <div id="show-pchat2" style="position: fixed; bottom: 16px; right: 16px" class="shadow rounded">
        <button title="Chat" class="btn btn-primary"><i class="fas fa-comments mr-2"></i><?= __('Chat'); ?></button>
    </div>
<?php endif; ?>

<?php
// Chat Engine
include LIB . "contents/chat.php"; ?>

<!-- // Load modal -->
<?php include "_modal_topic.php"; ?>
<?php include "_modal_advanced.php"; ?>
<?php include "_modal_social_media.php"; ?>

<!-- // Load highlight -->
<script src="<?= JWB; ?>highlight.js"></script>
<?php if (isset($engine) && $searchableInJsArray = $this->generateKeywords($engine->searchable_fields)) : ?>
    <script>
        $('.kd-item *').highlight(<?= $searchableInJsArray ?>);
    </script>
<?php endif; ?>

<!-- // load our vue app.js -->
<script src="<?php echo assets(v('js/app.js')); ?>"></script>
<script src="<?php echo assets(v('js/app_jquery.js')); ?>"></script>
<?php if ($sysconf['chat_system']['enabled'] && $sysconf['chat_system']['opac']) : ?>
    <script>
        $('#show-pchat').click(() => {
            $('.s-chat').hide()
            $('#show-pchat2').show()
        })
        $('#show-pchat2').click(() => {
            $('.s-chat').show(300, () => {
                $('#show-pchat2').hide()
            })
        })
    </script>
<?php endif; ?>
</body>
</html>