<?php

/**
 * Versioneer plugin for Craft CMS
 *
 * A fieldtype for getting at the rest of those entry versions.
 *
 * @author    Working Concept
 * @copyright Copyright (c) 2017 Working Concept
 * @link      https://workingconcept.com
 * @package   Versioneer
 * @since     0.0.1
 */

namespace workingconcept\versioneer;

use Craft;
use Craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use workingconcept\versioneer\fieldtypes\VersionHistoryField;
use yii\base\Event;

class VersioneerPlugin extends BasePlugin
{
    public $hasCpSettings = false;
    public $hasCpSection = false;

    public $version = '0.0.3';
    public $schemaVersion = '0.0.0';

    public function init()
    {
        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = VersionHistoryField::class;
            }
        );
        parent::init();
    }

    public function getCpNavItem()
    {
        return null;
    }
}
