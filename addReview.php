<!-- form that connects to the addFork php file which adds a new fork
 --><HTML>
	<form action="reviewServer.php" method="post">
		<label>Restaurant: </label>
		<input type="text" name="restaurantId" value="whatever"></input>
		<label>Rating: </label>
		<input type="text" name="rating"></input>
		<label>Durability: </label>
		<input type="text" name="durability"></input>
		<label>Looks: </label>
		<input type="text" name="looks"></input>
		<input type="text" name="userId"></input>
		<textarea name="reviewText" style="width:200px; height:600px;"></textarea>
		<button type="submit" name="submit">Add Review</button>
	</form>
</HTML>