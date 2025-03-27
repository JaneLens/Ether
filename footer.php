<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
        <footer class="foot_main">
            <div class="container">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
                    <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?></p>
                    <?php $this->options->Footer() ?>
                </div>
            </div>
        </footer>
    </div><!-- End main_screen -->
    
    <!-- 配件 -->
    
    <!-- 通知模态框 -->
    <?php if (! $this->user->hasLogin()): ?>
    <div class="notice-modal">
        <div class="modal-overlay"></div>
        <div class="modal-body">
            <div class="notice-content">
                <div class="notice-modal-body">
                    <?php if ($this->remember('mail',true) != "") : ?>
                        <?php 
                        $mail = Typecho_Cookie::get('__typecho_remember_mail');
                        $comments = $this->widget('Widget_Comments_RecentPlus', 'mail='.$mail.'&postAuthor='.$this->user->uid);
                        $hasComments = false;
                        ?>
                        
                        <?php while($comments->next()): ?>
                            <?php 
                            $hasComments = true;
                            // 判断是否作者回复（评论所在文章作者=评论者）
                            $isAuthorReply = ($comments->ownerId == $comments->authorId);
                            ?>
                            <li class="comment-notification-item <?php echo $isAuthorReply ? 'author-reply' : ''; ?>">
                                <!-- 头像 -->
                                <div class="comment-avatar">
                                    <img width="40" height="40" 
                                         src="<?php _getAvatarByMail($comments->mail); ?>" 
                                         alt="<?php $comments->author(); ?>">
                                </div>
                    
                                <div class="comment-info">
                                    <!-- 作者回复标记 -->
                                    <?php if($isAuthorReply): ?>
                                        <div class="author-badge">
                                            <svg width="14" height="14" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M12,2C6.48,2 2,6.48 2,12s4.48,10,10,10 10-4.48,10-10S17.52,2,12,2zM10,17l-5-5 1.41-1.41L10,14.17l7.59-7.59L19,8l-9,9z"/>
                                            </svg>
                                            作者回复
                                        </div>
                                    <?php endif; ?>
                    
                                    <!-- 元信息 -->
                                    <div class="comment-meta">
                                        <span class="author-name"><?php $comments->author(); ?></span>
                                        <span class="comment-time"><?php $comments->date('n月j日 H:i'); ?></span>
                                    </div>
                    
                                    <!-- 被回复内容 -->
                                    <?php if($comments->parent > 0): ?>
                                        <div class="parent-comment">
                                            <div class="original-comment">
                                                <span class="reply-to">回复我的评论：</span>
                                                <?php echo strip_tags($comments->parentText); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                    
                                    <!-- 回复内容 -->
                                    <div class="comment-content">
                                        <?php echo strip_tags($comments->text); ?>
                                    </div>
                    
                                    <!-- 文章信息 -->
                                    <a href="<?php $comments->permalink(); ?>" class="comment-source">
                                        《<?php $comments->title(); ?>》
                                    </a>
                                </div>
                            </li>
                        <?php endwhile; ?>
                        
                        <?php if (!$hasComments): ?>
                            <div class="no-comments-notice">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <p>还没有评论 留个脚印吧~</p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <button class="close-btn">
                <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M512 12C235.9 12 12 235.9 12 512s223.9 500 500 500 500-223.9 500-500S788.1 12 512 12z m166.3 609.7c15.6 15.6 15.6 40.9 0 56.6-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7L512 568.6 402.3 678.3c-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7c-15.6-15.6-15.6-40.9 0-56.6L455.4 512 345.7 402.3c-15.6-15.6-15.6-40.9 0-56.6 15.6-15.6 40.9-15.6 56.6 0L512 455.4l109.7-109.7c15.6-15.6 40.9-15.6 56.6 0 15.6 15.6 15.6 40.9 0 56.6L568.6 512l109.7 109.7z"></path>
                </svg>
            </button>
        </div>
    </div>
    <?php endif; ?>
    <?php if ($this->options->Footer_reward) : ?>
    <!-- 赞助弹出 -->
    <div class="reward-modal">
        <div class="modal-overlay"></div>
        <div class="modal-body">
            <div class="modal-content">
                <div class="reward-popup">
                    <div class="popup-header">
                        <p>谢谢赞赏</p>
                        <p class="subtitle">（微信）</p>
                    </div>
                    <div class="qrcode-container">
                        <img src="<?php $this->options->Footer_reward() ?>">
                    </div>
                </div>
            </div>
            <button class="close-btn">
                <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                    <path d="M512 12C235.9 12 12 235.9 12 512s223.9 500 500 500 500-223.9 500-500S788.1 12 512 12z m166.3 609.7c15.6 15.6 15.6 40.9 0 56.6-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7L512 568.6 402.3 678.3c-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7c-15.6-15.6-15.6-40.9 0-56.6L455.4 512 345.7 402.3c-15.6-15.6-15.6-40.9 0-56.6 15.6-15.6 40.9-15.6 56.6 0L512 455.4l109.7-109.7c15.6-15.6 40.9-15.6 56.6 0 15.6 15.6 15.6 40.9 0 56.6L568.6 512l109.7 109.7z"></path>
                </svg>
            </button>
        </div>
    </div>
    <?php endif; ?>
    <!-- jquery -->
    <script src="<?php _getAssets('Assets/Js/jquery@3.6.0/jquery.min.js'); ?>"></script>
    <!-- Pjax -->
    <script src="<?php _getAssets('Assets/Js/Pjax/Pjax.min.js'); ?>"></script>
    <!-- 加载 -->
    <script src="<?php _getAssets('Assets/Js/lazysizes@5.3.2/lazysizes.min.js'); ?>"></script>
    <!-- 提示 -->
    <link href="<?php _getAssets('Assets/Js/Message/message.min.css'); ?>" rel="stylesheet" />
    <script src="<?php _getAssets('Assets/Js/Message/message.min.js'); ?>"></script>
    <!-- 幻灯片 -->
    <link href="<?php _getAssets('Assets/Js/slick@1.8.1/slick.min.css'); ?>" rel="stylesheet" />
    <script src="<?php _getAssets('Assets/Js/slick@1.8.1/slick.min.js'); ?>"></script>
    <!-- 灯箱 -->
    <script src="<?php _getAssets('Assets/Js/view-image.min.js'); ?>"></script>
    <!-- 通用 -->
    <script src="<?php _getAssets('Assets/Js/Global.min.js'); ?>"></script>
    <script src="<?php _getAssets('Assets/Js/Pjax/Pjax.js'); ?>"></script>
    <!-- 灯箱 -->
    <script src="<?php _getAssets('Assets/Js/view-image.min.js'); ?>"></script>
    <script>
        window.ViewImage && ViewImage.init('.entry__layout img, .postlist_album img');
      <?php
      $cookie = Typecho_Cookie::getPrefix();
      $notice = $cookie . '__typecho_notice';
      $type = $cookie . '__typecho_notice_type';
      ?>
      <?php
      Typecho_Cookie::delete('__typecho_notice');
      Typecho_Cookie::delete('__typecho_notice_type');
      ?>
      <?php $this->options->CustomScript() ?>
    </script>
    <?php $this->options->CustomBodyEnd() ?>
    <?php $this->footer(); ?>
</body>
</html>
