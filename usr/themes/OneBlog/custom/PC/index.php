<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main padding">
    <!--顶部LOGO+搜索+一言-->
    <div class="header">
        <div class="logo">
            <a id="logo" title="<?php $this->options->title();?>" alt="<?php $this->options->title();?>" href="<?php $this->options->siteUrl(); ?>" style="background-image:url('<?php echo $this->options->logo; ?>')"></a>
        </div>
        <form autocomplete="off" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search" class="search">
            <input id="search-input" title="站内搜索" type="text" name="s" class="input" placeholder="<?php _e('输入关键字搜索'); ?>" required />
            <button type="submit" class="search-icon"><i class="iconfont icon-search"></i></button>
        </form>
    </div>
    <div class="one">
        <?php if ($this->is('index')){?>
        "&nbsp;<?php $quotes_file = dirname(__DIR__, 2) . '/api/quotes.txt';;$quotes = file($quotes_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);$random_quote = $quotes[array_rand($quotes)];echo $random_quote;?>"
        <?php }elseif($this->is('tag')){?>
        "&nbsp;<?php $this->archiveTitle(['tag'   => _t('博客内包含标签「<span>%s</span>」的文章')], '', ''); ?>&nbsp;&nbsp;<?php echo '共'.$this->getTotal().'篇';?>&nbsp;"
        <?php }elseif($this->is('category')){ ?>
        "&nbsp;<?php $this->archiveTitle(['category'   => _t('分类「<span>%s</span>」下的文章')], '', ''); ?>&nbsp;&nbsp;<?php echo '共'.$this->getTotal().'篇';?>&nbsp;"
        <?php }?>
    </div>
    <?php if ($this->is('index')){//如果是首页，则显示杂志banner文章
        if ($this->options->switch == 'on') {
        $defaultThumb = Helper::options()->themeUrl . '/assets/default/bg.jpg';
        $defaultPost = [
            'link' => 'https://oneblogx.com',
            'title' => '请填写文章cid',
            'thumb' => $defaultThumb,
        ];

        $posts = [];
        $rawData = get_banner_data($this->options);
        foreach ($rawData as $row) {
            $post = Typecho_Widget::widget('Widget_Abstract_Contents');
            $post->push($row);
            $thumbnail = showThumbnail($post) ?: $defaultThumb;
            $posts[] = [
                'link' => $post->permalink,
                'title' => $post->title,
                'thumb' => $thumbnail,
            ];
        }
        // 确保 posts 数组至少有 3 个元素
        for ($i = count($posts); $i < 3; $i++) {
            $posts[] = $defaultPost;
        }?>
        <div class="banner">
            <div class="banner-item">
                <a href="<?= $posts[0]['link'] ?>" title="<?= $posts[0]['title'] ?>">
                    <div class="banner-thumb lazy-load" data-src="<?= $posts[0]['thumb'] . ($posts[0]['thumb'] !== $defaultThumb && $this->options->imgSmall ? $this->options->imgSmall : ''); ?>">
                        <div class="banner-title"><h1><?= $posts[0]['title'] ?></h1></div>
                    </div>
                </a>
            </div>
            <div class="banner-item">
                <?php for ($i = 1; $i <= 2; $i++): ?>
                <a href="<?= $posts[$i]['link'] ?>" title="<?= $posts[$i]['title'] ?>">
                    <div class="banner-thumb lazy-load" data-src="<?= $posts[$i]['thumb'] . ($posts[$i]['thumb'] !== $defaultThumb && $this->options->imgSmall ? $this->options->imgSmall : ''); ?>">
                        <div class="banner-title"><h1><?= $posts[$i]['title'] ?></h1></div>
                    </div>
                </a>
                <?php endfor; ?>
            </div>
        </div>
    <?php } ?>
    <?php }?>
    <!--文章列表-->
    <div id="posts">
        <?php while($this->next()): ?>
        <div class="post">
            <h1 class="animated fadeInUp">
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
</div>
<!--返回顶部-->
<a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
<?php $this->need('custom/PC/footer.php');?>	