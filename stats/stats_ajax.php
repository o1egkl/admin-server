	<p>Statistics</p>
	
	<a href="list.php">Back to list</a>
	<br/><br/>
	The number of unique visitors is:
	<?php
	define("HTTP_SERVER_HOST","localhost");
	define("DB_HOST",HTTP_SERVER_HOST);
	define("DB_NAME", "admin");
	define("DB_USER", "root");
	define("DB_PASS", "");	
	// connect to the database
	
	// fill in your databasa data here!

		$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // change character set to utf8 and check it
        if (!$db_connection->set_charset("utf8")) {
            $errors[] = $db_connection->error;
        }
        $query = "select distinct ip from tracker WHERE page LIKE "."'". htmlspecialchars($_GET['page'])."'";
		// if no connection errors (= working database connection)
		if (!$db_connection->connect_errno) {
			$sql = "select distinct ip from tracker";
			$result = $db_connection->query($query);
			if ($result->num_rows > 0) {
				// show the number
				echo $result->num_rows;
			}	
		}
		$query = "select * from tracker WHERE page LIKE "."'". htmlspecialchars($_GET['page'])."'";
		$result = $db_connection->query($query);
	?>
	Site's visitors: <?= $result->num_rows; ?>
	<br/><br/>
	<table border="1" style="width:80%;">
		<tr>
			<th>IP</th>
			<th>User agent</th>
			<th>Country</th>
			<th>City</th>
			<th>Referer</th>
			<th>Is a bot?</th>
		</tr>
		<?php
		// get the list of visitors
		
		while ($row = mysqli_fetch_array($result))
		{
			?>
			<tr>
				<td><?php echo $row['ip'];?></td>
				<td><?php echo $row['http_user_agent'];?></td>
				<td><?php echo $row['country'];?></td>
				<td><?php echo $row['city'];?></td>
				<td><?php echo $row['http_referer'];?></td>
				<td><?php if ($row['isbot']==1) echo "yes"; else echo "no";?></td>
			</tr>
			<?php
		}
		?>
	</table>
