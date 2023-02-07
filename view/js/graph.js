let coso = document.getElementById("graphtest1").getContext("2d");
console.log("diagrama");
var chart = new Chart(coso,{
    type:"bar",
    data:{
        labels:["1","2","3","4"],
        datasets:[
            {
                label:"Mi grafico ",
                backgroundColor:"rgb(0,0,0)",
                data:[12,23,34,45]
            }
        ]
    }
})