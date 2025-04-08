<!--相册列表页面-->
<?php
// 获取unplash同步相册开关状态
$Unsplash = $this->options->Unsplash;
$accessKey = $this->options->Unsplash_API;
$Unsplash_user = $this->options->Unsplash_User;
$PhotoMid = $this->options->Unsplash_Cat;
// 开启照片同步且Unsplash Key填写完整才启用同步功能
if ($Unsplash == 'on' && $accessKey && $Unsplash_user && $PhotoMid) {
    $this->need('unsplash.php');
}?>

<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding" style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/photo.jpg';?>')">
        <a class="logo" href="<?php $this->options->siteUrl(); ?>">
            <img src="<?php echo $this->options->logoX ? $this->options->logoX : Helper::options()->themeUrl . '/assets/default/logo.png'; ?>">
            <div class="slogan">
                <h1><?php $this->options->title();?></h1>
                <span><?php echo $this->options->slogan ? $this->options->slogan : '自豪地使用ONEBLOG主题';?></span>
            </div>
        </a>
    </div>
    <div class="page_title padding animated fadeIn">
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?></h1>   
        <?php if ($Unsplash == 'on' && $accessKey && $Unsplash_user && $PhotoMid) { ?>
        <button id="updateBtn">
            <i class="iconfont icon-update"></i>同步照片
        </button>
        <?php } ?>
    </div>
    <div class="post_content padding animated fadeIn">
        <div id="photos">
            <?php while($this->next()): ?>
            <div class="photo image-shadow blur">
                <a data-fancybox="gallery" data-caption="<?php $this->title(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php echo $this->fields->author ? $this->fields->author() : $this->author(); ?>" href="<?php echo $this->fields->photo ? $this->fields->photo() : $this->fields->thumb(); ?>">
                    <img class="lazy-load" data-src="<?php echo $this->fields->thumb(); ?>" />
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="pageload" id="no_more">
            <?php $this->pageLink('点击查看更多','next'); ?>
        </div>
    </div>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>