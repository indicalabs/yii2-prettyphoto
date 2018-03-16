<?php
namespace indicalabs\prettyphoto;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Venu Narukulla. Venu <venu.narukulla@gmail.com>
 * @since 2.0
 */
class PrettyPhotoJqAsset extends AssetBundle
{
	public $sourcePath = '@vendor/indicalabs/yii2-prettyphoto';
	public $css = [
	];
	public $js = [
			'js/jquery.prettyPhoto.js',
	];
	public $depends = [
	];
	public function init()
	{
		parent::init();
	}
	
}
