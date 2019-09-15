<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Ajax Form </title>
    <link rel="stylesheet" href="./form.css">
</head>
<!-- body-------------------------  -->

<body>
    <main>
        <header>
            From validation using PHP AJAX and JSON
        </header>
        <div>

            <!-- form-------------------------  -->
            <form action="" method="post">
                <div class="name_div">
                    <label for="f_name">
                        Name
                    </label><span class="error"></span>
                    <input type="text" id="f_name" name="f_name">
                </div>

                <div class="email_div">
                    <label for="email">
                        Email
                    </label><span class="error"></span>
                    <input type="email" id="email" name="email">
                </div>

                <div class="paswd_div">
                    <label for="paswd">
                        Password
                    </label><span class="error"></span>
                    <input type="password" id="paswd" name="paswd">
                </div>

                <div class="submit_div">
                    <button id="submit" name="submit_btn">Submit</button>
                </div>

            </form>
        </div>
    </main>


    <!-- JAVASCRIPT----------------------  -->
    <script>
        let all_input = document.querySelectorAll('form input');
        let length = all_input.length;
        let submit_btn = document.getElementById('submit');
        let error = document.querySelectorAll('form .error');
        submit_btn.disabled = true;

        function showHint(e) {
            let error_block = e.target.parentElement.children[1];
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "process_form.php", true);
            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


/* WHAT IS --
onreadystatechange
	Defines a function to be called when the readyState property changes.

readyState
	Holds the status of the XMLHttpRequest. 
	0: request not initialized 
	1: server connection established
	2: request received 
	3: processing request 
	4: request finished and response is ready
status
	200: "OK"
	403: "Forbidden"
	404: "Page not found"
*/
            xhr.onreadystatechange = function() {

                if (xhr.readyState == 4 && xhr.status == 200) {
                    var j = show_json(xhr.responseText);

                    document.getElementById(e.target.id).style.borderColor = j.color;
                    error_block.style.color = j.color;
                    error_block.innerHTML = j.error;
                    if (j.error != 'good') {
                        submit_btn.disabled = true;
                    } else {
                        enable_submit_btn();
                    }
                };

            }
            /* Sending the request */
            xhr.send('value=' + e.target.value + '&name=' + e.target.getAttribute('name'));
        }

        /* It converts the text values which is returned by the server into JSON */
        function show_json(data) {
            var jsonn = JSON.parse(data);
            return jsonn;
        }

        /* If all there is no error then Enable submit button else keep it disabled */
        function enable_submit_btn() {
            for (let i = 0; i < length; i++) {
                if (error[i].innerText != 'good') {
                    submit_btn.disabled = true;
                    break;
                }

                if (all_input[i].value.length >= 4) {
                    submit_btn.disabled = false;
                } else {
                    submit_btn.disabled = true;
                    break;
                    //break;
                }

            }
        }

        for (let i = 0; i < length; i++) {
            all_input[i].addEventListener('keyup', function(e) {
                showHint(e);
            }, false);
        }
    </script>
</body>

</html>