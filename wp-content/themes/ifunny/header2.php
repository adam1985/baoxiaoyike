<div class="header">
    <div class="menu-box inside-page-menu">
        <div class="cl in-menu-box">
            <div class="fl mini-logo">
            </div>
            <div class="fl menu-list inside-menu-list">
                <ul class="cl">
                    <li><a href="/">首页</a></li>
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
            <!--div class="fr user-joke-post">
                <a href="#">登录</a>
                <a href="#">注册</a>
                <a href="#" class="joke-post">投稿</a>
            </div-->
        </div>
    </div>
</div>