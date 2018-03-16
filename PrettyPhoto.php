<?php
namespace indicalabs\prettyphoto;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\Widget;

/**
* PrettyPhoto widget class file
*
* @package pbm.widgets
* @author Chris Yates
* @version 1.0
* @copyright Copyright &copy; 2011 PBM Web Development - All Rights Reserved
* @license BSD 3-Clause License
*
*/
/**
* PrettyPhoto encapsulates the {@link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/ prettyPhoto} jQuery lightbox clone.
*
* To use the widget put the following code in a view:
* <pre>
* <?php $imagesmodel = Albums::findBySql("select * from tbl_albums where profile_id = :profileId",array(':profileId'=>1))
*													->all(); ?> 
* <?php $ImagesPath=Yii::$app->request->baseUrl.DIRECTORY_SEPARATOR.'albums'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR; ?>
*			
* 			echo yii\prettyphoto\PrettyPhoto::Widget([
*											'id' => 'prettyPhoto',
*											'name' => 'test',
*											// prettyPhoto options
*											'clientOptions'=> [
*													'opacity'=>0.60,
*													'modal'=>false,
*													'slideshow'=>20000,
*													'autoplay_slideshow'=>false,
*													'theme' => 'facebook',
*													'social_tools' => false	
*												],
*										]);
*			<ul>
*					<?php 
*						foreach ($imagesmodel as $k){
*							?>
*						<a href=<?php echo "http://YOUR-WEB-SITE/images/".$k->image_folder.'/'.$k->image_name ?> >
*						<img src=<?php echo "http://YOUR-WEB-SITE/images/".$k->image_folder.'/thumb_'.$k->image_name ?>  alt="" /></a>
*					
*					<?php }
*					?>
*				</ul>
*														
*
* echo links to content here;
*
* $this->endWidget('path.to.PrettyPhoto');
* </pre>
*
* Content links do not require the rel="prettyPhoto" attribute; the widget adds this.
*
* By configuring the {@link options} property, you may specify the options that
* need to be passed to prettyPhoto. Please refer to the {@link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/ prettyPhoto}
* documentation for possible options (name=>value pairs).
*/
class PrettyPhoto extends Widget {
	
	/**
	* @property array HTML options for the enclosing tag
	*/
	public $clientOptions;
	/**
	* @property boolean Whether PrettyPhoto is in gallery (many items) mode
	*/
	public $gallery=true;
	/**
	* @property array Additional options for PrettyPhoto
	*/
	public $options=[];
	

	/**
	* @property string The enclosing tag
	*/
	public $tag='div';
	/**
	* @property string The PrettyPhoto theme to use
	*/

	public function init() {

		parent::init();

		$id=$this->getId();
		if (isset($this->clientOptions['id']))
			$id = $this->clientOptions['id'];
		else
			$this->clientOptions['id']=$id;
	}

	/** Render widget html and register client scripts */
	public function run()
	{
		echo Html::beginTag($this->tag,$this->clientOptions)."\n";
		$view = $this->getView();
		PrettyPhotoAsset::register($view);
		$this -> options = ArrayHelper::merge($this -> options, $this -> clientOptions);
		echo $this->renderWidget() . "\n";
// 		echo Html::endTag($this->tag)."\n";
	}

	/**
	 * Renders the AutoComplete widget.
	 * @return string the rendering result.
	 */
	public function renderWidget()
	{
		$id = $this->clientOptions['id'];
		$options = Json::encode($this -> options);
		
		$this->getView()->registerJs("
            jQuery('#".$id." a').attr('rel','prettyPhoto_".$id."".($this->gallery?'[]':'')."');
            jQuery('a[rel^=\"prettyPhoto_".$id."\"]').prettyPhoto(".$options.');
        ');
	}
	
}
