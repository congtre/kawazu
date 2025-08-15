<?php get_header(); ?>
<div class="boxContent">
  <div class="boxMain">
    <main>
      <div class="boxLayoutBase">

<?php get_template_part('tmp/tmp-mv-base01'); ?>

        <div class="boxLayoutBaseIn">

<?php get_template_part('tmp/tmp-breadcrumb'); ?>

          <div class="boxPageWrap">


<?php //get_template_part('tmp/tmp-cat-ym-menu-base01'); ?>


            <div class="boxNewsS01Wrap">
              <div class="boxNewsS01 baseW baseSpW">
<?php get_template_part('tmp/tmp-single-base01'); ?>
              </div><!--/.boxNewsS01-->
            </div><!--/.boxNewsS01Wrap-->


          </div><!--/.boxPageWrap-->

        </div><!--/.boxLayoutBaseIn-->

      </div><!--/.boxLayoutBase-->
    </main>
  </div><!--/.boxMain-->
</div><!--/.boxContent-->
<?php get_footer(); ?>