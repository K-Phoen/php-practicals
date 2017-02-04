<h1>Status</h1>

<?php
	var_dump($parameters);
	echo '<p>'.$status['user'].' à dit le '.$status['date'].'</p>';
	echo '<p>'.$status['message'].'</p>';
	echo '<form action="/statuses/'.$status['id'].'" method="POST">
			<input type="hidden" name="_method" value="DELETE">
			<input type="submit" value="Delete">
		  </form>';
	echo '<a href="/statuses">retour</a>';
?>
