

<?php
	echo '<h1>'.$status['title'].'</h1>
		  <p>Posté par '.$status['user'].' le '.$status['date'].'</p>
		  <p>'.$status['message'].'</p>
		  <br />
		  <form action="/statuses/'.$status['id'].'" method="POST">
			<input type="hidden" name="_method" value="DELETE">
			<input type="submit" value="Delete">
		  </form>';
	echo '<a href="/statuses">retour</a>';
?>
