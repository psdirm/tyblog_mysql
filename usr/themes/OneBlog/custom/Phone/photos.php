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
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/photo.jpg';?>')">
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?><span>Scenery along the way</span></h1> 
        <?php if ($Unsplash == 'on' && $accessKey && $Unsplash_user && $PhotoMid) { ?>
        <button class="updateBtn" id="updateBtn"><i class="iconfont icon-bling"></i>同步照片</button>
        <?php } ?>
    </div>

    <div id="photos">
    <?php while($this->next()): ?>
        <div class="photo">
            <a data-fancybox="gallery" data-caption="<?php $this->title(); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php echo $this->fields->author ? $this->fields->author() : $this->author(); ?>" href="<?php echo $this->fields->photo ? $this->fields->photo() : $this->fields->thumb(); ?>">
                <img class="lazy-load" data-src="<?php echo $this->fields->thumb(); ?>" />
            </a>
        </div>
    <?php endwhile; ?>
    </div>
    <div class="page-navigator" style="display: none;">
    <?php $this->pageNav('', ''); ?>
    </div>
    <!-- 加载动画 -->
    <div id="loading-spinner" style="display: none;">
        <div class="spinner"></div>加载中...
    </div>

</div>
<?php $this->need('custom/Phone/footer.php');?>	

