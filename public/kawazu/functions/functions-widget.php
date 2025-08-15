<?php
# Custom Menu
function add_custom_menu(){
  register_nav_menus(
    array(
      'header_menu' => 'ヘッダーメニュー',
      'footer_menu' => 'フッターメニュー',
    )
  );
}
//add_action('after_setup_theme','add_custom_menu');
//'primary-menu'
//'primary'
//'secondary'

function default_global_menu(){
  echo '<ul><li>「外観」->「メニュー」から作成してください。</li></ul>';
}


class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  //function start_el( &$output, $item, $depth, $args ) {
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

    $home_url_for_match = preg_replace('/\:/','\:',home_url());
    $home_url_for_match = preg_replace('/\//','\/',$home_url_for_match);
    $home_url_for_match = preg_replace('/\./','\.',$home_url_for_match);
    $home_url_for_match = preg_replace('/\-/','\-',$home_url_for_match);
    $home_url_for_match = preg_replace('/\_/','\_',$home_url_for_match);
    $add_class = '';
    $add_class = ( preg_match( '/' . $home_url_for_match .'(|\/)$/', $item->url ) ) ? ' liHome' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/about(|\/)$/', $item->url ) ) ? ' liAbout' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/profile(|\/)$/', $item->url ) ) ? ' liProfile' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/product(|\/)$/', $item->url ) ) ? ' liProduct' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/voice(|\/)$/', $item->url ) ) ? ' liVoice' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/news(|\/)$/', $item->url ) ) ? ' liNews' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/event(|\/)$/', $item->url ) ) ? ' liEvent' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/access(|\/)$/', $item->url ) ) ? ' liAccess' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/contact(|\/)$/', $item->url ) ) ? ' liContact' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/privacy(|\/)$/', $item->url ) ) ? ' liPrivacy' : $add_class;
    $add_class = ( preg_match( '/' . $home_url_for_match .'\/sitemap(|\/)$/', $item->url ) ) ? ' liSitemap' : $add_class;
    $add_class .= ( ! empty( $item->image_url ) ) ? ' imgNav' : '';
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . esc_attr($add_class) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names . '>';

    $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
    $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
    $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
    //print_r($item);
    $item_image_url = $item->image_url;
    if(is_ssl() and $item_image_url != ''):
      $item_image_url = preg_replace('/^http\:\/\//','https://',$item_image_url);
    endif;

    $item_image_url_hover = $item->image_url_hover;
    if(is_ssl() and $item_image_url_hover != ''):
      $item_image_url_hover = preg_replace('/^http\:\/\//','https://',$item_image_url_hover);
    endif;

    $ttl = ! empty( $item_image_url ) ? '<img src="' . esc_url($item_image_url) . '" data-image="' . esc_url($item_image_url) . '" data-image-hover="' . esc_url( $item_image_url_hover ) . '" alt="' . apply_filters( 'the_title', $item->title, $item->ID) . '">' : apply_filters( 'the_title', $item->title, $item->ID);

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . $ttl . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

  }
}
function my_nav_menu_args($args) {
  $args = (object)$args;
  $args->walker = new My_Walker_Nav_Menu;
  return $args;
}
//add_filter('wp_nav_menu_args', 'my_nav_menu_args');



function custom_nav_menu_item( $item ) {
  $item->image_url = get_post_meta( $item->ID, '_menu_item_image_url', true );
  $item->image_url_hover = get_post_meta( $item->ID, '_menu_item_image_url_hover', true );
  return $item;
}
//add_filter( 'wp_setup_nav_menu_item', 'custom_nav_menu_item' );

