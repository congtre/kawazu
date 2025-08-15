<?php get_header(); ?>
<div class="boxContent">
  <div class="boxMain">
    <main>
      <div class="boxLayoutBase">

<?php get_template_part('tmp/tmp-mv-base01'); ?>

        <div class="boxLayoutBaseIn">

<?php get_template_part('tmp/tmp-breadcrumb'); ?>

          <div class="boxPageWrap">

<?php get_template_part('tmp/tmp-cat-ym-menu-base01-type02'); ?>


            <div class="boxNews01Wrap">
              <div class="boxNews01 baseW baseSpW">
<?php get_template_part('tmp/tmp-archive-loop-base02'); ?>
              </div><!--/.boxNews01-->
            </div><!--/.boxNews01Wrap-->


          </div><!--/.boxPageWrap-->

        </div><!--/.boxLayoutBaseIn-->

      </div><!--/.boxLayoutBase-->
    </main>
  </div><!--/.boxMain-->
</div><!--/.boxContent-->
<?php get_footer(); ?>