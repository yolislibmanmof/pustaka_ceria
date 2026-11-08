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
 * Navbar - Pustaka Ceria theme (v2 — All Menus Visible + Full Dropdown)
 */

// semua menu tampil sebagai link di navbar (desktop)
$main_menus = [
  'home'      => ['text' => __('Home'),      'url' => 'index.php',                              'icon' => 'fa-home'],
  'index'     => ['text' => __('Index'),     'url' => 'index.php?keywords=&search=search',      'icon' => 'fa-list'],
  'libinfo'   => ['text' => __('Information'),'url' => 'index.php?p=libinfo',                   'icon' => 'fa-info-circle'],
  'news'      => ['text' => __('News'),      'url' => 'index.php?p=news',                       'icon' => 'fa-newspaper'],
  'help'      => ['text' => __('Help'),      'url' => 'index.php?p=help',                       'icon' => 'fa-question-circle'],
  'librarian' => ['text' => __('Librarian'), 'url' => 'index.php?p=librarian',                  'icon' => 'fa-users'],
];

// dropdown "titik tiga" = SEMUA menu + area member
$drop = $main_menus;
if ($is_login) {
  $count_basket = count($_SESSION['m_mark_biblio'] ?? []);
  $drop['member'] = ['text' => htmlspecialchars($_SESSION['m_name'] ?? __('Member Area')), 'url' => 'index.php?p=member', 'icon' => 'fa-user'];
  $drop['basket'] = ['text' => __('Basket') . ' <sup id="count-basket" class="kd-badge">' . $count_basket . '</sup>', 'url' => 'index.php?p=member&sec=title_basket', 'icon' => 'fa-shopping-basket'];
  $drop['logout'] = ['text' => __('Logout'), 'url' => 'index.php?p=member&logout=1', 'icon' => 'fa-sign-out-alt'];
} else {
  $drop['member'] = ['text' => __('Member Area'), 'url' => 'index.php?p=member', 'icon' => 'fa-user'];
}

// active language: ?select_lang= (current request) wins over the cookie, then the system default
$select_lang = isset($_GET['select_lang']) && is_string($_GET['select_lang'])
  ? trim(strip_tags($_GET['select_lang']))
  : ($_COOKIE['select_lang'] ?? $sysconf['default_lang']);

// deteksi halaman aktif
$kd_p = $_GET['p'] ?? '';
$kd_is_search = isset($_GET['search']);
?>
<div class="kd-header kd-header-v2">
    <div class="kd-container">
        <a class="kd-brand" href="index.php">
            <?php
            if (isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && $imagesDisk->isExists($path = 'default/' . $sysconf['logo_image'])) {
              echo '<img src="' . SWB . 'lib/minigalnano/createthumb.php?filename=images/' . $path . '&width=350" alt="logo">';
            } elseif (file_exists(__DIR__ . '/../assets/images/logo.png')) {
              echo '<img src="' . assets('images/logo.png') . '" alt="logo">';
            }
            ?>
            <span class="kd-brand-text">
                <strong><?= htmlspecialchars($sysconf['library_name']); ?></strong>
                <?php if (!empty($sysconf['library_subname'])): ?>
                    <span><?= htmlspecialchars($sysconf['library_subname']); ?></span>
                <?php endif; ?>
            </span>
        </a>

        <button class="kd-icon-btn kd-burger" type="button" aria-label="Menu" onclick="document.getElementById('kd-nav').classList.toggle('open')">
            <i class="fas fa-bars"></i>
        </button>

        <nav class="kd-nav kd-nav-v2" id="kd-nav">
            <?php foreach ($main_menus as $key => $menu):
              if ($key === 'home')          $active = ($kd_p === '' && !$kd_is_search);
              elseif ($key === 'index')     $active = $kd_is_search;
              else                          $active = ($kd_p === $key);
            ?>
              <a class="kd-link<?= $active ? ' active' : '' ?>" href="<?= $menu['url'] ?>">
                  <i class="fas <?= $menu['icon'] ?>"></i> <?= $menu['text'] ?>
              </a>
            <?php endforeach; ?>

            <div class="kd-more" id="kd-more">
                <button type="button" class="kd-icon-btn" id="kd-more-btn" aria-haspopup="true" aria-expanded="false" aria-label="<?= __('Menu') ?>" title="<?= __('All Menus') ?>">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="kd-more-menu kd-more-menu-v2" id="kd-more-menu">
                    <span class="kd-more-title"><?= __('All Menus') ?></span>
                    <?php foreach ($drop as $key => $menu): ?>
                        <a href="<?= $menu['url'] ?>" class="<?= ($kd_p === $key) ? 'on' : '' ?>">
                            <i class="fas <?= $menu['icon'] ?>"></i> <span><?= $menu['text'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php
            // only Indonesian (ID) and English (EN) are shown, as in the design
            $kd_langs = array_filter($available_languages ?? [], fn($l) => in_array(strtolower(substr($l[0], 0, 2)), ['id', 'en']));
            usort($kd_langs, fn($a, $b) => strcmp($a[0], $b[0]));
            $kd_flags = ['ID' => 'fi-id', 'EN' => 'fi-us'];
            ?>
            <?php if (count($kd_langs) > 0): ?>
                <span class="kd-lang kd-lang-v2">
                <?php foreach ($kd_langs as $lang_index):
                  $code = strtoupper(substr($lang_index[0], 0, 2));
                  $lang_url = 'index.php?' . http_build_query(array_merge(array_filter($_GET, fn($v, $k) => $k !== 'select_lang' && is_string($v), ARRAY_FILTER_USE_BOTH), ['select_lang' => $lang_index[0]])); ?>
                    <a href="<?= htmlspecialchars($lang_url) ?>" title="<?= $lang_index[1] ?>"
                       class="<?= $lang_index[0] == $select_lang ? 'on' : '' ?>">
                        <span class="fi <?= $kd_flags[$code] ?? '' ?>"></span> <?= $code ?>
                    </a>
                <?php endforeach; ?>
                </span>
            <?php endif; ?>

            <button type="button" class="kd-icon-btn kd-theme-btn" id="kd-theme-toggle" aria-label="<?= __('Toggle theme') ?>">
                <i class="fas fa-moon"></i>
            </button>
        </nav>
    </div>
</div>
<script>
    (function () {
        var more = document.getElementById('kd-more'), moreBtn = document.getElementById('kd-more-btn');
        if (more) {
            moreBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                var open = more.classList.toggle('open');
                moreBtn.setAttribute('aria-expanded', open);
            });
            document.addEventListener('click', function (e) {
                if (!more.contains(e.target)) { more.classList.remove('open'); moreBtn.setAttribute('aria-expanded', false); }
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') { more.classList.remove('open'); moreBtn.setAttribute('aria-expanded', false); }
            });
        }
        var btn = document.getElementById('kd-theme-toggle');
        if (!btn) return;
        function paint() {
            var dark = document.documentElement.getAttribute('data-theme') === 'dark';
            btn.innerHTML = '<i class="fas ' + (dark ? 'fa-sun' : 'fa-moon') + '"></i>';
        }
        btn.addEventListener('click', function () {
            var next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            try { localStorage.setItem('kd-theme', next); } catch (e) {}
            paint();
        });
        paint();
    })();
</script>