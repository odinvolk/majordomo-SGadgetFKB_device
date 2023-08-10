<?php
$cmd = $params['cmd'];
$origot = $params['ORIGINAL_OBJECT_TITLE'];
/*
*http://192.168.10.26/objects/?object=MobileFKB01&op=m&m=setFullyCmd
*http://192.168.10.26/objects/?object=MobileFKB01&op=m&m=setFullyCmd&cmd=screenOff
*
*callmethodSafe('MobileFKB01.setFullyCmd',array('cmd'=>'setBooleanSetting', 'key'=>'kioskMode', 'value'=>'true',));
*callmethodSafe('MobileFKB01.setFullyCmd',array('cmd'=>'setStringSetting', 'key'=>'screenBrightness', 'value'=>'150',));
*    callMethod('MobileFKB01.setFullyCmd',array('cmd'=>'setStringSetting', 'key'=>'screenBrightness', 'value'=>'50',));
*            cm('MobileFKB01.setFullyCmd',array('cmd'=>'setStringSetting', 'key'=>'screenBrightness', 'value'=>'10',));
*/
$ot = $this->object_title;

$msl = 0;
$msl = $this->getProperty('minMsgLevel');
/*
$desc = $this->description;
$mqtt_st = $this->getProperty('mqtt_status');
$telegram_st = $this->getProperty('telegram_status');
$registerEvent_st = $this->getProperty('registerEvent_status');
*/
$pass = $this->getProperty('passw');
$ipterm = 'http://'.$this->getProperty('ip4').':'.$this->getProperty('port');

switch ($cmd) {
    case 'deviceInfo': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'setBooleanSetting': //say('Параметр set Boolean Setting найден', $msl);
                              //$cmd = $params['cmd'];
                              $key = $params['key'];
                              $value = $params['value']; // true false
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&key='.$key.'&value='.$value.'&password='.$pass.'&type=json', 0);
                              break;
    case 'setStringSetting': //say('Параметр set String Setting найден', $msl);
                              //$cmd = $params['cmd'];
                              $key = $params['key'];
                              $value = $params['value'];
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&key='.$key.'&value='.$value.'&password='.$pass.'&type=json', 0);
                              break;
    case 'textToSpeech': //say('Параметр text To Speech найден',0);
                         $text = $params['text'];      //  текст [text]
                         $locale = $params['locale'];  //  ru_RU de en_GB fr [locale]
                         $engine = $params['engine'];  //  движок [engine]
                         $queue = $params['queue'];    //  в очередь [0|1] ver. 1.38+
                         $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&text='.urlencode($text).'&locale='.$locale.'&password='.$pass.'&type=json', 0);
                         break;
    case 'stopTextToSpeech': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break; // ver. 1.38+
    case 'setOverlayMessage': //say('Параметр set Overlay Message найден', 0);
                              $text = $params['text'];
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&text='.urlencode($text).'&password='.$pass.'&type=json', 0);
                              break;
    case 'setAudioVolume': //say('Параметр set Audio Volume найден', 0);
                           $level = 50;  //установим громкость 50 по умолчанию
                           $stream = 3;  //установим канал 3 по умолчанию
                           if($params['level']) $level = $params['level'];
                           if($params['stream']) $stream = $params['stream'];
                           //$level = $params['level'];   //  level=[0-100] Уровень громкости
                           //$stream = $params['stream']; //  stream=[0-6 и 8-10] Канал
                           //stream: 0–Voice Call, 1–System, 2–Ring, 3–Music, 4–Alarm, 5–Notification, 6–Bluetooth, 8–DTMF, 9–TTS, 10–Accessibility
                           $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&level='.$level.'&stream='.$stream.'&password='.$pass.'&type=json');
                           break;
    case 'playSound': //say('Параметр play Sound найден', 0);
                           $url = $params['url'];         //  [url] https://youtu.be/uJMFUJ1L4Tw
                           $stream = $params['stream'];   //  stream=[1-6 и 10] Канал
                           $loop = $params['loop'];       //  [0|1] [true|false]
                           $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&url='.$url.'&stream='.$stream.'&loop='.$loop.'&password='.$pass.'&type=json');
                           break;
//http://192.168.10.26/objects/?script=getFully&cmd=playSound&url=http://192.168.10.26/cms/sounds/10h.mp3&stream=3&loop=false
    case 'stopSound': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json');
                           break;
    case 'playVideo': //say('Параметр play Video найден', 0);
                           $url = $params['url'];                           //  [url] https://youtu.be/uJMFUJ1L4Tw   xxx.flv
                           $loop = $params['loop'];                         //  [0|1]
                           $showControls = $params['showControls'];         //  [0|1]
                           $exitOnTouch = $params['exitOnTouch'];           //  [0-1]
                           $exitOnCompletion = $params['exitOnCompletion']; //  [0-1]
                           $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&url='.$url.'&loop='.$loop.'&showControls='.$showControls.'&exitOnTouch='.$exitOnTouch.'&exitOnCompletion='.$exitOnCompletion.'&password='.$pass.'&type=json');
                           break;
//http://192.168.10.26/objects/?script=getFully&cmd=playVideo&url=http://192.168.10.26/cms/sounds/xxx.flv&loop=0&showControls=0&exitOnTouch=0&exitOnCompletion=0
    case 'stopVideo': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break; // ver. 1.42+
    case 'focusTab': say('Параметр focus Tab найден', 0);
                              $tab = $params['tab'];
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&tab='.$tab.'&password='.$pass.'&type=json'); break;
//http://192.168.10.26/objects/?script=getFully&cmd=focusTab&tab=[index]
    case 'closeTab': say('Параметр close Tab найден', 0);
                              $tab = $params['tab'];
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&tab='.$tab.'&password='.$pass.'&type=json'); break;
//http://192.168.10.26/objects/?script=getFully&cmd=closeTab&tab=[index]
    case 'startApplication': say('Параметр start Application найден', 0);
                              $package = $params['package'];
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&package='.$package.'&password='.$pass.'&type=json'); break;
//http://192.168.10.26/objects/?script=getFully&cmd=startApplication&package=[pkg]
    case 'loadApkFile': say('Параметр load Apk File найден', 0);
                              $url = $params['url']; // [url] https://youtu.be/uJMFUJ1L4Tw
                              $forceInstall = $params['forceInstall']; // [true|false]
                              $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&url='.$url.'&forceInstall='.$forceInstall.'&password='.$pass.'&type=json');
                              break;
//http://192.168.10.26/objects/?script=getFully&cmd=loadApkFile&url=[url]&forceInstall=true
    case 'loadUrl': //say('Параметр load Url найден', 0);
                           $url = $params['url'];            //  [url] http://192.168.10.26/3rdparty/kalcaddle/
                             //$tab = 0;                     //  [0..n]  установим по умолчанию
                             //$newtab = false;              //  [true|false]  установим по умолчанию
                             //$focus = false;               //  [0|1] [true|false]  установим по умолчанию
                             //if($params['tab']) $tab = $params['tab'];
                             //if($params['newtab']) $newtab = $params['newtab'];
                             //if($params['focus']) $focus = $params['focus'];
                           $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&url='.urlencode($url).'&password='.$pass.'&type=json'); break;
//http://192.168.10.26/objects/?script=getFully&cmd=loadUrl&url=https://www.ab-log.ru/forum/viewtopic.php?f=1&t=1328&start=1880
//http://192.168.10.26/objects/?script=getFully&cmd=loadUrl&url=http://192.168.10.26/3rdparty/kalcaddle/
//http://192.168.10.26/objects/?script=getFully&cmd=loadUrl&url=[url]&tab=[0..n]&focus=[true|false]
//http://192.168.10.26/objects/?script=getFully&cmd=loadUrl&url=[url]&newtab=[true|false]&focus=[true|false]
    case 'screenOn': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); say($cmd, 0); break;
