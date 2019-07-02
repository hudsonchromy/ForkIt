<div class="stars">
	<span id="<?echo 'star-1'.'-'.$order?>" class="fa fa-star" onclick="<? echo 'updatestars' . $order . '(1)'?>"></span>
	<span id="<?echo 'star-2'.'-'.$order?>" class="fa fa-star" onclick="<? echo 'updatestars' . $order . '(2)'?>"></span>
	<span id="<?echo 'star-3'.'-'.$order?>" class="fa fa-star" onclick="<? echo 'updatestars' . $order . '(3)'?>"></span>
	<span id="<?echo 'star-4'.'-'.$order?>" class="fa fa-star" onclick="<? echo 'updatestars' . $order . '(4)'?>"></span>
	<span id="<?echo 'star-5'.'-'.$order?>" class="fa fa-star" onclick="<? echo 'updatestars' . $order . '(5)'?>"></span>
	<input id="<?echo $name?>" name="<?echo $name?>" value="1" style="display: none;">
</div>

<script>
	function <? echo 'updatestars' . $order . '(number)'?> {
		document.getElementById('<? echo $name?>').value= number;
		for (var i = 1; i <= 5; i++) {
			if (i <= number) {
				$('#star-' + i + "-" + <?echo $order?>).addClass("checked");
			} else {
				$('#star-' + i + "-" + <?echo $order?>).removeClass("checked");
			}
		}
	}
</script>