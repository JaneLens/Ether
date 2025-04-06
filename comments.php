<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<div id="comments" class="post_comment">
    <?php $this->comments()->to($comments); ?>
    <!--自定义评论函数-->
    <div style="color:var(--text-color-1);" class="comments-title">
        <svg class="icon" style="width:1.5em;height:1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3976"><path d="M521.2672 922.112c-6.6048 0-13.1584-2.0992-18.688-6.2976-14.2848-10.9056-28.2624-26.1632-43.0592-42.2912-15.7184-17.152-39.5264-43.0592-51.6096-46.2848-175.5648-46.5408-298.1888-197.376-298.1888-366.848 0-210.3808 184.6272-381.5424 411.5456-381.5424s411.5456 171.1616 411.5456 381.5424c0 165.5808-113.9712 311.3472-283.5968 362.752-15.2064 4.608-38.2464 27.392-58.5728 47.4624-16.7936 16.5888-34.1504 33.7408-51.8144 46.0288a30.56128 30.56128 0 0 1-17.5616 5.4784z m0-781.7728c-193.0752 0-350.1056 143.616-350.1056 320.1024 0 141.6704 103.8336 268.0832 252.5184 307.5072 29.44 7.8336 55.7568 36.4032 81.152 64.1024 5.9392 6.4512 11.9296 13.0048 17.664 18.8928 8.192-7.424 16.64-15.7696 24.9856-24.0128 26.624-26.3168 54.1696-53.504 83.968-62.5152 143.5136-43.4688 239.9744-165.632 239.9744-303.9232-0.0512-176.5888-157.0816-320.1536-350.1568-320.1536z" fill="var(--text-color-1)" p-id="3977"></path><path d="M397.7728 438.1184m-48.0256 0a48.0256 48.0256 0 1 0 96.0512 0 48.0256 48.0256 0 1 0-96.0512 0Z" fill="var(--text-color-1)" p-id="3978"></path><path d="M640.9216 438.1184m-48.0256 0a48.0256 48.0256 0 1 0 96.0512 0 48.0256 48.0256 0 1 0-96.0512 0Z" fill="var(--text-color-1)" p-id="3979"></path></svg>
        <b><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></b>
    </div>
    <!--评论列表开始-->
    
    <div class="comments-main">
    <?php if ($comments->have()): ?>
    <?php function threadedComments($comments, $options) {
            $commentClass = '';
            if ($comments->authorId) {
                    if ($comments->authorId == $comments->ownerId) {
                        $commentClass .= ' comment-by-author';
                    } else {
                        $commentClass .= ' comment-by-user';
                    }
                }
            $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="my-3 comment-body<?php if ($comments->levels > 0) { echo ' comment-child';$comments->levelsAlt(' comment-level-odd', ' comment-level-even');} else {echo ' comment-parent';}
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
        <div id="<?php $comments->theId(); ?>">
            <div class="comment-meta comment-author">
                <img width="40" height="40" class="avatar lazyload lazyloaded" src="<?php _getAvatarLazyload() ?>" data-src="<?php _getAvatarByMail($comments->mail); ?>" alt="头像" />
                <div class="comment-info">
                    <b class="fn">
                        <?php $comments->author(); ?>
                    </b>
                    <div class="comment-info-bottom">
                        <span><?php $comments->date('Y-m-d H:i'); ?></span>   
                    </div>
                </div>
            </div>
            
            <div class="comments-content comment-content">
                
                <?php if ($comments->status === "waiting") : ?>
                <div class="p-waiting">
                    <?php
                    $commentContent = $comments->content;
                    echo $commentContent; // 输出评论内容
                    ?>
                    <p>该评论已提交 <b>待</b>审核</p>
                </div>
                <?php else: ?>
                <?php
                    $commentContent = $comments->content;
                    echo $commentContent; // 输出评论内容
                ?>
                <?php endif; ?>
            </div>
            
            <!-- 回复按钮 -->
                <span class="cp-<?php $comments->theId(); ?> comment-reply text-muted comment-reply-link"><?php $comments->reply('回复'); ?></span>
                <span id="cancel-comment-reply" class="comment-reply cancel-comment-reply cl-<?php $comments->theId(); ?> text-muted comment-reply-link" style="display:none" ><?php $comments->cancelReply('取消'); ?></span>
            
            
            <!-- 回复框 -->
            <?php if ($comments->children) { ?>
            <div class="comment-children">
                <?php $comments->threadedComments($options); ?>
            </div>
            <?php } ?>
            
        </div>
    </li>
    <?php } ?>
    
    
    
    
    <?php $comments->listComments(); ?>
    
    <?php $comments->pageNav('', ''); ?>

    <?php
        // 获取当前页面的文章 CID
        $cid = $this->cid;
        // 查询当前页面的评论总数
        // 查询当前页面的评论总数，只查询 parent 为 0 的评论
        $comment_count = $this->db->fetchRow($this->db->select('COUNT(*) AS count')->from('table.comments')
            ->where('cid = ?', $cid)
            ->where('status = ?', 'approved')
            ->where('parent = ?', 0))['count'];//只查询父级评论，否则会导致分页存在问题
            
        if($comment_count > 6)://注意 这里的数字一定要与主题设置中分页显示的评论数一致，换言之 如果评论数有下一页 则显示加载更多按钮?>
        
        <!-- 添加一个按钮用来加载下一页评论 -->
        <div class="center flex justify-center">
            <button id="load-more-comments">
                <span class="comment-lable">查看更多</span>
            </button>
        </div>
        <?php endif; ?>
        <!-- 添加一个用于显示提示信息的元素 -->
        <div class="flex justify-center center">
            <div id="no-more-comments" style="display: none;">— 已显示全部评论 —</div>
         </div>
    <?php else: ?>
        <div class="no-comments">
            <svg class="icon" style="width:3em;height:3em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7595"><path d="M833 314.6c-43.8 28.2-61.9 48.2-87.8 47.1-25.9-1.1-70.5-28.6-88.9-36.4-29-12.3-70.3-21.6-95.6-5.3-20.1 14.5-2.9 39 4.6 48.1 7.4 9.1 43.7 36.4 54.4 49.8 6.1 7.7 6.7 18.8-5.8 20.6-24 6.7-41.4 1.6-57.3-1.8-15.8-3.3-32.2-15.3-57.7-13.7-32 2.1-21.1 29.7-21.1 29.7s26.4 78.7 97.6 96.5c62.2 15.6 347.3-127.7 378.6-180.1 30.5-50.5-59.3-94.2-121-54.5z m49.4 70.1c-32.8 24-119.1 69.2-216.8 109.3-32.5 13.3-60.8 22.1-80.5 16.7-21.7-6-44.6-19.8-52.3-37.3-3.3-7.6-1.9-12 8.7-7.6 13.2 5.5 24.6 6.9 39.8 8.8 17.8 2.2 34.7 0 34.7 0 28.7-4.3 32.8-11.2 39.5-19.2 7.8-9.4 9.3-22.3 4.3-39.5-5.4-18.9-30.3-36.4-30.3-36.4s-38.8-22.9-23.5-31.4c13-7.3 42 10.3 60.4 21.5 12 7.3 48.2 23.2 66.4 25.7 33.3 4.6 62.4-10.6 102.4-41.9 27.7-22.2 115.5-18.6 47.2 31.3zM801.7 530.5c-10.4 0-18.8 8.4-18.8 18.7-18.5 137.5-139.4 243.7-282.8 243.7-107.1 0-200.2-59.2-248.2-146.5 127.4-27.2 199.3-65.7 209.5-78.5 5.8-5.9 5.8-39.8-36.7-18.7-55.9 27.8-127.6 50.5-188.5 63.6-12.2-31.3-18.8-65.4-18.8-101 0-155.3 126.6-281.3 282.8-281.3 63.6 0 128.8 22.7 176.7 61.4 0 0 8.3 7 16.9 6.7 10.5-0.3 17.4-7.6 17.4-18 0-4.5-1.7-8.8-4.6-12.3 0.1-0.1-1.1-1.1-1.6-1.6-0.4-0.4-1-0.8-1.4-1.1-55.3-45.3-126.1-72.6-203.3-72.6-177 0-320.4 142.7-320.4 318.7 0 37.9 6.7 74.3 18.9 108.1-13.7 2.2-26.4 3.7-37.7 4.4-43.6 3-75.7-2-37.7-56.2 23.5-33.5 30.5-47.2 18.8-56.3-12.3-6.6-22.6 4.6-22.6 4.6s-44.5 52.3-53 89.1c-3.7 17.9-16.9 62.1 75.4 56.3 24.8-1.6 48.5-4.3 71.2-8 52.5 104.8 161.3 176.7 287 176.7 160.2 0 295.4-115.9 319.1-268.6 1.3-8.2 1.3-8.2 1.3-12.7 0-10.3-8.4-18.6-18.9-18.6z" p-id="7596"></path></svg>暂无评论
        </div>
    <?php endif; ?>
    
    </div>
    <!--评论列表end-->
    
    
    <!--评论输入框-->

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div id="reply-title" class="comment-reply-title">
            <svg class="icon" style="width: 1.5em;height: 1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6985"><path d="M825.5 832.2h-627c-72.7 0-131.9-59.1-131.9-131.9V323.6c0-72.7 59.1-131.9 131.9-131.9h626.9c72.7 0 131.9 59.1 131.9 131.9v376.7c0 72.8-59.1 131.9-131.8 131.9z m-627-602.7c-51.9 0-94.2 42.2-94.2 94.2v376.7c0 51.9 42.3 94.2 94.2 94.2h626.9c51.9 0 94.2-42.2 94.2-94.2V323.6c0-51.9-42.3-94.2-94.2-94.2H198.5z" fill="var(--text-color-1)" p-id="6986"></path><path d="M247.6 646.7h528.8v37.7H247.6zM830.4 388.7h-75.3V351h75.3v37.7z m-131.8 0h-75.3V351h75.3v37.7z m-131.9 0h-75.3V351h75.3v37.7z m-131.8 0h-75.3V351h75.3v37.7z m-131.9 0h-75.3V351H303v37.7zM830.4 547.9h-75.3v-37.7h75.3v37.7z m-131.8 0h-75.3v-37.7h75.3v37.7z m-131.9 0h-75.3v-37.7h75.3v37.7z m-131.8 0h-75.3v-37.7h75.3v37.7z m-131.9 0h-75.3v-37.7H303v37.7z" fill="var(--text-color-1)" p-id="6987"></path></svg>
            发布评论 
        </div>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    	    
    	        <div class="comment-textarea">
                    <textarea placeholder="请输入留言内容..." style="min-height:140px;" rows="3" cols="50" name="text" id="textarea" class="textarea Comment_Textarea w-full p-2 rounded" required ><?php $this->remember('text'); ?></textarea>
                    
                </div>
    	    
        	    <?php if ($this->user->hasLogin() && isset($this->user->group) && $this->user->group == "administrator"): ?>
                <!-- 用户是管理员时的内容 -->
                <?php else: ?>
                <div class="comment-author-info">
                    <div class="w-full comment-form-author">
                        <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                    </div>	    
                    <div class="w-full comment-form-email">
                        <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>	
                    <div class="w-full comment-form-url">
                        <input type="url" name="url" id="url" class="text" placeholder="<?php _e('https://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="comment-submit">
                    <div class="submit-right flex gap-2">
                        <button type="submit" class="submit">
                            <sapn id="comment-submit"><?php _e('提交审核'); ?></sapn>
                        </button>
                    </div>
                </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    
</div>
<style>
    #cancel-comment-reply-link {
    display: inline !important;
}
</style>
<script>
    function showhidediv(id){var sbtitle=document.getElementById(id);if(sbtitle){if(sbtitle.style.display=='flex'){sbtitle.style.display='none';}else{sbtitle.style.display='flex';}}}
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>