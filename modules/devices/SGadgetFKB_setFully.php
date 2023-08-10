<?php
if ($params['NEW_VALUE'] == $params['OLD_VALUE']) return;

//$prop = $params['PROPERTY'];
//$oldv = $params['OLD_VALUE'];
//$new = $params['NEW_VALUE'];
//$origot = $params['ORIGINAL_OBJECT_TITLE'];
//http://192.168.10.26/objects/?object=MobileFKB01&op=m&m=getFully
$ot = $this->object_title;

$msl = 0;
$msl = $this->getProperty('minMsgLevel');
/*
//$desc = $this->description;
//$mqtt_st = $this->getProperty('mqtt_status');
//$telegram_st = $this->getProperty('telegram_status');
//$registerEvent_st = $this->getProperty('registerEvent_status');
//$write_to_properties = $this->getProperty('write_to_properties');
*/
$pass = $this->getProperty('passw');
$ipterm = 'http://'.$this->getProperty('ip4').':'.$this->getProperty('port');
//Логика для кастомных команд
switch ($params['PROPERTY']) {
    case 'customCMD': //say('Команда customCMD найдена', $msl);// timeToScreenOff timeToScreenOffV2
                              //$prop = $params['NEW_VALUE'];
                              DebMes('Принято '.$params['PROPERTY'].' сооб '.$ipterm.' щение - '.$params['NEW_VALUE'].' для '.$pass.' устройства '.$params['ORIGINAL_OBJECT_TITLE']);
                              $getInfo = getURL($ipterm.'/?cmd='.$params['NEW_VALUE'].'&password='.$pass.'&type=json', 0);
                              break;
    case 'screenBrightness': //say('Команда screenBrightness найдена', $msl);
                             $key = $params['PROPERTY'];
                             $value = $params['NEW_VALUE'];
                             if($value >= '1' && $value <= '255') {
                                $getInfo = getURL($ipterm.'/?cmd=setStringSetting&key='.$key.'&value='.$value.'&password='.$pass.'&type=json', 0); }
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
    case 'setVolume': //say('Команда setVolume найдена', $msl);
                             $value = $params['NEW_VALUE'];
                             $stream = '3';
                             $newVal = (int) strip_tags($value);
                               if($newVal > 100) $newVal = 100;
                               if($newVal < 0) $newVal = 0;
                               //if($value != $newVal) {
                             $getInfo = getURL($ipterm.'/?cmd=setAudioVolume&level='.$newVal.'&stream='.$stream.'&password='.$pass.'&type=json', 0);// }
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
    case 'text-to-speech': //say('Команда text-to-speech найдена', $msl);
                             $value = $params['NEW_VALUE'];
                             $newVal = strip_tags($value);
                             //if($value != $newVal) {
                                $getInfo = getURL($ipterm.'/?cmd=textToSpeech&text='.urlencode($newVal).'&locale=ru&password='.$pass.'&type=json', 0);//}
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
    case 'currentPageNew': //say('Команда currentPageNew найдена', $msl); // Логика для отправки перейти на страницу
                             $value = $params['NEW_VALUE'];
                             $newVal = strip_tags($value);
                             //if($value != $newVal) {
                                $getInfo = getURL($ipterm.'/?cmd=loadUrl&url='.$newVal.'&password='.$pass.'&type=json', 0); //}
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
    case 'timeToScreenOff': //say('Команда time To Screen Off найдена', $msl); // Логика для отправки временем работы экрана
                             $value = $params['NEW_VALUE'];
                             $newVal = (int) strip_tags($value);
                             //if($value != $newVal) {
                             $getInfo = getURL($ipterm.'/?cmd=setStringSetting&key=timeToScreenOffV2&value='.$newVal.'&password='.$pass.'&type=json', 0);
                             //}
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
    case 'kioskModeNew': //say('Команда kiosk Mode New найдена', $msl); // Логика для управлением режимом КИОСК
                             $value = $params['NEW_VALUE'];
                             if($value == '1') {
                                $getInfo = getURL($ipterm.'/?cmd=lockKiosk&password='.$pass.'&type=json', 0);
                             } else if($value == '0') {
                                $getInfo = getURL($ipterm.'/?cmd=unlockKiosk&password='.$pass.'&type=json', 0);
                             }
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
    case 'maintenanceMode': //say('Команда maintenance Mode найдена', $msl); // Логика для управлением Режимом технического обслуживания
                             $value = $params['NEW_VALUE'];
                             if($value == '1') {
                                $getInfo = getURL($ipterm.'/?cmd=enableLockedMode&password='.$pass.'&type=json', 0);
                             } else if($value == '0') {
                                $getInfo = getURL($ipterm.'/?cmd=disableLockedMode&password='.$pass.'&type=json', 0);
                             }
                                $info = json_decode($getInfo, true);
                             if($info['status'] == 'OK') { DebMes('Успешно - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']);
                             } else { DebMes('Ошибка - old_val-> '.$params['OLD_VALUE'].' ->new_val-> '.$params['NEW_VALUE'].' -> '.$params['ORIGINAL_OBJECT_TITLE']); return; }
                             break;
     default: say('Принята неизвесная команда - '.$params['PROPERTY'].' для устройства '.$ot, $msl);
                break;
}
// Обратная связь
$json = json_decode($getInfo, true);

$i = $json['statustext'];
$s = $json['status'];
//getURL($ipterm.'/?cmd=textToSpeech&text='.urlencode($i.' '.$s).'&locale=de&password='.urlencode($pass));
getURL($ipterm.'/?cmd=setOverlayMessage&text='.urlencode($i.' - '.$s).'&password='.urlencode($pass));

callMethod('MobileFKB01.getAdmin', array('statustext'=>$i, 'status'=>$s));
//DebMes('Принята команда - '.$i.' - '.$s.' для устройства '.$ot);
//say('Принята команда - '.$i.' для устройства '.$ot, $msl);
