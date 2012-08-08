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

				$client->insert($client);
				$util->redirect('index.php');
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
				$client->delete($client);

				echo '<p>Registro deletado com sucesso</p>';
			}

			$query = new runQuery("SELECT * FROM clients");
			while($client = $query->returnData('array')){
				echo 'Name: ' . $client['name'] . ' ' . $client['lastName'] . ' ';
				echo '<a href="?action=delete&id=' . $client['id'] . '">Deletar </a> <br />';
			}

		}else if($_GET['action'] == 'show'){
			$query = new runQuery("SELECT * FROM clients");
			while($client = $query->returnData('array')){
				echo 'Name: ' . $client['name'] . ' ' . $client['lastName'] . '<br />';
			}
		}
	}

?>