<!--无图单页样式-->
<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main">
    <div class="post_nothumb animated fadeIn">
        <h1><?php $this->title() ?></h1>   
        <div class="post_meta">
            <span><?php $this->date('Y.m.d'); ?></span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
        </div>
    </div>
    <div class="post_content padding animated fadeIn">
        <?php echo AutoLightbox($this->content);?>
    </div>
    <?php $this->need('comments.php'); ?>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>