function custom_update_nav_menu_item ( $menu_id, $menu_item_db_id, $menu_item_args ) {
  if( is_array ( $_POST['menu-item-image-url'] ) ):
    $menu_item_args['menu-item-image-url'] = $_POST['menu-item-image-url'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_image_url', esc_url( $menu_item_args['menu-item-image-url'] ) );
  endif;
  if( is_array ( $_POST['menu-item-image-url-hover'] ) ):
    $menu_item_args['menu-item-image-url-hover'] = $_POST['menu-item-image-url-hover'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_image_url_hover', esc_url( $menu_item_args['menu-item-image-url-hover'] ) );
  endif;
//    update_post_meta( $menu_item_db_id, '_menu_item_image_url_hover', sanitize_html_class( $menu_item_args['menu-item-image-url-hover'] ) );
}
//add_action( 'wp_update_nav_menu_item', 'custom_update_nav_menu_item', 10, 3 );


class Custom_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
  public function start_lvl( &$output, $depth = 0, $args = array() ) {}
  public function end_lvl( &$output, $depth = 0, $args = array() ) {}
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
      'action',
      'customlink-tab',
      'edit-menu-item',
      'menu-item',
      'page-tab',
      '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
      $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
      if ( is_wp_error( $original_title ) )
        $original_title = false;
      } elseif ( 'post_type' == $item->type ) {
        $original_object = get_post( $item->object_id );
        $original_title = get_the_title( $original_object->ID );
      }

      $classes = array(
        'menu-item menu-item-depth-' . $depth,
        'menu-item-' . esc_attr( $item->object ),
        'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
      );

      $title = $item->title;

      if ( ! empty( $item->_invalid ) ) {
        $classes[] = 'menu-item-invalid';
        /* translators: %s: title of menu item which is invalid */
        $title = sprintf( __( '%s (Invalid)' ), $item->title );
      } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
        $classes[] = 'pending';
        /* translators: %s: title of menu item in draft status */
        $title = sprintf( __('%s (Pending)'), $item->title );
      }

      $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

      $submenu_text = '';
      if ( 0 == $depth )
        $submenu_text = 'style="display: none;"';

?>
  <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
    <dl class="menu-item-bar">
      <dt class="menu-item-handle">
        <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span></span>
        <span class="item-controls">
          <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
          <span class="item-order hide-if-js">
            <a href="<?php
            echo wp_nonce_url(
              add_query_arg(
                array(
                  'action' => 'move-up-menu-item',
                  'menu-item' => $item_id,
                ),
                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
              ),
              'move-menu_item'
            );
            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
|
            <a href="<?php
            echo wp_nonce_url(
              add_query_arg(
                array(
                  'action' => 'move-down-menu-item',
                  'menu-item' => $item_id,
                ),
                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
              ),
              'move-menu_item'
            );
            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
          </span>
          <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
            ?>"><?php _e( 'Edit Menu Item' ); ?></a>
        </span>
      </dt>
    </dl>

    <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
<?php if( 'custom' == $item->type ) : ?>
      <p class="field-url description description-wide">
        <label for="edit-menu-item-url-<?php echo $item_id; ?>">
          <?php _e( 'URL' ); ?><br />
          <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
        </label>
      </p>
<?php endif; ?>
      <p class="description description-thin">
        <label for="edit-menu-item-title-<?php echo $item_id; ?>">
          <?php _e( 'Navigation Label' ); ?><br />
          <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
        </label>
      </p>
      <p class="description description-thin">
        <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
          <?php _e( 'Title Attribute' ); ?><br />
          <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
        </label>
      </p>
      <p class="field-link-target description">
        <label for="edit-menu-item-target-<?php echo $item_id; ?>">
          <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
          <?php _e( 'Open link in a new window/tab' ); ?>
        </label>
      </p>
      <p class="field-css-classes description description-thin">
        <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
          <?php _e( 'CSS Classes (optional)' ); ?><br />
          <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
        </label>
      </p>
      <p class="field-xfn description description-thin">
        <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
          <?php _e( 'Link Relationship (XFN)' ); ?><br />
          <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
        </label>
      </p>

      <p class="field-custom description description-wide">
        <label for="edit-menu-item-image-url-<?php echo $item_id; ?>">
          <?php /*_e('Menu Image');*/ ?>GNavi画像URL<br />
          <input type="text" id="edit-menu-item-image-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-image-url" name="menu-item-image-url[<?php echo $item_id; ?>]" value="<?php echo esc_url( $item->image_url ); ?>" />
        </label>
      </p>

      <p class="field-custom description description-wide">
        <label for="edit-menu-item-image-url-hover-<?php echo $item_id; ?>">
          <?php /*_e('Menu Image(hover)');*/ ?>GNavi画像(hover)URL<br />
          <input type="text" id="edit-menu-item-image-url-hover-<?php echo $item_id; ?>" class="widefat code edit-menu-item-image-url-hover" name="menu-item-image-url-hover[<?php echo $item_id; ?>]" value="<?php echo esc_url( $item->image_url_hover ); ?>" />
        </label>
      </p>

      <p class="field-description description description-wide">
        <label for="edit-menu-item-description-<?php echo $item_id; ?>">
          <?php _e( 'Description' ); ?><br />
          <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
          <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
        </label>
      </p>

      <p class="field-move hide-if-no-js description description-wide">
        <label>
          <span><?php _e( 'Move' ); ?></span>
          <a href="#" class="menus-move menus-move-up" data-dir="up"><?php _e( 'Up one' ); ?></a>
          <a href="#" class="menus-move menus-move-down" data-dir="down"><?php _e( 'Down one' ); ?></a>
          <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
          <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
          <a href="#" class="menus-move menus-move-top" data-dir="top"><?php _e( 'To the top' ); ?></a>
        </label>
      </p>

      <div class="menu-item-actions description-wide submitbox">
