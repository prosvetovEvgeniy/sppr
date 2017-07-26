<?php
	require "includes/config.php";
	if(isset($_POST['getCookie'])){ //отправляем id user-а для переадресации через js
		echo $_SESSION['user_id'];
	}

	if(isset($_POST['methodType'])){
		if($_POST['methodType'] == "mah"){

			//находим проверяем существует ли метод с таким id
			$query = "SELECT `id` FROM `methods` WHERE `methodName`='Метод анализа иерархий'";
			$data = mysqli_query($connection, $query);
			if(mysqli_num_rows($data) == 1){
				$methodId = mysqli_fetch_assoc($data);
			}
			
			//делаем запись в таблицу эксперименты
			$query = "INSERT INTO `experiments` (experimentName, method_id, user_id) VALUES ('{$_POST['purpose_area']}', {$methodId['id']}, {$_SESSION['user_id']})";
			mysqli_query($connection, $query);

			//получаем id последней записи таблицы experiments
    		$experimentId = mysqli_insert_id($connection);

    		//записываем в базу данных критерии
    		$query = "INSERT INTO `criterions` (`criterionName`, `experiment_id`) VALUES";

    		for($i = 0; $i < $_POST['amount_criterians']; $i++){
    			if($i+1 != $_POST['amount_criterians']){
    				$query .= " ('{$_POST['criterian_'.$i]}', {$experimentId}),";
    			}
    			else{
    				$query .= " ('{$_POST['criterian_'.$i]}', {$experimentId})";
    			}
    		}
			mysqli_query($connection, $query);
    		//записываем в базу данных альтернативы
    		$query = "INSERT INTO `аlternatives` (`аlternativeName`, `experiment_id`) VALUES";

    		for($i = 0; $i < $_POST['amount_alternatives']; $i++){
    			if($i+1 != $_POST['amount_alternatives']){
    				$query .= " ('{$_POST['alternative_'.$i]}', {$experimentId}),";
    			}
    			else{
    				$query .= " ('{$_POST['alternative_'.$i]}', {$experimentId})";
    			}
    		}
    		mysqli_query($connection, $query);
    		//записываем в базу данных результируюшие веса
    		$query = "INSERT INTO `result_mah` (`experiment_id`, `alternative_name`, `weight_value`) VALUES";

    		for($i = 0; $i < $_POST['amount_alternatives']; $i++){
    			if($i+1 != $_POST['amount_alternatives']){
    				$query .= " ({$experimentId}, '{$_POST['alternative_'.$i]}', '{$_POST['result_weights_'.$i]}'),";
    			}
    			else{
    				$query .= " ({$experimentId}, '{$_POST['alternative_'.$i]}', '{$_POST['result_weights_'.$i]}')";
    			}
    		}
    		mysqli_query($connection, $query);

		}
		elseif($_POST['methodType'] == "matrixMethod"){
			//находим проверяем существует ли метод с таким id
			$query = "SELECT `id` FROM `methods` WHERE `methodName`='Принятие решений в условиях неопределенности'";
			$data = mysqli_query($connection, $query);
			if(mysqli_num_rows($data) == 1){
				$methodId = mysqli_fetch_assoc($data);
			}

			$query = "INSERT INTO `experiments` (experimentName, method_id, user_id) VALUES ('{$_POST['purpose_area_matrix_method']}', {$methodId['id']}, {$_SESSION['user_id']})";
			mysqli_query($connection, $query);
			
			//получаем id последней записи таблицы experiments
    		$experimentId = mysqli_insert_id($connection);

    		//записываем в базу данных критерии
    		$query = "INSERT INTO `criterions` (`criterionName`, `experiment_id`) VALUES";

    		for($i = 0; $i < $_POST['amount_criterians']; $i++){
    			if($i+1 != $_POST['amount_criterians']){
    				$query .= " ('{$_POST['criterian_'.$i]}', {$experimentId}),";
    			}
    			else{
    				$query .= " ('{$_POST['criterian_'.$i]}', {$experimentId})";
    			}
    		}
			mysqli_query($connection, $query);

			//записываем в базу данных альтернативы
    		$query = "INSERT INTO `аlternatives` (`аlternativeName`, `experiment_id`) VALUES";

    		for($i = 0; $i < $_POST['amount_alternatives']; $i++){
    			if($i+1 != $_POST['amount_alternatives']){
    				$query .= " ('{$_POST['alternative_'.$i]}', {$experimentId}),";
    			}
    			else{
    				$query .= " ('{$_POST['alternative_'.$i]}', {$experimentId})";
    			}
    		}
    		mysqli_query($connection, $query);

    		$query = "INSERT INTO `utility_matrix` (`experiment_id`, `alternative_i_id`, `criterion_j_id`, `value`) VALUES";

    		for($i = 0; $i < $_POST['amount_alternatives']; $i++){

    			$id_alt_i = "SELECT `id` FROM `аlternatives` WHERE `аlternativeName` = '{$_POST['alternative_'.$i]}' AND `experiment_id` = {$experimentId}";
    			$data = mysqli_query($connection, $id_alt_i);
    			$idI = mysqli_fetch_assoc($data);

    			for($j = 0; $j < $_POST['amount_criterians']; $j++){

    				$id_alt_j = "SELECT `id` FROM `criterions` WHERE `criterionName` = '{$_POST['criterian_'.$j]}' AND `experiment_id` = {$experimentId}";
    				$data = mysqli_query($connection, $id_alt_j);
    				$idJ = mysqli_fetch_assoc($data);

    				if(($i+1) == $_POST['amount_alternatives'] && ($j+1) == $_POST['amount_criterians']){
    					$query .= " ({$experimentId}, {$idI['id']}, {$idJ['id']}, {$_POST['utility_matrix_'.$i.'_'.$j]})";
                        
    				}
    				else{
    					$query .= " ({$experimentId}, {$idI['id']}, {$idJ['id']}, {$_POST['utility_matrix_'.$i.'_'.$j]}),";
                        
    				}
    			}
    		}
            
    		mysqli_query($connection, $query);
    	
    		if(isset($_POST['Laplas'])){
    			$query = "INSERT INTO `result_matrix_method`(`experiment_id`, `criterion_name`, `alternative_name`) VALUES ({$experimentId}, '{$_POST['Laplas']}', '{$_POST['Laplas_value']}')";
    			mysqli_query($connection, $query);
    		}
    		if (isset($_POST['Vald'])){
    			$query = "INSERT INTO `result_matrix_method`(`experiment_id`, `criterion_name`, `alternative_name`) VALUES ({$experimentId}, '{$_POST['Vald']}', '{$_POST['Vald_value']}')";
    			mysqli_query($connection, $query);
    		}
    		if (isset($_POST['Sevidg'])){
    			$query = "INSERT INTO `result_matrix_method`(`experiment_id`, `criterion_name`, `alternative_name`) VALUES ({$experimentId}, '{$_POST['Sevidg']}', '{$_POST['Sevidg_value']}')";
    			mysqli_query($connection, $query);
    		}
    		if (isset($_POST['Gurvich'])){
    			$query = "INSERT INTO `result_matrix_method`(`experiment_id`, `criterion_name`, `alternative_name`) VALUES ({$experimentId}, '{$_POST['Gurvich']}', '{$_POST['Gurvich_value']}')";
    			mysqli_query($connection, $query);
    		}
		}
		elseif($_POST['methodType'] == "riskMethod"){
            //находим проверяем существует ли метод с таким id
            $query = "SELECT `id` FROM `methods` WHERE `methodName`='Принятие решений в условиях риска'";
            $data = mysqli_query($connection, $query);
            if(mysqli_num_rows($data) == 1){
                $methodId = mysqli_fetch_assoc($data);
            }

            $query = "INSERT INTO `experiments` (experimentName, method_id, user_id) VALUES ('{$_POST['purpose_area_risk_method']}', {$methodId['id']}, {$_SESSION['user_id']})";
            mysqli_query($connection, $query);
            
            //получаем id последней записи таблицы experiments
            $experimentId = mysqli_insert_id($connection);

            //записываем в базу данных критерии
            $query = "INSERT INTO `criterions` (`criterionName`, `experiment_id`) VALUES";

            for($i = 0; $i < $_POST['amount_criterians']; $i++){
                if($i+1 != $_POST['amount_criterians']){
                    $query .= " ('{$_POST['criterian_'.$i]}', {$experimentId}),";
                }
                else{
                    $query .= " ('{$_POST['criterian_'.$i]}', {$experimentId})";
                }
            }
            mysqli_query($connection, $query);

            //записываем в базу данных альтернативы
            $query = "INSERT INTO `аlternatives` (`аlternativeName`, `experiment_id`) VALUES";

            for($i = 0; $i < $_POST['amount_alternatives']; $i++){
                if($i+1 != $_POST['amount_alternatives']){
                    $query .= " ('{$_POST['alternative_'.$i]}', {$experimentId}),";
                }
                else{
                    $query .= " ('{$_POST['alternative_'.$i]}', {$experimentId})";
                }
            }
            mysqli_query($connection, $query);

            //делаем запись в матрицу полезности
            $query = "INSERT INTO `utility_matrix` (`experiment_id`, `alternative_i_id`, `criterion_j_id`, `value`) VALUES";

            for($i = 0; $i < $_POST['amount_alternatives']; $i++){

                $id_alt_i = "SELECT `id` FROM `аlternatives` WHERE `аlternativeName` = '{$_POST['alternative_'.$i]}' AND `experiment_id` = {$experimentId}";
                $data = mysqli_query($connection, $id_alt_i);
                $idI = mysqli_fetch_assoc($data);

                for($j = 0; $j < $_POST['amount_criterians']; $j++){

                    $id_alt_j = "SELECT `id` FROM `criterions` WHERE `criterionName` = '{$_POST['criterian_'.$j]}' AND `experiment_id` = {$experimentId}";
                    $data = mysqli_query($connection, $id_alt_j);
                    $idJ = mysqli_fetch_assoc($data);

                    if(($i+1) == $_POST['amount_alternatives'] && ($j+1) == $_POST['amount_criterians']){
                        $query .= " ({$experimentId}, {$idI['id']}, {$idJ['id']}, {$_POST['winnings_matrix_'.$i.'_'.$j]})";
                        
                    }
                    else{
                        $query .= " ({$experimentId}, {$idI['id']}, {$idJ['id']}, {$_POST['winnings_matrix_'.$i.'_'.$j]}),";
                        
                    }
                }
            }
            mysqli_query($connection, $query);

            //делаем запись в таблицу со списком вероятностей
            $query = "INSERT INTO `probabilities` (`experiment_id`, `criterion_id`, `value`) VALUES";

            for($i = 0; $i < $_POST['amount_criterians']; $i++){
                $id_cr = "SELECT `id` FROM `criterions` WHERE `criterionName` = '{$_POST['criterian_'.$i]}' AND `experiment_id` = {$experimentId}";
                $data = mysqli_query($connection, $id_cr);
                $id = mysqli_fetch_assoc($data);

                if($i+1 != $_POST['amount_criterians']){
                    $query .= " ({$experimentId}, {$id['id']},{$_POST['winnings_matrix_p_'.$i]}),";
                }
                else{
                    $query .= " ({$experimentId}, {$id['id']},{$_POST['winnings_matrix_p_'.$i]})";
                }
            }
            mysqli_query($connection, $query);

            $query_high_risk = "INSERT INTO `result_risk_method` (`experiment_id`, `alternative_name`, `identifier`) VALUES";
            $query_middle_risk = "INSERT INTO `result_risk_method` (`experiment_id`, `alternative_name`, `identifier`) VALUES";
            $query_low_risk = "INSERT INTO `result_risk_method` (`experiment_id`, `alternative_name`, `identifier`) VALUES";


            for($i = 0; $i < $_POST['count_pareto']; $i++){
                if($i+1 != $_POST['count_pareto']){
                    $query_high_risk .= " ({$experimentId}, '{$_POST['hight_risk_'.$i]}', 'высокий риск'),";
                    $query_middle_risk .= " ({$experimentId}, '{$_POST['middle_risk_'.$i]}', 'средний риск'),";
                    $query_low_risk .= " ({$experimentId}, '{$_POST['low_risk_'.$i]}', 'низкий риск'),";
                }
                else{
                    $query_high_risk .= " ({$experimentId}, '{$_POST['hight_risk_'.$i]}', 'высокий риск')";
                    $query_middle_risk .= " ({$experimentId}, '{$_POST['middle_risk_'.$i]}', 'средний риск')";
                    $query_low_risk .= " ({$experimentId}, '{$_POST['low_risk_'.$i]}', 'низкий риск')";
                }
            }
            mysqli_query($connection, $query_high_risk);
            mysqli_query($connection, $query_middle_risk);
            mysqli_query($connection, $query_low_risk);
        }

	}
    if(isset($_POST['delete_task'])){
        $experiment_id = $_POST['experiment_id'];
        $method_name = $_POST['method_name'];

        if($method_name == "Метод анализа иерархий")
        {
            $query = "DELETE FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `criterions` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `result_mah` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `experiments` WHERE `id`={$experiment_id}";
            mysqli_query($connection, $query);
        }
        elseif($method_name == "Принятие решений в условиях неопределенности"){
            $query = "DELETE FROM `utility_matrix` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `criterions` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `result_matrix_method` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `experiments` WHERE `id`={$experiment_id}";
            mysqli_query($connection, $query);
        }
        elseif($method_name == "Принятие решений в условиях риска"){
            $query = "DELETE FROM `utility_matrix` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `probabilities` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `result_risk_method` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `criterions` WHERE `experiment_id`={$experiment_id}";
            mysqli_query($connection, $query);

            $query = "DELETE FROM `experiments` WHERE `id`={$experiment_id}";
            mysqli_query($connection, $query);
        }
    }
?>