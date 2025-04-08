<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main padding">
    <!--顶部LOGO+搜索-->
    <div class="header">
        <div class="logo">
            <a id="logo" title="<?php $this->options->title();?>" alt="<?php $this->options->title();?>" href="<?php $this->options->siteUrl(); ?>" style="background-image:url('<?php echo $this->options->logo; ?>')"></a>
        </div>
        <form autocomplete="off" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search" class="search">
            <input id="search-input" title="站内搜索" type="text" name="s" class="input" placeholder="<?php _e('输入关键字搜索'); ?>" required />
            <button type="submit" class="search-icon"><i class="iconfont icon-search"></i></button>
        </form>
    </div>
    <div class="one">"&nbsp;<?php $this->archiveTitle(['search'   => _t('博客内包含关键字「<span>%s</span>」的文章')], '', ''); ?>&nbsp;&nbsp;<?php echo '共'.$this->getTotal().'篇';?>&nbsp;"
    </div>
    <!--搜索结果页文章列表-->
    <?php if ($this->have()): ?>
    <div id="posts">
        <?php while($this->next()): ?>
        <div class="post">
            <h1 class="post_title animated fadeInUp">
                <a href="<?php $this->permalink() ?>" ><?php if (isset($this->fields->title)): ?><?php  $this->fields->title();?><?php else: ?><?php $this->title();?><?php endif; ?></a>
            </h1>
            <div class="post_preview animated fadeInUp">
                <p class="post_abstract"><?php $this->excerpt(80,'...'); ?></p>
                <?php if(showThumbnail($this)):?>
                <div class="post_img lazy-load" data-src="<?php echo showThumbnail($this) . ($this->options->imgSmall ?: ''); ?>">
                </div>
                <?php endif;?>
            </div>
            <div class="post_meta animated fadeInUp">
                <span><?php echo time_ago($this->date); ?></span>
                <span><?php get_post_view($this) ?>&nbsp;阅读</span>
                <span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <!--点击无限加载-->
    <div class="load" id="no_more">
         <?php $this->pageLink('点击查看更多','next'); ?>
    </div>
    <!--返回顶部-->
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
    <?php else: ?>
    <div class="nodata">
        <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
        <span>没有找到相关内容</span>
        <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
    </div>
    <?php endif; ?>
</div>
<?php $this->need('custom/PC/footer.php');?>	