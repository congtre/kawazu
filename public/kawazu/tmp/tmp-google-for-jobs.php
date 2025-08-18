<?php if(is_singular('recruit') and get_field('gjs_recruit_title')):

        $title = get_field('gjs_recruit_title');//※ 職務の名称

        $description = get_field('gjs_recruit_cont');//※ 概要
        $description_employment_status = trim(strip_tags(get_field('雇用形態')));//雇用形態
        $description_place = trim(strip_tags(get_field('勤務地')));//勤務地
        $description_working_hours = get_field('gjs_recruit_working_hours');//勤務時間
        $description_salary = trim(strip_tags(get_field('給与')));//給与
        $description_payrise = trim(strip_tags(get_field('昇給')));//昇給
        $description_bonus = trim(strip_tags(get_field('賞与')));//賞与
        $description_holiday = trim(strip_tags(get_field('休日・休暇')));//休日・休暇
        $description_welfare = trim(strip_tags(get_field('待遇・福利厚生')));//待遇

        $datePosted = get_the_time('Y-m-d');//※ 雇用主が求人情報を投稿した最初の日付【形式】2016-02-18 or 2016-02-18T00:00
        $validThrough = get_field('gjs_recruit_valid_through');//有効期限【形式】2017-03-18 or 2017-03-18T00:00

        $employmentType = '';//雇用形態 (単数用) %s FULL_TIME / PART_TIME / CONTRACTOR / TEMPORARY / INTERN / VOLUNTEER / PER_DIEM / OTHER
        $employmentTypes = '';//雇用形態 (複数用) %s【形式】"FULL_TIME", "PART_TIME"
        $employment_type0 = get_field('gjs_recruit_employment_type');
        if(isset($employment_type0) and is_array($employment_type0)):
          if(count($employment_type0) == 1):
            $employmentType = $employment_type0[0];
          else:
            foreach($employment_type0 as $value):
              $employmentTypes = ($employmentTypes) ? ', "'.$value.'"' : '"'.$value.'"';
            endforeach;
          endif;
        endif;

        $company_name = get_field('gjs_recruit_company_name');//※ %s
        $company_hp_url = get_field('gjs_recruit_company_hp_url');//%s
        $company_logo_url = get_field('gjs_recruit_company_logo_url');//%s

        $addressRegion = get_field('gjs_recruit_address_region');//※ 勤務地 %s 県
        $addressLocality = get_field('gjs_recruit_address_locality');//※ 勤務地 %s 市
        $streetAddress = get_field('gjs_recruit_street_address');//※ 勤務地 %s 住所
        $postalCode = get_field('gjs_recruit_postal_code');//※ 勤務地 %s 郵便番号【形式】000-0000

        $base_salary_value = get_field('gjs_recruit_base_salary_value');// 雇用主から提示された実際の基本給 %d
        $base_salary_minValue = get_field('gjs_recruit_base_salary_min_value');//%d
        $base_salary_maxValue = get_field('gjs_recruit_base_salary_max_value');//%d
        $base_salary_unitText = get_field('gjs_recruit_base_salary_unitText');//%s 期間 YEAR / MONTH / WEEK / DAY / HOUR /


        $disp_check = 'ok';
        if(!$title):
          $disp_check = 'ng';
        endif;
        if(!$description):
          $disp_check = 'ng';
        endif;
        if(!$datePosted):
          $disp_check = 'ng';
        endif;
        if(!$company_name):
          $disp_check = 'ng';
        endif;
        if(!$postalCode):
          $disp_check = 'ng';
        endif;
        if(!$addressRegion):
          $disp_check = 'ng';
        endif;
        if(!$addressLocality):
          $disp_check = 'ng';
        endif;
        if(!$streetAddress):
          $disp_check = 'ng';
        endif;

        if($disp_check == 'ok'):
