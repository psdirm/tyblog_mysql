<!--404错误页面-->
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
    <div class="one">"&nbsp;迷失的人迷失了，相逢的人会再相逢。"</div>
    <div class="nodata">
        <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
        <span>404：您所访问的页面不存在或已失效</span>
        <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
    </div>
</div>
<?php $this->need('custom/PC/footer.php');?>	