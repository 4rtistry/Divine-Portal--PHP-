var modal = document.getElementById("editModal");
var btn = document.getElementById("editBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "flex";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.querySelector('#submitbtn').addEventListener('click', function(){
    const password = document.querySelector('.user_password');
    const label = document.querySelector('.labelclass');

    password.type = "password";
    label.style.display = "block";
})

document.querySelector('.uptform').addEventListener('submit', function(){
    event.preventDefault();
    const regid = document.querySelector('.regid').value;
    const passwordval = document.querySelector('.user_password').value;

    fetch('verify_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'regid=' + encodeURIComponent(regid) + '&password=' + encodeURIComponent(passwordval)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            this.submit();
        } else {
            document.querySelector('.wrongpass').style.display = 'block';
        }
    })
})

document.querySelector('.close').addEventListener('click', function(){
    const password = document.querySelector('.user_password');
    const label = document.querySelector('.labelclass');
    const wrongpass = document.querySelector('.wrongpass');

    password.type = "hidden";
    wrongpass.style.display = "none";
    label.style.display = "none";
})
;

