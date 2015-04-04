<?php
	/**
	 * ������� [link type="text/css"] ���, (��� ����������, ��. ������ ��������) �������� � �������� ����� filemtime �����,
	 * ����� ������� ����������� �������� ����������� ����� ��������� �����, ����� ��� ��������.
	 * 
	 * ��� ������ � .htaccess ���������� ��������: RewriteRule ^(.*)\.[\d]{10}\.(css|js)$ $1.$2 [L]
	 * 
	 * @usage cssInc('/css/style.css');
	 * 
	 * @param string $file ���������� ���� � css �����
	 * @param boolean $return ���� �������� � �������� ����� TRUE, ������� ������ ��������� ������ ��� ������.
	 * @return void|string
	 */
	
	function cssInc($file, $return = false) {
		
		if ( empty($file) ) {
			return false;
		}
		
		if ( '/' != substr($file, 0, 1) ) {
			// ���� ����� ������������� ����
			$filePath = $_SERVER['DOCUMENT_ROOT'] . preg_replace('#([^/])+$#', '', $_SERVER['REQUEST_URI']) . $file;
		} else {
			// ���� ����� ���������� ����
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
	