<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
        <p class="link-to-original">
<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
        </p>
<?php endif; ?>
        <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
        echo wp_nonce_url(
          add_query_arg(
            array(
              'action' => 'delete-menu-item',
              'menu-item' => $item_id,
            ),
            admin_url( 'nav-menus.php' )
          ),
          'delete-menu_item_' . $item_id
        ); ?>"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
        ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
      </div>

      <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
      <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
      <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
      <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
      <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
      <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
    </div><!-- .menu-item-settings-->
    <ul class="menu-item-transport"></ul>
<?php
    $output .= ob_get_clean();
  }
} // Walker_Nav_Menu_Edit
//add_filter( 'wp_edit_nav_menu_walker', function( $class ){ return 'Custom_Walker_Nav_Menu_Edit'; } );


class WP_Custom_Post_Type_Widgets_Recent_Posts_list extends WP_Widget {

  public function __construct() {
    $widget_ops = array( 'classname' => 'widget_recent_entries', 'description' => __( '最近の投稿 (カスタム投稿タイプ含む)', 'custom-post-type-widgets' ) );
    parent::__construct( 'custom-post-type-recent-posts_list', __( '最近の投稿 (カスタム投稿タイプ含む)', 'custom-post-type-widgets' ), $widget_ops );
    $this->alt_option_name = 'widget_custom_post_type_recent_posts_list';
    add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
    add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
    add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
  }

  public function widget( $args, $instance ) {
    $cache = array();
    if ( ! $this->is_preview() ) {
      $cache = wp_cache_get( 'widget_custom_post_type_recent_posts_list', 'widget' );
    }
    if ( ! is_array( $cache ) ) {
      $cache = array();
    }
    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }
    if ( isset( $cache[ $args['widget_id'] ] ) ) {
      echo $cache[ $args['widget_id'] ];
      return;
    }

