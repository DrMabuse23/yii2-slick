<?php
/**
 * 2014 , 04 02
 
    Copyright (c) 2014, Pascal Brewing <pascalbrewing@gmail.com>
    All rights reserved.
    
    Redistribution and use in source and binary forms, with or without modification,
    are permitted provided that the following conditions are met:
    
    * Redistributions of source code must retain the above copyright notice, this
      list of conditions and the following disclaimer.
    
    * Redistributions in binary form must reproduce the above copyright notice, this
      list of conditions and the following disclaimer in the documentation and/or
      other materials provided with the distribution.
    
    * Neither the name of the {organization} nor the names of its
      contributors may be used to endorse or promote products derived from
      this software without specific prior written permission.
    
    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
    ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
    WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
    ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
    (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
    LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
    ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
    (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
    SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace drmabuse\slick;

use app\extensions\slick\assets\SlickAssets;
use yii\base\Widget;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

class SlickWidget extends Widget{

    public $template    = 'carousel';
    public $container   = '.slick';

    /**
     * @accessibility,boolean, default: true,Enables tabbing and arrow key navigation,
     * @autoplay,boolean, default: false,,Enables Autoplay,
     * @autoplaySpeed,int(ms), default: 3000 ,Autoplay Speed in milliseconds,
     * @arrows,boolean, default: true,Prev/Next Arrows,
     * @cssEase,string, default: 'ease',CSS3 Animation Easing,
     * @dots,boolean, default: false,Show dot indicators,
     * @draggable,boolean, default: true,Enable mouse dragging,
     * @fade,boolean, default: false,Enable fade,
     * @easing,string, default: 'linear',Add easing for jQuery animate. Use with easing libraries or default easing methods,
     * @infinite,,boolean, default: true,Infinite loop sliding,
     * @onBeforeChange,function, default: null,Before slide callback,
     * @onAfterChange,function, default: null,After slide callback,
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