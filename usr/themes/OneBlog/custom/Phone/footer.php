<?php $this->footer();?>
<script src="<?php $this->options->themeUrl('/assets/sdk/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/sdk/layer/layer.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.js'); ?>"></script>

<?php if ($this->is('post') || $this->is('page')): ?>
<!--评论无限加载-->
<script src="<?php $this->options->themeUrl('/assets/js/comments.js'); ?>"></script>
<!--表情支持-->
<script src="<?php $this->options->themeUrl('/assets/js/emoji.js'); ?>"></script>
<?php if ($this->options->BeCode == 'on'):?>
<!--代码高亮逻辑-->
<script src="<?php $this->options->themeUrl('/assets/sdk/highlightjs/highlight.min.js'); ?>"></script>
<script defer>
document.addEventListener('DOMContentLoaded', function () {
    const codeBlocks = document.querySelectorAll('pre code');
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                hljs.highlightElement(entry.target);
                observer.unobserve(entry.target); 
            }
        });
    }, {
        rootMargin: '0px',
        threshold: 0.1 // 当代码块进入视口 10% 时触发，减少资源占用
    });

    codeBlocks.forEach(function (codeBlock) {
        observer.observe(codeBlock); 
        codeBlock.style.filter = 'none'; // 显示高亮后的代码块
    });
});
</script>
<?php endif;?>
<?php endif;?>

<?php if ($this->is('index')):?> 
<script src="<?php $this->options->themeUrl('/assets/sdk/swiper/swiper-bundle.min.js'); ?>"></script>
<?php endif; ?>
<?php $Unsplash = $this->options->Unsplash; if ($this->is('category', 'photos') && $Unsplash == 'on'): ?>
<script src="<?php $this->options->themeUrl('/assets/js/unsplash.js'); ?>"></script><!--更新照片-->
<?php endif; ?>

<script src="<?php $this->options->themeUrl('/assets/js/oneblog_m.js?v=3.5.2'); ?>"></script>

<!--统计代码-->
<?php if (!empty($this->options->Tongji)): ?>
<?php $this->options->Tongji();?>
<?php endif; ?>

</body>
</html>