<?php
	require_once "Includes/config.php";
	require_once "Includes/Classes/users.class.php";

	echo '<p><a href="index.php"> Go home </a></p>';

	if($_GET){

		if($_GET['action'] == 'insert'){

			if($_POST){

				$name = $_POST['name'];
				$lastName = $_POST['lastName'];

				$client = new client(array(
					'name' => $name,
					'lastName' => $lastName
				));

				$client->insert();
				// $util->redirect('index.php');
			}

			echo '
				<form method="post">
					<input type="text" name="name" id="name">
					<input type="text" name="lastName" id="lastName">
					<input type="submit" value="Submit">
					<input type="reset" value="clear">
				</form>
			';

		}else if($_GET['action'] == 'delete'){

			if($_GET['id']){
				$client = new client();
				$client->valuePK = $_GET['id'];
				$client->delete();

				echo '<p>Registro deletado com sucesso</p>';
			}

			$query = new runQuery("SELECT * FROM users");
			while($client = $query->returnData('array')){
				echo 'Name: ' . $client['name'] . ' ' . $client['lastName'] . ' ';
				echo '<a href="?action=delete&id=' . $client['id'] . '">Deletar </a> <br />';
			}

		}else if($_GET['action'] == 'update'){

			if($_POST['id']){
				$client = new client(array(
					'name' => $_POST['name'],
					'lastName' => $_POST['lastName']
				));

				$client->valuePK = $_POST['id'];
				$client->update();

				echo '<p>Registro atualizado com sucesso</p>';
			}
			if($_GET['id']){
				$client = new client();
				// $client->getClient();
				$all_clients = $client->selectAll();
				while ($bla = mysql_fetch_array($all_clients)) {
					echo $bla['name'] . ' - ' . $bla['lastName'] . '<br />';
				}

				$query = new runQuery("SELECT * FROM users WHERE id = " . $_GET['id']);
				while($client = $query->returnData('array')){
					echo '
						<form method="post">
							name: <input type="text" name="name" id="name" value="' . $client['name'] . '">
							<input type="text" name="lastName" id="lastName" value="' . $client['lastName'] . '">
							<input type="text" name="id" id="id" value="' . $client['id'] . '">
							<input type="submit" value="Submit">
							<input type="reset" value="clear">
						</form>
					';
				}
			}


		}else if($_GET['action'] == 'show'){
			$client = new Client();
			// $client->selectAll();

			$query = new runQuery("SELECT * FROM users");
			while($client = $query->returnData('array')){
				echo 'Name: ' . $client['name'] . ' ' . $client['lastName'] . '<br />';
			}
		}
	}

?>