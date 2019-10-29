<?php

/* ОБЩИЕ ФУНКЦИИ SQL */
// Получение значения столбца по уникальному значению другого столбца (SELECT * FROM * WHERE). Возвращает значение параметра в найденном столбце, а в случае отсутствия значения в исходном столбце, возвращает 'NO_VALUE'
function select_from_where($connection, $table, $initial_column, $initial_type, $initial_value, $result_column)	{
	$query = 'SELECT ' . $result_column . ' FROM ' . $table . ' WHERE ' . $initial_column . ' = ?';
	$stmt = $connection -> prepare($query);
	$stmt -> bind_param($initial_type, $initial_value);
	$stmt -> execute();
	$stmt -> store_result();
	$rows_count = $stmt -> num_rows;
	$stmt -> bind_result($result_value);
	$stmt -> fetch();
	if ($rows_count == 0)	{$result_value = 'NO_VALUE';} // Запрос не дал результата.
	$stmt -> close();
	return $result_value;
}
// Установление значения столбца по уникальному значению другого столбца (UPDATE * SET * WHERE). Возвращает количество изменённых строк.
function update_set_where($connection, $table, $initial_column, $initial_type, $initial_value, $result_column, $result_type, $result_value)	{
	$query = 'UPDATE ' . $table . ' SET ' . $result_column . ' = ? WHERE ' . $initial_column . ' = ?';
	$stmt = $connection -> prepare($query);
	$stmt -> bind_param($result_type . $initial_type, $result_value, $initial_value);
	$stmt -> execute();
	$rows_count = $stmt -> affected_rows;
	$stmt -> close();
	return $rows_count; // Если 0, то запрос не дал результата.
}
// Установление текущей даты/времени по уникальному значению другого столбца (UPDATE * SET * WHERE). Возвращает количество изменённых строк.
function update_set_now_where($connection, $table, $initial_column, $initial_type, $initial_value, $result_column)	{
	$query = 'UPDATE ' . $table . ' SET ' . $result_column . ' = NOW() WHERE ' . $initial_column . ' = ?';
	$stmt = $connection -> prepare($query);
	$stmt -> bind_param($initial_type, $initial_value);
	$stmt -> execute();
	$rows_count = $stmt -> affected_rows;
	$stmt -> close();
	return $rows_count; // Если 0, то запрос не дал результата.
}

?>
