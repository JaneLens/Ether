<?php
function themeConfig($form)
{
    $Favicon = new Typecho_Widget_Helper_Form_Element_Textarea(
    'Favicon',
    NULL,
    NULL,
    '网站 Favicon 设置',
    '介绍：用于设置网站 Favicon，一个好的 Favicon 可以给用户一种很专业的观感 <br />
         格式：图片 URL地址 或 Base64 地址 <br />
         其他：免费转换 Favicon 网站 <a target="_blank" href="//tool.lu/favicon">tool.lu/favicon</a>'
  );
  $form->addInput($Favicon);

  $CustomFont = new Typecho_Widget_Helper_Form_Element_Text(
    'CustomFont',
    NULL,
    NULL,
    '自定义网站字体（非必填）',
    '介绍：用于修改全站字体，填写则使用引入的字体，不填写使用默认字体 <br>
         格式：字体URL链接（推荐使用woff格式的字体，网页专用字体格式） <br>
         注意：字体文件一般有几兆，建议使用cdn链接'
  );
  $form->addInput($CustomFont);

  
  $Index_banner = new Typecho_Widget_Helper_Form_Element_Textarea(
    'Index_banner',
    NULL,
    'Ether主题 || https://amrx.me/usr/uploads/2025/03/785358057.png || https://amrx.me/214',
    '自定义首页头部幻灯片图片',
    '介绍：自定义首页头部显示的图片地址<br>
    格式：名称 || 图片地址 || 链接地址 <br />
    注意：一行一个幻灯片信息(最少需要两个)'
  );
  $form->addInput($Index_banner);
    
  $AssetsURL = new Typecho_Widget_Helper_Form_Element_Text(
    'AssetsURL',
    NULL,
    NULL,
    '自定义静态资源CDN地址（非必填）',
    '介绍：自定义静态资源CDN地址，不填则走本地资源 <br />
     教程：<br />
     1. 将整个assets目录上传至你的CDN <br />
     2. 填写静态资源地址访问的前缀 <br />
     3. 例如：https://npm.elemecdn.com/typecho-latest'
  );
  $form->addInput($AssetsURL);
  
  $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL,NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔'));
    $form->addInput($sticky);
  
  $Footer_reward = new Typecho_Widget_Helper_Form_Element_Text(
    'Footer_reward',
    NULL,
    NULL,
    '微信二维码（非必填）',
    '介绍：自定义文章页赞助微信二维码图片地址'
  );
  $form->addInput($Footer_reward);
  
  $Friends = new Typecho_Widget_Helper_Form_Element_Textarea(
    'Friends',
    NULL,
    '林翊的博客 || https://amrx.me || https://amrx.me/usr/uploads/2025/03/3040485709.jpg || 星光洒满你眼底 温柔藏在我心里',
    '友情链接（非必填）',
    '介绍：用于填写友情链接 <br />
         注意：您需要先增加友链链接页面（新增独立页面-右侧模板选择友链），该项才会生效 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
         其他：一行一个，一行代表一个友链'
  );
  $form->addInput($Friends);
  
  $Footer = new Typecho_Widget_Helper_Form_Element_Textarea(
    'Footer',
    NULL,
    '<a href="https://amrx.me/feed/" target="_blank" rel="noopener noreferrer">RSS</a>
    <a href="https://amrx.me/sitemap.xml" target="_blank" rel="noopener noreferrer" style="margin-left: 15px">MAP</a>',
    '自定义底部栏右侧内容（非必填）',
    '介绍：用于修改全站底部右侧内容（wap端下方） <br>
         例如：&lt;a href="/"&gt;首页&lt;/a&gt; &lt;a href="/"&gt;关于&lt;/a&gt; <br>
         就是说使用代码就对了 配合着自定义CSS'
  );
  $form->addInput($Footer);

  
  $CustomCSS = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomCSS',
    NULL,
    NULL,
    '自定义CSS（非必填）',
    '介绍：请填写自定义CSS内容，填写时无需填写style标签。<br />
         其他：如果想修改主题色 或其它 都可以通过这个实现 <br />
         例如：:root { --text-color-3: #ff6800; }'
  );
  $form->addInput($CustomCSS);
  
  $CustomScript = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomScript',
    NULL,
    NULL,
    '自定义JS（非必填）',
    '介绍：请填写自定义JS内容，例如网站统计等，填写时无需填写script标签。'
  );
  $form->addInput($CustomScript);
  
  $CustomHeadEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomHeadEnd',
    NULL,
    NULL,
    '自定义增加&lt;head&gt;&lt;/head&gt;里内容（非必填）',
    '介绍：此处用于在&lt;head&gt;&lt;/head&gt;标签里增加自定义内容 <br />
         例如：可以填写引入第三方css、js等等'
  );
  $form->addInput($CustomHeadEnd);
  
  $CustomBodyEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
    'CustomBodyEnd',
    NULL,
    NULL,
    '自定义&lt;body&gt;&lt;/body&gt;末尾位置内容（非必填）',
    '介绍：此处用于填写在&lt;body&gt;&lt;/body&gt;标签末尾位置的内容 <br>
         例如：可以填写引入第三方js脚本等等'
  );
  $form->addInput($CustomBodyEnd);
  

}