<?php
$msl = 0;
$msl = $this->getProperty('minMsgLevel');//private_mode
/*
sayTo('Есть сообщение - '.$rezult.' - '.$params['VALUE'], $msl, $desc);  //На терминале установить в конце обработчика ?terminal=P11moon
sayReply('Есть - сообщение - '.$rezult.' - '.$params['VALUE'], $msl);
say('Есть - сообщение - '.$rezult.' - '.$params['VALUE'], $msl, 6);
sg('minMsgLevel','1');  //Уровень сообщений системы
if ($params['NEW_VALUE'] == $params['OLD_VALUE']) return;
*/
$state = json_decode($params['VALUE'], true);

if(!isset($state['deviceId'])) {
$res = array('status' => ' от', 'date' => date('Y/m/d H:i:s', time()));
say('Не понятно для кого сообщение - '.$state['deviceId'], $msl, 6);
DebMes('Не понятно для кого сообщение - '.$state['deviceId'].' - '.$params['VALUE'] .$res['status'].' - '.$res['date']);
} else {
$ot = $this->object_title;
$desc = $this->description;

switch ($state['event']) {
    case 'onMotion': //$this->callmethodSafe('motionDetected'); 
                     if($this->getProperty('private_mode') != 1) {
                         $this->callmethodSafe('motionDetected');
                     //say('Есть - сообщение - '.$rezult.' - '.$params['VALUE'], $msl);
                     }
                     //DebMes('Обнаружено движение '.$ot);
                     //sayTo('Есть сообщение - '.$rezult.' - '.$params['VALUE'], $msl, $desc);
                     //sayReply('Есть - сообщение - '.$rezult.' - '.$params['VALUE'], $msl);
                     //say('Есть - сообщение - '.$rezult.' - '.$params['VALUE'], $msl, 6);
                     //$command='Сколько время';
                     //callMethod('ThisComputer.commandReceived', array('command'=>$command));
                     break; 
    case 'onMovement': //sayTo('О движение устройства ' .$ot, $msl, $desc); // on Movement
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     break;
    case 'onBatteryLevelChanged': //$this->callMethodSafe('logicAction');
                     //$this->setProperty('batteryLevel',$state['level']);
                     if($state['level'] < 15  && (time() - registeredEventTime($desc.'/lowPower') > 5*60)){
                       say("Планшет '.$desc.' почти разряжен ! ", $msl);
                       registerEvent($desc.'/lowPower', array('level'=>$state['level']));
                     }
                     if($state['level'] > 99 && (time() - registeredEventTime($desc.'/FullCharge') > 20*60)){
                       say("Планшет '.$desc.' заряжен ! ", $msl);
                       registerEvent($desc.'/FullCharge', array('level'=>$state['level']));
                     }
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - '.$state['level'].'% -  от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - '.$state['level'].'% -  от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     //registerError($desc.'/Charge', 'Уровень заряда изменился. - '.$state['level'].'% - '.$ot);
                     registerEvent($desc.'/Charge', array('level'=>$state['level']));
                     //DebMes('Уровень заряда изменился - '.$state['level'].'% - '.$ot);
                     say('Уровень заряда '.$desc.' изменился - '.$state['level'].'%', $msl); 
                     break;
    case 'unplugged': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     //registerError('Отключена зарядка', 'Внешнее питание отключено');
                     //DebMes('Отключена зарядка ' .$ot);
                     say('Отключена зарядка ', $msl);
                     break;
    case 'pluggedAC': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     //DebMes('Подключена зарядка к розетке ' .$ot);
                     say('Подключена зарядка к розетке ', $msl); 
                     break;
    case 'pluggedUSB': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     //DebMes('Подключена зарядка к USB ' .$ot);
                     say('Подключена зарядка к USB ' .$ot, $msl); 
                     break;
    case 'powerOff': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'],100);
                     //DebMes('Подключена зарядка к розетке ' .$ot);
                     say('Внешнее питание отключено ', 0, $desc); 
                     break;
    case 'powerOn': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'],100);
                     //DebMes('Подключена зарядка к розетке ' .$ot);
                     say('Внешнее питание подключено ', 0); 
                     break;
    case 'screenOff': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'],100);
                     //DebMes('Подключена зарядка к розетке ' .$ot);
                     sayTo('Дисплей выключен ', 0, $desc); 
                     break;
    case 'screenOn': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'],100);
                     //DebMes('Подключена зарядка к розетке ' .$ot);
                     sayTo('Дисплей включен ', $msl, $desc); 
                     break;
    case 'volumeUp': say('Уровень звука увеличен ' .$desc, $msl); break;
    case 'volumeDown': say('Уровень звука уменьшен ' .$desc, $msl); break;
    case 'hideKeyboard': say('Клавиатура скрыта ', $msl); break;
    case 'showKeyboard': say('Клавиатура открыта ', $msl); break;
    case 'onScreensaverStart': say('Скринсейвер запущен ' .$ot, $msl); break;
    case 'onScreensaverStop': say('Скринсейвер остановлен ' .$ot, $msl); break;
    case 'mqttDisconnected': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     //say('Брокер эм-кйу-тэ-тэ Отключён ' .$ot, $msl);
                     break;
    case 'mqttConnected': //$this->callMethodSafe('logicAction');
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     //say('Брокер эм-кйу-тэ-тэ Подключён ' .$ot, $msl);
                     break;
    case 'internetReconnect': //say('Переподключение к интернету ' .$ot, $msl);
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     break;
    case 'internetDisconnect': //say('Нет связи с интернетом ' .$ot, $msl);
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     break;
    case 'onQrScanCancelled': say('Скан отменён ' .$ot, $msl); //onQrScanCancelled
                     $this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
                     DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
                     //say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
                     break;
     default: //say('Сообщение не распознано', 0);
              $this->result = array('status' => 'не распознано', 'date' => date('Y/m/d H:i:s', time()));
              DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
              say('Сообщение не распознано о - '.$state['event'].' от - '.$state['deviceId'].' - '.$this->result['status'].' - в - '.$this->result['date'], $msl);
              break;
}
/*
$passw = $this->getProperty('passw');
$ipterm = 'http://'.$this->getProperty('ip4').':'.$this->getProperty('port');

getURL($ipterm.'/?cmd=textToSpeech&text='.urlencode($i).'&locale=de&password='.urlencode($pass));
getURL($ipterm.'/?cmd=setOverlayMessage&text='.urlencode($i).'&password='.urlencode($pass));

$this->result = array('status' => 'пртнято', 'date' => date('Y/m/d H:i:s', time()));
DebMes('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date']);
say('Сообщение - '.$state['event'].' - от - '.$state['deviceId'].' - '.$this->result['status'].' - '.$this->result['date'], $msl);
*/
}