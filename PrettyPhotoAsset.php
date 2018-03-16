<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace indicalabs\prettyphoto;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Venu Narukulla. Venu <venu.narukulla@gmail.com>
 * @since 2.0
 */
class PrettyPhotoAsset extends AssetBundle
{
	public $sourcePath = '@bower/jquery-prettyphoto';
	public $css = [
			'css/prettyPhoto.css',
	];
	public $js = [
	];
	public $img = [
				'images/flags.png',
		];
	public $depends = [
			'yii\web\JqueryAsset',
	        'indicalabs\prettyphoto\PrettyPhotoJqAsset'
	];
	public function init()
	{
		parent::init();
		$this->publishOptions['beforeCopy'] = function ($from) {
			$path = str_replace(realpath(Yii::getAlias('@bower') . DIRECTORY_SEPARATOR . 'jquery-prettyphoto'), '', $from);
			return
			$path === DIRECTORY_SEPARATOR.'images'
					|| (0 === strpos($path, DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'prettyPhoto'))
					|| (0 === strpos($path, DIRECTORY_SEPARATOR.'css'))
					|| $path === DIRECTORY_SEPARATOR.'js'
							|| $path === DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'jquery.prettyPhoto.js';
		};
	}
	
}
