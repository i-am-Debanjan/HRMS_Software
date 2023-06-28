var myDate = new Date();
var hrs = myDate.getHours();
var greet;

if (hrs < 12)
    greet = '<i class="fas fa-coffee"></i> Good Morning';
else if (hrs >= 12 && hrs < 17)
    greet = '<i class="fas fa-sun"></i> Good Afternoon';
else if (hrs >= 17 && hrs <= 24)
    greet = '<i class="fas fa-moon"></i> Good Evening';

document.getElementById('greetings').innerHTML = '<b>' + greet + '</b>';