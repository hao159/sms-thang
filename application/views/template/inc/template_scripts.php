<?php
/**
 * template_scripts.php
 *
 * Author: pixelcave
 *
 * All vital JS scripts are included here
 *
 */

?>
<script>
	
 	function showTime(){
        var date = new Date();
        var h = date.getHours(); 
        var m = date.getMinutes(); 
        var s = date.getSeconds(); 
        var session = "AM";
        var monthNames = [ "tháng 1", "tháng 2", "tháng 3", "tháng 4", "tháng 5", "tháng 6", "tháng 7", "tháng 8", "tháng 9", "tháng 10", "tháng 11", "tháng 12" ]; 
        var dayNames= ["Chủ nhật","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"]

        // Create an object newDate()
        // Retrieve the current date from the Date object
        date.setDate(date.getDate());
        // At the output of the day, date, month and year    
        $('#date').html(dayNames[date.getDay()] + ", ngày " + date.getDate() + ', ' + monthNames[date.getMonth()] + ', ' + date.getFullYear());
        if(h == 0) {
            h = 12;
        }
        
        if(h > 12) {
            h = h - 12;
            session = "PM";
        }
        
        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;
        
        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("clock").innerText = time;
        document.getElementById("clock").textContent = time;
        
        setTimeout(showTime, 1000);    
    }

    $(document).ready(function() {
    	showTime();
        console.log('%c  Welcome! '+ '<?= !empty($_ENV['APP_TITLE']) ? $_ENV['APP_TITLE'] : "hao.nguyen Portal"?>', 'font-size:25px; border-radius: 2px; padding: 3px; color: #EE4B4E' );
        console.log('%c  Developer by', 'font-size:25px; border-radius: 2px; padding: 3px; color: #EE4B4E' );
        console.log('%c '+'<?= !empty($_ENV['APP_AUTHOR']) ? $_ENV['APP_AUTHOR'] : "hao.nguyen"?>' , 'margin: auto; font-size:50px;color:#EE4B4E;text-shadow:0 1px 0 #F2A8A1,0 2px 0 #F2A8A1 ,0 3px 0 #F2A8A1 ,0 4px 0 #F2A8A1 ,0 5px 0 #F2A8A1 ,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15);')
        console.log('%c    Phone: 0906 200 910 - https://haonguyen96.net/ - haonh1502@gmail.com' , 'border-radius: 2px; padding: 3px; color: #EE4B4E' );
        console.log('%c    "reproach yourself first before you reproach others" ' , 'border-radius: 2px; padding: 3px; color: #EE4B4E' );
    });
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
</script>

