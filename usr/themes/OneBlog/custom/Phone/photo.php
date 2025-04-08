<!--相册详情页-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	
<!--全局容器-->
<div class="main">
    <div class="post_nothumb padding animated fadeIn">
        <h1><?php $this->title() ?></h1>   
        <div class="post_meta">
            <span><?php $this->date('Y.m.d'); ?></span>
            <span><?php $firstCat = $this->categories[0]; ?><a href="<?php echo $firstCat['permalink']; ?>"><?php echo $firstCat['name']; ?></a></span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
        </div>
    </div>
    <div class="post_content padding">
        <a data-fancybox="gallery" data-caption="<?php $this->title();?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?>"  href="<?php $this->fields->photo();?>">
            <img src="<?php $this->fields->photo ? $this->fields->photo() : $this->fields->thumb();?>" />
        </a>
        <?php echo AutoLightbox($this->content);?>  
        <div class="cc-say" style="margin-bottom:30px">
            本摄影作品著作权归作者 [&nbsp;<span><?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?></span>&nbsp;] 享有，未经作者书面授权，禁止以任何目的、任何形式转载或使用，本声明具有法律效力，作者保留法律范围内的一切权利。
        </div>
    </div>
    <?php $this->need('comments.php'); ?>
</div>
<?php $this->need('custom/Phone/footer.php');?>	