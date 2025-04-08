<!--评论部分的代码是通用的-->
<div class="padding" id="comments">
<?php $this->comments()->to($comments); ?>
<!--评论输入框-->
<?php if($this->allow('comment')): ?>
<div id="<?php $this->respondId(); ?>" class="respond">
    <div class="cancel-comment-reply">
    <?php $comments->cancelReply(); ?>
    </div>
    <h3 class="oneblog" id="response"><?php _e('<i class="iconfont icon-memos"></i>发表留言'); ?></h3>
    <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    <?php if ($this->user->hasLogin()): ?>
    <?php else: ?>
        <div class="comment-author-info">
            <div class="comment-md-3">
                <label for="author"><?php _e('称呼'); ?><span class="required">*</span></label>
                <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
            </div>	    
            <div class="comment-md-3">
                <label for="mail"<?php if ($this->options->commentsRequireMail): ?><?php endif; ?>><?php _e('邮箱'); ?><span class="required">*</span></label>
                <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
            </div>	
            <div class="comment-md-3">
                <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
                <input type="url" name="url" id="url" class="text" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
            </div>
        </div>
    <?php endif; ?>
        <textarea placeholder="请输入留言内容..." name="text" id="textarea" required ><?php $this->remember('text'); ?></textarea>
        
        
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
                <button type="submit" class="submit"><?php _e('提交审核'); ?></button>
            </div>
    </form>
</div>
<?php endif; ?>
<!--评论列表开始-->
<?php if ($comments->have()): ?>
<div class="line"></div>
<h3 class="oneblog"><?php $this->commentsNum(_t('<i class="iconfont icon-guestbook"></i>暂无留言'), _t('<i class="iconfont icon-guestbook"></i>读者留言<span>1</span>'), _t('<i class="iconfont icon-guestbook"></i>读者留言<span>%d</span>')); ?></h3>
<?php function threadedComments($comments, $options) {$commentLevelClass = $comments->levels > 0 ? 'comment-child' : 'comment-parent';?>
<li class="animated fadeIn <?php echo $commentLevelClass;?>">
    <div id="<?php $comments->theId(); ?>"><!--回复框跟随 容器必须保留该ID-->
    <div class="user">
        <?php $email=$comments->mail; $imgUrl = getGravatar($email);echo '<img class="avatar" src="'.$imgUrl.'">'; ?>
        <div class="user-info">
            <div class="name">
                <?php $comments->author(); ?>
                <?php dengji($comments->mail);?>
                <?php if ($comments->status === "waiting") : ?>
                    <span class="waiting">[ 审核中 ]</span>
                <?php endif; ?>
            </div>
            <div class="date">
                <span><?php $comments->date('Y-m-d H:i'); ?></span>
                <span class="comment-reply"><?php $comments->reply(); ?></span>       
            </div>
        </div>
    </div>
    
    <div class="<?= $comments->status === "waiting" ? 'waiting' : '' ?>"><?= parseEmojis($comments->content); ?></div>
    
    <!--子级评论列表-->
    <?php if ($comments->children) { $comments->threadedComments($options);} ?>
    </div>
</li>
<?php } ?>
<?php $comments->listComments(); ?>
<?php $comments->pageNav('', ''); ?>
        
<div id="loading-spinner" style="display: none;">
    <div class="spinner"></div><span>加载中...</span>
</div>
<div class="end" id="no-more" style="display: none;">END</div>
<?php else:?>
<div class="end" id="no-more" style="display: none;">END</div>
<?php endif; ?>
    
<!--评论列表end-->
</div>
