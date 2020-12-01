
    function showTime(){
        var time = new Date();
        document.getElementById("currentTime").innerHTML = time.toLocaleString('en-US', {hour: 'numeric' ,minute: 'numeric',second: 'numeric',  hour12:true});
        delete_past_requests();
        return true;
    }

    function showDateInfo(){
        var d = new Date();
        var days = ["Sunday" , "Monday" , "Tuesday" , "Wednesday" , "Therisday" , "Friday" , "Saturday"];
        var months = ["January" , "February" , "March" , "April" , "May" , "Jnu" , "Julai" ,"Augest" , "Sebtenber" , "October" , "November" , "December"];
        document.getElementById("day_name").innerHTML = days[d.getDay()];
        document.getElementById("date_info").innerHTML = months[d.getMonth()] + "  " + d.getDate() + "th, " + d.getFullYear();
        
        document.getElementById("day_name2").innerHTML = days[d.getDay()];
        document.getElementById("month_name").innerHTML = months[d.getMonth()];
        document.getElementById("month_name").innerHTML = months[d.getMonth()];
        document.getElementById("year_name").innerHTML = d.getFullYear();
    }

