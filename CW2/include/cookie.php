<?php
if ($_SESSION['cookie']!= TRUE){
	$_SESSION['cookie'] = TRUE;
	echo '<div id="cookie">
This site uses cookies to enable certain functions. By continuing to browse the site you are agreeing to their use.
You can learn more about cookies <a href="https://en.wikipedia.org/wiki/HTTP_cookie">here.</a>
</div>';
}
?>