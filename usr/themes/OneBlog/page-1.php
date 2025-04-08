<?php
/**
 * 无图单页
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(isMobile()){  //移动端单独编写
    $this->need('custom/Phone/page-1.php');
}else{
    $this->need('custom/PC/page-1.php'); 
}?>