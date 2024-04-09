<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include '/var/www/html/html/header.html'; ?>
</head>
<body>
    <article> 
        
        <div class='title'>
            <h1><object data="../images/tomato.svg" class="icon" width="30" height="30"></object></i>  Pomodoro Timer</h1>
        </div>
<!--         <div class='description'>
            <p>This is a simple Pomodoro timer that alternates between intervals of 25 minutes of working, and 5 minutes of relaxing. After 5 breaks, you get one long break, which is 25 minutes. For many people, it can help with focus issues, particularly those with ADHD.</p></div> -->

            <p class = "timer" id="timer"><b>25:00</b></p>
            <p class = "timer state" id="state"><b>Work</b></p>

        <div class='flexh'>
            <input class='button' type="button" value="Start Timer" onclick="StartPomodoro()">
            <input class='button stop' type="button" value="Stop Timer" onclick="StopPomodoro()">
            <input class='button configure' type="button" value="Customize" onclick="CustomizePomodoro()">
        </div>
        <div class='tool customizer'>

            <div class=='user-input'>
                <input type="number" id="work-time" placeholder="Work time">
            </div>
            <div class='user-input'>
                <input type="number" id="short-break-time" placeholder="Short Break time">
            </div>
            <div class='user-input'>
                <input type="number" id="long-break-time" placeholder="Long Break time">
            </div>
            <input class='button confirm' type="button" value="Confirm" onclick="SaveSettings()">
            <input class='button cancel' type="button" value="Cancel" onclick="CustomizePomodoro()">
        </div>
        <audio>
            <source src="../audio/chime.mp3" type="audio/mpeg">
        </audio>
    </article>

    <script>
        var worktime = 0.05;
        var shortbreak = 5;
        var longbreak = 15;
        var currentTimer = -1;
        var breakCount = 1;

        const chime = document.querySelector("audio");

        function CustomizePomodoro() {
            // Toggle customization field visibility
            settings = document.querySelector(".customizer");
            if (settings.style.display == "block") {
                settings.style.display = "none";
            } else {
                settings.style.display = "block";
            }
        }
        function SaveSettings() {
            // Save settings to variables
            worktime = document.getElementById("work-time").value;
            shortbreak = document.getElementById("short-break-time").value;
            longbreak = document.getElementById("long-break-time").value;
            CustomizePomodoro();
        }
        function StartPomodoro() {
            var state = document.getElementById("state");
            chime.pause();
            chime.currentTime = 0;
            var timerClass = document.getElementsByClassName("timer");

            //onStart
            clearInterval(window.interval);
            timerClass[0].classList.remove("flash");
            currentTimer +=1;
            chime.loop = true;
            
            if (breakCount % 5 == 0 && breakCount != 0){
                console.log("longbreak")
                console.log(currentTimer);
                console.log(currentTimer % 5);
                breakCount += 1;
                var time = longbreak * 60;
                var minutes;
                var seconds;
                var interval = setInterval(function() {
                    minutes = parseInt(time / 60);
                    seconds = parseInt(time % 60);
                    
                    minutes = minutes < 10 ? "0" + minutes : minutes; // If minutes < 10
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    
                    state.innerHTML = "<b>Long Break</b>";
                    timer.innerHTML = "<b>" + minutes + ":" + seconds + "</b>";
                
                    if (--time < 0) { // If time is less than 0, stop the timer
                        clearInterval(interval);
                        timer.innerHTML = "00:00";
                        chime.play();
                    }
                }, 1000);


            } else if (currentTimer % 2 == 0) {
                console.log("worktime");
                console.log(currentTimer);
                console.log(currentTimer % 2);
                breakCount += 1;
                var time = worktime * 60;
                var minutes;
                var seconds;
                window.interval = setInterval(function() {
                    minutes = parseInt(time / 60);
                    seconds = parseInt(time % 60);

                    minutes = minutes < 10 ? "0" + minutes : minutes; // If minutes < 10
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    state.innerHTML = "<b>Work</b>";
                    timer.innerHTML = "<b>" + minutes + ":" + seconds + "</b>";


                    if (--time < 0) { // If time is less than 0, stop the timer
                        clearInterval(interval);
                        timer.innerHTML = "<b>00:00</b>";
                        chime.play();
                        timer.classList.add("flash");
                    }
            }, 1000);


            } else if (currentTimer % 2 == 1) {
                console.log("shortbreak")
                console.log(currentTimer);
                console.log(currentTimer % 2);
                var time = shortbreak * 60;
                var minutes;
                var seconds;
                window.interval = setInterval(function() {
                    minutes = parseInt(time / 60);
                    seconds = parseInt(time % 60);

                    minutes = minutes < 10 ? "0" + minutes : minutes; // If minutes < 10
                    seconds = seconds < 10 ? "0" + seconds : seconds;


                    state.innerHTML = "<b>Short Break</b>";
                    timer.innerHTML = "<b>" + minutes + ":" + seconds + "</b>";

                    if (--time < 0) { // If time is less than 0, stop the timer
                        clearInterval(interval);
                        timer.innerHTML = "00:00";
                        chime.play();
                    }
            }, 1000);
            }

        }
        function StopPomodoro() {
            clearInterval(window.interval);
        }

    </script>

</body>
</html>