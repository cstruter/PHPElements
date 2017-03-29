<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<link href="../Styles/CSTruter.Elements.min.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="../Scripts/CSTruter.Elements.min.js"></script>
	</head>
	<body>

		<?php
			echo $form->BeginTag();
			echo $control->Render(); 
		?>		
		<br/>
		<?php 
			echo $button->Render();
			echo $form->EndTag(); 
		?>
	
	</body>
</html>