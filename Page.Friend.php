<?php
/**
 * 友链
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<main class="main-content container page">
    <?php
          $friends = [];
          $friends_text = $this->options->Friends;
          if ($friends_text) {
            $friends_arr = explode("\r\n", $friends_text);
            if (count($friends_arr) > 0) {
              for ($i = 0; $i < count($friends_arr); $i++) {
                $name = explode("||", $friends_arr[$i])[0];
                $url = explode("||", $friends_arr[$i])[1];
                $avatar = explode("||", $friends_arr[$i])[2];
                $desc = explode("||", $friends_arr[$i])[3];
                $friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
              };
            }
          }
    ?>
    
    <?php if (sizeof($friends) > 0) : ?>

    <div class="links_part_grid">
        <?php foreach ($friends as $item) : ?>
        <a href="<?php echo $item['url']; ?>" class="links_grid_item" target="_blank" rel="noopener noreferrer" >
            <img class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>" alt="<?php echo $item['name']; ?>" />
            <span class="links_author"><?php echo $item['name']; ?></span>
            <p class="links_description"><?php echo $item['desc']; ?></p>
        </a>
        <?php endforeach; ?>
    </div>
    <?php else:?>
    <div class="no_links">
        这人好可怜 连个好友都没 
    </div>
    <?php endif; ?>

    <!-- 评论 -->
    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>