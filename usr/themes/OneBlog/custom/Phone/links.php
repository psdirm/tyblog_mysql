<!--友情链接页面-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	

<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/friend.jpg';?>')">
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?><span>My online friends</span></h1> 
    </div>

    <?php if (array_key_exists('Links', Typecho_Plugin::export()['activated'])):?>
     <!--新版本样式-->
     <div class="links">
         <?php Links_Plugin::output("
			<li class='link'>
				<a href='{url}' target='_blank' rel='nofollow'>
				    <img src='{image}' alt='{name}'/>
				    <div class='link-info'>
				        <h3>{name}</h3>
				        <span title='{description}'>{description}</span>
				    </div>
				</a>
			</li>
		 ", 0); ?>
     </div>
    <?php else:?>
	<div class="nodata">
        <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
        <span>暂未启用Links插件，请先安装并启用该插件。</span>
    </div>
	<?php endif;?>
    <div class="end">END</div>
</div>
<?php $this->need('custom/Phone/footer.php');?>	