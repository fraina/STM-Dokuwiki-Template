<?php
/**
 * Template header, included in the main and detail files
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
?>

<!-- ********** HEADER ********** -->
<header class="header">
    <div class="header-content">
        <hgroup class="header-heading fl">
            <h1 class="header-title prs">
                <?php
                    // display logo and wiki title in a link to the home page
                    tpl_link(
                        wl(),
                        '<span>'.$conf['title'].'</span>',
                        'accesskey="h" title="[H]"'
                    );
                ?>
            </h1>
            <?php if ($conf['tagline']): ?>
                <h5 class="header-subTitle tsi"><?php echo $conf['tagline']; ?></h5>
            <?php endif ?>
        </hgroup>
        <div class="header-nav fr pc-only">
            <div class="header-navButton--menuTools has-subList">
                <a class="icon-cube"></a>
                <ul>
                    <?php
                            tpl_action('edit', 1, 'li');
                            tpl_action('revert', 1, 'li');
                            tpl_action('backlink', 1, 'li');
                            tpl_action('recent', 1, 'li');
                            tpl_action('media', 1, 'li');
                            tpl_action('index', 1, 'li');
                    ?>
                </ul>
            </div>
            <div class="header-navButton--userTools has-subList">
                <a class="icon-user"></a>
                <ul>
                    <?php
                        if (!empty($_SERVER['REMOTE_USER'])) {
                            echo '<li class="user">';
                            tpl_userinfo(); /* 'Logged in as ...' */
                            echo '</li>';
                        }
                        tpl_action('admin', 1, 'li');
                        tpl_action('profile', 1, 'li');
                        tpl_action('register', 1, 'li');
                        tpl_action('login', 1, 'li');
                    ?>
                </ul>
            </div>
            <div class="header-navButton--searchBar">
                <?php tpl_searchform(); ?>
                <a class="icon-search"></a>
            </div>
        </div>
        <div class="header-nav fr not-pc">
          <div class="header-navButton">
            <a class="icon-cube"></a>
          </div>
      </div>
    </div>
</header>

<div class="nav-for-device">
  <div class="header-navButton--searchBar">
      <?php tpl_searchform(); ?>
      <a class="icon-search"></a>
  </div>
  <ul>
    <?php
            tpl_action('edit', 1, 'li');
            tpl_action('backlink', 1, 'li');
            tpl_action('recent', 1, 'li');
            tpl_action('index', 1, 'li');
    ?>
    <?php
        if (!empty($_SERVER['REMOTE_USER'])) {
            echo '<li class="user">';
            tpl_userinfo(); /* 'Logged in as ...' */
            echo '</li>';
        }
        tpl_action('admin', 1, 'li');
        tpl_action('profile', 1, 'li');
        tpl_action('register', 1, 'li');
        tpl_action('login', 1, 'li');
    ?>
  </ul>
</div>
