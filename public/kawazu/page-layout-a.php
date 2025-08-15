<?php get_header(); ?>
<div class="boxContent">
  <div class="boxMain">
    <main>
      <div class="boxLayoutBase">

<?php get_template_part('tmp/tmp-mv-base01'); ?>

        <div class="boxLayoutBaseIn">

<?php get_template_part('tmp/tmp-breadcrumb'); ?>

          <div class="boxPageWrap">


<?php if(have_posts()): while(have_posts()): the_post(); ?>
            <div class="boxPage01 baseW baseSpW">
              <div class="boxPostBody">

<?php   //remove_filter('the_content', 'wpautop');
        the_content(); ?>

              </div><!--/.boxPostBody-->
            </div><!--/.boxPage01-->
<?php endwhile; endif; ?>


          </div><!--/.boxPageWrap-->

        </div><!--/.boxLayoutBaseIn-->

      </div><!--/.boxLayoutBase-->
    </main>
  </div><!--/.boxMain-->
</div><!--/.boxContent-->
<?php get_footer(); ?>
