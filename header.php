<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit" />
    <meta name="format-detection" content="email=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
    <?php if ($this->options->Favicon()) : ?>
    <link rel="shortcut icon" href="<?php $this->options->Favicon() ?>" />
    <?php else : ?>
    <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text x=%22-0.125em%22 y=%22.9em%22 font-size=%2290%22>🌈</text></svg>" />
    <?php endif; ?>
    <title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php if ($this->is('single')) : ?>
      <meta name="keywords" content="<?php echo $this->fields->keywords ? $this->fields->keywords : htmlspecialchars($this->_keywords); ?>" />
      <meta name="description" content="<?php echo $this->fields->description ? $this->fields->description : htmlspecialchars($this->_description); ?>" />
      <?php $this->header('keywords=&description='); ?>
    <?php else : ?>
      <?php $this->header(); ?>
    <?php endif; ?>
    <!-- 通用 -->
    <link href="<?php _getAssets('Assets/Css/Style.css'); ?>" rel="stylesheet" />
    <?php $this->options->CustomHeadEnd() ?>
    <?php
        $fontUrl = $this->options->CustomFont ?? ''; // 使用空字符串作为默认值
        $fontFormat = '';
        
        if (strpos($fontUrl, 'woff2') !== false) {
            $fontFormat = 'woff2';
        } elseif (strpos($fontUrl, 'woff') !== false) {
            $fontFormat = 'woff';
        } elseif (strpos($fontUrl, 'ttf') !== false) {
            $fontFormat = 'truetype';
        } elseif (strpos($fontUrl, 'eot') !== false) {
            $fontFormat = 'embedded-opentype';
        } elseif (strpos($fontUrl, 'svg') !== false) {
            $fontFormat = 'svg';
        }
    ?>
    <style>
        @font-face {
            font-family: 'wodeziti';
            font-weight: 400;
            font-style: normal;
            font-display: swap;
            src: url('<?php echo $fontUrl ?>');
            <?php if ($fontFormat) : ?>src: url('<?php echo $fontUrl ?>') format('<?php echo $fontFormat ?>');
            <?php endif; ?>
        }
        body {
            <?php if ($fontUrl) : ?>
            font-family: 'wodeziti';
            font-weight: 400;
            <?php else : ?>
            font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
        <?php endif; ?>
      }
      <?php $this->options->CustomCSS() ?>
    
    </style>
</head>

