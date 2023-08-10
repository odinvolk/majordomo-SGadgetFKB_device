<?php

$this->device_types['MobileFKB'] = array(
    'TITLE'=>'Gadget FKB',
    'PARENT_CLASS'=>'SDevices',
    'CLASS'=>'SGadgetFKB',
    'DESCRIPTION'=>'Gadget devices FKB',
    'PROPERTIES'=>array(
//        'namePAW'=>array('DESCRIPTION'=>'Имя устройства как на устройстве','_CONFIG_TYPE'=>'text'),
        'minMsgLevel'=>array('DESCRIPTION'=>'Уровень сообщений','_CONFIG_TYPE'=>'num','_CONFIG_HELP'=>'SdTher'),
        
        'mqttWriteToProperties'=>array('DESCRIPTION'=>'Включить чтение и запись доп. параметров через MQTT','_CONFIG_TYPE'=>'yesno','DATA_KEY'=>1),
        'mqttWriteToGeolocation'=>array('DESCRIPTION'=>'Включить чтение и запись параметров Geolocation через MQTT','_CONFIG_TYPE'=>'yesno','DATA_KEY'=>1),
        'getWriteToProperties'=>array('DESCRIPTION'=>'Включить чтение и запись параметров через GET','_CONFIG_TYPE'=>'yesno','DATA_KEY'=>1),
        'registerEvent_status'=>array('DESCRIPTION'=>'Включить трансляцию в registerEvent','_CONFIG_TYPE'=>'yesno','DATA_KEY'=>1),
        
        'batteryLevel'=>array('DESCRIPTION'=>LANG_DEVICES_BATTERY_LEVEL.'*','ONCHANGE'=>'batteryLevelUpdated'),
//        'batteryCharging'=>array('DESCRIPTION'=>'Состояние заряда батареи'),
        
        'isPlugged'=>array('DESCRIPTION'=>'На зарядке? (isPlugged)*'),
        
        'deviceID'=>array('DESCRIPTION'=>'Уникальный ID Fully (deviceID)*','_CONFIG_TYPE'=>'text','DATA_KEY'=>1),
        'passw'=>array('DESCRIPTION'=>'Пароль администратора Fully -=М=-','_CONFIG_TYPE'=>'text','DATA_KEY'=>1),
        'ip4'=>array('DESCRIPTION'=>'Ай-пи адрес Fully (ip4) прим. http://192.168.8.129:2323*','_CONFIG_TYPE'=>'text','DATA_KEY'=>1),

//        'wifiSignalLevel'=>array('DESCRIPTION'=>'Уровень сигнала WiFi (wifiSignalLevel)*'),
//        'startUrl'=>array('DESCRIPTION'=>'Стартовый Url-адрес (startUrl)*'),
        
        'timeToScreenOff'=>array('DESCRIPTION'=>'Время отключения экрана (timeToScreenOff)','ONCHANGE'=>'setFully','_CONFIG_TYPE'=>'num','DATA_KEY'=>1),
        'text-to-speech'=>array('DESCRIPTION'=>'Отправить текст в речь (text-to-speech)','ONCHANGE'=>'setFully','_CONFIG_TYPE'=>'text','DATA_KEY'=>1),
        'setVolume'=>array('DESCRIPTION'=>'Изменения громкости Fully','ONCHANGE'=>'setFully'),
        'screenBrightness'=>array('DESCRIPTION'=>'Яркость экрана (screenBrightness)','ONCHANGE'=>'setFully'),
        'kioskModeNew'=>array('DESCRIPTION'=>'Изменения режима киоска (kioskMode)','ONCHANGE'=>'setFully','_CONFIG_TYPE'=>'num','DATA_KEY'=>1),
        'customCMD'=>array('DESCRIPTION'=>'Команды дополнительные (customCMD)  прим. cmd=setStringSetting&key=screenBrightness&value=5','ONCHANGE'=>'setFully','_CONFIG_TYPE'=>'text','DATA_KEY'=>1),
        'currentPageNew'=>array('DESCRIPTION'=>'Ссылка на новую страницу Fully','ONCHANGE'=>'setFully','_CONFIG_TYPE'=>'text','DATA_KEY'=>1),
        'clearCache'=>array('DESCRIPTION'=>'Очистить кэш (clearCache)','ONCHANGE'=>'setFully','_CONFIG_TYPE'=>'num','DATA_KEY'=>1),
        
        'lastSayMessage'=>array('DESCRIPTION'=>'Трансляция сообщений от Алисы (lastSayMessage)','ONCHANGE'=>'onSwitch'),
        
        'screenOrientation'=>array('DESCRIPTION'=>'Ориентация экрана (screenOrientation)*','DATA_KEY'=>1),
        'motionDetectorStatus'=>array('DESCRIPTION'=>'Состояние датчика движения 2 - вкл. 3 - выкл. (motionDetectorStatus)*','DATA_KEY'=>1),
        'lastAppStart'=>array('DESCRIPTION'=>'Последнее приложение для запуска (last App Start)*'),
        'kioskMode'=>array('DESCRIPTION'=>'Состояние режима Киоска (kioskMode)*'),
        'isScreenOn'=>array('DESCRIPTION'=>'Включен ли экран? (isScreenOn)*'),
        'deviceManufacturer'=>array('DESCRIPTION'=>'Производитель устройства (manufacturer)*'),
        'currentPageUrl'=>array('DESCRIPTION'=>'URL текущей страницы (currentPageUrl)*'),
        'blocked'=>array('DESCRIPTION'=>'Отключить на время реакцию на движение -=М=-'),
//        'comm_other_openURL'=>array('DESCRIPTION'=>'Открыть URL в браузере [строка] http://ya.ru'),
//        'comm_other_play'=>array('DESCRIPTION'=>'Воспроизвести мелодию уведомления [логическое]'),
//        'comm_other_vibrate'=>array('DESCRIPTION'=>'Включить вибрацию, время в секундах [число] (1000 = 1сек)','_CONFIG_TYPE'=>'num'),
//        'comm_tts_request'=>array('DESCRIPTION'=>'Отправить текст в речь [строка]','_CONFIG_TYPE'=>'text'),
//        'comm_tts_stop'=>array('DESCRIPTION'=>'Остановить речь [логическое]','_CONFIG_TYPE'=>'num'),
//        'info_display_mode'=>array('DESCRIPTION'=>'Установка режима подсветки (auto manual)','_CONFIG_TYPE'=>'select','_CONFIG_OPTIONS'=>'auto=Автоматический,manual=Ручной'),
//        'info_display_status'=>array('DESCRIPTION'=>'Состояние дисплея Включен Выключен (true false)'),
        ),
    'METHODS'=>array(
         'eventFully'=>array('DESCRIPTION'=>'События Fully из MQTT -=F=- (DeviceInfoUpdated)','_CONFIG_SHOW'=>0),
         
         'getInfoFully'=>array('DESCRIPTION'=>'Запрос GET информации из Fully и запись в setProperty (getInfoFully) -=F=-','_CONFIG_SHOW'=>0),
         'getListFully'=>array('DESCRIPTION'=>'Запрос GET информации из Fully и запись в setProperty (listSettings) -=F=-','_CONFIG_SHOW'=>0),
         'InfoFully'=>array('DESCRIPTION'=>'Состояния Fully из MQTT -=F=- (DeviceInfoUpdated)','_CONFIG_SHOW'=>0),
         
         'setFully'=>array('DESCRIPTION'=>'Команды управления Fully через HTTP -=F=- (setFully)','_CONFIG_SHOW'=>1),
         'setFullyCmd'=>array('DESCRIPTION'=>'Установить параметры Fully -=F=-','_CONFIG_SHOW'=>1),

         'batteryLevelUpdated'=>array('DESCRIPTION'=>'Обновлен уровень заряда батареи (Battery level updated) -=М=-','_CONFIG_SHOW'=>1),
         'statusUpdated'=>array('DESCRIPTION'=>'Статус -=М=-','_CONFIG_SHOW'=>1),
         
         'onSwitch'=>array('DESCRIPTION'=>' -=М=-','_CONFIG_SHOW'=>1),
         'motionDetected'=>array('DESCRIPTION'=>'Детектор движения -=М=-','_CONFIG_SHOW'=>1),
         
//         'setUpdatedText'=>array('DESCRIPTION'=>'Change updated text -=М=-','_CONFIG_SHOW'=>0),
//         'logicAction'=>array('DESCRIPTION'=>'Logic Action -=М=-','_CONFIG_SHOW'=>1),
//         'keepAlive'=>array('DESCRIPTION'=>'Alive update -=М=-','_CONFIG_SHOW'=>1),
         
//         'switch'=>array('DESCRIPTION'=>'Пареключить','_CONFIG_SHOW'=>1),
//         'turnOn'=>array('DESCRIPTION'=>LANG_DEVICES_TURN_ON,'_CONFIG_SHOW'=>1),eventFully
//         'turnOff'=>array('DESCRIPTION'=>LANG_DEVICES_TURN_OFF,'_CONFIG_SHOW'=>1),
//         'voiceOn'=>array('DESCRIPTION'=>LANG_DEVICES_TURN_ON,'_CONFIG_SHOW'=>1),
//         'voiceOff'=>array('DESCRIPTION'=>LANG_DEVICES_TURN_OFF,'_CONFIG_SHOW'=>1),
    ),
);
