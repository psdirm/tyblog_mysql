<!--移动端顶部导航+侧边栏菜单-->

<!-- 移动端侧栏菜单-->
<div id="menu" class="menu">
    <div class="close">
        <span id="close"><i class="iconfont icon-cancel"></i></span>
    </div>
    <?php if ($menu = parseCustomMenu()): ?>
        <?php echo $menu['hasIcon']; ?>
    <?php endif; ?>
    <div class="copyright">
        <div class="switch">
            夜间模式<input type="checkbox" id="oneblog-protect"><label for="oneblog-protect" class="switchBtn"></label>
        </div>
        <span>©<?php if (!empty($this->options->Webtime)): echo $this->options->Webtime().'-'; ?><?php endif; ?><?php echo date('Y'); ?>&nbsp;&nbsp;<a href="<?php echo $this->options->siteUrl; ?>"><?php echo $this->options->title; ?></a></span>
        <span>Designed by <a id="author-info" href="https://oneblogx.com" title="主题" target="_blank">OneBlog</a></span>
    </div>
</div>

<!--移动端顶部菜单-->

<div class="header bg-white">
    <?php if ($menu = parseCustomMenu()): ?>
    <i id="openmenu" class="iconfont icon-nav"></i>
    <?php endif;?>
    <a id="logo" class="logo" href="<?php $this->options->siteUrl(); ?>" style="background-image:url('<?php echo $this->options->logo; ?>')"></a>
    <i id="search" class="iconfont icon-search"></i>
</div>
<!--移动端搜索弹框-->
<div class="search-layer">
    <div class="search">
        <form autocomplete="off" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search" class="search-form">
            <input type="text" name="s" class="input" placeholder="<?php _e('输入关键字搜索'); ?>" required />
            <button type="submit" class="search-icon">搜索</button>
        </form>
    </div>
</div>


