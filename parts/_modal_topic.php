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
 * @Created by          : Waris Agung Widodo (ido.alit@gmail.com)
 * @Date                : 2020-01-02 16:27
 * @File name           : _modal_topic.php (v2 — Cinematic Upgrade)
 *
 * Modal pemilih kelas DDC 000-900. Desain card grid dengan ikon, badge,
 * dan hover shine. Gambar PNG tetap digunakan (kompatibilitas).
 */

// Data kelas DDC — memudahkan iterasi & konsisten dengan hero
$kd_ddc_modal = [
    ['0', '0-chemical',           __('Computer Science, Information & General Works'), '#2563eb', '#dbeafe'],
    ['1', '1-memory',             __('Philosophy & Psychology'),                        '#7c3aed', '#ede9fe'],
    ['2', '2-mosque',             __('Religion'),                                       '#059669', '#d1fae5'],
    ['3', '3-diploma',            __('Social Sciences'),                                '#b45309', '#fef3c7'],
    ['4', '4-translation',        __('Language'),                                       '#e11d48', '#ffe4e6'],
    ['5', '5-math',               __('Pure Science'),                                   '#0d9488', '#ccfbf1'],
    ['6', '6-blackboard',         __('Applied Sciences'),                               '#4f46e5', '#e0e7ff'],
    ['7', '7-quill',              __('Art & Recreation'),                               '#db2777', '#fce7f3'],
    ['8', '8-books',              __('Literature'),                                     '#ea580c', '#ffedd5'],
    ['9', '9-return-to-the-past', __('History & Geography'),                            '#0891b2', '#cffafe'],
];
?>

<div class="modal fade kd-topic-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content kd-modal-surface">
            <div class="kd-modal-head">
                <div class="kd-modal-head-left">
                    <span class="kd-modal-icon" style="background:linear-gradient(135deg,#2563eb,#7c3aed)">
                        <i class="fas fa-th-large"></i>
                    </span>
                    <div>
                        <h5 class="kd-modal-title" id="exampleModalLabel"><?= __('Select the topic you are interested in'); ?></h5>
                        <p class="kd-modal-sub"><?= __('Browse by DDC classification — click a class to search directly.'); ?></p>
                    </div>
                </div>
                <button type="button" class="kd-modal-x" data-dismiss="modal" aria-label="<?= __('Close') ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="kd-modal-body">
                <div class="kd-topic-grid">
                    <?php foreach ($kd_ddc_modal as $i => $d):
                        list($num, $img, $label, $color, $bg) = $d;
                    ?>
                        <a class="kd-topic-card kd-card-in"
                           href="index.php?callnumber=<?= $num ?>&search=search"
                           style="--tc: <?= $color ?>; --tb: <?= $bg ?>; animation-delay: <?= $i * 60 ?>ms">
                            <span class="kd-topic-num">DDC <?= $num ?>00</span>
                            <span class="kd-topic-img-wrap">
                                <img src="<?= assets('images/' . $img . '.png'); ?>" alt="<?= htmlspecialchars($label) ?>" loading="lazy">
                            </span>
                            <strong class="kd-topic-label"><?= $label ?></strong>
                            <span class="kd-topic-go">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="kd-topic-shine" aria-hidden="true"></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="kd-modal-foot">
                <span class="kd-modal-credit">
                    <i class="fas fa-image"></i>
                    <?= __('Icons made by'); ?>
                    <a href="http://www.freepik.com" title="Freepik" target="_blank" rel="noopener">Freepik</a>
                    <?= __('from'); ?>
                    <a href="https://www.flaticon.com/" title="Flaticon" target="_blank" rel="noopener">www.flaticon.com</a>
                </span>
            </div>
        </div>
    </div>
</div>