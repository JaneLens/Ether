<?php
/**
 * Ether
 *
 * @package Ether
 * @author 林翊
 * @version 1.2
 * @link //amrx.me
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$sticky = $this->options->sticky; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
if($sticky && $this->is('index') || $this->is('front')){
    $sticky_cids = explode(',', strtr($sticky, ' ', ','));//分割文本 
    $sticky_html = "<span style='color:red'>置顶</span>"; //置顶标题的 html
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order('', "(case cid$order end)");
    if ($this->currentPage == 1) foreach($db->fetchAll($select1) as $sticky_post){
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
$uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?',$uid,'private');
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->currentPage, $this->parameter->pageSize));
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
}
$this->need('header.php');
?>

<main class="main-content container">
    <?php if ($this->options->Index_banner) : ?>
    <!-- 幻灯片 -->
    <section class="single-list">
        <?php
            $slides = [];
            $slides_text = $this->options->Index_banner; // 假设 Index_banner 存储了幻灯片数据
            if ($slides_text) {
                $slides_arr = explode("\r\n", $slides_text);
                if (count($slides_arr) > 0) {
                    for ($i = 0; $i < count($slides_arr); $i++) {
                        $slide_data = explode("||", $slides_arr[$i]);
                        $title = trim($slide_data[0]); // 幻灯片标题
                        $image_url = trim($slide_data[1]); // 幻灯片图片URL
                        $link_url = trim($slide_data[2]); // 幻灯片链接URL
                        $slides[] = array(
                            "title" => $title,
                            "image_url" => $image_url,
                            "link_url" => $link_url
                        );
                    }
                }
            }
        ?>
        <?php if (!empty($slides)): ?>
        
            <?php foreach ($slides as $slide): ?>
                <div class="single-item">
                    <div class="single-banlist">
                        <img src="<?php echo $slide['image_url']; ?>" width="100%" alt="<?php echo $slide['title']; ?>">
                        <h1>
                            <a href="<?php echo $slide['link_url']; ?>" target="_blank" rel="noopener noreferrer" >
                                <?php echo $slide['title']; ?>
                            </a>
                        </h1>
                        <span class="single_blur"></span>
                    </div>
                </div>
            <?php endforeach; ?>
            
        <?php endif; ?>
    </section>
    <?php endif; ?>
    <!-- 文章列表 -->
    <section class="index_list">
        <?php if ($this->have()): ?>
        <?php while($this->next()): ?>
        <article class="article-item">
            <div class="post_head">
                <div class="author">
                    <img width="35" height="35" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($this->author->mail) ?>" alt="<?php $this->author(); ?>" />
                    <div class="name_author">
                        <h3 alt="<?php $this->author(); ?>"><?php $this->author(); ?></h3>
                        <div class="flex items-center">
                            <span><?php echo human_time_diff($this->created); ?></span>
                            <?php if(time() - $this->created <= 259200): ?>
                             · <span>NEW</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <a href="<?php $this->permalink() ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#a8c2d2"><path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM12 7C11.4872 7 10.9925 7.07719 10.5269 7.21995C11.3954 7.61175 12 8.48527 12 9.5C12 10.8807 10.8807 12 9.5 12C8.48527 12 7.61175 11.3954 7.22057 10.5268C7.07719 10.9925 7 11.4872 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7Z"></path></svg>
                </a>
            </div>
            <div class="post_conter">
                <?php if($this->fields->article_type == "Whisper") { ?>
                    <!-- 微语样式 -->
                    <div class="blog_content">
                        <?php
                        // 获取文章内容
                        $content = $this->content;
                                
                        // 去除图片标签（<img>）
                        $contentWithoutImages = preg_replace('/<img[^>]+>/i', '', $content);
                                
                        // 去除所有 HTML 标签，只保留纯文字
                        $plainText = strip_tags($contentWithoutImages, '<p><a>');
                                
                        // 输出纯文字内容
                        echo $plainText;
                        ?>
                    </div>
                    
                    <?php
                        $content = $this->content;
                        $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
                            preg_match_all($pattern, $content, $matches);
                                        
                        $imageCount = count($matches[1]);
                        $maxImages = min($imageCount, 9);
                    ?>
                    
                    <!-- 图集 -->
                    <?php if($imageCount == 0):?>
                        <?php else:?>
                        <div class="postlist_album" num="<?php echo $imageCount;?>">
                            <?php
                                for ($i = 0; $i < $maxImages; $i++) {
                                    echo '<span data-fancybox="gallery'.$this->cid.'" class="postlist_gallery" href="'.$matches[1][$i].'"><img class="lazyload postlist_img" src="'.get_Lazyload().'" data-src="'.$matches[1][$i].'" alt="'.$this->title.'">';
                                    if ($imageCount > 8 && $i == 9) {
                                    echo '<span class="mask">+'.($imageCount - 9).'</span>';
                                    }
                                    echo '</span>';
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                    
                <?php } else {?>
                <!-- 默认样式 -->
                <h3>
                    <a href="<?php $this->permalink() ?>" alt="<?php $this->title() ?>"><?php $this->title() ?></a>
                </h3>
                <div class="excerpt" alt="<?php $this->title() ?>">
                    <?php $this->excerpt(140, '...'); ?>
                </div>
                <?php }?>
                <!-- 标签 -->
                <?php if ($this->have() && $this->tags): ?> <!-- 双重兼容性判断 -->
                  <div class="legacy-tags">
                    <?php $tags = $this->tags; ?> <!-- 旧版本标签数据存储方式 -->
                    <?php if (!empty($tags)): ?>
                      <?php foreach ($tags as $tag): ?> <!-- 使用数组遍历 -->
                        <a href="<?php echo $tag['permalink']; ?>" class="tag-link" alt="<?php echo htmlspecialchars($tag['name']); ?>">
                          # <?php echo htmlspecialchars($tag['name']); ?>
                        </a>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
                <!-- 底部信息 -->
                <div class="post_info_footer">
                    <?php $this->sticky(); ?>
                    <span><a href="<?php $this->permalink() ?>" alt="<?php get_post_view($this) ?>人阅读过<?php $this->title() ?>"><?php get_post_view($this) ?> 阅读</a></span>
                    <span><?php $this->commentsNum('0 评论', '1 条评论', '%d 条评论'); ?></span>
                </div>
            </div>
                
        </article>
        <?php endwhile; ?>
        <?php else: ?>暂无文章<?php endif; ?>
    </section>
    <div class="archive_next" style="padding: 30px 0;text-align: center" alt="更多文章">
        <?php $this->pageLink('查看更多','next'); ?>
    </div> 
</main>

<?php $this->need('footer.php'); ?>


            
