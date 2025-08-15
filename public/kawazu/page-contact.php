<?php ob_start(); ?>
<?php get_header(); ?>
<div class="boxContent">
  <div class="boxMain">
    <main>
      <div class="boxLayoutBase">

<?php get_template_part('tmp/tmp-mv-base01'); ?>

        <div class="boxLayoutBaseIn">

<?php get_template_part('tmp/tmp-breadcrumb'); ?>


          <div class="boxPageWrap">


            <div class="boxContact01Wrap">
              <div class="boxContact01 baseW baseSpW">
<?php require_once(get_stylesheet_directory().'/csnkform/csnkform-contact-core.php'); ?>
<?php require_once(get_stylesheet_directory().'/csnkform/csnkform-contact-form.php'); ?>
              </div><!--/.boxContact01-->
            </div><!--/.boxContact01Wrap-->


          </div><!--/.boxPageWrap-->


        </div><!--/.boxLayoutBaseIn-->

      </div><!--/.boxLayoutBase-->
    </main>
  </div><!--/.boxMain-->
</div><!--/.boxContent-->
<?php get_footer(); ?>
<?php ob_end_flush(); ?>