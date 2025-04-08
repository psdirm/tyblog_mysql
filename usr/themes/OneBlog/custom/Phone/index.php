<!--移动端首页 / 分类页 / 标签页 -->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	
<?php if ($this->is('index')) { // 如果是首页，则显示轮播banner文章
    if ($this->options->switch == 'on') {
        $defaultThumb = Helper::options()->themeUrl . '/assets/default/bg.jpg';
        $defaultPost = [
            'link' => 'https://oneblogx.com',
            'title' => '请填写文章cid',
            'thumb' => $defaultThumb,
        ];

        $rawData = get_banner_data($this->options);
        $posts = array_map(function($row) use ($defaultThumb) {
            $post = Typecho_Widget::widget('Widget_Abstract_Contents');
            $post->push($row);
            $thumbnail = showThumbnail($post) ?: $defaultThumb;
            return [
                'link' => $post->permalink,
                'title' => $post->title,
                'thumb' => $thumbnail,
            ];
        }, $rawData);

        // 确保 posts 数组至少有 3 个元素
        while (count($posts) < 3) {
            $posts[] = $defaultPost;
        }
        ?>
        
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="swiper-slide">
                    <a href="<?= $posts[$i]['link'] ?>" title="<?= $posts[$i]['title'] ?>" style="background-image:url('<?= $posts[$i]['thumb'] . ($posts[$i]['thumb'] !== $defaultThumb && $this->options->imgSmall ? $this->options->imgSmall : ''); ?>')">
                        <h1><?= $posts[$i]['title'] ?></h1>
                    </a>
                </div>
                <?php endfor; ?>
            </div>
            <!-- 如果需要分页器 -->
            <div class="swiper-pagination"></div>
        </div>
    <?php } ?>
    <!-- 轮播banner文章结束 -->

<?php }elseif ($this->is('category')) {//分类页则显示分类图片、分类名和标题
    // 从分类描述中提取数据
    $description = $this->getPageRow()['description'];
    $imageUrl = Helper::options()->themeUrl . '/assets/default/note.jpg'; 
    $textDescription = ''; 
    if (!empty($description)) {
        if (preg_match('/https:\/\/[^\s]+/', $description, $matches)) {
            $imageUrl = $matches[0]; 
        }
        $textDescription = trim(preg_replace('/https:\/\/[^\s]+/', '', $description));
        if (empty($textDescription)) {
            $textDescription = '暂无关于该分类的介绍';
        }
    }?>
    <style>
        .page_thumb.oneblog:before {background: url('<?php echo $imageUrl;?>') no-repeat 100% 75%;background-size: cover;}
    </style>
    <div class="page_thumb oneblog padding">
        <div class="category-thumb" style="background-image:url('<?php echo $imageUrl;?>')"></div>
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?><span><?php echo $textDescription;?></span></h1> 
    </div>
<?php }elseif($this->is('tag')){ //标签页则显示该标签下的第一篇文章的封面图片和标签名?>
    <div class="page_thumb padding" style="background-image:url('<?php showThumbnail($this);?>')">
        <h1>#<?php $this->archiveTitle(' &raquo; ', ''); ?>#</h1> 
    </div>
<?php } ?>
    
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

<?php $this->need('custom/Phone/footer.php');?>	