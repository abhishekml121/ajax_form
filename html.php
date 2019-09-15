<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Ajax form </title>
</head>
<!-- body-------------------------  -->
<body>
	<main>
		<div>
			<!-- form-------------------------  -->
			<form action="process_form.php">
				<div class="name_div">
					<label for="f_name">
						Name
					</label>
					<input type="text" id="f_name" name="f_fname">
				</div>

				<div class="email_div">
					<label for="email">
						Email
					</label>
					<input type="text" id="email" name="email">
				</div>

				<div class="paswd">
					<label for="paswd">
						Password
					</label>
					<input type="password" id="paswd" name="paswd">
				</div>
				
			</form>
		</div>
	</main>


	<!-- JAVASCRIPT----------------------  -->
	<script>
	function showHint(str) {
	if (str.length == 0) {
	document.getElementById("txtHint").innerHTML = "";
	return;
	} else {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	document.getElementById("txtHint").innerHTML = this.responseText;
	}
	};
	xmlhttp.open("GET", "gethint.php?q=" + str, true);
	xmlhttp.send();
	}
	}
	</script>
</body>
</html>