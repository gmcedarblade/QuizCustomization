<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        #flexContainer {
            flex-flow: row wrap;

            margin-right: 10px;
        }
    </style>
</head>
<body id="body">
    <div id="flexContainer">
<?php
$row = 0;
if (($handle = fopen("https://www.wisc-online.com/ARISE_Files/Experimental/ReadFile/questions.csv", "r")) !== FALSE) {

    if(!isset($_SESSION['questions'])) {

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            $num = count($data);
            $answer = $num-1;
            $row++;

            $question = $data[0];
            $answerA = $data[1];
            $answerB = $data[2];
            $answerC = $data[3];
            $answerD = $data[4];
            $theAnswer = $data[$answer];

            $_SESSION['questions'][] = array($question, $answerA, $answerB, $answerC, $answerD, $theAnswer);


        }

    }

    shuffle($_SESSION['questions']);

    foreach($_SESSION['questions'] as $something) {
        echo "<h2>$something[0]</h2></>";
        echo "<button type='button' title='$something[5]' id='$something[1]' onclick='checkAnswer(this.id, this.title)'>$something[1]</button>";
        echo "<button type='button' title='$something[5]' id='$something[2]' onclick='checkAnswer(this.id, this.title)'>$something[2]</button>";
        echo "<button type='button' title='$something[5]' id='$something[3]' onclick='checkAnswer(this.id, this.title)'>$something[3]</button>";
        echo "<button type='button' title='$something[5]' id='$something[4]' onclick='checkAnswer(this.id, this.title)'>$something[4]</button>";

        break;

    }

    if(empty($_SESSION['questions'])) {
        echo "<h1>There are no more questions to answer</h1>";
    }

    unset($_SESSION['questions'][0]);
    $_SESSION['questions'] = array_values($_SESSION['questions']);
    fclose($handle);
}
?>
    </div>
    <script type="text/javascript">

        var body = document.querySelector('#body');

        var newDiv = document.createElement('div');


        function checkAnswer(id, answer) {

            if(id === answer) {
//                alert('Correct!');
                newDiv.id = 'message';
                newDiv.style.backgroundColor = 'black';
                newDiv.style.color = 'white';
                newDiv.style.position = 'absolute';
                newDiv.style.height = 150 + 'px';
                newDiv.style.width = 150 + 'px';
                newDiv.style.left = 400 + 'px';
                newDiv.style.top = 400 + 'px';
                newDiv.innerHTML = "Correct!";
                newDiv.onclick = function() {
                    var message = document.querySelector('#message');
                    body.removeChild(message);
                    window.location.reload();
                }

                body.appendChild(newDiv);

                var buttons = document.querySelectorAll('button');

                for(var i = 0; i < buttons.length; i++ ) {
                    if(buttons[i].id != answer) {
                        buttons[i].disabled = true;
                    }
                }

            } else {
//                alert("Incorrect!");
//                alert('Incorrect!');
                newDiv.id = 'message';
                newDiv.style.backgroundColor = 'black';
                newDiv.style.color = 'white';
                newDiv.style.position = 'absolute';
                newDiv.style.height = 150 + 'px';
                newDiv.style.width = 150 + 'px';
                newDiv.style.left = 400 + 'px';
                newDiv.style.top = 400 + 'px';
                newDiv.innerHTML = "Incorrect!";
                newDiv.onclick = function() {
                    var message = document.querySelector('#message');
                    body.removeChild(message);

                }

                body.appendChild(newDiv);

                document.getElementById('' + id).disabled = true;
            }


        }
    </script>
</body>
</html>
