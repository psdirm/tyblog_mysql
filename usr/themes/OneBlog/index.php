<?php
/**
 *
 * 一款简约文艺的文字博客主题：那些物质的东西，都会随着时间慢慢销蚀，而我们写下的文字，最趋近于永恒。希望你在用上这款主题之后，不忘初心，坚持把自己的博客写下去。
 * 官网：<a href="https://oneblogx.com">oneblogx.com</a>
 * 文档：<a href="https://docs.oneblogx.com">docs.oneblogx.com</a>
 * 
 * @package OneBlog
 * @author 彼岸临窗
 * @version 3.5.2
 * @link https://oneblogx.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if(isMobile()){  //移动端单独编写
    $this->need('custom/Phone/index.php');
}else{
    $this->need('custom/PC/index.php'); 
}?>
