# UMeng PHP SDK For Laravel 4.2.*

整合修改官方的示例，融合到L4中。

1.composer 安装

    composer require jason-xt/umeng-laravel @dev

2.在app.php 中添加ServiceProvider、Facades

    'JasonXt\UmengLaravel\UMengLaravelServiceProvider',
aliases:

    'Android'           => 'JasonXt\UmengLaravel\Facades\Android',
    'IOS'               => 'JasonXt\UmengLaravel\Facades\IOS',

3.配置文件

    php artisan config:publish jason-xt/umeng-laravel
 
 修改配置文件config/packages/jason-xt/umeng-laravel/config.php 填上你自己的Key Secret
 
4.示例

    $apns = ['alert' => ['title'=>'biaoti','body'=>'fujingdexuanjianghu'], 'badge' => 1, 'sound' => 'bingbong.aiff'];
    return IOS::customizedcast('S100000567',$apns);
    $body = ['ticker'=>'收到请告诉我','title'=>'通知标题','text'=>'通知文字描述','after_open'=>'go_app'];
    return Android::customizedcast('S100000597', $body);
 
 
