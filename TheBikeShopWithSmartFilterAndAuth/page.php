<?php
if (isset($_COOKIE["auth_token"]))
{
    echo '
    <h1">PAGE</h1>
    <input type="text" id="myInput">  
    <button onclick="onClick()">---</button>  
    <ul id="myUl"></ul>
    <script>
        function onClick() {
            var myInput = document.getElementById("myInput").value
            var myUl = document.getElementById("myUl")
            myUl.innerHTML += "<li>" + myInput + "</li>"
            //var li = document.createElement("li")
            //li.textContent = myInput
            //myUl.appendChild(li)
        }
    </script>
    ';
}
else
{
    header("Location: index.php");
    exit;
}
?>