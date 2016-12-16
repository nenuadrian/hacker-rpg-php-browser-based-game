

<?php echo Asset::css('computer-animated.css'); ?>
<div class="comp">
	<div class="monitor">
		<div class="mid">
			<div class="site">
				<div class="topbar">
					<div class="cerrar">
						<div class="circl"></div>
						<div class="circl"></div>
						<div class="circl"></div>
					</div>
				</div>
				<div class="inhead">
					<div class="mid">
						<div class="item"></div>
					</div>
					<div class="mid txr">
						<div class="item"></div>
						<div class="item"></div>
						<div class="item"></div>
						<div class="item"></div>
					</div>
				</div>
				<div class="inslid">

				</div>
				<div class="incont">
					<div class="item"></div>
					<div class="item"></div>
					<div class="item"></div>
					<div class="item"></div>
					<div class="wid">
						<div class="itwid">
							<div>
								<div class="contfoot"></div>
							</div>
						</div>
						<div class="itwid">
							<div>
								<div class="contfoot"></div>
							</div>
						</div>
						<div class="itwid">
							<div>
								<div class="contfoot"></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="infoot">

					</div>
				</div>
			</div>
		</div>
		<div class="mid codigo">
			<div class="line">
				<div class="item var"></div>
				<div class="item cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line">
				<div class="item min var"></div>
				<div class="item min fun"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line">
				<div class="item min var"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line">
				<div class="item var"></div>
				<div class="item atr"></div>
				<div class="item cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item min atr"></div>
				<div class="item lrg fun"></div>
				<div class="item min fun"></div>
				<div class="item lrg cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item lrg atr"></div>
				<div class="item min fun"></div>
				<div class="item min cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item atr"></div>
				<div class="item min fun"></div>
				<div class="item atr"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item min atr"></div>
				<div class="item min cont"></div>
				<div class="item lrg atr"></div>
				<div class="item  fun"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item min atr"></div>
				<div class="item lrg fun"></div>
				<div class="item lrg cont"></div>
				<div class="item min fun"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item min var"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item min var"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab2">
				<div class="item min var"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab2">
				<div class="item min atr"></div>
				<div class="item min fun"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab3">
				<div class="item min atr"></div>
				<div class="item min fun"></div>
				<div class="item lrg fun"></div>
				<div class="item lrg cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab3">
				<div class="item min atr"></div>
				<div class="item min fun"></div>
				<div class="item lrg atr"></div>
				<div class="item lrg cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab4">
				<div class="item min fun"></div>
				<div class="item lrg atr"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab1">
				<div class="item atr"></div>
				<div class="item var"></div>
				<div class="item cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab3">
				<div class="item min var"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line tab4">
				<div class="item min atr"></div>
				<div class="item min fun"></div>
				<div class="item lrg atr"></div>
				<div class="item lrg cont"></div>
				<div class="clearfix"></div>
			</div>
			<div class="line">
				<div class="item min var"></div>
				<div class="clearfix"></div>
			</div>

		</div>
	</div>
	<div class="base">

	</div>
</div>

<br/><br/>
<div class=" text-center">


<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task_remaining, 'duration' => $task['task_duration'], 'max_width' => '200px')); ?>
	<form method="post">
	<?php if (Auth::get('group') == 2): ?>
		<button type="submit" name="skip" value="true" class="btn btn-success">skip</button>
	<?php endif; ?>
		<button type="submit" name="cancel" value="true" class="btn btn-danger">cancel</button>
	</form>
</div>
