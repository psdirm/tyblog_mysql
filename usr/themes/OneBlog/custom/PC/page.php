<!--默认独立页面样式-->
<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg';?>')">
        <a class="logo" href="<?php $this->options->siteUrl(); ?>">
            <img src="<?php echo $this->options->logoX ? $this->options->logoX : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
            <div class="slogan">
                <h1><?php $this->options->title();?></h1>
                <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
            </div>
        </a>
    </div>
    <div class="page_title animated fadeIn">
        <h1><?php $this->title(); ?></h1>   
    </div>
    <div class="post_content padding animated fadeIn">
        <?php echo AutoLightbox($this->content);?>
    </div>
    <?php $this->need('comments.php'); ?>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>
