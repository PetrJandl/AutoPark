<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>AutoPark - pro touchscreen</title>
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

  </head>
  <body>

    <div id="app" v-cloak>

    <div id="clock">
        <span class="date">{{ date }}</span>
        <span class="time">{{ time }}</span>
    </div>

    <h2 class="vyberAutoNadpis">Stav autoparku a rezervací</h2>

    <div class="row vyberAuto">

        <label for="red" v-if="checkedTealCar == '' && checkedWhiteCar == ''" id="redCarCase" class="cell-sm-4 cell-md-4 cell-lg-4 " @click="btnCar('redL')">
            <input type='checkbox' id="red" value="red" v-model='cars' @change='updateCheck()' />
            <div id="redL" class="cell-12 button outline large car">
                <span class="mif-automobile mif-6x fg-red" v-if="lockedRedCar==''"></span>
                <span class="mif-key fg-red" v-if="lockedRedCar!=''"></span> {{ lockedRedCar }}
            </div>
        </label>
        <div v-if="checkedTealCar != '' || checkedWhiteCar != ''" class="cell-sm-4 cell-md-4 cell-lg-4 ">&nbsp;</div>

        <label v-if="checkedRedCar == '' && checkedWhiteCar == ''" id="tealCarCase" class="cell-sm-4 cell-md-4 cell-lg-4 " @click="btnCar('tealL')">
            <input type='checkbox' id="teal" value="teal" v-model='cars' @change='updateCheck()' />
            <div id="tealL" for="teal" class="cell-12 button outline large car">
                <span class="mif-automobile mif-6x fg-teal" v-if="lockedTealCar==''"></span>
                <span class="mif-key fg-teal" v-if="lockedTealCar!=''"></span> {{ lockedTealCar }}
            </div>
        </label>
        <div v-if="checkedRedCar != '' || checkedWhiteCar != ''" class="cell-sm-4 cell-md-4 cell-lg-4 ">&nbsp;</div>

        <label v-if="checkedRedCar == '' && checkedTealCar == ''" id="whiteCarCase" class="cell-sm-4 cell-md-4 cell-lg-4 " @click="btnCar('whiteL')">
                <input type='checkbox' id="white" value="white" v-model='cars' @change='updateCheck()' />
                <div id="whiteL" for="white" class="cell-12 button outline large car">
                    <span class="mif-automobile mif-6x fg-white" v-if="lockedWhiteCar==''"></span>
                    <span class="mif-key fg-white" v-if="lockedWhiteCar!=''"></span> {{ lockedWhiteCar }}
                </div>
        </label>
        <div v-if="checkedRedCar != '' || checkedTealCar != ''" class="cell-sm-4 cell-md-4 cell-lg-4 ">&nbsp;</div>

    </div>

    <div v-if="checkedRedCar || checkedTealCar || checkedWhiteCar">
    <h2 v-if="checkedRedCar || checkedTealCar || checkedWhiteCar">
        Klíče od
        <span v-if="checkedRedCar" class="fg-red">červeného</span>
        <span v-if="checkedTealCar" class="fg-teal">modrozeleného</span>
        <span v-if="checkedWhiteCar" class="fg-white">bílého</span>
        vozidla si bere?</h2>
    <div class="row">
    <?php
        $drivers=array(
            0 => array("name"=>"zam01",		"label"=>"zam01Label",		"text" => "Zaměstnanec 01"),
            1 => array("name"=>"zam02",		"label"=>"zam02Label",		"text" => "Zaměstnanec 02"),
            2 => array("name"=>"zam03",		"label"=>"zam03Label",		"text" => "Zaměstnanec 03"),
            3 => array("name"=>"zam04",		"label"=>"zam04Label",		"text" => "Zaměstnanec 04"),
            4 => array("name"=>"zam05",		"label"=>"zam05Label",		"text" => "Zaměstnanec 05"),
            5 => array("name"=>"zam06",		"label"=>"zam06Label",		"text" => "Zaměstnanec 06"),
            6 => array("name"=>"zam07",		"label"=>"zam07Label",		"text" => "Zaměstnanec 07"),
            7 => array("name"=>"zam08",		"label"=>"zam08Label",		"text" => "Zaměstnanec 08"),
            8 => array("name"=>"zam09",	"label"=>"zam09Label",		"text" => "Zaměstnanec 09"),
            9 => array("name"=>"zam10",	"label"=>"zam10Label",		"text" => "Zaměstnanec 10"),
            10 => array("name"=>"zam11",	"label"=>"zam11Label",		"text" => "Zaměstnanec 11"),
            11 => array("name"=>"zam12",	"label"=>"zam12Label",		"text" => "Zaměstnanec 12"),
        );
        
        
        function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
            $sort_col = array();
            foreach ($arr as $key=> $row) {
                $sort_col[$key] = $row[$col];
            }
            
            array_multisort($sort_col, $dir, $arr);
        }
        
        
        array_sort_by_column($drivers, 'order');
        
        
        
        foreach($drivers as $i => $driver){
            ?>

        <input type="checkbox" id="<?=$driver['name']?>" v-model="people" value="<?=$driver['name']?>" />
        <label id="<?=$driver['label']?>" for="<?=$driver['name']?>" class="cell-sm-4 cell-md-4 cell-lg-3 button outline large" @click="btnPeople('<?=$driver['text']?>')"><?=$driver['text']?></label>


        <?php
        }
        
        ?>

    </div>
    </div>


    <div v-if="!checkedRedCar && !checkedTealCar && !checkedWhiteCar">
    <h2>Rezervace - dnes</h2>
    <div class="row">
        <div class="cell-sm-4 cell-md-4 cell-lg-4 ">
            <div class="cell-12 button outline large">
                8:00&nbsp;&nbsp;&nbsp;&nbsp;
                    <span  v-if="(hour >= 7 && hour <= 11)" class="mif-truck fg-red ani-pass">&nbsp;&nbsp;</span>
                    <span  v-if="(hour < 7 || hour > 11)" class="mif-truck fg-red">&nbsp;&nbsp;</span>
                10:00 Kavárna
            </div>
        </div>

        <div class="cell-sm-4 cell-md-4 cell-lg-4 ">
            <div id="redL" class="cell-12  outline large">

            </div>
        </div>

        <div class="cell-sm-4 cell-md-4 cell-lg-4 ">
            <div class="cell-12 button outline large">
                10:00&nbsp;&nbsp;&nbsp;&nbsp;
                    <span  v-if="(hour >= 10 && hour <= 17)" class="mif-truck fg-white ani-pass">&nbsp;&nbsp;</span>
                    <span  v-if="(hour < 10 || hour > 17)" class="mif-truck fg-white">&nbsp;&nbsp;</span>
                16:00 Zaměstnanec 02
            </div>
        </div>
    </div>
    <h3>Rezervace - zítra</h3>
    <div class="row">
        <div class="cell-sm-4 cell-md-4 cell-lg-4 ">
            <div class="cell-12 button outline large">
                7:14&nbsp;&nbsp;&nbsp;&nbsp; <span class="mif-lock fg-red">&nbsp;&nbsp;</span> 16:14 Zaměstnanec 04
            </div>
        </div>

        <div class="cell-sm-4 cell-md-4 cell-lg-4 ">
            <div id="redL" class="cell-12  outline large">

            </div>
        </div>

        <div class="cell-sm-4 cell-md-4 cell-lg-4 ">
            <div id="redL" class="cell-12  outline large">

            </div>
        </div>
    </div>

    </div>

</div>


<script src="/js/run.js"></script>


  </body>
</html>