//http://192.168.10.26/objects/?script=getFully&cmd=screenOn
//http://192.168.10.26/objects/?object=MobileFKB01&op=m&m=getFully&cmd=screenOff
    case 'screenOff': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'forceSleep': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'triggerMotion': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'loadStartUrl': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'refreshTab': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;  //   (ver. 1.45+)
    case 'clearCache': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'clearWebstorage': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'clearCookies': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;  //   (ver. 1.28+)
    case 'startScreensaver': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'stopScreensaver': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'startDaydream': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'stopDaydream': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'lockKiosk': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'unlockKiosk': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'toForeground': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'toBackground': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'restartApp': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'exitApp': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'popFragment': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'enableLockedMode': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break; // Maintenance
    case 'disableLockedMode': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'shutdownDevice': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break; //root
    case 'rebootDevice': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break; //root
    case 'loadStatsCSV': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
    case 'getScreenshot': $getScreen = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass); break;
    case 'getCamshot': $getCam = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass); break;
    case 'listSettings': $getInfo = getURL($ipterm.'/?cmd='.$cmd.'&password='.$pass.'&type=json'); break;
     default: say('Принята неизвесная команда - '.$params['PROPERTY'].' для устройства '.$ot, $msl);
                break;
}

// Обратная связь
$json = json_decode($getInfo, true);

$i = $json['statustext'];
$s = $json['status'];
getURL($ipterm.'/?cmd=textToSpeech&text='.urlencode($i.' '.$s).'&locale=en_GB&password='.urlencode($pass));
getURL($ipterm.'/?cmd=setOverlayMessage&text='.urlencode($i.' - '.$s).'&password='.urlencode($pass));

//callMethod('MobileFKB01.getAdmin',array('statustext'=>$i, 'status'=>$s));
callMethod('MobileFKB01.getAdmin', array('status'=>$json['status']));

if($json['status'] == 'OK') { DebMes('Успешно - old -> '.$params['OLD_VALUE'].' ->new-> '.$params['NEW_VALUE'].' -> '.$origot);
    } else { DebMes('Ошибка - old -> '.$params['OLD_VALUE'].' -> new -> '.$params['NEW_VALUE'].' -> '.$origot); return; }
//DebMes('Принята команда - '.$i.' - '.$s.' для устройства '.$ot);
//say('Принята команда - '.$i.' для устройства '.$ot, $msl);