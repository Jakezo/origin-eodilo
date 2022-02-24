let CurrentDate = "";
let CurrentTime = "";

let DiffDate = "";
let DiffTime = "";

let Ctime;
let Cyear;
let Cmonth;
let Cdate;
let Chour;
let Cminutes;
let Cseconds;

function StringTime( val ){
    if( val ) {
        return ("0" + val.toString()).slice(-2);
    } else {
        return "";
    }
}

function getTime(){
    Ctime = new Date();
    Cyear = Ctime.getFullYear();
    Cmonth = Ctime.getMonth() + 1;
    Cdate = Ctime.getDate();
    Chour = Ctime.getHours();
    Cminutes = Ctime.getMinutes();
    Cseconds = Ctime.getSeconds();

    Cmonth = StringTime( Cmonth );
    Cdate = StringTime( Cdate );
    Chour = StringTime( Chour );
    Cminutes = StringTime( Cminutes );
    Cseconds = StringTime( Cseconds );

    CurrentDate = Cyear + "-" + Cmonth + "-" + Cdate;
    CurrentTime = Chour + ":" + Cminutes + ":" + Cseconds;

    return Cyear + "-" + Cmonth + "-" + Cdate + " " + Chour + ":" + Cminutes + ":" + Cseconds;
}

function getTimeDiff( Sdate, DiffType, DiffVal ) {

    let Dtime = new Date(Sdate);
    DiffVal = parseInt(DiffVal);
    
    console.log("----현재 " + Dtime);
    console.log("날자" + Dtime.getDate());

    if( DiffType == "Y" ) {
        Dtime.setYear(Sdate.getFullYear() + DiffVal);
    } 
    console.log(DiffVal + "----변경후 Y" + Dtime);

    if( DiffType == "M" ) {
        Dtime.setMonth(Sdate.getMonth() + DiffVal);
        Dtime.setDate(Sdate.getDate() - 1);
        Dtime.setMinutes(Sdate.getMinutes() - 5);
    }
    console.log(DiffVal + "----변경후 M" + Dtime);

    if( DiffType == "D" ) {
        console.log("이렇게 바꿀예정----" + (Sdate.getDate() + DiffVal));
        Dtime.setDate(Sdate.getDate() + DiffVal);
        //Dtime.setMinutes(Dtime.getMinutes() - 5);
    }
    console.log(DiffVal + "----변경후 D" + Dtime);

    if( DiffType == "H" ) {
        Dtime.setHours(Sdate.getHours() + DiffVal);
        Dtime.setMinutes(Sdate.getMinutes() - 5);
    }
    console.log(DiffVal + "----변경후 H" + Dtime);

    if( DiffType == "I" ) {
        Dtime.setMinutes(Sdate.getMinutes() + DiffVal - 5);
    }
    console.log(DiffVal + "----변경후 I" + Dtime);


    if( DiffType == "S" ) {
    }
    
    console.log(DiffVal + "----변경후 S" + Dtime);

    let Dyear = Dtime.getFullYear();
    let Dmonth = Dtime.getMonth() + 1;
    let Ddate = Dtime.getDate();
    let Dhour = Dtime.getHours();
    let Dminutes = Dtime.getMinutes();
    let Dseconds = "00";

    DiffDate = Dyear + "-" + Dmonth + "-" + Ddate;
    DiffTime = Dhour + ":" + Dminutes + ":" + Dseconds;


    Dmonth = StringTime( Dmonth );
    Ddate = StringTime( Ddate );
    Dhour = StringTime( Dhour );
    Dminutes = StringTime( Dminutes );
    Dseconds = StringTime( Dseconds );

    DiffDate = Dyear + "-" + Dmonth + "-" + Ddate;
    DiffTime = Dhour + ":" + Dminutes + ":" + Dseconds;

    console.log("1변경시간:" + DiffDate + " " + DiffTime);
    return DiffDate + " " + DiffTime;

}


$(document).ready(function ()
{
    console.log("시간실행1111");
    setInterval(function()
    {
       $("#topTimer").html(getTime());
       console.log("시간실행");
    },1000);
});
