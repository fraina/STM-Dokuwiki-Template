<?php
/**
 * DokuWiki Image Detail Page
 *
 * @author   Andreas Gohr <andi@splitbrain.org>
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();
header('X-UA-Compatible: IE=edge,chrome=1');

$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
?><!DOCTYPE html>
<html lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8" />
    <title>
        <?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG))?>
        [<?php echo strip_tags($conf['title'])?>]
    </title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders()?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>

<body>
    <div class="wrapper">
      <script>console.log(<?php
        echo json_encode($conf['sidebar']);
      ?>);</script>
        <?php
            // render the content into buffer for later use
            ob_start();
            tpl_content(false);
            $buffer = ob_get_clean();
        ?>
        <?php include('tpl_header.php') ?>

        <div class="wrapper-content">
            <div class="sidebar fl">
                <aside class="sidebar-aside">
                    <?php if(!$ERROR): ?>
                      <h3 class="sidebar-title"><?php echo nl2br(hsc(tpl_img_getTag('simple.title'))); ?></h3>
                    <?php endif; ?>

                    <div class="sidebar-breadcrumbs">
                        <?php if($conf['breadcrumbs'] || $conf['youarehere']): ?>
                            <div class="breadcrumbs">
                                <?php if($conf['youarehere']): ?>
                                    <div class="youarehere"><?php tpl_youarehere() ?></div>
                                <?php endif ?>
                                <?php if($conf['breadcrumbs']): ?>
                                    <div class="trace"><?php tpl_breadcrumbs() ?></div>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="sidebar-page">
                      <?php if ($showSidebar): ?>
                        <?php tpl_includeFile('sidebarheader.html') ?>
                        <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                        <?php tpl_includeFile('sidebarfooter.html') ?>
                      <?php endif; ?>
                    </div>
                </aside>
            </div>
            <div class="main fr">
                <div class="detail-wrapper">
                    <?php tpl_flush() ?>
                    <?php
                    if($ERROR):
                        echo '<h1>'.$ERROR.'</h1>';
                    else: ?>
                        <?php if($REV) echo p_locale_xhtml('showrev');?>
                        <h2><?php echo hsc(tpl_img_getTag('IPTC.Headline',$IMG)); ?></h2>

                        <div class="detail-img">
                          <?php tpl_img(); /* parameters: maximum width, maximum height (and more) */ ?>
                        </div>

                        <div class="detail-meta">
                            <?php tpl_img_meta(); ?>
                        </div>
                        <?php //Comment in for Debug// dbg(tpl_img_getTag('Simple.Raw'));?>
                    <?php endif; ?>
                </div>

                <!-- PAGE ACTIONS -->
                <?php if (!$ERROR): ?>
                    <ul class="detail-tools">
                        <?php
                            $data = array(
                                'view' => 'detail',
                                'items' => array(
                                    'mediaManager' => tpl_action('mediaManager', 1, 'li', 1),
                                    'img_backto' =>   tpl_action('img_backto', 1, 'li', 1)
                                )
                            );

                            // the page tools can be amended through a custom plugin hook
                            $evt = new Doku_Event('TEMPLATE_PAGETOOLS_DISPLAY', $data);
                            if($evt->advise_before()) {
                                foreach($evt->data['items'] as $k => $html) echo $html;
                            }
                            $evt->advise_after();
                            unset($data);
                            unset($evt);
                        ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include('tpl_footer.php') ?>
    <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
