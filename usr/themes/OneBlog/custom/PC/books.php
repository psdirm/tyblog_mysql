<!--书单列表页面样式-->
<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/book.jpg';?>')">
        <a class="logo" href="<?php $this->options->siteUrl(); ?>">
            <img src="<?php echo $this->options->logoX ? $this->options->logoX : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
            <div class="slogan">
                <h1><?php $this->options->title();?></h1>
                <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
            </div>
        </a>
    </div>
    <div class="page_title padding animated fadeIn">
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?></h1>  
    </div>
    <div class="post_content padding animated fadeIn">
        <div id="books">
            <?php while($this->next()): ?>
            <a href="<?php $this->permalink() ?>" class="book">
                <div class="book-thumb lazy-load" data-src="<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg'; ?>">
                </div>
                <div class="book-name"><?php echo $this->title ? $this->title : '请填写书名'; ?></div>
            </a>
            <?php endwhile; ?>
        </div>
        <div class="pageload" id="no_more">
            <?php $this->pageLink('点击查看更多','next'); ?>
        </div>
    </div>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>