?>
  <script type="application/ld+json"> {
    "@context" : "http://schema.org/",
    "@type" : "JobPosting",
    "title" : "<?php echo esc_html($title); ?>",
    "description" : "
    <p><?php echo esc_html($description); ?></p>
<?php if($description_employment_status): ?>
    <p><strong>雇用形態</strong>：<?php echo esc_html($description_employment_status); ?></p>
<?php endif; ?>
<?php if($description_place): ?>
    <p><strong>勤務地</strong>：<?php echo esc_html($description_place); ?></p>
<?php endif; ?>
<?php if($description_working_hours): ?>
    <p><strong>勤務時間</strong>：<?php echo esc_html($description_working_hours); ?></p>
<?php endif; ?>
<?php if($description_salary): ?>
    <p><strong>給与</strong>：<?php echo esc_html($description_salary); ?></p>
<?php endif; ?>
<?php if($description_payrise): ?>
    <p><strong>昇給</strong>：<?php echo esc_html($description_payrise); ?></p>
<?php endif; ?>
<?php if($description_bonus): ?>
    <p><strong>賞与</strong>：<?php echo esc_html($description_bonus); ?></p>
<?php endif; ?>
<?php if($description_holiday): ?>
    <p><strong>休日・休暇</strong>：<?php echo esc_html($description_holiday); ?></p>
<?php endif; ?>
<?php if($description_welfare): ?>
    <p><strong>待遇</strong>：<?php echo esc_html($description_welfare); ?></p>
<?php endif; ?>",
    "datePosted" : "<?php echo esc_html($datePosted); ?>",
<?php if($validThrough): ?>
    "validThrough" : "<?php echo esc_html($validThrough); ?>",
<?php endif; ?>
<?php if($employmentTypes): ?>
    "employmentType" : [<?php echo $employmentTypes; ?>],
<?php elseif($employmentType): ?>
    "employmentType" : "<?php echo esc_html($employmentType); ?>",
<?php endif; ?>
    "hiringOrganization" : {
        "@type" : "Organization",
<?php $add_comma = ($company_hp_url or $company_logo_url) ? ',' : ''; ?>
        "name" : "<?php echo esc_html($company_name); ?>"<?php echo $add_comma; ?>
<?php if($company_hp_url): ?>
<?php   $add_comma = ($company_logo_url) ? ',' : ''; ?>
        "sameAs" : "<?php echo esc_url($company_hp_url); ?>"<?php echo $add_comma; ?>
<?php endif; ?>
<?php if($company_logo_url): ?>
        "logo" : "<?php echo esc_url($company_logo_url); ?>"
<?php endif; ?>
    },
    "jobLocation" : {
      "@type" : "Place",
      "address" : {
        "@type" : "PostalAddress",
        "addressRegion" : "<?php echo esc_html($addressRegion); ?>",
        "addressLocality" : "<?php echo esc_html($addressLocality); ?>",
        "streetAddress" : "<?php echo esc_html($streetAddress); ?>",
        "postalCode" : "<?php echo esc_html($postalCode); ?>",
        "addressCountry": "JP"
      }
<?php if($base_salary_value or $base_salary_minValue or $base_salary_maxValue or $base_salary_unitText): ?>
    },
    "baseSalary": {
      "@type": "MonetaryAmount",
      "currency": "JPY",
      "value": {
        "@type": "QuantitativeValue",
<?php   if($base_salary_value): ?>
        "value": <?php echo esc_html($base_salary_value); ?>,
<?php   endif; ?>
<?php   if($base_salary_minValue): ?>
        "minValue": <?php echo esc_html($base_salary_minValue); ?>,
<?php   endif; ?>
<?php   if($base_salary_maxValue): ?>
        "maxValue": <?php echo esc_html($base_salary_maxValue); ?>,
<?php   endif; ?>
<?php   if($base_salary_unitText): ?>
        "unitText": "<?php echo esc_html($base_salary_unitText); ?>"
<?php   endif; ?>
      }
<?php endif; ?>
    }
  }
  </script>
<?php   endif;//disp ok ?>
<?php endif;//is Page Recruit ?>