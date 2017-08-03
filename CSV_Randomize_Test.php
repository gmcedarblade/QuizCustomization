<!DOCTYPE html>
<html>
<?php
$row = 0;
if (($handle = fopen("https://www.wisc-online.com/ARISE_Files/Experimental/ReadFile/questions.csv", "r")) !== FALSE) {

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
        $num = count($data);
        $answer = $num-1;
        $row++;

        $theAnswer = $data[$answer];

        $question = $data[0];
        $answerA = $data[1];
        $answerB = $data[2];
        $answerC = $data[3];
        $answerD = $data[4];

        $_SESSION['questions'][] = array($question, $answerA, $answerB, $answerC, $answerD);


    }
//
//    echo "<br>Question: $question</br><br />";
//
//    for ($c=0; $c < $answer; $c++) {
//
//        echo "<button type='button' title='$theAnswer' id='$data[$c]' onclick='checkAnswer(this.id, this.title)'>$data[$c]</button><br />\n";
//
//    }
//
//
//    echo "<br>Answer: $data[$answer]</br>\n\n";

    shuffle($_SESSION['questions']);
    foreach($_SESSION['questions'] as $something) {
        echo "<table><tr><td>$something[0]</td></tr></table>";
    }



    fclose($handle);


}
?>
<script type="text/javascript">
    function checkAnswer(id, answer) {
//        alert("id: " + id + ", answer: " + answer);
        if(id === answer) {
            alert('Correct!');
        } else {
            alert("Incorrect!");
        }
    }
</script>
</html>
