//form that connects to the newFork php file which adds a new fork
<HTML>
	<form action="addFork.php" method="post">
		<label>Restaurant: </label>
		<input type="text" name="restaurant" value="whatever"></input>
		<label>Rating: </label>
		<input type="text" name="rating"></input>
		<label>Durability: </label>
		<input type="text" name="durability"></input>
		<label>Looks: </label>
		<input type="text" name="looks"></input>
		<button type="submit" name="submit">Add Fork</button>
	</form>
</HTML>