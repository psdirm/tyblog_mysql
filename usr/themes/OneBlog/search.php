<?php //搜索页面
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(isMobile()){  //移动端单独编写
    $this->need('custom/Phone/search.php');
}else{
    $this->need('custom/PC/search.php'); 
}?>