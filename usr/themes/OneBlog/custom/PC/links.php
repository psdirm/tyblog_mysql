<!--友情链接页面-->
<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/friend.jpg';?>')">
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
    <?php if (array_key_exists('Links', Typecho_Plugin::export()['activated'])):?>
    <div class="links padding">
        <?php Links_Plugin::output("
			<li class='link'>
				<a href='{url}' target='_blank' rel='nofollow'>
				    <img src='{image}' alt='{name}'/>
				    <div class='link-info'>
				        <h3>{name}</h3>
				        <span class='lite-black' title='{description}'>{description}</span>
				    </div>
				</a>
			</li>
		 ", 0); ?>
    </div>
    <?php else:?>
	<div class="nodata">
        <img src='<?php $this->options->themeUrl('assets/img/404.png'); ?>'></img>
        <span>暂未启用Links插件，请先安装并启用该插件。</span>
    </div>
	<?php endif;?>
    <div class="post_content padding animated fadeIn">
        <h4 class="link-request">
            <span>#</span>
            友链要求
        </h4>
        <?php echo AutoLightbox($this->content);?>
    </div>
    <?php $this->need('comments.php'); ?>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>