<body>
    <div class="main_screen">
        <header class="header">
      <!-- 顶部导航栏 -->
        <nav class="navbar container">
            <button class="life_menu" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM16.5 7.5L14 14L7.5 16.5L10 10L16.5 7.5ZM12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"></path></svg>
            </button>
            <div class="navbar-brand">
                <h1 class="logo">
    				<a href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>" alt="<?php $this->options->title(); ?>">
    					<img class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($this->author->mail) ?>" alt="<?php $this->author(); ?>" />
    				</a>
    	        </h1>
            </div>
            <ol class="navbar-nav">
                <?php \Widget\Metas\Category\Rows::alloc()->listCategories('wrapClass=widget-list'); ?>
                <li class="page_list">
                    <span>专题</span>
                    <?php \Widget\Contents\Page\Rows::alloc()->listPages('wrapClass=widget-list'); ?>
                </li>
            </ol>
            <div class="menu_off"></div>
            <div class="navbar-actions">
                <!-- 返回顶部按钮 -->
                <button class="back-to-top" aria-label="返回顶部">
                    <svg class="icon" style="width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7550"><path d="M810.438503 379.664884l-71.187166-12.777183C737.426025 180.705882 542.117647 14.602496 532.991087 7.301248c-12.777184-10.951872-32.855615-10.951872-47.45811 0-9.12656 7.301248-204.434938 175.229947-206.26025 359.586453l-67.536542 10.951871c-18.253119 3.650624-31.030303 18.253119-31.030303 36.506239v189.832442c0 10.951872 5.475936 21.903743 12.777184 27.379679 7.301248 5.475936 18.253119 9.12656 29.204991 7.301248l135.073084-23.729055c40.156863 47.458111 93.090909 74.83779 149.675579 74.837789 56.58467 0 109.518717-25.554367 149.675579-74.837789l136.898396 23.729055c10.951872 1.825312 21.903743-1.825312 29.204991-7.301248 9.12656-7.301248 12.777184-16.427807 12.777184-27.379679V414.345811c3.650624-16.427807-9.12656-31.030303-25.554367-34.680927zM766.631016 564.02139l-114.994652-20.078431c-14.602496-1.825312-27.379679 3.650624-36.506239 14.602496-27.379679 40.156863-65.71123 62.060606-105.868093 62.060606-40.156863 0-76.663102-21.903743-105.868093-62.060606-7.301248-9.12656-18.253119-14.602496-29.204991-14.602496h-5.475936L255.543672 564.02139v-116.819964l69.361854-12.777184c18.253119-3.650624 31.030303-20.078431 31.030303-38.33155v-27.37968c0-118.645276 107.693405-237.290553 156.976827-284.748663 49.283422 47.458111 156.976827 166.103387 156.976827 284.748663v27.37968c-1.825312 18.253119 12.777184 34.680927 31.030303 38.33155l71.187166 12.777184v116.819964H766.631016zM620.606061 766.631016H401.568627c-20.078431 0-36.506239 16.427807-36.506238 36.506239v109.518716c0 14.602496 9.12656 29.204991 23.729055 34.680927 14.602496 5.475936 31.030303 1.825312 40.156863-9.126559l16.427807-18.25312 32.855615 80.313726c5.475936 14.602496 18.253119 23.729055 34.680927 23.729055 16.427807 0 27.379679-9.12656 34.680927-23.729055l32.855615-80.313726 16.427807 18.25312c10.951872 10.951872 25.554367 14.602496 40.156863 9.126559 14.602496-5.475936 23.729055-18.253119 23.729055-34.680927v-109.518716c-3.650624-20.078431-20.078431-36.506239-40.156862-36.506239z m-109.518717 122.2959L491.008913 839.643494H529.340463l-18.253119 49.283422z" p-id="7551"></path></svg>
                </button>
                <!-- 触发访问按钮 管理员不显示 -->
                <?php if (! $this->user->hasLogin()): ?>
                <button class="notice-trigger-btn">
                    <svg class="icon" style="width: 1.5em;height: 1.5em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5121"><path d="M682.666667 640c-12.8 0-21.333333-8.533333-21.333334-21.333333s8.533333-21.333333 21.333334-21.333334c72.533333 0 128 55.466667 128 128 0 25.6-17.066667 42.666667-42.666667 42.666667H256c-25.6 0-42.666667-17.066667-42.666667-42.666667 0-55.466667 34.133333-102.4 85.333334-119.466666V469.333333c0-89.6 55.466667-162.133333 128-196.266666V256c0-46.933333 38.4-85.333333 85.333333-85.333333s85.333333 38.4 85.333333 85.333333v17.066667c76.8 34.133333 128 106.666667 128 196.266666v64c0 12.8-8.533333 21.333333-21.333333 21.333334s-21.333333-8.533333-21.333333-21.333334V469.333333c0-93.866667-76.8-170.666667-170.666667-170.666666s-170.666667 76.8-170.666667 170.666666v170.666667c-46.933333 0-85.333333 38.4-85.333333 85.333333h512c0-46.933333-38.4-85.333333-85.333333-85.333333z m-213.333334-379.733333c12.8-4.266667 29.866667-4.266667 42.666667-4.266667s29.866667 0 42.666667 4.266667V256c0-25.6-17.066667-42.666667-42.666667-42.666667s-42.666667 17.066667-42.666667 46.933334c0-4.266667 0 0 0 0zM618.666667 853.333333h-213.333334c-12.8 0-21.333333-8.533333-21.333333-21.333333s8.533333-21.333333 21.333333-21.333333h213.333334c12.8 0 21.333333 8.533333 21.333333 21.333333s-8.533333 21.333333-21.333333 21.333333z" p-id="5122"></path></svg>
                </button>
                <?php endif; ?>
            </div>
        </nav>
    </header>