    ob_start();

    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( '', 'custom-post-type-widgets' ) : $instance['title'], $instance, $this->id_base );
    $posttype = $instance['posttype'];
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
      $number = 5;
    }
    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $post_types = get_post_types( array( 'public' => true ), 'objects' );

    if ( ( array_key_exists( $posttype, (array) $post_types ) and !is_post_type_archive($posttype) and !is_tax($posttype.'-cat') and !is_singular($posttype) ) or ( $posttype == 'all' and !is_post_type_archive('news') and !is_tax('news-cat') and !is_singular('news') ) ) {
      $set_posttype = array();
      $set_posttype = ($posttype == 'all') ? array('news','blog','blog2','blog3','event','newsletter') : array($posttype);
      $query = new WP_Query( array(
        'post_type' => $set_posttype,
        'posts_per_page' => $number,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'ignore_sticky_posts' => true,
      ) );

      if ( $query->have_posts() ) : ?>
      <div class="boxSideRecentPost">
        <?php //echo $args['before_widget']; ?>
        <?php if ( $title ) {
          //echo $args['before_title'] . $title . $args['after_title'];
          echo '<h2 class="ttlBaseSide01">' . $title . '</h2>';
        } ?>
<?php if($posttype == 'all'): ?>
        <div class="boxSideFeed">
<?php   $linkin = (get_option('my_btn_rss01')) ? '<img src="'.esc_url(get_option('my_btn_rss01')).'" alt="RSS">' : 'RSS'; ?>
          <a href="<?php bloginfo('rss2_url'); ?>"><?php echo $linkin; ?></a>
        </div><!--/.boxSideFeed-->
<?php endif; ?>
        <ul class="ulSideRecentPostList">
        <?php $cnt = 0; ?>
        <?php while ( $query->have_posts() ) : $query->the_post();
                $icn_new = '';
                if($cnt === 0):
                  $icn_new = (get_option('my_btn_new01')) ? '<img src="'.esc_url(get_option('my_btn_new01')).'" alt="New">' : '<span class="cRed">New!</span>' ;
                endif;
                $cnt++;
        ?>
          <li>
          <?php if ( $show_date ) : ?>
            <span class="txtDate"><?php echo get_the_date(); ?><?php echo $icn_new; ?></span>
          <?php endif; ?>
            <span class="txtTtl"><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></span>
          </li>
        <?php endwhile; ?>
        </ul><!--/.ulSideRecentPostList-->
        <?php //echo $args['after_widget']; ?>
        <div class="boxSideBaseToArchive">
<?php $post_dir = ($posttype == 'all') ? 'news' : $posttype; ?>
          <a href="<?php echo esc_url(home_url('/')); ?><?php echo esc_attr($post_dir); ?>/"><?php echo $title; ?>一覧</a>
        </div><!--/.boxSideBaseToArchive-->
      </div><!--/.boxSideRecentPost-->
        <?php
        wp_reset_postdata();
      endif;
    }

    if ( ! $this->is_preview() ) {
      $cache[ $args['widget_id'] ] = ob_get_flush();
      wp_cache_set( 'widget_custom_post_type_recent_posts_list', $cache, 'widget' );
    }
    else {
      ob_end_flush();
    }
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['posttype'] = strip_tags( $new_instance['posttype'] );
    $instance['number'] = (int) $new_instance['number'];
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

    $this->flush_widget_cache();

    $alloptions = wp_cache_get( 'alloptions', 'options' );
    if ( isset( $alloptions['widget_custom_post_type_recent_posts_list'] ) ) {
      delete_option( 'widget_custom_post_type_recent_posts_list' );
    }

    return $instance;
  }


  public function flush_widget_cache() {
    wp_cache_delete( 'widget_custom_post_type_recent_posts_list', 'widget' );
  }


  public function form( $instance ) {
    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $posttype = isset( $instance['posttype'] ) ? $instance['posttype']: 'post';
    $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
    ?>
    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'タイトル:', 'custom-post-type-widgets' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><label for="<?php echo $this->get_field_id( 'posttype' ); ?>"><?php _e( '投稿タイプ:', 'custom-post-type-widgets' ); ?></label>
    <select name="<?php echo $this->get_field_name( 'posttype' ); ?>" id="<?php echo $this->get_field_id( 'posttype' ); ?>">
      <option value="all"<?php selected( 'all', $posttype ); ?>>すべて</option>
    <?php
      $post_types = get_post_types( array( 'public' => true ), 'objects' );
      foreach ( $post_types as $post_type => $value ) {
        if ( 'attachment' == $post_type or 'post' == $post_type or 'page' == $post_type or 'voice' == $post_type or 'product' == $post_type ) {
          continue;
        }
      ?>
        <option value="<?php echo esc_attr( $post_type ); ?>"<?php selected( $post_type, $posttype ); ?>><?php _e( $value->label, 'custom-post-type-widgets' ); ?></option>
    <?php } ?>
    </select>
    </p>

    <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( '表示する件数:', 'custom-post-type-widgets' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

    <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( '日付を表示しますか？', 'custom-post-type-widgets' ); ?></label></p>
<?php
  }
}
//add_action('widgets_init',create_function('','return register_widget("WP_Custom_Post_Type_Widgets_Recent_Posts_list");'));






