<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_genericcarousel
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport( 'joomla.application.module.helper' );

if ($jq == 1) {
    JHtml::_('jquery.framework');
}
$document->addScript(JURI::base() . 'modules/mod_genericcarousel/assets/slick/slick.min.js');

// $responsive = '
//   [
//     {
//       breakpoint: 1024,
//       settings: {
//         slidesToShow: 3,
//         slidesToScroll: 3,
//         infinite: true
//       }
//     },
//     {
//       breakpoint: 600,
//       settings: {
//         slidesToShow: 2,
//         slidesToScroll: 2,
//         infinite: true
//       }
//     },
//     {
//       breakpoint: 480,
//       settings: {
//         slidesToShow: 1,
//         slidesToScroll: 1,
//         infinite: true
//       }
//     },
// 	{
// 		breakpoint: 300,
// 		settings: \'unslick\'
// 	}
//   ]';


$responsive = '[';
for ($i = 1; $i < 4; $i++) {
    $bp= 'breakpoint'.$i;
    $itemsnr='nrOfItemsBp'.$i;
    $itemsscrollnr='scrollitemsBp'.$i;

    $responsive = $responsive.'{
          breakpoint:'.$car_bp[$bp].',
          settings: {
            slidesToShow:'.$car_bp[$itemsnr].',
            slidesToScroll:'.$car_bp[$itemsscrollnr].',
            infinite: true
          }
        },';
}
$responsive = $responsive.']';

if ($CarouselType == 'O') {
    $document->addScriptDeclaration('
   	 jQuery(document).ready(function(){
  		jQuery(".'.$carousel_id.'").slick({
   			 arrows:'.$arrows.',
   			 autoplay:true,
   			 autoplaySpeed:'.$CarouselSpeed.',
             dots:'.$paginationbool.',
             responsive:'.$responsive.'
  			});
		})');
} elseif ($CarouselType == 'I') {
    $document->addScriptDeclaration('
   	 jQuery(document).ready(function(){
  		jQuery(".'.$carousel_id.'").slick({
   			 arrows:'.$arrows.',
   			 autoplay:true,
   			 autoplaySpeed:'.$CarouselSpeed.',
             dots:'.$paginationbool.',
             slidesToShow: ' . $CarouselItems . ',
             slidesToScroll: '.$skrollItems.',
             responsive:'.$responsive.'
  			});
		})');
}elseif ($CarouselType == 'L') {
    $document->addScriptDeclaration('
   	 jQuery(document).ready(function(){
  		jQuery(".'.$carousel_id.'").slick({
   			 arrows:'.$arrows.',
   			 autoplay:true,
             lazyLoad: "ondemand",
   			 autoplaySpeed:1000,
             slidesToShow: ' . $CarouselItems . ',
             slidesToScroll: 1,
             responsive:'.$responsive.'
  			});
		})');
}


?>

<div class="<?php echo $carousel_id; ?>" >

    <?php for ($i = 1; $i < 11; $i++) {
        $number= 'name'.$i;
        $captionnr='title'.$i;

        $mod = JModuleHelper::getModule($car_img[$number],$car_img[$captionnr]);
        echo JModuleHelper::renderModule($mod);
    }
    ?>
</div>
