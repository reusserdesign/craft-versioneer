<?php

namespace workingconcept\versioneer\fieldtypes;

use craft\base\Field;
use Craft;
use craft\base\ElementInterface;

class VersionHistoryField extends Field
{

	public $name = "yuo";

	public function getName()
	{
		return Craft::t('versioneer', 'Version History');
	}

	/**
	 * @inheritdoc
	 */
	public static function displayName(): string
	{
		return Craft::t('versioneer', 'Version History');
	}

	public function getInputHtml($value, ElementInterface $element = null): string
	{
		$viewService = Craft::$app->getView();

		$currentSiteHandle = Craft::$app->getSites()->getSiteById($element->siteId, true)->handle;
		$siteId = $element->siteId ?? Craft::$app->getSites()->getCurrentSite()->id;
		$html = '';

		$html = $viewService->renderTemplate('versioneer/fieldtypes/history', [
			'versions' =>  Craft::$app->entryRevisions->getVersionsByEntryId($element->canonicalId, $siteId, 500, true),
			'entry'    => $element,
			'id' => $viewService->formatInputId($this->handle),
			'name' => $this->handle,
			'value' => $value,
			'selectedId' => $element->id,
			'currentSiteHandle' => $currentSiteHandle,
		]);

		return $html;
	}
}