## Widget
if (function_exists('register_sidebar')):
/*
  register_sidebar(array(
    'name'          => 'RecruitTOPスライダー',
    'id'            => 'recruit_top_slider',
    'description'   => '',
    'before_widget' => '<li>',
    'after_widget'  => '</li>'."\n",
  ));
*/
/*
  register_sidebar(array(
    'name'          => 'TOPページバナー',
    'id'            => 'index_banner',
    'description'   => '',
    'before_widget' => '<li>',
    'after_widget'  => '</li>'."\n",
  ));
*/
endif;


class My_Banner_Widget extends WP_Widget{
  /* Widgetの登録 */
  function __construct(){
    parent::__construct(
      'my_banner_widget',
      'バナー',
      array('description'=>'バナー画像、リンク先設定')
    );
  }
  /* 表側の表示 */
  public function widget($args,$instance){
    $bn_url = $instance['bn_url'];
    if(is_ssl()):
      $bn_url = preg_replace('/^http\:\/\//','https://',$bn_url);
    endif;
    $bn_alt = $instance['bn_alt'];
    $link_url = $instance['link_url'];
    $link_blank = $instance['link_blank'];
    ($link_blank === '1') ? $add_opt = ' target="_blank" rel="noopener"' : $add_opt = '';
    $add_tag1_s = '';
    $add_tag1_f = '';
    if($link_url):
      $add_tag1_s = '<a href="'.esc_url($link_url).'"'.$add_opt.'>';
      $add_tag1_f = '</a>';
    endif;
    echo $args['before_widget'];
    echo $add_tag1_s.'<img src="'.esc_url($bn_url).'" alt="'.esc_attr($bn_alt).'">'.$add_tag1_f;
    echo $args['after_widget'];
  }
  /* Widget管理画面出力 */
  public function form($instance){
    $bn_url = $instance['bn_url'];
    if(is_ssl()):
      $bn_url = preg_replace('/^http\:\/\//','https://',$bn_url);
    endif;
    $bn_url_name = $this->get_field_name('bn_url');
    $bn_url_id = $this->get_field_id('bn_url');
    $bn_alt = $instance['bn_alt'];
    $bn_alt_name = $this->get_field_name('bn_alt');
    $bn_alt_id = $this->get_field_id('bn_alt');
    $link_url = $instance['link_url'];
    $link_url_name = $this->get_field_name('link_url');
    $link_url_id = $this->get_field_id('link_url');
    $link_blank = $instance['link_blank'];
    $link_blank_name = $this->get_field_name('link_blank');
    $link_blank_id = $this->get_field_id('link_blank');
    ?>
    <p>
      <label for="<?php echo $bn_url_id; ?>">バナー:</label><br>
        <div id="selectImg_<?php echo $bn_url_id; ?>"></div>
<?php if($bn_url): ?>
        <img src="<?php echo esc_url($bn_url); ?>" alt="" id="preview_<?php echo $bn_url_id; ?>" class="imgWidget">
        <input type="hidden" name="<?php echo $bn_url_name; ?>" value="<?php echo esc_url($bn_url); ?>" id="input_<?php echo $bn_url_id; ?>">
        <button type="button" data-name="<?php echo $bn_url_name; ?>" class="btnImgRemoveV4" id="remove_<?php echo $bn_url_id; ?>">画像削除</button>
<?php else: ?>
        <?php /*<div id="selectImg_<?php echo $bn_url_id; ?>"></div> */ ?>
        <button type="button" data-name="<?php echo $bn_url_name; ?>" class="btnImgUpV4" id="<?php echo $bn_url_id; ?>">画像選択</button>
<?php endif; ?>
    </p>
    <p>
      <label for="<?php echo $bn_alt_id; ?>">バナー画像 代替テキスト(alt):</label>
      <input class="widefat" id="<?php echo $bn_alt_id; ?>" name="<?php echo $bn_alt_name; ?>" type="text" value="<?php echo esc_attr($bn_alt); ?>">
    </p>
    <p>
      <label for="<?php echo $link_url_id; ?>">リンク先URL:</label>
      <input class="widefat" id="<?php echo $link_url_id; ?>" name="<?php echo $link_url_name; ?>" type="text" value="<?php echo esc_attr($link_url); ?>">
    </p>
    <p>
      <label for="<?php echo $link_blank_id; ?>">別ウインドウ表示:</label>
      <?php $s_link_blank[$link_blank] = ' checked'; ?>
      <input class="widefat" id="<?php echo $link_blank_id; ?>" name="<?php echo $link_blank_name; ?>" type="checkbox" value="1"<?php echo $s_link_blank[1]; ?>>
    </p>
    <?php
  }
  function update($new_instance,$old_instance){
    //if($_POST['remove_'])
    $err_chk = 0;
    if($new_instance['bn_url'] and !filter_var($new_instance['bn_url'],FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)):
      //return false;
      $err_chk = 1;
    endif;
    //if($new_instance['link_url'] and !filter_var($new_instance['link_url'],FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)):
    if($new_instance['link_url'] and !preg_match('/^http(s|)\:\/\//',$new_instance['link_url'])):
      //return false;
      $err_chk = 1;
    endif;
    if($new_instance['link_blank'] and !filter_var($new_instance['link_blank'],FILTER_VALIDATE_INT)):
      //return false;
      $err_chk = 1;
    endif;
    if($err_chk === 1) return false;
    return $new_instance;
  }
}# my_Banner_Widget
/**/
add_action('widgets_init',function(){
  register_widget('My_Banner_Widget');
});



