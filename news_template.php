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
 * @Date                : 2019-01-31 17:30
 * @File name           : news_template.php (v2 — Cinematic Upgrade)
 */

function news_list_tpl($title, $path, $date, $summary) {
    global $sysconf;
    if (isset($_COOKIE['select_lang'])) $sysconf['default_lang'] = trim(strip_tags($_COOKIE['select_lang']));

    // Format tanggal dengan Carbon (sudah ada di SLiMS)
    try {
        $parsed = \Carbon\Carbon::parse($date)->locale($sysconf['default_lang']);
        $day_num = $parsed->format('d');
        $month_short = $parsed->isoFormat('MMM');
        $full_date = $parsed->isoFormat('dddd, LL');
        $year = $parsed->format('Y');
    } catch (\Exception $e) {
        $day_num = $date; $month_short = ''; $full_date = $date; $year = '';
    }
    ?>

    <article class="kd-news-card kd-card-in">
        <aside class="kd-news-date" aria-label="<?= htmlspecialchars($full_date) ?>">
            <span class="kd-news-day"><?= htmlspecialchars($day_num) ?></span>
            <span class="kd-news-month"><?= htmlspecialchars($month_short) ?></span>
            <span class="kd-news-year"><?= htmlspecialchars($year) ?></span>
            <i class="far fa-calendar-alt kd-news-ico" aria-hidden="true"></i>
        </aside>
        <div class="kd-news-body">
            <div class="kd-news-meta">
                <span class="kd-news-date-full"><i class="far fa-clock"></i> <?= htmlspecialchars($full_date) ?></span>
            </div>
            <h3 class="kd-news-title"><?= htmlspecialchars(strip_tags($title)) ?></h3>
            <p class="kd-news-summary"><?= $summary ?>…</p>
            <a class="kd-news-read-more" href="<?php echo SWB . 'index.php?p=' . $path ?>">
                <?php echo __('Read More') ?>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="kd-news-shine" aria-hidden="true"></div>
    </article>

    <?php
}