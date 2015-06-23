<?php
/**
 * Created by PhpStorm.
 * User: xutao
 * Date: 15/6/16
 * Time: 上午9:37
 */
namespace JasonXt\UmengLaravel;

use JasonXt\UmengLaravel\Android\AndroidBroadcast;
use JasonXt\UmengLaravel\Android\AndroidCustomizedcast;
use JasonXt\UmengLaravel\Android\AndroidUnicast;
use JasonXt\UmengLaravel\Android\AndroidGroupcast;
use JasonXt\UmengLaravel\Android\AndroidFilecast;

use JasonXt\UmengLaravel\IOS\IOSBroadcast;
use JasonXt\UmengLaravel\IOS\IOSCustomizedcast;
use JasonXt\UmengLaravel\IOS\IOSUnicast;
use JasonXt\UmengLaravel\IOS\IOSGroupcast;
use JasonXt\UmengLaravel\IOS\IOSFilecast;

use JasonXt\UmengLaravel\Exception\Exception;

class Pusher
{

    protected $appkey = NULL;
    protected $appMasterSecret = NULL;
    protected $timestamp = NULL;
    protected $validation_token = NULL;

    public function __construct($key, $secret)
    {
        $this->appkey = $key;
        $this->appMasterSecret = $secret;
        $this->timestamp = strval(time());
    }

    public function sendAndroidUnicast($device_tokens = '', $body = [], $custom = [], $production = true)
    {
        try {
            $unicast = new AndroidUnicast();
            $unicast->setAppMasterSecret($this->appMasterSecret);
            $unicast->setPredefinedKeyValue("appkey", $this->appkey);
            $unicast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set your device tokens here
            $unicast->setPredefinedKeyValue("device_tokens", $device_tokens);

//            $unicast->setPredefinedKeyValue("ticker", "Android unicast ticker");
//            $unicast->setPredefinedKeyValue("title", "Android unicast title");
//            $unicast->setPredefinedKeyValue("text", "Android unicast text");
//            $unicast->setPredefinedKeyValue("after_open", "go_app");
            foreach($body as $key =>$val){
                $unicast->setPredefinedKeyValue($key,$val);
            }
            // Set 'production_mode' to 'false' if it's a test device.
            // For how to register a test device, please see the developer doc.
            $unicast->setPredefinedKeyValue("production_mode", $production);
            // Set extra fields
            foreach ($custom as $key => $val) {
                $unicast->setExtraField($key, $val);
            }
            return $unicast->send();
        } catch (Exception $e) {
            return $e->getCode();
        }
    }


    /** customizedcast(通过开发者自有的alias进行推送)
     * @param string $alias
     * @param string $alias_type
     * @param array $body
     * @param bool $production
     * @return int|mixed
     * @throws Android\Exception
     */
    public function sendAndroidCustomizedcast($alias = '', $alias_type ='', $body = [],$production = true)
    {
        try {
            $customizedcast = new AndroidCustomizedcast();
            $customizedcast->setAppMasterSecret($this->appMasterSecret);
            $customizedcast->setPredefinedKeyValue("appkey", $this->appkey);
            $customizedcast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set your alias here, and use comma to split them if there are multiple alias.
            // And if you have many alias, you can also upload a file containing these alias, then
            // use file_id to send customized notification.
            $customizedcast->setPredefinedKeyValue("alias",$alias );
            // Set your alias_type here
            $customizedcast->setPredefinedKeyValue("alias_type", $alias_type);
            foreach($body as $key =>$val){
                $customizedcast->setPredefinedKeyValue($key,$val);
            }
            $customizedcast->setPredefinedKeyValue("production_mode", $production);
            return $customizedcast->send();
        } catch (Exception $e) {
            return $e->getCode();
        }
    }

    /**  发送iOS 单播消息
     * @param string $device_tokens ","分割
     * @param array $aps ['alert'=>'','badge'=>0,'sound'=>'chime','content-available'=>'']
     * @param bool $production
     * @return int|mixed
     */
    public function sendIOSUnicast($device_tokens = '', $aps = [], $custom = [], $production = true)
    {
        try {
            $unicast = new IOSUnicast();
            $unicast->setAppMasterSecret($this->appMasterSecret);
            $unicast->setPredefinedKeyValue("appkey", $this->appkey);
            $unicast->setPredefinedKeyValue("timestamp", $this->timestamp);
            $unicast->setPredefinedKeyValue("device_tokens", $device_tokens);
            foreach ($aps as $key => $val) {
                $unicast->setPredefinedKeyValue($key, $val);
            }
            // Set 'production_mode' to 'true' if your app is under production mode
            $unicast->setPredefinedKeyValue("production_mode", $production);
            // Set customized fields
            foreach ($custom as $key => $val) {
                $unicast->setCustomizedField($key, $val);
            }
            return $unicast->send();
        } catch (Exception $e) {
            return $e->getCode();
        }
    }

    /** customizedcast(通过开发者自有的alias进行推送)
     * @param string $alias
     * @param string $alias_type
     * @param array $aps
     * @param bool $production
     * @return int|mixed
     */
    public function sendIOSCustomizedcast($alias = '', $alias_type = '', $aps = [], $production = true)
    {
        try {
            $customizedcast = new IOSCustomizedcast();
            $customizedcast->setAppMasterSecret($this->appMasterSecret);
            $customizedcast->setPredefinedKeyValue("appkey", $this->appkey);
            $customizedcast->setPredefinedKeyValue("timestamp", $this->timestamp);
            // Set your alias here, and use comma to split them if there are multiple alias.
            // And if you have many alias, you can also upload a file containing these alias, then
            // use file_id to send customized notification.
            $customizedcast->setPredefinedKeyValue("alias", $alias);
            // Set your alias_type here
            $customizedcast->setPredefinedKeyValue("alias_type", $alias_type);
            foreach ($aps as $key => $val) {
                $customizedcast->setPredefinedKeyValue($key, $val);
            }
            $customizedcast->setPredefinedKeyValue("production_mode", $production);
            return $customizedcast->send();
        } catch (Exception $e) {
            return $e->getCode();
        }
    }
}