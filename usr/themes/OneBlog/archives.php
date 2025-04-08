<?php
/**
 * 归档页面
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(isMobile()){  //移动端单独编写
    $this->need('custom/Phone/archives.php');
}else{
    $this->need('custom/PC/archives.php'); 
}?>