<?php
/* 主题设置 */
require_once('function.php');
// 主题初始化
function themeInit($archive){
    // 判断是否是添加评论的操作
    // 为文章或页面、post操作，且包含参数`themeAction=comment`(自定义)
    if($archive->is('single') && $archive->request->isPost() && $archive->request->is('themeAction=comment')){
        // 为添加评论的操作时
        ajaxComment($archive);
    }
}
// 自定义字段
function themeFields($layout) {
    $article_type= new Typecho_Widget_Helper_Form_Element_Radio('article_type',array('0' => _t('文章'),'Whisper' => _t('微语')),'0',_t('文章类型'),_t("选择文章类型首页输出"));
    $layout->addItem($article_type);
}