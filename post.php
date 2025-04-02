<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main class="main-content container post">
    <?php if($this->fields->article_type == "Whisper") { ?>
    <!-- 微语 -->
    <header class="Whisper_main">
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
        <div class="entry__layout formatted-content post_container">
            <?php $this->content(); ?>
        </div>
    </header>
    <?php } else {?>
    <!-- 文章 -->
    <div class="post_title">
        <h1><?php $this->title() ?></h1>
        <p>
            <span><img width="25" height="25" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($this->author->mail) ?>" alt="<?php $this->author(); ?>" /></span>
            <span><?php echo human_time_diff($this->created); ?></span>
            <span><?php get_post_view($this) ?> 阅读</span>
        </p>
    </div>
    <div class="article_main">
        
        <div class="entry__layout formatted-content post_container">
            <?php $this->content(); ?>
        </div>
        <!-- 标签 -->
        <?php if ($this->have() && $this->tags): ?> <!-- 双重兼容性判断 -->
            <div class="legacy-tags">
                <?php $tags = $this->tags; ?> <!-- 旧版本标签数据存储方式 -->
                <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $tag): ?> <!-- 使用数组遍历 -->
                    <a href="<?php echo $tag['permalink']; ?>" class="tag-link">
                      # <?php echo htmlspecialchars($tag['name']); ?>
                    </a>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <!-- 版权 -->
        <div class="footer_author">
            <div class="post_author">
                <span>最后更于:<?php echo date('Y/m/d', $this->modified);?></span>
            </div>
            <?php if ($this->options->Footer_reward) : ?>
            <a class="post-reward_btn" href="javascript:void(0);" id="reward_btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M19.1458 8.99325L9.34705 14.6006L9.27753 14.6465C9.18483 14.6925 9.09213 14.7154 8.97625 14.7154C8.72133 14.7154 8.51275 14.5776 8.39688 14.3709L8.35053 14.2791L6.51971 10.329C6.49653 10.283 6.49653 10.2371 6.49653 10.1912C6.49653 10.0074 6.63558 9.86964 6.82098 9.86964C6.8905 9.86964 6.96003 9.8926 7.02955 9.93853L9.18483 11.4543C9.34705 11.5461 9.53245 11.615 9.74103 11.615C9.8569 11.615 9.97278 11.5921 10.0887 11.5461L18.3634 7.89746C16.9347 6.27313 14.6348 5.19995 12.0006 5.19995C7.57986 5.19995 4.10059 8.22235 4.10059 11.8C4.10059 13.1655 4.60024 14.4728 5.53227 15.5809C5.58056 15.6383 5.65277 15.7177 5.74666 15.8155C6.54199 16.6438 6.94301 17.7739 6.84765 18.9182L6.82289 19.2153L7.53841 18.7789C8.34812 18.2851 9.30697 18.095 10.2438 18.2426C10.4553 18.2759 10.6292 18.3015 10.7634 18.3192C11.1696 18.3728 11.5828 18.4 12.0006 18.4C16.4213 18.4 19.9006 15.3776 19.9006 11.8C19.9006 10.8036 19.6307 9.85022 19.1458 8.99325ZM6.19286 21.9423C6.00989 22.0566 5.79484 22.1087 5.57981 22.0908C5.02944 22.045 4.62045 21.5616 4.66631 21.0112L4.85456 18.7521C4.90224 18.1799 4.70173 17.6149 4.30407 17.2008C4.1819 17.0735 4.08111 16.9627 4.0017 16.8683C2.80622 15.447 2.10059 13.6951 2.10059 11.8C2.10059 7.0503 6.53297 3.19995 12.0006 3.19995C17.4682 3.19995 21.9006 7.0503 21.9006 11.8C21.9006 16.5496 17.4682 20.4 12.0006 20.4C11.4911 20.4 10.9906 20.3665 10.5018 20.302C10.3491 20.2819 10.1593 20.254 9.93256 20.2182C9.46412 20.1444 8.9847 20.2395 8.57985 20.4864L6.19286 21.9423Z"></path></svg>
                <span>赞助</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <!-- 样式结束 -->
    <?php }?>
    <!-- 相关文章 -->
    <?php $this->related(5)->to($relatedPosts); ?>
    <?php if ($relatedPosts->have()): ?>
    <div class="related-posts">
        <h3>相关文章</h3>
        <ul class="post_related_list">
            <?php while ($relatedPosts->next()): ?>
                <li>
                    <a href="<?php $relatedPosts->permalink(); ?>">
                        <?php $relatedPosts->title(); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php endif; ?>
    <!-- 评论 -->
    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>