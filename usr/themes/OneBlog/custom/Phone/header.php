<!--移动端通用页头-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="dns-prefetch" href="https://at.alicdn.com">
<link rel="dns-prefetch" href="https://cravatar.cn">
<link rel="dns-prefetch" href="https://images.unsplash.com">
<?php if (!empty($this->options->dnsPrefetch)):
$domains = array_filter(array_map('trim', explode("\n", $this->options->dnsPrefetch)));
foreach ($domains as $domain): ?>
<link rel="dns-prefetch" href="<?php echo $domain; ?>">
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($this->options->Favicon)):?>
<link rel="shortcut icon" href="<?php echo $this->options->Favicon; ?>" type="image/x-icon" />
<?php endif; ?>
<title>
<?php if ($this->is('index')): ?>
<?php $this->options->title(); ?> - <?php echo !empty($this->options->slogan) ? $this->options->slogan() : '自豪地使用OneBlog主题'; ?>
<?php else: ?>
<?php $this->archiveTitle([
            'category' => _t('%s'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?>
<?php endif; ?>
</title>
<link href="<?php $this->options->themeUrl('/assets/sdk/animate.compat.css'); ?>" rel="stylesheet"><!--动画效果-->
<link href="//at.alicdn.com/t/c/font_3940454_u9s3lgsdiq.css" rel="stylesheet"/><!---图标库 iconfont.cn -->
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/sdk/swiper/swiper-bundle.min.css'); ?>" /><!--轮播图-->
<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/sdk/fancybox3/jquery.fancybox.min.css'); ?>" /><!--灯箱效果-->
<link href="<?php $this->options->themeUrl('/assets/css/Phone.css?v=3.5.2'); ?>" rel="stylesheet"/><!--主题移动端核心样式-->
<!--各页面OG信息及SEO优化-->
<?php $NoPostIMG = $this->options->NoPostIMG ? $this->options->NoPostIMG : Helper::options()->themeUrl . '/assets/default/bg.jpg';
$Webthumb = $this->options->Webthumb ? $this->options->Webthumb : Helper::options()->themeUrl . '/assets/default/oneblogx.webp';
$image_width = 1280; 
$image_height = 720; ?>
<!--通用声明-->
<meta property="og:image:width" content="<?= $image_width ?>">
<meta property="og:image:height" content="<?= $image_height ?>">
<!--首页-->
<?php if ($this->is('index')): ?>
<meta property="og:description" content="<?php echo $this->options->description(); ?>" />
<meta property="og:image" content="<?php echo $Webthumb; ?>" />
<meta property="og:image:type" content="image/webp">
<meta name="image" content="<?php echo $Webthumb; ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo $Webthumb; ?>">
<meta name="msapplication-TileImage" content="<?php echo $Webthumb; ?>">
<!--文章详情页-->
<?php elseif ($this->is('post')):
$thumb = showThumbnail($this);?>
<meta property="og:description" content="<?php echo $this->excerpt(80,'...'); ?>" />
<meta property="og:image" content="<?php echo $thumb; ?>" />
<meta name="image" content="<?php echo $thumb; ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo $thumb; ?>">
<meta name="msapplication-TileImage" content="<?php echo $thumb; ?>">
<!--其他页面-->
<?php else:?>
<meta property="og:image" content="<?php echo $Webthumb; ?>" />
<meta property="og:image:type" content="image/webp">
<meta name="image" content="<?php echo $Webthumb; ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo $Webthumb; ?>">
<meta name="msapplication-TileImage" content="<?php echo $Webthumb; ?>">
<?php endif;?>


<script>
var logoUrl = "<?php echo $this->options->logo ? $this->options->logo : Helper::options()->themeUrl . '/assets/default/logo.svg'; ?>";
var logoLightUrl = "<?php echo $this->options->logoWhite ? $this->options->logoWhite : Helper::options()->themeUrl . '/assets/default/logoWhite.svg'; ?>";
var bannerSwitch = "<?php echo $this->options->switch; ?>";
(function() {
    var currentTheme = document.cookie.replace(/(?:(?:^|.*;\s*)eyeProtectMode\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('protect-eye');
    }
})();
</script>
<?php $this->header();?>
</head>
<body>