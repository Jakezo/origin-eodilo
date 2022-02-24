function getTime(){
    let time = new Date();
    let year = time.getFullYear()
    let month = time.getMonth() + 1;
    let day = time.getDay();
    let hour = time.getHours();
    let minutes = time.getMinutes();
    let seconds = time.getSeconds();

    month = ("0" + month.toString()).slice(-2);
    day = ("0" + day.toString()).slice(-2);
    hour = ("0" + hour.toString()).slice(-2);
    minutes = ("0" + minutes.toString()).slice(-2);
    seconds = ("0" + seconds.toString()).slice(-2);

    return year +"-" + month + "-"+day + " " + hour +":" + minutes + ":"+seconds;
}


$(document).ready(function ()
{
    setInterval(function()
    {
       $("#topTimer").html(getTime());
    },1000);
});
