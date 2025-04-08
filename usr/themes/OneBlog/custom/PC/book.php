<!--书单详情页面样式-->
<?php $this->need('custom/PC/header.php');?>
<!--全局容器-->
<style>
.book-bg:before {
    background: url('<?php echo showThumbnail($this);?>') no-repeat 100% 75%;
}
</style>
<div class="main">
    <div style="overflow: hidden;">
    <!--书单详情页顶部-->
    <div class="book-bg">
        <div class="book-thumb" style="background-image: url('<?php echo $this->fields->thumb ? $this->fields->thumb : Helper::options()->themeUrl . '/assets/default/bg.jpg'; ?>');">
        </div>
        <div class="book-info">
            <h2><?php $this->title();?></h2>
            <span>作者：<?php echo $this->fields->author ? $this->fields->author : '未填写';?></span>
            <span>类别：<?php echo $this->fields->bookCat ? $this->fields->bookCat : '未填写';?></span>
            <span>出版时间：<?php echo $this->fields->bookYear ? $this->fields->bookYear : '未填写';?></span>
        </div>
    </div>
    <!--书摘笔记和书籍简介-->
    <div class="book-tab">
        <div class="tab-item">
            <a href="#booknote" class="selected">读书笔记</a>
            <a href="#bookinfo">本书简介</a>
        </div>
        <!--读书笔记-->
        <div class="booknote" id="booknote">
            <div id="comments">
                <?php $this->comments()->to($comments); $user = Typecho_Widget::widget('Widget_User');
                if($user->hasLogin() && $this->allow('comment'))://登录后才能判断所属权限组
                    $userGroup = get_object_vars($this->user)['row']['group'];
                    if($userGroup == "administrator"){//站长才能发表读书笔记?>
                    <!--显示笔记输入框-->
                    <div id="<?php $this->respondId(); ?>" class="respond">
                        <h3 class="oneblog" id="response"><?php _e('<i class="iconfont icon-memos"></i>读书笔记'); ?></h3>
                        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                            <textarea placeholder="记录书中的句子或此刻的想法..." name="text" id="textarea" required ><?php $this->remember('text'); ?></textarea>
                            <div class="comment-submit">
                                <div class="emoji" title="添加表情">
                                    <i id="emoji-btn" class="iconfont icon-emoji"></i>
                                    <div id="emoji-picker" class="emoji-picker" style="display:none;">
                                        <div class="emoji-categories">
                                            <button type="button" class="emoji-category" data-category="emotion">表情</button>
                                            <button type="button" class="emoji-category" data-category="special">特殊</button>
                                            <button type="button" class="emoji-category" data-category="kaomoji">颜文字</button>
                                        </div>
                                        <div class="emoji-container">
                                            <!-- 表情图标会动态加载到这里 -->
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="submit"><?php _e('记录'); ?></button>
                            </div>
                        </form>
                    </div>
                    <?php }?>
                <?php endif;?>
                <!--读书笔记列表-->
                <?php if ($comments->have()): function threadedComments($comments, $options){?>
                <li>
                    <?php echo parseEmojis($comments->content); ?>
                    <span><?php $comments->date('Y年m月d日'); ?></span>
                </li>
                <? }?>
                <?php $comments->listComments(); ?>
                <?php $comments->pageNav('', ''); ?>
                <div id="loading-spinner" style="display: none;">
                    <div class="spinner"></div><span>加载中...</span>
                </div>
                <div class="end" id="no-more" style="display: none;">END</div>
                <?php elseif(!$user->hasLogin()):?>
                <div class="nodata">
                    <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
                    <span>博主暂未发布本书的读书笔记。</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!--书籍简介-->
        <div class="bookinfo" id="bookinfo">
            <?php if (empty(trim($this->content))): ?>
            <div class="nodata">
                <img src='<?php $this->options->themeUrl('assets/img/nodata.svg'); ?>'></img>
                <span>博主很懒，暂未填写本书简介。</span>
            </div>
            <?php else: ?>
            <div class="about">
                <?php echo AutoLightbox($this->content);?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <a id="gototop" class="hidden"><i class="iconfont icon-up"></i></a>
</div>
<?php $this->need('custom/PC/footer.php'); ?>