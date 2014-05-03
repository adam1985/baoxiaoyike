 <div class="header">
    <div class="banner">
        <div class="in-banner">
            <div class="joke-logo">
                <a href="/"></a>
            </div>
            <!--div class="publish-joke">
                <a href="#">
                    <img src="/assets/images/publish_joke.gif" />
                </a>
            </div>
            <div class="cl user-login">
                <a class="fl" href="#">登录</a>
                <a class="fl" href="#">注册</a>
            </div-->
        </div>
    </div>
    <div class="menu-box">
        <div class="cl in-menu-box">
            <div class="fl menu-list">
                <ul>
                    <li><a <?php if( is_home() || is_front_page() ) { echo 'class="on"'; } ?> href="/">首页</a></li>
                    <?php 
                        $menus = get_terms('category', 'orderby=displayorder&hide_empty=0' );
                        $cat_id = -1;
                        if ( is_category() ) {
                            $cat_id = get_query_var('cat');
                        }
                        foreach ($menus as $menu) {
                            if( $menu->term_id > 1 ) {
                                $class = '';

                                if( $cat_id == $menu->term_id) {
                                    $class = 'class="on"';
                                }
                                echo '<li><a '.$class.' href="'.get_term_link($menu, $menu->slug).'" title="'.$menu->name.'">'.$menu->name.'</a></li>';
                            }
                            
                        }
                    ?>
                </ul>
            </div>
            <div class="fr upload-joke">
                <!--a class="sprites" href="#">上传笑料</a-->
            </div>
        </div>
    </div>
    <!--div class="sub-banner">
        <div class="in-sub-banner">
            <a href="#">
                <img src="/img/banner.jpg" width="960" height="80" />
            </a>
        </div>
    </div-->
</div>