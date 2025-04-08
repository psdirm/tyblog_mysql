<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main">
    <?php if($this->fields->thumb): ?>
    <!--有封面图的文章详情页顶部样式-->
    <div class="post_thumb lazy-load" data-src="<?php $this->fields->thumb();?>">
        <div class="post_header padding animated fadeIn">
            <?php $firstCat = $this->categories[0]; ?>
            <a href="<?php echo $firstCat['permalink']; ?>"><?php echo $firstCat['name']; ?></a>
            <h1><?php $this->title() ?></h1>   
            <div class="post_meta">
                <span><?php $this->date('Y.m.d'); ?></span>
                <span>/</span>
                <span><?php get_post_view($this) ?>&nbsp;阅读</span>
                <span>/</span>
                <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
                <span>/</span>
                <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
            </div>
        </div>
    </div>
    <?php else: ?>
    <!--没有封面图的文章详情页顶部样式-->
    <div class="post_nothumb animated fadeIn">
        <h1><?php $this->title() ?></h1>   
        <div class="post_meta">
            <span><?php $this->date('Y.m.d'); ?></span>
            <span><?php $firstCat = $this->categories[0]; ?><a href="<?php echo $firstCat['permalink']; ?>"><?php echo $firstCat['name']; ?></a></span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
        </div>
    </div>
    <?php endif;?>
    <!--通用文章正文-->
    <div class="post_content padding animated fadeIn">
        <?php echo AutoLightbox($this->content);?>
        <div class="cc-say">
            本文著作权归作者 [&nbsp;<span><?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?></span>&nbsp;] 享有，未经作者书面授权，禁止转载，封面图片来源于 [&nbsp;<span><?php echo $this->fields->origin ? $this->fields->origin : '互联网' ;?></span>&nbsp;] ，本文仅供个人学习、研究和欣赏使用。如有异议，请联系博主及时处理。
        </div>
        <?php if ($this->tags) { ?>
        <div class="tags"><?php $this->tags('', true); ?></div>
        <?php } ?>
    </div> 
    <!--通用文章评论-->
    <?php $this->need('comments.php'); ?>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>