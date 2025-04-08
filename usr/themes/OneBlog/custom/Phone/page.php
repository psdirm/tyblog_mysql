<!--默认独立页面样式-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>')">
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?></h1> 
    </div>
    <div class="post_content padding">
        <?php echo AutoLightbox($this->content);?>   
    </div>
    <?php $this->need('comments.php'); ?>
</div>
<?php $this->need('custom/Phone/footer.php');?>	