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
 * Detail template - Pustaka Ceria theme (v2.1 — Cinematic Upgrade, navbar-safe)
 * CATATAN: file ini dirender SEBELUM index_template; navbar & search band
 * ditambahkan otomatis oleh parts/_other.php. JANGAN include parts di sini.
 */

// the detail is rendered before index_template, so make sure extra translations are loaded
include_once __DIR__ . '/lang.php';

$setBookmarked = trim(isset($_SESSION['bookmark'][$biblio_id]) ? 'bg-success text-white' : '');

// back link: return to previous search when keywords are known
$kd_back = 'index.php';
if (!empty($_GET['keywords'])) {
    $kd_back = 'index.php?keywords=' . urlencode($_GET['keywords']) . '&search=search';
}

// similar documents: share at least one subject with this record
$kd_similar = [];
$kd_db = isset($this) && isset($this->db) ? $this->db : $GLOBALS['dbs'];
$kd_sq = $kd_db->query('SELECT b.biblio_id, b.title, b.publish_year, b.image,
    (SELECT GROUP_CONCAT(a.author_name SEPARATOR "; ") FROM biblio_author ba INNER JOIN mst_author a ON a.author_id=ba.author_id WHERE ba.biblio_id=b.biblio_id) AS authors
    FROM biblio b
    INNER JOIN biblio_topic bt ON bt.biblio_id=b.biblio_id
    WHERE b.biblio_id<>'.(int)$biblio_id.' AND bt.topic_id IN (SELECT topic_id FROM biblio_topic WHERE biblio_id='. (int)$biblio_id.')
    GROUP BY b.biblio_id ORDER BY COUNT(*) DESC, b.biblio_id DESC LIMIT 6');
if ($kd_sq) {
    while ($r = $kd_sq->fetch_assoc()) $kd_similar[] = $r;
}

// availability summary: total copies minus copies currently on loan (from database)
$kd_total = (int)$kd_db->query('SELECT COUNT(*) FROM item WHERE biblio_id='. (int)$biblio_id)->fetch_row()[0];
$kd_lent = (int)$kd_db->query('SELECT COUNT(*) FROM loan AS l INNER JOIN item AS i ON l.item_code=i.item_code WHERE l.is_lent=1 AND l.is_return=0 AND i.biblio_id='. (int)$biblio_id)->fetch_row()[0];
$kd_avail = max(0, $kd_total - $kd_lent);

// copies (items) of this record, straight from the database
$kd_items = [];
$kd_iq = $kd_db->query('SELECT i.item_code, i.call_number, l.location_name, ct.coll_type_name, st.item_status_name, st.no_loan,
    (SELECT COUNT(*) FROM loan lo WHERE lo.item_code=i.item_code AND lo.is_lent=1 AND lo.is_return=0) AS on_loan
    FROM item i
    LEFT JOIN mst_location l ON l.location_id=i.location_id
    LEFT JOIN mst_coll_type ct ON ct.coll_type_id=i.coll_type_id
    LEFT JOIN mst_item_status st ON st.item_status_id=i.item_status_id
    WHERE i.biblio_id='. (int)$biblio_id.' ORDER BY i.item_code');
if ($kd_iq) {
    while ($r = $kd_iq->fetch_assoc()) {
        if ((int)$r['on_loan'] > 0) { $r['_cls'] = 'loan'; $r['_label'] = _('On Loan'); }
        elseif (!empty($r['item_status_name'])) { $r['_cls'] = 'no'; $r['_label'] = $r['item_status_name']; }
        else { $r['_cls'] = 'ok'; $r['_label'] = _('Available'); }
        $kd_items[] = $r;
    }
}

$kd_row = function ($label, $value, $class = '') {
    if ($value === null || trim(strip_tags((string)$value)) === '') return;
    echo '<dt>' . $label . '</dt><dd class="' . $class . '">' . $value . '</dd>';
};
?>

<!-- Breadcrumb hero (konten murni, tanpa navbar — navbar dari _other.php) -->
<div class="kd-detail-hero">
    <div class="kd-detail-hero-inner kd-container">
        <a class="kd-back" href="<?=$kd_back?>"><i class="fas fa-arrow-left"></i> <?=__('Back to search results'); ?></a>
        <div class="kd-breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i></a>
            <span>/</span>
            <a href="index.php?keywords=&search=search"><?=__('Collections'); ?></a>
            <span>/</span>
            <span><?=htmlspecialchars(mb_strimwidth(strip_tags($title), 0, 60, '…'))?></span>
        </div>
    </div>
</div>

<div class="kd-container">
    <div class="kd-detail kd-reveal">
        <article class="kd-card kd-detail-main">
            <div class="kd-tags" style="margin-bottom:6px">
                <?php if (!empty($gmd_name)): ?><span class="kd-tag"><i class="fas fa-file-alt"></i> <?=$gmd_name?></span><?php endif; ?>
                <?php if (!empty($publish_year)): ?><span class="kd-tag plain"><i class="far fa-calendar"></i> <?=$publish_year?></span><?php endif; ?>
                <?php if (!empty($classification)): ?><span class="kd-tag plain"><i class="fas fa-tag"></i> <?=htmlspecialchars($classification)?></span><?php endif; ?>
            </div>
            <h1 class="kd-detail-title"><?=stripslashes($title); ?></h1>
            <div class="kd-byline">
                <i class="fas fa-pen-fancy"></i>
                <?=str_replace('<br />', ' · ', $authors); ?>
            </div>

            <div class="kd-detail-actions">
                <a href="#" data-id="<?=$biblio_id?>" data-detail="true" class="kd-act-btn bookMarkBook <?=$setBookmarked?>">
                    <i class="fas fa-bookmark"></i>
                    <label id="label-<?=$biblio_id?>" style="margin:0;cursor:pointer"><?=in_array($biblio_id, $_SESSION['bookmark'] ?? []) ? _('Bookmarked') : _('Bookmark') ?></label>
                </a>
                <a href="javascript:void(0)" class="kd-act-btn" data-toggle="modal" data-id="<?=$biblio_id?>" data-title="<?=$title?>" data-target="#mediaSocialModal">
                    <i class="fas fa-share-alt"></i> <?=_('Share') ?>
                </a>
                <a href="index.php?p=cite&id=<?= (int)$biblio_id?>" class="kd-act-btn openPopUp citationLink" target="_blank">
                    <i class="fas fa-quote-right"></i> <?=_('Cite') ?>
                </a>
                <a href="index.php?p=show_detail&id=<?=$biblio_id?>&MARC=true" class="kd-act-btn" target="_blank">
                    <i class="fas fa-file-code"></i> MARC
                </a>
            </div>

            <!-- Tabbed content -->
            <div class="kd-tabs">
                <div class="kd-tabs-nav">
                    <button type="button" class="kd-tab-btn active" data-tab="overview">
                        <i class="fas fa-book-open"></i> <?=__('Overview'); ?>
                    </button>
                    <button type="button" class="kd-tab-btn" data-tab="availability">
                        <i class="fas fa-boxes"></i> <?=__('Availability'); ?> <sup><?= (int)$kd_total ?></sup>
                    </button>
                    <button type="button" class="kd-tab-btn" data-tab="metadata">
                        <i class="fas fa-info-circle"></i> <?=__('Metadata'); ?>
                    </button>
                </div>

                <div class="kd-tab-content">
                    <!-- TAB: Overview -->
                    <div class="kd-tab-pane active" data-pane="overview">
                        <div class="kd-note-box">
                            <div class="kd-note-head">
                                <i class="fas fa-file-alt"></i> <strong><?=__('Abstract / Description'); ?></strong>
                            </div>
                            <div class="kd-note-body">
                                <?=trim(strip_tags((string)$notes)) !== '' ? $notes : '<em class="kd-muted">' . _('No additional notes / abstract for this collection.') . '</em>' ?>
                            </div>
                        </div>

                        <div class="kd-meta-grid">
                            <div class="kd-meta-item">
                                <span><?=__('Publisher'); ?></span>
                                <strong><?=htmlspecialchars($publisher_name ?: '-') ?></strong>
                            </div>
                            <div class="kd-meta-item">
                                <span><?=__('Place & Year'); ?></span>
                                <strong><?=htmlspecialchars(trim(trim((string)$publish_place) . ((string)$publish_year !== '' ? ', ' . $publish_year : ''), ', ') ?: '-') ?></strong>
                            </div>
                            <div class="kd-meta-item">
                                <span><?=__('ISBN / ISSN'); ?></span>
                                <strong class="kd-mono-n"><?=htmlspecialchars($isbn_issn ?: '-') ?></strong>
                            </div>
                            <div class="kd-meta-item">
                                <span><?=__('Language'); ?></span>
                                <strong><?=htmlspecialchars($language_name ?: '-') ?></strong>
                            </div>
                        </div>

                        <?php if (!empty($subjects)): ?>
                        <div class="kd-subjects-block">
                            <div class="kd-sub-h"><i class="fas fa-tags"></i> <?=__('Subject(s)'); ?></div>
                            <div class="kd-subjects-chips">
                                <?php
                                if (preg_match_all('/<a[^>]*href="([^"]*)"[^>]*>([^<]*)<\/a>/', (string)$subjects, $m)) {
                                    foreach ($m[1] as $i => $url) {
                                        echo '<a class="kd-subject-chip" href="' . $url . '"><i class="fas fa-hashtag"></i> ' . htmlspecialchars(strip_tags($m[2][$i])) . '</a>';
                                    }
                                } else {
                                    echo $subjects;
                                }
                                ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- TAB: Availability -->
                    <div class="kd-tab-pane" data-pane="availability">
                        <div class="kd-avail-hero <?= $kd_avail > 0 ? 'ok' : 'no' ?>">
                            <div class="kd-avail-icon">
                                <i class="fas <?= $kd_avail > 0 ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                            </div>
                            <div>
                                <strong><?= $kd_avail > 0 ? _('Available') : __('All copies on loan') ?></strong>
                                <small><?= sprintf(__('%d of %d copies available'), $kd_avail, $kd_total) ?></small>
                            </div>
                        </div>

                        <?php if ($kd_items): ?>
                        <div class="kd-items-wrap">
                            <table class="kd-items">
                                <thead><tr>
                                    <th><?=__('Barcode / Item Code') ?></th>
                                    <th><?=__('Call No.') ?></th>
                                    <th><?=__('Location & Collection') ?></th>
                                    <th><?=__('Status') ?></th>
                                </tr></thead>
                                <tbody>
                                    <?php foreach ($kd_items as $it): ?>
                                        <tr>
                                            <td><code><?=htmlspecialchars($it['item_code']) ?></code></td>
                                            <td><?=htmlspecialchars($it['call_number'] ?: ($call_number ?? '')) ?></td>
                                            <td><?=htmlspecialchars($it['location_name'] ?: '-') ?><?=$it['coll_type_name'] ? ' <span class="kd-muted">· ' . htmlspecialchars($it['coll_type_name']) . '</span>' : ''?></td>
                                            <td><span class="kd-st <?=$it['_cls']?>"><?=htmlspecialchars($it['_label']) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <p class="kd-empty-msg"><i class="fas fa-inbox"></i> <?=_('No copy data') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- TAB: Metadata -->
                    <div class="kd-tab-pane" data-pane="metadata">
                        <div class="kd-fields">
                            <?php
                            $kd_v = function ($v) {
                                $t = trim(strip_tags((string)$v));
                                return $t === '' ? '-' : htmlspecialchars($t);
                            };
                            $kd_place_year = trim(trim((string)$publish_place) . ((string)$publish_year !== '' ? ', ' . $publish_year : ''), ', ');
                            $kd_loc = '';
                            foreach ($kd_items as $it) { if (trim((string)$it['location_name']) !== '') { $kd_loc = $it['location_name']; break; } }
                            $kd_lu_q = $kd_db->query('SELECT last_update FROM biblio WHERE biblio_id='. (int)$biblio_id);
                            $kd_lu = $kd_lu_q ? ($kd_lu_q->fetch_row()[0] ?? '') : '';

                            $kd_fields = [
                                ['Series Title', $kd_v($series_title)],
                                ['Call Number', trim((string)$call_number) !== '' ? '<span class="kd-mono-b">' . $kd_v($call_number) . '</span>' : '-'],
                                ['Publisher', $kd_v($publisher_name)],
                                ['Place & Year Published', $kd_v($kd_place_year)],
                                ['Edition', $kd_v($edition)],
                                ['Physical Description (Collation)', $kd_v($collation)],
                                ['ISBN / ISSN', trim((string)$isbn_issn) !== '' ? '<span class="kd-mono-n">' . $kd_v($isbn_issn) . '</span>' : '-'],
                                ['Classification', $kd_v($classification)],
                                ['Language', $kd_v($language_name)],
                                ['Shelf Location', $kd_v($kd_loc)],
                                ['Specific Detail Info', $kd_v($spec_detail_info)],
                                ['Last Updated', $kd_v($kd_lu)],
                            ];
                            foreach ($kd_fields as $f): ?>
                                <div class="kd-field"><span><?=__($f[0].'')?></span><b><?=$f[1] ?></b></div>
                            <?php endforeach; ?>
                        </div>

                        <dl class="kd-dl">
                            <?php
                            $kd_row(__('Content Type'), $content_type);
                            $kd_row(__('Media Type'), $media_type);
                            $kd_row(__('Carrier Type'), $carrier_type);
                            $kd_row(__('Statement of Responsibility'), $sor);
                            if (!empty($biblio_custom)) {
                                foreach ($biblio_custom as $item) $kd_row($item['label'], $item['value']);
                            }
                            ?>
                        </dl>

                        <?php if (!empty($related)): ?>
                            <div class="kd-sub-h"><?=__('Other version/related'); ?></div>
                            <div><?=$related?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- File Attachment -->
            <div class="kd-section-block" id="attachment">
                <div class="kd-sub-h"><i class="fas fa-paperclip"></i> <?=_('File Attachment'); ?></div>
                <div class="kd-attachment-box" itemprop="associatedMedia"><?= !$file_att ? '<em class="kd-muted"><i class="fas fa-inbox"></i> ' . _('No Data') . '</em>' : $file_att; ?></div>
            </div>

            <!-- Comments -->
            <div class="kd-section-block" id="comment">
                <div class="kd-sub-h"><i class="fas fa-comments"></i> <?=_('Comments'); ?></div>
                <?php echo showComment($biblio_id); ?>
                <?php if (!isset($_SESSION['mid']) && $sysconf['comment']['enable']): ?>
                    <a href="index.php?p=member" class="kd-act-btn kd-act-primary mt-2">
                        <i class="fas fa-sign-in-alt"></i> <?=_('You must be logged in to post a comment'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </article>

        <!-- Sticky sidebar: cover 3D + similar docs -->
        <aside class="kd-detail-side">
            <div class="kd-cover-card kd-tilt-card" data-tilt data-tilt-max="4" data-tilt-speed="400" data-tilt-glare data-tilt-max-glare="0.12" data-tilt-scale="1.02">
                <div class="kd-cover-frame">
                    <?=$image; ?>
                    <div class="kd-cover-shine"></div>
                </div>
                <div class="kd-avail-box <?=$kd_avail > 0 ? 'ok' : 'no'?>">
                    <span><?=__('Availability') ?></span>
                    <strong><?=$kd_avail === 1 ? _('1 Item') : sprintf(_(' %d Items'), $kd_avail) ?></strong>
                </div>
                <a class="kd-side-btn openPopUp citationLink" href="index.php?p=cite&id=<?= (int)$biblio_id?>" title="<?=str_replace('{title}', htmlspecialchars(substr(strip_tags($title), 0, 50)), _('Citation for: {title}')) ?>" target="_blank">
                    <i class="fas fa-quote-right"></i> <?=_('Cite This Collection') ?>
                </a>
                <a class="kd-side-btn" href="index.php?p=show_detail&id=<?= (int)$biblio_id?>&MARC=true" target="_blank">
                    <i class="fas fa-file-code"></i> <?=_('Download MARC') ?>
                </a>
                <a class="kd-side-btn" href="index.php?p=show_detail&id=<?= (int)$biblio_id?>&JSONLD=true" target="_blank">
                    <i class="fas fa-database"></i> <?=_('View JSON Record') ?>
                </a>
            </div>

            <?php if ($kd_similar): ?>
                <div class="kd-card kd-related kd-reveal">
                    <div class="kd-related-head">
                        <i class="fas fa-layer-group"></i>
                        <strong><?=__('Similar Documents'); ?></strong>
                    </div>
                    <div class="kd-related-list">
                        <?php foreach ($kd_similar as $s):
                            $s_img = !empty($s['image']) ? './lib/minigalnano/createthumb.php?filename=' . urlencode('images/docs/' . $s['image']) . '&width=80' : '';
                        ?>
                            <a class="kd-related-item" href="index.php?p=show_detail&id=<?=$s['biblio_id'] ?>">
                                <?php if ($s_img): ?>
                                    <span class="kd-related-cover" style="background-image:url('<?=$s_img?>')"></span>
                                <?php else: ?>
                                    <span class="kd-related-cover kd-related-cover-empty"><i class="fas fa-book"></i></span>
                                <?php endif; ?>
                                <span class="kd-related-info">
                                    <strong><?=htmlspecialchars(mb_strimwidth($s['title'], 0, 90, '…')) ?></strong>
                                    <small><?=htmlspecialchars(trim(($s['authors'] ?? '') . ($s['publish_year'] ? ' · ' . $s['publish_year'] : ''), ' ·')) ?></small>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</div>
</div>

<script>
(function () {
    // Tab switching
    document.querySelectorAll('.kd-tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var tab = btn.getAttribute('data-tab');
            document.querySelectorAll('.kd-tab-btn').forEach(function (b) { b.classList.toggle('active', b === btn); });
            document.querySelectorAll('.kd-tab-pane').forEach(function (p) {
                p.classList.toggle('active', p.getAttribute('data-pane') === tab);
            });
        });
    });

    // Scroll reveal
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) { en.target.classList.add('kd-in'); io.unobserve(en.target); }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.kd-reveal').forEach(function (el, i) {
            el.style.transitionDelay = (i * 90) + 'ms';
            io.observe(el);
        });
    } else {
        document.querySelectorAll('.kd-reveal').forEach(function (el) { el.classList.add('kd-in'); });
    }
})();
</script>