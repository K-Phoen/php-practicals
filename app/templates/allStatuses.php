<h1>All Statuses</h1>

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
    <input type="text" name="username">
	<br/>
	<label for="title">Title:</label>
    <br/>
    <input name="title"></textarea>
	<br/>
    <label for="message">Message:</label>
    <br/>
    <textarea name="message"></textarea>
	<br/>
    <input type="submit" value="Tweet!">
</form>
