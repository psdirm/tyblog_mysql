<!--移动端搜索结果页-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	

<!--搜索结果页文章列表-->
<?php if ($this->have()): ?>
<div class="search-result">
    <span><i class="iconfont icon-post"></i><?php $this->archiveTitle(['search'   => _t('搜索到与&nbsp;<strong>%s</strong>&nbsp;有关的文章')], ''); ?>&nbsp;<?php echo '共&nbsp;'.$this->getTotal().'&nbsp;篇';?></span>
</div>
<div class="main padding" id="posts">
    <?php while($this->next()): ?>
    <div class="post">
        <h1><a href="<?php $this->permalink() ?>"><?php $this->title(); ?></a></h1>
        <div class="post_preview">
            <p><?php $this->excerpt(40, '...'); ?></p>
            <?php if(showThumbnail($this)):?>
            <div class="post_img lazy-load" data-src="<?php echo showThumbnail($this) . ($this->options->imgSmall ?: ''); ?>">
            </div>
            <?php endif;?>
        </div>
        <div class="post_meta">
            <span><?php echo time_ago($this->date); ?></span>
            <span><?php get_post_view($this) ?>&nbsp;阅读</span>
            <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
        </div>
    </div>
    <?php endwhile; ?>
    <div class="page-navigator" style="display: none;">
        <?php $this->pageNav('', ''); ?>
    </div>
</div>
<!-- 加载动画 -->
<div id="loading-spinner" style="display: none;">
    <div class="spinner"></div>加载中...
</div>
<?php else: ?>
    <div class="main nodata">
        <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
        <span>没有找到相关内容</span>
        <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
    </div>
<?php endif; ?>


<?php $this->need('custom/Phone/footer.php');?>	