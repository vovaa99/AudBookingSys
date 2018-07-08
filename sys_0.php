<?php
include 'head.php';
session_start();
include 'lib/connection.php';


$date = $_SESSION['date'];
?>
<script>
    function audrequest() {
        /*var formData = {
         'room': $('input[audrequest=room]').val(),
         'date': $('input[audrequest=date]').val(),
         'lesson': $('input[audrequest=lesson]').val(),
         'email': $('input[audrequest=email]').val(),
         'faculty': $('input[audrequest=faculty]').val(),
         'prepname': $('input[audrequest=prepname]').val(),
         'aim': $('input[audrequest=aim]').val()
         };*/
        /*var room = document.getElementById("room").value; 
         var date = document.getElementById("date").value; 
         var lesson = document.getElementById("lesson").value; 
         var email = document.getElementById("email").value; 
         var prepname = document.getElementById("prepname").value; 
         var aim = document.getElementById("aim").value; */

        formData = {
            'room': document.getElementById("room").value,
            'date': document.getElementById("date").value,
            'lesson': document.getElementById("lesson").value,
            'email': document.getElementById("email").value,
            'faculty':document.getElementById("faculty").value,
            'prepname': document.getElementById("prepname").value,
            'aim': document.getElementById("aim").value
        }
        alert(formData['room']);
        $.ajax({
            type: "POST",
            url: "newAudRequest.php",
            data: formData,
            cache: false,
            success: function (html) {
                $('#error').html(html);
            }
        });
        return false;
    }
</script>
<div id="error"></div>
<p>Заявка на аудиторию room, date, lesson пара</p> 

<p>
    <label for="prepname">ФИО преподавателя
        <input class="input" id="prepname" name="prepname" type="text" value="">
    </label>
</p>
<p>
    <label for="aim">Цель
        <input class="input" id="aim" name="aim"  type="text" value="Проведение занятия">
    </label>
</p> 
<p>
    <label for="faculty">Факультет
        <input class="input" id="faculty" name="faculty"  type="text" value="Факультет">
    </label>
</p> 
<input class="input" id="lesson" name="lesson" type="text" value="lesson">
<input class="input" id="date" name="date" type="date" value="2018-07-08">  
<input class="input" id="room" name="room" type="text" value="room">  
<input class="input" id="email" name="email" type="text" value="<?php print $_SESSION['session_username']; ?>">  
<p class="submit"><input class="button" name="submit_zayavka" type="submit" value="Оставить заявку" onclick="return audrequest();"></p>



<?php
include 'footer.php';
