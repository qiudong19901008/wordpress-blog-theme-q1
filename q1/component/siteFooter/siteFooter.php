<?php

  use q1\constant\Options;
  use function q1\helper\{
    getQ1Option,
  };

  $footerMenuList = getQ1Option(Options::Q1_OPTION_GLOBAL_FOOTER_MENU,[]);
  // var_dump($footerMenuList);
  $footerLicenseList = getQ1Option(Options::Q1_OPTION_GLOBAL_FOOTER_LICENSE,[]);
  $footerCopyright = getQ1Option(Options::Q1_OPTION_GLOBAL_FOOTER_COPYRIGHT);
  $friendLinkList = getQ1Option(Options::Q1_OPTION_GLOBAL_FOOTER_FRIEND_LINK,[]);
  // var_dump($friendLinkList);

  // $options = get_option( Options::Q1_OPTION_PREFIX );
  // $option = $options[Options::Q1_OPTION_GLOBAL_FOOTER_FRIEND_LINK];
  // var_dump($option);

?>


<div class="siteFooter">
    <!-- 友情链接 -->
    <?php if(count($friendLinkList) != 0): ?>

      <div class="siteFooter__friendLink">
        <div class="siteFooter__friendLinkTitle">
          友情链接:
        </div>
        <ul class="siteFooter__friendLinkList">

          <?php foreach($friendLinkList as $index => $link): ?>

            <?php echo $link['item']; ?>

          <?php endforeach;?>

        </ul>
      </div>

    <?php endif; ?>
    
    <!-- menu -->
    <ul class="siteFooter__menu">


      <?php foreach($footerMenuList as $index => $menu): ?>

          <?php if($index+1 === count($footerMenuList)): ?>
            <?php 
              echo $menu['item'];
              break; 
            ?>
          <?php endif;  ?>
        
          <?php echo $menu['item'] ?>
          <span class="siteFooter__cutOff">|</span>
        <!-- <a href="#">关于我们</a>
        <span class="siteFooter__cutOff">|</span>
        <a href="#">联系我们</a>
        <span class="siteFooter__cutOff">|</span>
        <a href="#">隐私策略</a>
        <span class="siteFooter__cutOff">|</span>
        <a href="#">网站地图</a> -->

      <?php endforeach;?>


    </ul>

    <!-- licence -->
    <ul class="siteFooter__licence">


    <?php foreach($footerLicenseList as $index => $license): ?>

      <?php if($index+1 === count($footerLicenseList)): ?>
        <?php 
          echo $license['item'];
          break; 
        ?>
      <?php endif;  ?>

      <?php echo $license['item']; ?>
      <span class="siteFooter__cutOff">|</span>

      <!-- <a href="#">公安备案</a>
      <span class="siteFooter__cutOff">|</span>
      <a href="#">网信部备案</a> -->


    <?php endforeach;?>
      

    </ul>
    


    <!-- copyright -->
    <div class="copyright">

      <?php echo $footerCopyright; ?>
      
      <!-- ©2021 <a href="#">srcmini</a> -->
    </div>
    
    <p style="text-align:right;position:absolute;bottom:30px;right:10px;">
        <?php printf('%d 次查询, 耗时 %s 秒', get_num_queries(), timer_stop(0, 3)); ?>
    </p>

    <p style="text-align:right;position:absolute;bottom:10px;right:10px;">
        <?php echo 'powerd by <a href="w2fenx.com" style="font-size:6px;">合道社</a>'  ?>
    </p>
    
    
</div>