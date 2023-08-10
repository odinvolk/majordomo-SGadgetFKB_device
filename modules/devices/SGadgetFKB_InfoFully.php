<?php
//$this->result = array('status' => 'ok', 'timestamp' => time());

//$ot = $this->object_title;
//$desc = $this->description;
//$record_switch=$this->getProperty('record_switch'); //вкл/выкл запись на камере
//$linked_room=$this->getProperty('linkedRoom');
//$status = $this->getProperty('status');
//$mqtt_st = $this->getProperty('mqtt_status');
//$telegram_st = $this->getProperty('telegram_status');
//$registerEvent_st = $this->getProperty('registerEvent_status');
$mqtt_write_to_prop = $this->getProperty('mqttWriteToProperties');
$get_write_to_prop = $this->getProperty('getWriteToProperties');
$mqtt_write_to_geoloc = $this->getProperty('mqttWriteToGeolocation');
//
//if ($params['NEW_VALUE'] == $params['OLD_VALUE']) return;
$message = $params['VALUE']; // Принимаем данные
//$this->setProperty('message', $message); // Записываем сырые данные в свойство
$state = json_decode($message, true); // Декодируем в массив

//---------------------- Записываем данные в свойства
$this->setProperty('batteryLevel', $state['batteryLevel']);
$this->setProperty('isPlugged', $state['isPlugged']);
$this->setProperty('ssid', $state['SSID']);
$this->setProperty('ip4', $state['ip4']);
$this->setProperty('screenOrientation', $state['screenOrientation']);
$this->setProperty('screenBrightness', $state['screenBrightness']);
$this->setProperty('screenLocked', $state['screenLocked']);
$this->setProperty('isScreenOn', $state['screenOn']);
$this->setProperty('motionDetectorStatus', $state['motionDetectorStatus']);
$this->setProperty('internalStorageFreeSpace', $state['internalStorageFreeSpace']);
$this->setProperty('internalStorageTotalSpace', $state['internalStorageTotalSpace']);
$this->setProperty('ramFreeMemory', $state['ramFreeMemory']);
$this->setProperty('ramTotalMemory', $state['ramTotalMemory']);
$this->setProperty('appFreeMemory', $state['appFreeMemory']);
$this->setProperty('appTotalMemory', $state['appTotalMemory']);
$this->setProperty('appStartTime', $state['appStartTime']);
$this->setProperty('kioskMode', $state['kioskMode']);
$this->setProperty('currentPageUrl', $state['currentPageUrl']);

if ($mqtt_write_to_geoloc)
{
$this->setProperty('altitude', $state['altitude']);
$this->setProperty('longitude', $state['longitude']);
$this->setProperty('latitude', $state['latitude']);
}

if ($mqtt_write_to_prop)
{
//---------------------------------------------------- Записываем доп. данные в свойства
//$this->setProperty('v',$ver);   // sg($ot.'.v',$ver);
//$this->setProperty('alarm',intval($alarm));
//$this->setProperty('time',date('H:i:s d-m-Y', $time));
$this->setProperty('deviceId', $state['deviceId']);
$this->setProperty('mac', $state['Mac']);
$this->setProperty('ip6', $state['ip6']);
$this->setProperty('host', $state['host']);
$this->setProperty('foreground', $state['foreground']);
$this->setProperty('locale', $state['locale']);
$this->setProperty('serial', $state['serial']);
$this->setProperty('version', $state['version']);
$this->setProperty('versionCode', $state['versionCode']);
$this->setProperty('build', $state['build']);
$this->setProperty('model', $state['model']);
$this->setProperty('deviceManufacturer', $state['manufacturer']);
$this->setProperty('androidVersion', $state['androidVersion']);
$this->setProperty('SDK', $state['SDK']);
$this->setProperty('webviewUA', $state['webviewUA']);
$this->setProperty('isDeviceOwner', $state['isDeviceOwner']);
$this->setProperty('topFragmentTag', $state['topFragmentTag']);
$this->setProperty('isRooted', $state['isRooted']);
$this->setProperty('isLicensed', $state['isLicensed']);
$this->setProperty('isInForcedSleep', $state['isInForcedSleep']);
$this->setProperty('maintenanceMode', $state['maintenanceMode']);
$this->setProperty('inDaydream', $state['inDaydream']);
}
/* --------------------------------------------------------------------------------------------------------------------

---------------------------------------------------------------------------------------------------------------------  */

