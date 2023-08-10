<?php

//$this->setProperty('batteryLevel',$this->getProperty('info_battery_level')); //передает значение из метода в метод

if ($link_type=='sensor_pass_battery') {
   $value = (int)gg($device1['LINKED_OBJECT'].'.levelWork');
   $minValue = (int)gg($device1['LINKED_OBJECT'].'.minWork');
   
   if ($value < $minValue) $statusLowBattery = true;
   else $statusLowBattery = false;
   sg($object.'.state',($statusLowBattery ? 1 : 0));
   sg($object.'.level',$value);
}