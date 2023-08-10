<?php
$this->device_links['SGadgetFKB']=array(
    array (
        'LINK_NAME'=>'sensor_pass_battery',
        'LINK_TITLE'=>LANG_DEVICES_LINK_SENSOR_PASS_BATTERY, //Пересылка данных о батареи
        'LINK_DESCRIPTION'=>'Выставляет свойства в связанном объекте', //Выставляет свойства в связанном объекте и посылает данные в HomeKit
        'TARGET_CLASS'=>'SDevices,SControllers,SSensors',
    ),
        array(
            'LINK_NAME'=>'switch_it',
            'LINK_TITLE'=>LANG_DEVICES_LINK_SWITCH_IT, //Включить/Выключить
            'LINK_DESCRIPTION'=>LANG_DEVICES_LINK_SWITCH_IT_DESCRIPTION, //Управление другим устройством по событию
            'TARGET_CLASS'=>'SControllers,SDevices,SSensors',
            'PARAMS'=>array(
                array(
                    'PARAM_NAME'=>'action_type',
                    'PARAM_TITLE'=>LANG_DEVICES_LINK_ACTION_TYPE, //Действие
                    'PARAM_TYPE'=>'select',
                    'PARAM_OPTIONS'=>array(
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_TURN_ON,'VALUE'=>'turnon'), // Включить
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_TURN_OFF,'VALUE'=>'turnoff'), // Выключить
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_SWITCH,'VALUE'=>'switch'), // Переключить
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_OPEN,'VALUE'=>'open'), // Открыть
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_CLOSE,'VALUE'=>'close') // Закрыть
                        )
                ),
                array(
                    'PARAM_NAME'=>'action_delay',
                    'PARAM_TITLE'=>LANG_DEVICES_LINK_SWITCH_IT_PARAM_ACTION_DELAY, //Задержка выполнения (секунд)
                    'PARAM_TYPE'=>'num'
                )
            )
            ),
            array(
            'LINK_NAME'=>'sensor_switch',
            'LINK_TITLE'=>LANG_DEVICES_LINK_SENSOR_SWITCH,
            'LINK_DESCRIPTION'=>LANG_DEVICES_LINK_SENSOR_SWITCH_DESCRIPTION,
            'TARGET_CLASS'=>'SControllers',
            'PARAMS'=>array(
                array(
                    'PARAM_NAME'=>'condition_type',
                    'PARAM_TITLE'=>LANG_DEVICES_LINK_SENSOR_SWITCH_PARAM_CONDITION,
                    'PARAM_TYPE'=>'select',
                    'PARAM_OPTIONS'=>array(
                        array('TITLE'=>LANG_DEVICES_LINK_SENSOR_SWITCH_PARAM_CONDITION_ABOVE,'VALUE'=>'above'),
                        array('TITLE'=>LANG_DEVICES_LINK_SENSOR_SWITCH_PARAM_CONDITION_BELOW,'VALUE'=>'below')
                    )
                ),
                array(
                    'PARAM_NAME'=>'condition_value',
                    'PARAM_TITLE'=>LANG_DEVICES_LINK_SENSOR_SWITCH_PARAM_VALUE,
                    'PARAM_TYPE'=>'num'
                ),
                array(
                    'PARAM_NAME'=>'action_type',
                    'PARAM_TITLE'=>LANG_DEVICES_LINK_ACTION_TYPE,
                    'PARAM_TYPE'=>'select',
                    'PARAM_OPTIONS'=>array(
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_TURN_ON,'VALUE'=>'turnon'),
                        array('TITLE'=>LANG_DEVICES_LINK_TYPE_TURN_OFF,'VALUE'=>'turnoff')
                    )
                )
            )
        ),
        array (
            'LINK_NAME'=>'sensor_pass',
            'LINK_TITLE'=>LANG_DEVICES_LINK_SENSOR_PASS,
            'LINK_DESCRIPTION'=>LANG_DEVICES_LINK_SENSOR_PASS_DESCRIPTION,
            'TARGET_CLASS'=>'SThermostats',
        ),
);