##### Pc/Sp対応バナーウィジェット #####
class My_Banner_PcSp_Widget extends WP_Widget{
  /* Widgetの登録 */
  function __construct(){
    parent::__construct(
      'my_banner_pcsp_widget',
      'バナー(Pc/Sp対応)',
      array('description'=>'バナー画像(Pc/Sp)、リンク先設定')
    );
  }
  /* 表側の表示 */
  public function widget($args,$instance){
    $bn_pc_url = $instance['bn_pc_url'];
    $bn_sp_url = $instance['bn_sp_url'];
    if(is_ssl()):
      $bn_pc_url = preg_replace('/^http\:\/\//','https://',$bn_pc_url);
      $bn_sp_url = preg_replace('/^http\:\/\//','https://',$bn_sp_url);
    endif;
    $bn_alt = $instance['bn_alt'];
    $link_url = $instance['link_url'];
    $link_blank = $instance['link_blank'];
    ($link_blank === '1') ? $add_opt = ' target="_blank" rel="noopener"' : $add_opt = '';
    $add_tag1_s = '';
    $add_tag1_f = '';
    if($link_url):
      $add_tag1_s = '<a href="'.esc_url($link_url).'"'.$add_opt.'>';
      $add_tag1_f = '</a>';
    endif;
    echo $args['before_widget'];
    echo $add_tag1_s.'<img src="'.esc_url($bn_pc_url).'" alt="'.esc_attr($bn_alt).'" class="imgMain dPcInline"><img src="'.esc_url($bn_sp_url).'" alt="'.esc_attr($bn_alt).'" class="imgMain dSpInline">'.$add_tag1_f;
    echo $args['after_widget'];
  }
  /* Widget管理画面出力 */
  public function form($instance){
    $bn_pc_url = $instance['bn_pc_url'];
    $bn_sp_url = $instance['bn_sp_url'];
    if(is_ssl()):
      $bn_pc_url = preg_replace('/^http\:\/\//','https://',$bn_pc_url);
      $bn_sp_url = preg_replace('/^http\:\/\//','https://',$bn_sp_url);
    endif;
    $bn_pc_url_name = $this->get_field_name('bn_pc_url');
    $bn_pc_url_id = $this->get_field_id('bn_pc_url');
    $bn_sp_url_name = $this->get_field_name('bn_sp_url');
    $bn_sp_url_id = $this->get_field_id('bn_sp_url');
    $bn_alt = $instance['bn_alt'];
    $bn_alt_name = $this->get_field_name('bn_alt');
    $bn_alt_id = $this->get_field_id('bn_alt');
    $link_url = $instance['link_url'];
    $link_url_name = $this->get_field_name('link_url');
    $link_url_id = $this->get_field_id('link_url');
    $link_blank = $instance['link_blank'];
    $link_blank_name = $this->get_field_name('link_blank');
    $link_blank_id = $this->get_field_id('link_blank');
    ?>
    <p>
      <label for="<?php echo $bn_pc_url_id; ?>">バナー(PC):</label><br>
        <div id="selectImg_<?php echo $bn_pc_url_id; ?>"></div>
<?php if($bn_pc_url): ?>
        <img src="<?php echo esc_url($bn_pc_url); ?>" alt="" id="preview_<?php echo $bn_pc_url_id; ?>" class="imgWidget">
        <input type="hidden" name="<?php echo $bn_pc_url_name; ?>" value="<?php echo esc_url($bn_pc_url); ?>" id="input_<?php echo $bn_pc_url_id; ?>">
        <button type="button" data-name="<?php echo $bn_pc_url_name; ?>" class="btnImgRemoveV4" id="remove_<?php echo $bn_pc_url_id; ?>">画像削除</button>
<?php else: ?>
        <?php /*<div id="selectImg_<?php echo $bn_pc_url_id; ?>"></div> */ ?>
        <button type="button" data-name="<?php echo $bn_pc_url_name; ?>" class="btnImgUpV4" id="<?php echo $bn_pc_url_id; ?>">画像選択</button>
<?php endif; ?>
    </p>
    <p>
      <label for="<?php echo $bn_sp_url_id; ?>">バナー(SP):</label><br>
        <div id="selectImg_<?php echo $bn_sp_url_id; ?>"></div>
<?php if($bn_sp_url): ?>
        <img src="<?php echo esc_url($bn_sp_url); ?>" alt="" id="preview_<?php echo $bn_sp_url_id; ?>" class="imgWidget">
        <input type="hidden" name="<?php echo $bn_sp_url_name; ?>" value="<?php echo esc_url($bn_sp_url); ?>" id="input_<?php echo $bn_sp_url_id; ?>">
        <button type="button" data-name="<?php echo $bn_sp_url_name; ?>" class="btnImgRemoveV4" id="remove_<?php echo $bn_sp_url_id; ?>">画像削除</button>
<?php else: ?>
        <?php /*<div id="selectImg_<?php echo $bn_sp_url_id; ?>"></div> */ ?>
        <button type="button" data-name="<?php echo $bn_sp_url_name; ?>" class="btnImgUpV4" id="<?php echo $bn_sp_url_id; ?>">画像選択</button>
<?php endif; ?>
    </p>
    <p>
      <label for="<?php echo $bn_alt_id; ?>">バナー画像 代替テキスト(alt):</label>
      <input class="widefat" id="<?php echo $bn_alt_id; ?>" name="<?php echo $bn_alt_name; ?>" type="text" value="<?php echo esc_attr($bn_alt); ?>">
    </p>
    <p>
      <label for="<?php echo $link_url_id; ?>">リンク先URL:</label>
      <input class="widefat" id="<?php echo $link_url_id; ?>" name="<?php echo $link_url_name; ?>" type="text" value="<?php echo esc_attr($link_url); ?>">
    </p>
    <p>
      <label for="<?php echo $link_blank_id; ?>">別ウインドウ表示:</label>
      <?php $s_link_blank[$link_blank] = ' checked'; ?>
      <input class="widefat" id="<?php echo $link_blank_id; ?>" name="<?php echo $link_blank_name; ?>" type="checkbox" value="1"<?php echo $s_link_blank[1]; ?>>
    </p>
    <?php
  }
  function update($new_instance,$old_instance){
    //if($_POST['remove_'])
    $err_chk = 0;
    if($new_instance['bn_pc_url'] and !filter_var($new_instance['bn_pc_url'],FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)):
      //return false;
      $err_chk = 1;
    endif;
    if($new_instance['bn_sp_url'] and !filter_var($new_instance['bn_sp_url'],FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)):
      //return false;
      $err_chk = 1;
    endif;
    //if($new_instance['link_url'] and !filter_var($new_instance['link_url'],FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)):
    if($new_instance['link_url'] and !preg_match('/^http(s|)\:\/\//',$new_instance['link_url'])):
      //return false;
      $err_chk = 1;
    endif;
    if($new_instance['link_blank'] and !filter_var($new_instance['link_blank'],FILTER_VALIDATE_INT)):
      //return false;
      $err_chk = 1;
    endif;
    if($err_chk === 1) return false;
    return $new_instance;
  }
}# my_Banner_Widget
add_action('widgets_init',function(){
  register_widget('My_Banner_PcSp_Widget');
});
?>