// --------------------------------------------------------------------------------------------------------------------
if ($get_write_to_prop)
{
$pass = $this->getProperty('passw');
$ipterm = 'http://'.$this->getProperty('ip4').':'.$this->getProperty('port');
$getInfo = getURL($ipterm.'/?cmd=deviceInfo&password='.urlencode($pass).'&type=json');

$state = json_decode($getInfo, true);

//-------------------------------------------------------------------------
$this->setProperty('internalStorageFreeSpace', $state['internalStorageFreeSpace']);
$this->setProperty('deviceName', $state['deviceName']);
$this->setProperty('appVersionCode', $state['appVersionCode']);
$this->setProperty('appTotalMemory', $state['appTotalMemory']);
$this->setProperty('lastAppStart', $state['lastAppStart']);
$this->setProperty('locationAltitude', $state['locationAltitude']);
$this->setProperty('locationLongitude', $state['locationLongitude']);
$this->setProperty('wifiSignalLevel', $state['wifiSignalLevel']);
$this->setProperty('isScreenOn', $state['isScreenOn']);
$this->setProperty('currentFragment', $state['currentFragment']);
$this->setProperty('ramFreeMemory', $state['ramFreeMemory']);
$this->setProperty('kioskMode', $state['kioskMode']);
$this->setProperty('displayHeightPixels', $state['displayHeightPixels']);
$this->setProperty('appVersionName', $state['appVersionName']);
$this->setProperty('maintenanceMode', $state['maintenanceMode']);
$this->setProperty('externalStorageTotalSpace', $state['externalStorageTotalSpace']);
$this->setProperty('appFreeMemory', $state['appFreeMemory']);
$this->setProperty('internalStorageTotalSpace', $state['internalStorageTotalSpace']);
$this->setProperty('ramUsedMemory', $state['ramUsedMemory']);
$this->setProperty('foregroundApp', $state['foregroundApp']);
$this->setProperty('ssid', $state['ssid']);
$this->setProperty('mac', $state['mac']);
$this->setProperty('startUrl', $state['startUrl']);
$this->setProperty('screenOrientation', $state['screenOrientation']);
$this->setProperty('externalStorageFreeSpace', $state['externalStorageFreeSpace']);
$this->setProperty('isLicensed', $state['isLicensed']);
$this->setProperty('androidSdk', $state['androidSdk']);
$this->setProperty('deviceManufacturer', $state['deviceManufacturer']);
$this->setProperty('isPlugged', $state['plugged']);
$this->setProperty('keyguardLocked', $state['keyguardLocked']);
$this->setProperty('currentTabIndex', $state['currentTabIndex']);
$this->setProperty('isDeviceAdmin', $state['isDeviceAdmin']);
$this->setProperty('batteryLevel', $state['batteryLevel']);
$this->setProperty('appUsedMemory', $state['appUsedMemory']);
$this->setProperty('locationProvider', $state['locationProvider']);
$this->setProperty('locationLatitude', $state['locationLatitude']);
$this->setProperty('hostname6', $state['hostname6']);
$this->setProperty('hostname4', $state['hostname4']);
$this->setProperty('ramTotalMemory', $state['ramTotalMemory']);
$this->setProperty('kioskLocked', $state['kioskLocked']);
$this->setProperty('ip4', $state['ip4']);
$this->setProperty('deviceID', $state['deviceID']);
$this->setProperty('isDeviceOwner', $state['isDeviceOwner']);
$this->setProperty('ip6', $state['ip6']);
$this->setProperty('displayWidthPixels', $state['displayWidthPixels']);
$this->setProperty('androidVersion', $state['androidVersion']);
$this->setProperty('screenBrightness', $state['screenBrightness']);
$this->setProperty('webviewUa', $state['webviewUa']);
$this->setProperty('deviceModel', $state['deviceModel']);
$this->setProperty('currentPageUrl', $state['currentPageUrl']);
$this->setProperty('currentPage', $state['currentPage']);
$this->setProperty('motionDetectorState', $state['motionDetectorState']);
}
//-------------------------------------------------------------------------
