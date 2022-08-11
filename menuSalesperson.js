function displayCurrentTime() {
    var d = new Date();
    var currentTime = new Date(Date.parse(d));
    var timeObj = document.getElementById("time")
    timeObj.innerHTML = "Today is " + currentTime.toLocaleString();
    timeObj.style.color = "cornflowerblue";
    timeObj.style.fontSize = "20px";
}