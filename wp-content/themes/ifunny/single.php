<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php include (TEMPLATEPATH . '/meta.php'); ?>
    <?php include (TEMPLATEPATH . '/link.php'); ?>
</head>
<body>
<div class="warpper">
    <?php include (TEMPLATEPATH . '/header2.php'); ?>
    <div class="cl container">   
        <div class="fl article">
            <?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();

            ?>
            <?php setPostViews(get_the_ID()); ?>
            <div class="art-list">
                    <div class="cl art-title">
                        <h2 class="fl">
                            <?php the_title(); ?>
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
                    <div class="cl page-list-control">
                        <?php
                            $prev_post = get_previous_post();
                            if (!empty( $prev_post )): ?>
                              <a title="<?php echo $prev_post->post_title; ?>" class="sprites fl prev-joke" href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                上一条
                            </a>
                        
                        <?php endif; ?>

                        <?php
                            $next_post = get_next_post();
                            if (!empty( $next_post )): ?>
                              <a title="<?php echo $next_post->post_title; ?>"  class="sprites fl next-joke" href="<?php echo get_permalink( $next_post->ID ); ?>">
                                下一条笑话
                              </a>

                        <?php endif; ?>


                    </div>
                </div>

            <?php            
                    endwhile;
                endif;
            ?>

            
            <div class="hot-joke-list">
                <ul class="cl">
                  <?php //hots_posts(); ?>
                </ul>
                <div id="wumiiDisplayDiv"></div>
                <!-- UJian Button BEGIN -->
                <div class="ujian-hook"></div>
                <script type="text/javascript">var ujian_config = {num:12,picSize:84,textHeight:45};</script>
                <script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js?uid=1601356"></script>
                <a href="http://www.ujian.cc" style="border:0;"><img src="http://img.ujian.cc/pixel.png" alt="友荐云推荐" style="border:0;padding:0;margin:0;" /></a>
                <!-- UJian Button END -->
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
