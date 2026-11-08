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
 * Generic content page (info, news, help, librarian, detail) - Pustaka Ceria theme (v2)
 */

$kd_page = isset($_GET['p']) ? (string) $_GET['p'] : '';
$kd_page_clean = htmlspecialchars(strip_tags((string) $page_title));

// Icon per halaman (opsional)
$kd_page_icons = [
    'libinfo'  => 'fa-info-circle',
    'news'     => 'fa-newspaper',
    'help'     => 'fa-question-circle',
    'librarian'=> 'fa-users',
    'visitor'  => 'fa-user-clock',
    'show_detail' => 'fa-book-open',
];
$kd_icon = isset($kd_page_icons[$kd_page]) ? $kd_page_icons[$kd_page] : 'fa-file-alt';
?>
<header class="c-header"><?php include '_navbar.php'; ?></header>
<?php include '_search-form.php'; ?>

<!-- Page hero with breadcrumb -->
<div class="kd-page-hero kd-card-in">
    <div class="kd-container">
        <nav class="kd-breadcrumb" aria-label="breadcrumb">
            <a href="index.php"><i class="fas fa-home"></i></a>
            <span>/</span>
            <span><?= $kd_page_clean ?></span>
        </nav>
        <div class="kd-page-title-wrap">
            <span class="kd-page-icon"><i class="fas <?= $kd_icon ?>"></i></span>
            <h1 class="kd-page-title"><?= $kd_page_clean ?></h1>
            <span class="kd-page-accent"></span>
        </div>
    </div>
</div>

<section class="kd-page">
    <div class="kd-container">
        <?php
        if ($kd_page !== 'show_detail') {
            if ($kd_page === 'librarian') {
                // Halaman pustakawan: bungkus dalam grid cards
                echo '<div class="kd-librarian-grid">';
                echo $main_content;
                echo '</div>';
            } elseif ($kd_page === 'news') {
                // Halaman berita: wrapper agar card berjejer dengan spacing
                echo '<div class="kd-news-list">';
                echo $main_content;
                echo '</div>';
            } elseif ($kd_page === 'help') {
                // Halaman bantuan: prose card
                echo '<article class="kd-prose-card">';
                echo '<div class="kd-prose-head"><i class="fas fa-question-circle"></i> <strong>' . __('Frequently Asked Questions & Guides') . '</strong></div>';
                echo $main_content;
                echo '</article>';
            } else {
                // Halaman info / lainnya: prose card
                echo '<article class="kd-prose-card">';
                echo $main_content;
                echo '</article>';
            }
        } else {
            // show_detail dirender oleh detail_template.php sebelum index
            echo $main_content;
        }
        ?>
    </div>
</section>