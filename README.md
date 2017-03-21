yii2-slick
==========

[the Preview http://kenwheeler.github.io/slick/](http://kenwheeler.github.io/slick/ "http://kenwheeler.github.io/slick/")

The yii2 widget to the fantastic slick-carousel. This widget generate you the only the javascript.

### Installation Composer
    drmabuse/yii2-slick-carousel:"*"

### Using

```php

    <?php
	\drmabuse\slick\SlickWidget::begin([
	    'htmlOptions' => [
	        'class' => ['slider', 'single-item'],
	    ],
		'settings'  => [
			'slick' => [
				'infinite'      =>  true,
				'slidesToShow'  =>  3,
				'onBeforeChange'=> new \yii\web\JsExpression('function(){
				}'),
				'onAfterChange' => new \yii\web\JsExpression('function(){
					console.debug(this);
				}'),
				'responsive' => [
					[
						'breakpoint'=> 768,
						  'settings'=> [
							  'arrows'=> false,
							  'centerMode'=> true,
							  'centerPadding'=> 40,
							  'slidesToShow'=> 3
						  ]
					]
				],
			],
			'slickGoTo'         => 3,
		]
	]);

    ?>
    
    <div><h3>1</h3></div>
    <div><h3>2</h3></div>
    <div><h3>3</h3></div>
    <div><h3>4</h3></div>
    <div><h3>5</h3></div>
    <div><h3>6</h3></div>
    
    <?php 
    \drmabuse\slick\SlickWidget::end();
    ?>
```
