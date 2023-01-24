<?php
/**
 * Template footer, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** FOOTER ********** -->
<footer class="footer">
    <div class="footer-content">
        <?php tpl_pageinfo() ?>
        <?php tpl_license(''); // license text ?>
        <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    </div>
</footer>
