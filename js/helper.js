function charcountupdate(str){
    let count = str.length; //kui pikk on nimi vormil
    if(count<=20){
        document.getElementById("info").innerText = count + " märki 20-st";
    }else {
        document.getElementById("name").value = str.substring(0,20);
    }
}