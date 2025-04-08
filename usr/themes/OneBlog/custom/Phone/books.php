<!--书单列表页-->
<?php $this->need('custom/Phone/header.php');?>	
<?php $this->need('custom/Phone/menu.php');?>	
<!--全局容器-->
<div class="main">
    <div class="page_thumb padding"  style="background-image:url('<?php echo $this->getPageRow()['description'] ? $this->getPageRow()['description'] : Helper::options()->themeUrl . '/assets/default/book.jpg';?>')">
        <h1><?php $this->archiveTitle(' &raquo; ', ''); ?><span>Books I've Read</span></h1> 
    </div>
    <div id="books">
        <?php while($this->next()): ?>
        <a href="<?php $this->permalink() ?>" class="book">
            <div class="book-thumb lazy-load" data-src="<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg'; ?>"></div>
            <div class="book-name"><?php echo $this->title ? $this->title : '请填写书名'; ?></div>
        </a>
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