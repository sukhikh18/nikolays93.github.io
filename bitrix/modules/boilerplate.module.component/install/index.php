<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

IncludeModuleLangFile(__FILE__);

if (class_exists('boilerplate_module')) {
    return;
}

class boilerplate_module extends CModule
{

    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';
        $this->MODULE_ID = 'boilerplate.module';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'] ?? '';
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'] ?? '';
        $this->MODULE_NAME = 'Пример модуля';
        $this->MODULE_DESCRIPTION = 'Тестовый модуль для разработчиков, можно использовать как основу для разработки новых модулей для 1С:Битрикс';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';
    }

    /**
     * Module contains this components
     */
    public static function getComponentNames(): array
    {
        return [
            'boilerplate.component',
        ];
    }

    /**
     * Get application folder.
     * @return string /document/local (when exists) or /document/bitrix
     */
    public static function getRoot()
    {
        $local = $_SERVER['DOCUMENT_ROOT'] . '/local';
        if (1 === preg_match('#local[\\\/]modules#', __DIR__) && is_dir($local)) {
            return $local;
        }

        return $_SERVER['DOCUMENT_ROOT'] . BX_ROOT;
    }


    function DoInstall()
    {
        global $APPLICATION, $DB;

        if (!CheckVersion(ModuleManager::getVersion('main'), '14.00.00')) {
            $APPLICATION->ThrowException('Версия главного модуля ниже 14. Не поддерживается технология D7, необходимая модулю. Пожалуйста обновите систему.');
        }

        /**
         * Install Database
         */

        /**
         * Install Events
         */

        /**
         * Install Files
         */
        CopyDirFiles(__DIR__ . '/components', static::getRoot() . '/components', true, true);

        ModuleManager::RegisterModule($this->MODULE_ID);
    }

    /**
     * @param string $componentName component folder name
     */
    public function deleteComponent($componentName, $vendor = '')
    {
        DeleteDirFilesEx($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/components/' . $vendor . $componentName);
        DeleteDirFilesEx($_SERVER['DOCUMENT_ROOT'] . '/local/components/' . $vendor . $componentName);
    }

    function DoUninstall()
    {
        global $DB;

        /**
         * Uninstall Database
         */

        /**
         * Uninstall Events
         */

        /**
         * Uninstall Files
         */
        array_map([$this, 'deleteComponent'], static::getComponentNames());

        UnRegisterModule($this->MODULE_ID);
    }
}