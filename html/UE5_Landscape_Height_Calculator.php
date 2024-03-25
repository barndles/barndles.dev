<?php include 'header.html'; ?>
<link rel="stylesheet" href="../css/style.css">

<body>
    <article>
        
        <div class='title'>
            <h1><i class='fas fa-mountain-sun'></i>  UE5 Landscape Height Calculator</h1>
        </div>
        <div class='description'>
            <p>This is a simple calculator that lets you input the real-world min and max of your heightmap, in meters, and it will output the UE5 Z scale necessary to maintain accurate proportions.</p></div>
        <div class='tool'>
            <div class=='user-input'>
                <input type="number" id="min-height" placeholder="Min Height">
            </div>
            <div class='user-input'>
                <input type="number" id="max-height" placeholder="Max Height">
            </div>
                <input class='button' type="button" value="Calculate" onclick="calculate()">
            
                <p id="height"></p>
                
                <script>
                    function calculate() {
                        var minHeight = document.getElementById("min-height").value;
                        var maxHeight = document.getElementById("max-height").value;
                        
                        heightRange = maxHeight - minHeight;
                        height = (heightRange * 100) * 0.001953125;

                        document.getElementById("height").innerHTML = height + "m";
                    }
                </script>
        
    
        </div>
    </article>
</body>