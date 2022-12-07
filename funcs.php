<?php
	function isNull ($nombre, $user, $pass, $pass_con, $email){
		if(strlen(trim($nombre)) < 1 || strlen(trim($user))< 1 || strlen (trim(
		$pass)) < 1 || strlen (trim($pass_con)) < 1 || strlen (trim($email)) < 1)
		{
			return true;
			}else {
			return false;
		}
	}
	function isEmail ($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return true;
			}else {
			return false;
		}
	}
	function validaPassword ($var1, $var2)
	{
		if(strcmp($var1, $var2) !==0 ){
			return false;
		}else{
			return true;
		}
	}
	function usuarioExiste($usuario)
	{
		global $mysqli;
		$stmt = $mysqli->prepare("SELECT id FROM registro WHERE usuario = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			}else{
			return false;
		}
	}
	function productoExiste($nprod)
	{
		global $mysqli;
		$stmt = $mysqli->prepare("SELECT id FROM producto WHERE nprod = ? LIMIT 1");
		$stmt->bind_param("s", $nprod);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			}else{
			return false;
		}
	}
	
	function emailExiste($usuario)
	{
		global $mysqli;
		$stmt = $mysqli->prepare("SELECT id FROM registro WHERE email = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			}else{
			return false;
		}
	}
	function hashPassword($password)
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	function registroUsuario($usuario,$pass_hash,$nombre,$email,$tipo_usuario)
	{
		global $mysqli;
		$stmt = $mysqli->prepare("INSERT INTO registro (usuario,password,nombre,email,id_tipo) VALUES (?,?,?,?,?)");
		
		$stmt->bind_param('ssssi',$usuario,$pass_hash,$nombre,$email,$tipo_usuario);
		if ($stmt->execute()){
			return $mysqli->insert_id;
		}else{
			return 0;
		}
	}
	function registroProducto($nprod,$marca,$medida,$precio,$stock)
	{
		global $mysqli;
		$stmt = $mysqli->prepare("INSERT INTO registro (nprod,marca,medida,precio,stock) VALUES (?,?,?,?,?)");
		
		$stmt->bind_param('sssii',$nprod,$marca,$medida,$precio,$stock);
		if ($stmt->execute()){
			return $mysqli->insert_id;
		}else{
			return 0;
		}
	}
	
?>