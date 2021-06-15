<?php
	/**
	 * Выводит [link type="text/css"] тег, (или возвращает, см. второй параметр) добавляя в название файла filemtime метку,
	 * таким образом обеспечивая загрузку актуального после изменений файла, минуя кеш браузера.
	 * 
	 * Для работы в .htaccess необходимо добавить: RewriteRule ^(.*)\.[\d]{10}\.(css|js)$ $1.$2 [L]
	 * 
	 * @usage cssInc('/css/style.css');
	 * 
	 * @param string $file Абсолютный путь к css файлу
	 * @param boolean $return Если передано и значение равно TRUE, функция вернет результат вместо его вывода.
	 * @return string $htmlCode
	 * @author dima@foreline.ru
	 */
	
	function cssInc(string $file, bool $return = false): string
	{
		
		if ( empty($file) ) {
			return false;
		}
		
		if ( '/' != substr($file, 0, 1) ) {
			// Если задан относительный путь
			$filePath = $_SERVER['DOCUMENT_ROOT'] . preg_replace('#([^/])+$#', '', $_SERVER['REQUEST_URI']) . $file;
		} else {
			// Если задан абсолютный путь
			$filePath = $_SERVER['DOCUMENT_ROOT'] . $file;
		}
		
		$fileSrc = str_replace('.css', '.' . filemtime($filePath) . '.css', $file);
		
		$output = '<link href="' . $fileSrc . '" rel="stylesheet" type="text/css" />' . "\n";
		
		if ( $return ) {
			return $output;
		} else {
			echo $output;
		}
	}
	
