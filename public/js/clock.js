
      document.addEventListener('DOMContentLoaded', () => {

        //===
        // VARIABLES
        //===
        r = document.getElementById('datetime').value;
        r = r + " "+ "23:59"
        const DATE_TARGET = new Date(r);
        // DOM for render

        const SPAN_DAYS = document.querySelector('span#days');
        const SPAN_HOURS = document.querySelector('span#hours');
        const SPAN_MINUTES = document.querySelector('span#minutes');
        const SPAN_SECONDS = document.querySelector('span#seconds');
        // Milliseconds for the calculations
        const MILLISECONDS_OF_A_SECOND = 1000;
        const MILLISECONDS_OF_A_MINUTE = MILLISECONDS_OF_A_SECOND * 60;
        const MILLISECONDS_OF_A_HOUR = MILLISECONDS_OF_A_MINUTE * 60;
        const MILLISECONDS_OF_A_DAY = MILLISECONDS_OF_A_HOUR * 24

        //===
        // FUNCTIONS
        //===

        /**
        * Method that updates the countdown and the sample
        */
        function updateCountdown() {
            // Calcs
            const NOW = new Date()
            const DURATION = DATE_TARGET - NOW;
            const REMAINING_DAYS = Math.floor(DURATION / MILLISECONDS_OF_A_DAY);

            const REMAINING_HOURS = Math.floor((DURATION % MILLISECONDS_OF_A_DAY) / MILLISECONDS_OF_A_HOUR);
            const REMAINING_MINUTES = Math.floor((DURATION % MILLISECONDS_OF_A_HOUR) / MILLISECONDS_OF_A_MINUTE);
            const REMAINING_SECONDS = Math.floor((DURATION % MILLISECONDS_OF_A_MINUTE) / MILLISECONDS_OF_A_SECOND);

            if(REMAINING_DAYS <= 0){
                document.getElementById('dd').style.display = 'none';
            }
            var v=0;
            v= REMAINING_HOURS.toString().length;
            n = REMAINING_SECONDS.toString().length;
            m = REMAINING_MINUTES.toString().length;
            if (v > 1){
                document.getElementById('dig').style.display = 'none';
            }else{
                document.getElementById('dig').style.display = 'block';
            }
            if (n > 1){
                document.getElementById('digi').style.display = 'none';
            }else{
                document.getElementById('digi').style.display = 'block';
            }
            if (m > 1){
                document.getElementById('digil').style.display = 'none';
            }else{
                document.getElementById('digil').style.display = 'block';
            }
            // Render
            SPAN_DAYS.textContent = REMAINING_DAYS;
            SPAN_HOURS.textContent = REMAINING_HOURS;
            SPAN_MINUTES.textContent = REMAINING_MINUTES;
            SPAN_SECONDS.textContent = REMAINING_SECONDS;
        }

        //===
        // INIT
        //===
        updateCountdown();
        // Refresh every second
        setInterval(updateCountdown, MILLISECONDS_OF_A_SECOND);


        var r =0;
    function seleccionar(){
        if( r%2 == 0){
        document.getElementById('seleccion').style.display = "block";
        r++;
        }
        else{
        document.getElementById('seleccion').style.display = "none";
        r++;
        }
    }
    });


