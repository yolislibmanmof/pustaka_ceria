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
 * Advanced search modal - Pustaka Ceria theme (v2 — polished)
 * Every field is a real search parameter of SLiMS and is pre-filled from the current query.
 */

// current value of a search parameter (plain text, safe for attributes)
$kd_av = function ($name) {
    $v = $_GET[$name] ?? '';
    if (is_array($v) || $v === '0') return '';
    return htmlspecialchars(trim((string)$v), ENT_QUOTES);
};
// mark the matching option as selected
$kd_sel = function ($html, $name) {
    $v = $_GET[$name] ?? '';
    if (is_array($v) || $v === '' || $v === '0') return $html;
    $needle = 'value="' . $v . '"';
    return str_replace($needle, $needle . ' selected', $html);
};
?>

<div class="modal fade kd-adv kd-adv-modal" id="adv-modal" tabindex="-1" role="dialog" aria-labelledby="kdAdvTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <form class="modal-content kd-modal-surface" action="index.php" method="get">
            <div class="kd-modal-head kd-adv-head">
                <div class="kd-modal-head-left">
                    <span class="kd-modal-icon kd-adv-icon"><i class="fas fa-sliders-h"></i></span>
                    <div>
                        <h5 class="kd-modal-title" id="kdAdvTitle"><?= __('Detailed Search') ?></h5>
                        <p class="kd-modal-sub"><?= __('Combine several search fields at once in table') ?> <code>search_biblio</code></p>
                    </div>
                </div>
                <button type="button" class="kd-modal-x kd-adv-x" data-dismiss="modal" aria-label="<?= __('Close') ?>"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="kd-modal-body kd-adv-body">
                <div class="kd-adv-row c2">
                    <div class="kd-adv-f">
                        <label for="adv-titles"><i class="fas fa-book"></i> <?= __('Book Title') ?></label>
                        <input type="text" name="title" id="adv-titles" value="<?= $kd_av('title') ?>" placeholder="<?= __('Enter words in the title...') ?>">
                    </div>
                    <div class="kd-adv-f">
                        <label for="adv-author"><i class="fas fa-user"></i> <?= __('Author Name') ?></label>
                        <input type="text" name="author" id="adv-author" value="<?= $kd_av('author') ?>" placeholder="<?= __('e.g. Mulyadi, Sugiyono...') ?>">
                    </div>
                </div>

                <div class="kd-adv-row c2">
                    <div class="kd-adv-f">
                        <label for="adv-subject"><i class="fas fa-tag"></i> <?= __('Topic / Subject') ?></label>
                        <input type="text" name="subject" id="adv-subject" value="<?= $kd_av('subject') ?>" placeholder="<?= __('e.g. Accounting, Psychology, Fiction...') ?>">
                    </div>
                    <div class="kd-adv-f">
                        <label for="adv-isbn"><i class="fas fa-barcode"></i> ISBN / ISSN</label>
                        <input type="text" name="isbn" id="adv-isbn" value="<?= $kd_av('isbn') ?>" placeholder="<?= __('e.g. 978-979-...') ?>">
                    </div>
                </div>

                <div class="kd-adv-row c3">
                    <div class="kd-adv-f">
                        <label for="adv-publisher"><i class="fas fa-building"></i> <?= __('Publisher') ?></label>
                        <input type="text" name="publisher" id="adv-publisher" value="<?= $kd_av('publisher') ?>" placeholder="<?= __('e.g. Erlangga, Salemba...') ?>">
                    </div>
                    <div class="kd-adv-f">
                        <label for="adv-publishyear"><i class="far fa-calendar"></i> <?= __('Publication Year') ?></label>
                        <input type="number" name="publishyear" id="adv-publishyear" min="1000" max="2100" value="<?= $kd_av('publishyear') ?>" placeholder="<?= __('e.g. 2022') ?>">
                    </div>
                    <div class="kd-adv-f">
                        <label for="adv-location"><i class="fas fa-map-marker-alt"></i> <?= __('Shelf Location') ?></label>
                        <select id="adv-location" name="location"><?= $kd_sel(commonList('location'), 'location'); ?></select>
                    </div>
                </div>

                <div class="kd-adv-row c2">
                    <div class="kd-adv-f">
                        <label for="adv-coll-type"><i class="fas fa-layer-group"></i> <?= __('Collection Type') ?></label>
                        <select name="colltype" id="adv-coll-type"><?= $kd_sel(commonList('collection'), 'colltype'); ?></select>
                    </div>
                    <div class="kd-adv-f">
                        <label for="adv-gmd"><i class="fas fa-compact-disc"></i> <?= __('Media Format (GMD)') ?></label>
                        <select id="adv-gmd" name="gmd"><?= $kd_sel(commonList('gmd'), 'gmd'); ?></select>
                    </div>
                </div>
            </div>

            <div class="kd-modal-foot kd-adv-foot">
                <button type="button" class="kd-modal-btn-secondary kd-adv-cancel" data-dismiss="modal"><?= __('Cancel') ?></button>
                <button type="submit" name="search" value="search" class="kd-modal-btn-primary kd-adv-go">
                    <i class="fas fa-search"></i> <?= __('Find Collection') ?>
                </button>
            </div>
        </form>
    </div>
</div>