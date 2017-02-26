<h1>All Statuses</h1>
<form action="/statuses" method="GET">
    <label for="numberLimit">Number of results:</label>
    <input id="numberLimit" type="number" name="numberOfResults" required="required">
		<br/>
		<label for="orderBy">Number of results:</label>
		<select id="orderBy" name="orderBy" required="required">
			<option value="date" selected="selected">Date</option>
			<option value="title" >Title</option>
		</select>
		<br/>
    <input type="submit" value="Filter">
</form>
<?php
echo '<table border="1">
		  <tr>
			<th>user</th>
			<th>Title</th>
			<th>Date</th>
			<th>See</th>
		  </tr>';
foreach ($parameters as $key => $status) {
    echo '<tr>
			<td>'.$status['user'].'</td>
			<td>'.$status['title'].'</td>
			<td>'.$status['date'].'</td>
			<td><a href="/statuses/'.$status['id'].'">See</a></td>
		  </tr>';
}
echo '</table>';

?>
<br />
<h1>Post a new status</h1>

<form action="/statuses" method="POST">
    <label for="username">Username:</label>
    <br/>
    <input id="username" type="text" name="username">
	<br/>
	<label for="title">Title:</label>
    <br/>
    <input id="title" name="title" ></textarea>
	<br/>
    <label for="message">Message:</label>
    <br/>
    <textarea id="message" name="message" rows="4" cols="50"></textarea>
	<br/>
    <input type="submit" value="Tweet!">
</form>
