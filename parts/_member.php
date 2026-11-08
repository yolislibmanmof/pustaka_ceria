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
 * Member area - Pustaka Ceria theme (v2 — Cinematic Upgrade)
 */

// Deteksi halaman (login vs dashboard) untuk hero icon
$kd_member_icon = $is_login ? 'fa-user-circle' : 'fa-sign-in-alt';
$kd_member_title = $is_login ? __('Member Dashboard') : __('Member Login');
$kd_member_sub = $is_login 
    ? __('Manage your loans, bookmarks, and reading history.')
    : __('Sign in to access your personalized library experience.');
?>
<header class="c-header"><?php include '_navbar.php'; ?></header>

<?php if ($is_login) : ?>
    <!-- Dashboard hero -->
    <div class="kd-member-hero kd-card-in">
        <div class="kd-container">
            <nav class="kd-breadcrumb" aria-label="breadcrumb">
                <a href="index.php"><i class="fas fa-home"></i></a>
                <span>/</span>
                <span><?= __('Member Area') ?></span>
            </nav>
            <div class="kd-page-title-wrap">
                <span class="kd-page-icon"><i class="fas <?= $kd_member_icon ?>"></i></span>
                <h1 class="kd-page-title"><?= __('Welcome back') ?>, <?= htmlspecialchars($_SESSION['m_name'] ?? __('Member')) ?>!</h1>
                <span class="kd-page-accent"></span>
            </div>
            <p class="kd-member-lead"><?= htmlspecialchars($_SESSION['m_email'] ?? '') ?></p>
        </div>
    </div>

    <!-- Stats strip (jumlah pinjaman, bookmark, dll) -->
    <div class="kd-container kd-member-stats-wrap kd-card-in">
        <div class="kd-member-stats">
            <div class="kd-stat-pill">
                <i class="fas fa-shopping-basket"></i>
                <div>
                    <strong><?= (int)count($_SESSION['m_mark_biblio'] ?? []) ?></strong>
                    <span><?= __('Basket') ?></span>
                </div>
            </div>
            <div class="kd-stat-pill">
                <i class="fas fa-bookmark"></i>
                <div>
                    <strong><?= (int)count($_SESSION['bookmark'] ?? []) ?></strong>
                    <span><?= __('Bookmarks') ?></span>
                </div>
            </div>
            <div class="kd-stat-pill">
                <i class="fas fa-book"></i>
                <div>
                    <strong><?= htmlspecialchars($_SESSION['m_member_type_name'] ?? '-') ?></strong>
                    <span><?= __('Member Type') ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="kd-container kd-member-wrap kd-card-in">
        <div class="kd-member-card">
            <?php echo $main_content; ?>
        </div>
    </div>
<?php else: ?>
    <?php include '_search-form.php'; ?>

    <!-- Login hero -->
    <div class="kd-member-hero kd-login-hero kd-card-in">
        <div class="kd-container">
            <div class="kd-login-head">
                <span class="kd-page-icon kd-icon-large"><i class="fas <?= $kd_member_icon ?>"></i></span>
                <h1 class="kd-page-title"><?= __('Member Login') ?></h1>
                <p class="kd-member-lead"><?= __('Access your loans, bookmarks, and reading history in one place.') ?></p>
            </div>
        </div>
    </div>

    <div class="kd-container kd-member-wrap page-member-area">
        <div class="kd-login-grid kd-card-in">
            <div class="kd-login-form-col">
                <div class="kd-prose-card kd-login-card">
                    <?php echo $main_content; ?>
                </div>
            </div>
            <aside class="kd-login-side">
                <div class="kd-side-info">
                    <h3><i class="fas fa-info-circle"></i> <?= __('Need help?') ?></h3>
                    <p><?= __('If you are a registered member, use your member ID and password to log in.') ?></p>
                    <p><?= __('Not a member yet? Contact the librarian to register.') ?></p>
                    <div class="kd-side-contact">
                        <a href="mailto:tutorialslims@gmail.com"><i class="fas fa-envelope"></i> tutorialslims@gmail.com</a>
                        <a href="https://instagram.com/tutorial_slims" target="_blank"><i class="fab fa-instagram"></i> @tutorial_slims</a>
                    </div>
                </div>
                <div class="kd-side-info">
                    <h3><i class="fas fa-shield-alt"></i> <?= __('Your data is safe') ?></h3>
                    <p><?= __('We protect your information with industry-standard security. Your password is never shared.') ?></p>
                </div>
            </aside>
        </div>
    </div>
<?php endif; ?>