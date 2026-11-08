<?php
/**
 * MLA Style citation — Pustaka Ceria wrapper (v2 - Bugfix)
 */
$author_list = [];
$authors_string = '';
foreach ($authors as $order => $data) {
    $chunk_name = explode(' ', $data['author_name']);
    $last_chunkname_order = array_key_last($chunk_name);
    $last_name = $chunk_name[$last_chunkname_order];
    $first_name = $chunk_name[0] ?? '';
    if (!str_ends_with(trim($first_name), ',')) {
        unset($chunk_name[$last_chunkname_order]);
        if ($order > 0 && count($authors) > 2) continue;
        $author_list[] = $last_name . ', ' . implode(', ', array_map(fn($name) => ucfirst($name) . '', $chunk_name)) . '.';
    } else {
        if ($order > 0 && count($authors) > 2) continue;
        unset($chunk_name[0]);
        $author_list[] = $first_name . ' ' . implode(', ', array_map(fn($name) => ucfirst($name) . '', $chunk_name)) . '.';
    }
}
$authors_string = implode(', ', $author_list) . (count($authors) > 2 ? ' et al.' : '');
$citation_text = '';
if ($authors_string) {
    $citation_text .= $authors_string . ' ';
    $citation_text .= '<em>' . $title . '</em>. ';
    if ($edition) $citation_text .= $edition . '. ';
    $citation_text .= $publish_place . ': ' . $publisher_name . ', ' . $publish_year . '.';
} else {
    $citation_text = '<em>' . $title . '</em>. ';
    if ($edition) $citation_text .= $edition . '. ';
    $citation_text .= $publish_place . ': ' . $publisher_name . ', ' . $publish_year . '.';
}
?>
<div class="kd-citation-page">
    <a href="javascript:history.back()" class="kd-citation-back">
        <i class="fas fa-arrow-left"></i> <?= __('Back to record'); ?>
    </a>
    <h1><?= __('MLA Style'); ?> <?= __('Citation'); ?></h1>
    <div class="citation-text" id="citation-text"><?= $citation_text; ?></div>
    <div class="kd-citation-actions">
        <button type="button" onclick="copyCitation()" class="kd-citation-actions-btn">
            <i class="fas fa-copy"></i> <?= __('Copy'); ?>
        </button>
        <button type="button" onclick="window.print()" class="kd-citation-actions-btn">
            <i class="fas fa-print"></i> <?= __('Print'); ?>
        </button>
        <a href="javascript:history.back()" class="kd-citation-actions-btn">
            <i class="fas fa-times"></i> <?= __('Close'); ?>
        </a>
    </div>
</div>
<script>
function copyCitation() {
    var t = document.getElementById('citation-text').innerText;
    if (navigator.clipboard) { navigator.clipboard.writeText(t); }
    else { var ta = document.createElement('textarea'); ta.value = t; document.body.appendChild(ta); ta.select(); document.execCommand('copy'); document.body.removeChild(ta); }
}
</script>