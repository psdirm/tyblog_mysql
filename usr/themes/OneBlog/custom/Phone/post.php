<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>
<div class="main">
    <?php if($this->fields->thumb): ?>
    <!--如是有图文章，则显示缩略图-->
    <div class="post_thumb lazy-load" data-src="<?php $this->fields->thumb();?>">
        <div class="oneblog-date">
            <div class="date">
                <span class="day"><?php $this->date('d'); ?></span>
                <span class="year"><?php $this->date('M,Y'); ?></span>
            </div>         
        </div>
    </div>
    <!--当前文章所属分类 只取第一个分类-->
    <div class="category">
        <?php $firstCat = $this->categories[0]; ?>
        <a href="<?php echo $firstCat['permalink']; ?>"><?php echo $firstCat['name']; ?></a>
    </div>
    
    <!--文章标题和统计-->
    <div class="post_info">
        <h1><?php $this->title();?></h1>   
        <span>阅读&nbsp;<?php get_post_view($this) ?></span>
        <span><?php $this->commentsNum('评论 0', '评论 1', '评论 %d'); ?></span>
    </div>
    
    <?php else: ?>
    <!--没有封面图的文章详情页顶部样式-->
    <div class="post_nothumb animated fadeIn">
        <div class="breadcrumb">
            <li><a href="<?php $this->options->siteUrl(); ?>">首页</a><span>&gt;</span></li>
            <li><?php $firstCat = $this->categories[0]; ?><a href="<?php echo $firstCat['permalink']; ?>"><?php echo $firstCat['name']; ?></a><span>&gt;</span></li>
            <li>正文</li>
        </div>
        <h1><?php $this->title() ?></h1>   
        <div class="post_meta">
            <span><?php $this->date('Y年m月d日'); ?></span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            <span><?php echo art_count($this->cid); ?>&nbsp;字</span>
        </div>
    </div>
    <?php endif;?>

    <!--通用文章正文-->
    <div class="post_content padding">
        <?php echo AutoLightbox($this->content);?>
        <!--版权说明-->
        <div class="cc-say">
            本文著作权归作者 [&nbsp;<span><?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?></span>&nbsp;] 享有，未经作者书面授权，禁止转载，封面图片来源于 [&nbsp;<span><?php echo $this->fields->origin ? $this->fields->origin : '互联网' ;?></span>&nbsp;] ，本文仅供个人学习、研究和欣赏使用。如有异议，请联系博主及时处理。
        </div>
        <!--文章标签-->
        <div class="tags"><?php $this->tags('', true); ?></div>
        <!--相关文章-->
        <?php $this->related(5)->to($relatedPosts); ?>
        <?php if ($relatedPosts->have()): ?>
        <h3 class="oneblog"><i class="iconfont icon-app theme-color"></i>猜你喜欢</h3>
        <?php while ($relatedPosts->next()): ?>
            <div class="relate-post" style="background-image:url('<?php echo showThumbnail($relatedPosts); ?>')">
                <a href="<?php echo $relatedPosts->permalink(); ?>" title="<?php echo $relatedPosts->title(); ?>">
                    <h2 class="prev-title"><?php echo $relatedPosts->title(); ?></h2>
                </a>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <!--通用文章评论-->
    <?php $this->need('comments.php'); ?> 
</div>
<?php $this->need('custom/Phone/footer.php');?>	