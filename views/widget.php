<?php
/**
 * @var $atts
 * @var $place
 * @var $temp
 * @var $wind
 * @var $weather
 */

?>

<div class="ww-wrap">
	<?php if(isset($atts['title']) && !empty($atts['title'])): ?>
		<div class="ww-title">
			<?php echo $atts['title']; ?>
		</div>
	<?php endif; ?>
	<div class="ww-row">
		<div class="ww-col">
            <img src="<?php echo 'https://openweathermap.org/img/wn/' . $weather['icon'] . '@2x.png'; ?>" alt="current_weather" class="ww-image">
		</div>
		<div class="ww-col">
			<div class="ww-city">
                <?php echo $place; ?>
			</div>
			<div class="ww-temp">
                <?php echo round($temp); ?>&deg;
			</div>
			<?php if(isset($atts['wind']) && !empty($atts['wind']) && $atts['wind'] == true): ?>
				<div class="ww-wind">
                    <span class="ww-wind-label">Wind </span>
                    NE <?php echo $wind['speed'], (empty($atts['units']) || $atts['units'] == 'metric') ? 'm/s' : 'm/h'; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

