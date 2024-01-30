function increaseDecreaseMark(answer, index) {
        var correctAnswer = $('#correct_answer' + index).val();
        var right = $('#right').text();
        var wrong = $('#wrong').text();

        if (answer == correctAnswer) {
            var totalRight = parseInt(right) + 1;
            $('#right').text(totalRight);
        } else {
            var totalWrong = parseInt(wrong) + 1;
            $('#wrong').text(totalWrong);
        }

        $('#mcq_1_' + index).attr('disabled', true);
        $('#mcq_2_' + index).attr('disabled', true);
        $('#mcq_3_' + index).attr('disabled', true);
        $('#mcq_4_' + index).attr('disabled', true);
        
    }

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 10000000000);