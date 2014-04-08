<?php
/**
 *The MIT License (MIT)

Copyright (c) 2014 DrMabuse

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
 */

namespace drmabuse\slick;

use drmabuse\slick\assets\SlickAssets;
use yii\base\Widget;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

class SlickWidget extends Widget{

    public $container   = '.slick';

    /**
     * @accessibility,boolean, default: true,Enables tabbing and arrow key navigation,
     * @autoplay,boolean, default: false,,Enables Autoplay,
     * @autoplaySpeed,int(ms), default: 3000 ,Autoplay Speed in milliseconds,
     * @arrows,boolean, default: true,Prev/Next Arrows,
	 * @centerMode, boolean	false,Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts.
	 * @centerPadding,int 50,Side padding when in center mode
     * @cssEase,string, default: 'ease',CSS3 Animation Easing,
     * @dots,boolean, default: false,Show dot indicators,
     * @draggable,boolean, default: true,Enable mouse dragging,
     * @fade,boolean, default: false,Enable fade,
     * @easing,string, default: 'linear',Add easing for jQuery animate. Use with easing libraries or default easing methods,
     * @infinite,,boolean, default: true,Infinite loop sliding,
	 * @lazyLoad,string	'ondemand',Set lazy loading technique. Accepts 'ondemand' or 'progressive'.
     * @onBeforeChange,function, default: null,Before slide callback,
     * @onAfterChange,function, default: null,After slide callback,
	 * @onInit,function	null,Callback that fires after first initialization
	 * @onReInit,function	null,Callback that fires after every re-initialization
     * @pauseOnHover,boolean, default: true,Pause Autoplay On Hover,
     * @placeholders,,boolean, default: true,,Enable placeholders to enforce slidesToScroll with uneven
     * slide counts. (Doesn't work with infinite: true),
     * @responsive,object, default: null,Object containing breakpoints as keys and settings objects as values,
     * @slide,element, default: 'div',Slide element,
     * @slidesToShow,int, default: 1,,# of slides to show,
     * @slidesToScroll,,int, default: 1,# of slides to scroll,
     * @speed,,int(ms), default: 300,Slide speed,
     * @swipe,boolean, default: true,Enable swiping,
     * @touchMove,boolean, default: true,Enable slide motion with touch,
     * @touchThreshold,,int, default: 5,Swipe distance threshold,
     * @vertical,boolean, default: false,Vertical slide direction,
     *
     * @var array
     */
    public $settings    = [];

    public function init()
    {

    }

    public function run()
    {
        return $this->registerSlickJs();
    }

    private function registerSlickJs(){
        $jQueryContainer = "$('{$this->container}')";
        SlickAssets::register($this->view);

        if(!empty($this->settings)){
            $var = uniqid('$container');
            $query = "var {$var} =  {$jQueryContainer};".PHP_EOL;

            foreach($this->settings as $method => $settings){
                $opt = Json::encode($settings);
                if(!is_null($settings))
                    $query .= "{$var}.{$method}({$opt});".PHP_EOL;
                else
                    $query .= "{$var}.{$method}();".PHP_EOL;
            }

            return $this->view->registerJs($query,View::POS_READY);
        }
        return $this->view->registerJs($jQueryContainer.".slick()",View::POS_READY);
    }
} 