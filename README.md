# cssInc
PHP function for including css files with filemtime stamp

Usage is simple as:

    <?php
      cssInc('css/style.css');
      // or
      echo cssInc('css/style.css', true);
    ?>

Which will output:

    <link href="css/style.1421404145.css" rel="stylesheet" type="text/css" />

where 1421404145 if file mtime stamp. Keeping sure changes will miss browser cache.

The following rule should be added to apache .htaccess file:

    # apache confiruration
    <IfModule mod_rewrite.c>
	    Options +FollowSymLinks
	    RewriteEngine On
        RewriteRule ^(.*)\.[\d]{10}\.(css|js)$ $1.$2 [L]
    </IfModule>

or to ngingx nginx.conf file:

    # nginx configuration
    location / {
        rewrite "^/(.*)\.[\d]{10}\.(css|js)$" /$1.$2 break;
    }
