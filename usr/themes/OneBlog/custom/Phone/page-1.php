<!--无图单页-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	
<!--全局容器-->
<div class="main">
    <div class="post_nothumb padding animated fadeIn">
        <h1><?php $this->title() ?></h1>   
        <div class="post_meta">
            <span><?php $this->date('Y年m月d日'); ?></span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
        </div>
    </div>
    <div class="post_content padding">
        <?php echo AutoLightbox($this->content);?>   
    </div>
    <?php $this->need('comments.php'); ?>
</div>
<?php $this->need('custom/Phone/footer.php');?>	