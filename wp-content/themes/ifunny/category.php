<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php include (TEMPLATEPATH . '/meta.php'); ?>
    <?php include (TEMPLATEPATH . '/link.php'); ?>
</head>
<body>
<div class="warpper">
    <?php include (TEMPLATEPATH . '/top.php'); ?>
    <?php include (TEMPLATEPATH . '/header1.php'); ?>
    <div class="cl container">
        <div class="fl article">
            <?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
            ?>
                <div class="art-list">
                    <div class="cl art-title">
                        <h2 class="fl">
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h2>
                        <div class="fr gray">
                            <!--div class="fl art-writer">
                                <a href="javascript:void(null)">
                                    <i class="nv-sprites fl inline-block"></i>
                                    <?php the_author() ?>
                                </a>
                            </div-->
                            <div class="fr art-create-time">
                                <?php echo '发表于 '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="art-content">
                        <?php getArticleContent($post); ?>
                    </div>
                    <?php include (TEMPLATEPATH . '/user-interact.php'); ?>
                </div>
            
            <?php            
                    endwhile;
                endif;
            ?>
            <div class="page-list">
                <?php pagination($query_string); ?> 
            </div>
        </div>
        <?php //get_sidebar(); ?>
    </div>
    <div class="footer">
        <?php include (TEMPLATEPATH . '/copyright.php'); ?>
    </div>
</div>
<?php include (TEMPLATEPATH . '/script.php'); ?>
</body>
</html>
