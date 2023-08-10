<?php
/**
 * 
 * Позволяет подключить системные сообщения SAY и посылает их в Fully
 * 
 * Подключать в локальный метод ThisComputer -> onSwitch код callMethod('MobileFKB01.onSwitch', array('NEW_VALUE'=>$params['NEW_VALUE']));
 * Или в модуле Общие настройки -> Обработчики -> After SAY (code) вставить код callMethod('MobileFKB01.onSwitch', array('VALUE'=>$ph,'level'=>$level));
 * 
 * After SAY - Код, вызываемый после отправки фразы на произношение. 
 * В данном коде можно использовать значение фразы ($ph) и уровень важности ($level).
 * 
 * @return mixed
 */
//if ($params['NEW_VALUE'] == $params['OLD_VALUE']) return;
//$prop = $params['PROPERTY'];
//$old = $params['OLD_VALUE'];
//$new = $params['NEW_VALUE'];
//$origot = $params['ORIGINAL_OBJECT_TITLE'];
$value = $params['VALUE']; // из MQTT

if (!isset($params['VALUE'])) { 
    $value = $params['NEW_VALUE'];// из ThisComputer->onSwitch
} else {
    $value = $params['VALUE'];
}

//global $voicemode;
// $voicemode='on';
// say('Сейчас '.timeNow(),2);
//say('Сейчас '.$value, $params['level']);

$passw = $this->getProperty('passw');
$ipterm = 'http://'.$this->getProperty('ip4').':'.$this->getProperty('port');
getURL($ipterm.'/?cmd=textToSpeech&text='.urlencode($value).'&locale=ru&password='.urlencode($passw));
getURL($ipterm.'/?cmd=setOverlayMessage&text='.urlencode($value).'&password='.urlencode($passw));
//$ot = $this->object_title;
//$date = date('Y/m/d H:i:s', time());
//DebMes('Принято сообщение - '.$value.' - с уровнем - '.$params['level'].' - для устройства - '.$ot.' - от - '.$date);
