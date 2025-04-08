<!--移动端404页面-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	

<div class="main nodata">
    <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
    <span>404：你所访问的页面不存在或已失效</span>
    <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
</div>

<?php $this->need('custom/Phone/footer.php');?>	