<?php function csnkform_admin_data_menu(){
        add_submenu_page( 'csnkform_admin_page', 'データ', 'データ', 'manage_options', 'csnkform_admin_data_page', 'csnkform_admin_data_func' );
      }
      add_action('admin_menu', 'csnkform_admin_data_menu');



      function csnkform_admin_data_func() {

        $page_slug = 'csnkform_admin_data_page';

        $status_array = array(
          '0'=>'未対応',
          '1'=>'対応済',
        );
        $status_color_array = array(
          '0'=>'#ff0000',
          '1'=>'#0000ff',
        );

        $con = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        @mysqli_set_charset($con, 'utf8');
        if(mysqli_connect_errno()):
          printf('Connect failed: %s', mysqli_connect_error());
        endif;

        if(!mysqli_connect_errno()):
          $sql = "create table if not exists csnkform_data (
            id bigint primary key auto_increment not null,
            mail_page_slug varchar(200) not null,
            mail_to varchar(200) not null,
            mail_from varchar(200) not null,
            mail_from_name varchar(200) not null,
            mail_subject varchar(200) not null,
            mail_body longtext not null,
            status tinyint not null,
            date_time datetime not null,
            user_agent text not null,
            ip varchar(50) not null
          )";
          $rst = @mysqli_query($con, $sql);
          if($errstr = mysqli_error($con)):
            echo $errstr;
          else:
            if(is_object($rst)):
              @mysqli_free_result($rst);
            endif;
          endif;

          $action = 'rename_table';
          $action = '';
          if($action == 'rename_table'):
            $sql = 'rename table csnkform_history to csnkform_data';
            $rst = @mysqli_query($con,$sql);
            @mysqli_free_result($rst);
          endif;

          $action = 'alter_table';
          $action = '';
          if($action == 'alter_table'):
            $sql = 'alter table csnkform_data add status tinyint not null after mail_body';
            $rst = @mysqli_query($con,$sql);
            @mysqli_free_result($rst);
          endif;

          if(isset($_GET['pcode']) and $_GET['pcode'] == '123'):
            //show_column
            $table_column = '';
            $sql = 'desc csnkform_data';
            $rst = @mysqli_query($con, $sql);
            $table_column .= '    <h2 class="ttl01">Table: csnkform_data</h2>'."\n";
            $table_column .= '<div class="line_column no01"><span>Field</span><span>Type</span><span>Null</span><span>Key</span><span>Default</span><span>Extra</span></div>'."\n";
            while($col = mysqli_fetch_assoc($rst)):
              $table_column .= '<div class="line_column"><span>'.esc_html($col['Field']).'</span><span>'.esc_html($col['Type']).'</span><span>'.esc_html($col['Null']).'</span><span>'.esc_html($col['Key']).'</span><span>'.esc_html($col['Default']).'</span><span>'.esc_html($col['Extra']).'</span></div>'."\n";
            endwhile;
            @mysqli_free_result($rst);
            echo $table_column;
          endif;
        endif;//!mysqli_connect_errno

        @mysqli_close($con);
?>

<div class="boxCsnkAdmin">

<?php   if(!isset($_GET['my_action']) or $_GET['my_action'] == ''):
          require_once(dirname(__FILE__).'/csnkform-admin-data-archive.php');
        elseif(isset($_GET['my_action']) and $_GET['my_action'] == 'detail'):
          require_once(dirname(__FILE__).'/csnkform-admin-data-detail.php');
        endif;
?>

</div><!--/.boxCsnkAdmin-->



<?php }// func csnkform_admin_data_func ?>