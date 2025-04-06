/* ====================================================
 *                  PJAX 初始化配置
 * ==================================================== */

/**
 * 初始化Pjax实例，配置页面无刷新加载
 * @type {Pjax}
 */
var pjax = new Pjax({
    /**
     * 指定PJAX需要替换的页面元素
     * 数组形式，每个元素是一个CSS选择器
     */
    selectors: [
        "title",                   // 页面标题（必选）
        "meta[name=description]",  // SEO描述meta标签
        "main"                     // 主内容容器
    ],
    /**
     * 是否在URL后添加随机参数避免缓存
     * @type {boolean}
     */
    cacheBust: false               // 禁用缓存清除（推荐）
});

/* ====================================================
 *                  PJAX 事件处理
 * ==================================================== */

/**
 * PJAX请求开始事件处理
 * 在页面开始加载时显示加载状态
 */
$(document).on('pjax:send', function() {
    // 显示加载中的提示信息
    Qmsg.loading('加载中..');
    
    // 给主屏幕添加加载状态类（可用于显示加载动画）
    $('.main_screen').addClass('pjax');
    
    // 这里可以添加其他需要在加载前执行的操作
});

/**
 * PJAX 请求结束时触发
 * 重新初始化必要的组件
 */
$(document).on('pjax:end', function() {
    // 重新设置滚动加载功能
    setupScrollLoad();
    // 重新初始化点赞功能
    initLikeFunction();
});

// pjax开始时的回调
$(document).on('pjax:start', function () {
    // 移除滚动和触摸移动事件监听
    $(window).off('scroll touchmove');
    // 移除加载更多按钮的点击事件监听
    $('.main-content').off('click', '.archive_next .next');
    // 移除点赞事件监听
    $(document).off('click', '.post_like');
});

/**
 * PJAX请求完成事件处理
 * 在页面加载完成后初始化组件和功能
 */
$(document).on('pjax:complete', function() {
    /* ----------------------------
     * 组件重新初始化部分
     * -------------------------- */
    
    // 1. 初始化模态框相关功能
    initRewardModal();   // 赞助弹窗功能
    
    // 2. 初始化页面交互组件
    initCarousel();      // 轮播图组件
    initArticleFold();   // 文章折叠功能
    
    // 3. 评论相关功能
    comments_next();     // 评论加载更多功能
    
    // 4. 移除旧的滚动事件监听，避免重复绑定
    $(window).off('scroll touchmove');
    
    // 5. 重新绑定滚动加载功能
    setupScrollLoad();   // 无限滚动加载
    
    // 6. 初始化代码高亮和模态框
    initPage();         // 代码显示功能
    
    // 7. 表单提交功能
    $('.submit').off('click');  // 先解绑旧事件
    initCommentSubmit();        // 评论提交功能
    
    // 8. 移除点赞事件监听
    $(document).off('click', '.post_like');
    
    // 9. 互动功能
    initLikeFunction();  // 点赞功能
    
    /* ----------------------------
     * 清理和状态恢复部分
     * -------------------------- */
    
    /**
     * 页面加载完成后的清理函数
     */
    function cleanup() {
        // 关闭所有提示信息
        Qmsg.closeAll();
        
        // 移除加载状态类
        $('.main_screen').removeClass('pjax');
        
        // 这里可以添加其他清理操作
    }
    
    // 延迟执行清理，确保过渡动画完成（250ms是常见动画时长）
    setTimeout(cleanup, 250);
    
    // 这里可以添加其他需要在加载完成后执行的操作
});

/* ====================================================
 *                  注意事项
 * ==================================================== */

/**
 * 使用PJAX时需要注意：
 * 1. 所有需要在页面加载后执行的JS都需要在pjax:complete中重新初始化
 * 2. 事件绑定前需要先解绑，避免重复绑定
 * 3. 对于第三方插件，可能需要特殊处理（如轮播图需要先销毁再初始化）
 * 4. 保持组件初始化的顺序合理（如先初始化DOM再绑定事件）
 */