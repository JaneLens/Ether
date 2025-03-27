/* ====================================================
 *                  PJAX 初始化配置
 * ==================================================== */
var pjax = new Pjax({
    /**
     * 在页面进行 PJAX 时需要被替换的元素或容器
     * 一条一个 CSS 选择器，数组形式
     */
    selectors: [
        "title",                   // 页面标题
        "meta[name=description]",  // 页面描述meta标签
        "main"                     // 主内容区域
    ],
    cacheBust: false               // 禁用缓存清除
});

/* ====================================================
 *                  PJAX 事件处理
 * ==================================================== */

/**
 * PJAX 开始发送请求时触发
 * 显示加载提示并添加加载状态类
 */
$(document).on('pjax:send', function() {
    Qmsg.loading('加载中..');          // 显示加载提示
    $('.main_screen').addClass('pjax'); // 添加加载状态类
});

/**
 * PJAX 请求结束时触发
 * 重新初始化必要的组件
 */
$(document).on('pjax:end', function() {
    initRewardModal();  // 初始化赞助弹窗
    initArticleFold();  // 初始化文章折叠
    comments_next();    // 初始化评论加载更多
});

$(document).on('pjax:beforeSend', function() {
    // 清理旧绑定
    $('main').off('click', '.comment-reply-link, .cancel-comment-reply, #comment-submit');
});

/**
 * PJAX 完全完成后触发
 * 重新初始化所有组件并清除加载状态
 */
$(document).on('pjax:complete', function() {
    // 重新初始化所有必要组件
    initRewardModal();   // 赞助弹窗
    initCarousel();      // 轮播图
    initArticleFold();   // 文章折叠
    comments_next();     // 评论加载更多
    setupScrollLoad();   // 无限滚动加载
    initPage();      // 初始化评论代码美化
    
    /**
     * PJAX完成后的清理函数
     * 关闭所有提示并移除加载状态类
     */
    function cleanup() {
        Qmsg.closeAll();                 // 关闭所有提示
        $('.main_screen').removeClass('pjax'); // 移除加载状态类
    }
    
    // 延迟250ms执行清理，确保过渡效果完成
    setTimeout(cleanup, 250);
});