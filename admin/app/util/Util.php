<?php

class Utils
{
	public static function formatCurrencyBr($vlr, $precision=2) {
		return number_format($vlr, $precision, ",", ".");
	}

	public static function formatCurrency($vlr, $precision=2, $dec_point=".", $thousands_sep="") {
		// 100.000.000.000,00 ==> 100000000000.00
		if ( !is_numeric( $vlr ) )
		{
			$vlr = str_replace(".", "", $vlr);
			$vlr = str_replace(",", ".", $vlr);
		}

		return number_format($vlr, $precision, $dec_point, $thousands_sep);
	}

	public static function formatHours($str) {
		return substr_replace($str, '', '5');
	}

	public static function addZeros($number, $n) {
		return str_pad($number, $n, "0", STR_PAD_LEFT);
	}

	public static function formatadata_sql($dt)
	{
		if ( strpbrk($dt, '-') != true )
		{
			$dia = substr($dt,0,2);
			$mes = substr($dt,3,2);
			$ano = substr($dt,6,4);
			$nova_data = $ano."-".$mes."-".$dia;
			return $nova_data;
		} else return $dt;
	}

	public static function formatadata_br($dt, $type='/')
	{
		if ( strpbrk($dt, $type) != true )
		{
			$ano = substr($dt,0,4);
			$mes = substr($dt,5,2);
			$dia = substr($dt,8,2);
			$nova_data = $dia.$type.$mes.$type.$ano;
			return $nova_data;
		} else return $dt;
	}

	public static function setFullLimit()
	{
		set_time_limit(0);
		ini_set("memory_limit", '4000M');
		ini_set("post_max_size", '2000M');
		ini_set("upload_max_filesize", '2000M');
		ini_set("max_input_time", '999999');
		ini_set("max_execution_time", '999999');
		ini_set("output_buffering", 'On');
		ini_set("mysql.timeout", '999999');
		ini_set("soap.wsdl_cache_ttl",'999999');
	}

	public static function createDir($dirName = null)
	{
		if($dirName != null) {
			if (is_dir($dirName))
			{
				@chmod($dirName, 0777);
			} else {
				@mkdir($dirName, 0777, true);
				@chmod($dirName, 0777);
			}
		}
	}

	public static function deleteDir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);

			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}

			reset($objects);
			rmdir($dir);
		}
	}

	public static function deleteFile($file) {
		unlink( $file );
	}

	public static function substituirCaracteresEspeciais($termo) {
		$caracteres_especiais = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A',
			'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A',
			'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I',
			'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O',
			'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
			'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a',
			'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a',
			'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i',
			'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o',
			'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
			'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y',
			'ƒ'=>'f');

		$termo = strtoupper(strtr($termo,$caracteres_especiais));
		$termo = preg_replace("/[^a-z]/i"," ",$termo);

		return $termo;
	}
}
