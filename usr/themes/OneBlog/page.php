<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(isMobile()){  //移动端单独编写
    $this->need('custom/Phone/page.php');
}else{
    $this->need('custom/PC/page.php'); 
}?>