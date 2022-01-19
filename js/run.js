var app = new Vue({
    el: '#app',
    data: {
        carsdata: ["red","teal","white"],
        cars: [],
        people: [],
        checkedCar: '',
        checkedRedCar: false,
        checkedTealCar: false,
        checkedWhiteCar: false,
        lockedRedCar: '',
        lockedTealCar: 'Zaměstnanec 04',
        lockedWhiteCar: '',
        time: '',
        date: '',
        hour: 0
    },
    mounted: function () {
        Metro.init();
        //console.log("kuku");
    },
    methods: {
     updateCheck: function(){
           for (var key in this.cars) {


                if ( this.cars[key] == "red" && this.lockedRedCar!="" ){
                    this.lockedRedCar = "";
                    this.checkedRedCar = false;
                    document.getElementById(this.cars[key]).checked = false;
                    this.cars = [];
                }

                if ( this.cars[key] == "teal" && this.lockedTealCar!="" ){
                    this.lockedTealCar = "";
                    this.checkedTealCar = false;
                    document.getElementById(this.cars[key]).checked = false;
                    this.cars = [];
                }

                if ( this.cars[key] == "white" && this.lockedWhiteCar!="" ){
                    this.lockedWhiteCar = "";
                    this.checkedWhiteCar = false;
                    document.getElementById(this.cars[key]).checked = false;
                    this.cars = [];
                }



                if ( this.cars[key] == "red"){
                    this.checkedRedCar = true;
                    return;
                }else{
                    this.checkedRedCar = false;
                }
                if ( this.cars[key] == "teal"){
                    this.checkedTealCar = true;
                    return;
                }else{
                    this.checkedTealCar = false;
                }
                if ( this.cars[key] == "white"){
                    this.checkedWhiteCar = true;
                    return;
                }else{
                    this.checkedWhiteCar = false;
                }


            }

     },
     btnCar: function($barva) {


       //$( "input[name='redn']" ).next().removeClass("bg-gray fg-black");
       //$( "input[name='tealn']" ).next().removeClass("bg-gray fg-black");
       //$( "input[name='whiten']" ).next().removeClass("bg-gray fg-black");


       //$( "#" + $barva).addClass("bg-red fg-black");
       //console.log("kuku" + $barva);

     },
     btnPeople: function($people) {

            //$( "input[name='peopleName']" ).next().removeClass("bg-gray fg-black");
            //$( "#" + $people).addClass("bg-gray fg-black");

            if(this.checkedRedCar){ this.lockedRedCar=$people;  }
            if(this.checkedTealCar){ this.lockedTealCar=$people;    }
            if(this.checkedWhiteCar){ this.lockedWhiteCar=$people;    }


            //console.log("kuku" + $people);

            this.checkedRedCar=false;
            this.checkedTealCar=false;
            this.checkedWhiteCar=false;

            this.cars = [];

            //this.people=[];

            //console.log("cars:" +this.cars + " checkedRedCar:" + this.checkedRedCar + " people:" +  this.people);



     }
   }
});



var week = ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'];
var timerID = setInterval(updateTime, 1000);
updateTime();
function updateTime() {
    var cd = new Date();
    app.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
    app.hour = cd.getHours();
    app.date =
        week[cd.getDay()]
        + ' ' +
        zeroPadding(cd.getDate(), 2)
        + '.' +
        zeroPadding(cd.getMonth()+1, 2)
        + '.' +
        zeroPadding(cd.getFullYear(), 4)
        ;
};

function zeroPadding(num, digit) {
    var zero = '';
    for(var i = 0; i < digit; i++) {
        zero += '0';
    }
    return (zero + num).slice(-digit);
}
