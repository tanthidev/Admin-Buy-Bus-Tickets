<?php 
    $date = date_format(date_create($_GET['date']),"Y-m-d");
    $time = $_GET['time'];
    $data = $database -> getReference("Tickets") -> getValue();
    $seats = array();
    foreach($data as $item){
      if(($item['date']==$date)&&($time==$item['time'])){
          foreach($item['seat'] as $seat){
              array_push($seats, $seat);
          }
      }
    }

    $times = $database -> getReference("Time") -> getValue();

?>

<div id="main" class="main-content flex-1 mt-12 md:mt-2 pb-24 md:pb-5">

  <div class="bg-gray-800 pt-3">
      <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
          <h1 class="font-bold pl-2">Detail Bus</h1>
      </div>
  </div>
  
  <div class="flex">
    <div class="calendar">
      <div class="min-h-screen antialiased sans-serif">
        <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
          <form action="/busdetail.php" method="GET" class="container flex mx-auto px-4 py-2 md:py-10">
            <div class="mb-5 w-64">
              <label for="datepicker" class="font-bold mb-1 text-gray-200 block">Select Date</label>
              <div class="relative">
                <input type="hidden" name="date" x-ref="date" :value="datepickerValue" />
                <input value="<?php $_GET['date'] ?>" type="text" x-on:click="showDatepicker = !showDatepicker" x-model="datepickerValue" x-on:keydown.escape="showDatepicker = false" class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50" placeholder="Select date" readonly />
      
      
                <div class="absolute top-0 right-0 px-3 py-2">
                  <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
      
                <!-- <div x-text="no_of_days.length"></div>
                  <div x-text="32 - new Date(year, month, 32).getDate()"></div>
                  <div x-text="new Date(year, month).getDay()"></div> -->
      
                <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0" style="width: 17rem" x-show.transition="showDatepicker" @click.away="showDatepicker = false">
                  <div class="flex justify-between items-center mb-2">
                    <div>
                      <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                      <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                    </div>
                    <div>
                      <button type="button" class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full" @click="if (month == 0) {
                              year--;
                              month = 12;
                            } month--; getNoOfDays()">
                        <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                      </button>
                      <button type="button" class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full" @click="if (month == 11) {
                              month = 0; 
                              year++;
                            } else {
                              month++; 
                            } getNoOfDays()">
                        <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                      </button>
                    </div>
                  </div>
      
                  <div class="flex flex-wrap mb-3 -mx-1">
                    <template x-for="(day, index) in DAYS" :key="index">
                      <div style="width: 14.26%" class="px-0.5">
                        <div x-text="day" class="text-gray-800 font-medium text-center text-xs"></div>
                      </div>
                    </template>
                  </div>
      
                  <div class="flex flex-wrap -mx-1">
                    <template x-for="blankday in blankdays">
                      <div style="width: 14.28%" class="text-center border p-1 border-transparent text-sm"></div>
                    </template>
                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                      <div style="width: 14.28%" class="px-1 mb-1">
                        <div @click="getDateValue(date)" x-text="date" class="cursor-pointer text-center text-sm rounded-full leading-loose transition ease-in-out duration-100" :class="{
                            'bg-indigo-200': isToday(date) == true, 
                            'text-gray-600 hover:bg-indigo-200': isToday(date) == false && isSelectedDate(date) == false,
                            'bg-indigo-500 text-white hover:bg-opacity-75': isSelectedDate(date) == true 
                          }"></div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
            </div>
            <div class="ml-3">
                  <label for="datepicker" class="font-bold mb-1 text-gray-200 block">Time:</label>
                  
                  <select value="<?php $_GET['time'] ?>" name="time" id="time" class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50>">
                      <?php 
                          foreach($times as $time){
                            if($time == $_GET['time']){
                              echo '
                                <option value="'.$time.'"selected>'.$time.'</option>
                              ';
                            } else{
                                echo '
                                <option value="'.$time.'">'.$time.'</option>
                                ';
                            }
                          }
                      ?>
                  </select>
            </div>
            <div class="ml-6"> 
              <input type="submit" value="Check" class="inline-block px-4 py-2 text-white mt-7 font-semibold border-2 bg-gray-500 border-gray-500 rounded-md hover:bg-gray-700 hover:text-white hover:border-gray-700 focus:outline-none focus:ring focus:ring-gray-100 cursor-pointer">
              
            </div>
          </form>
      </div>
    </div>
    
  </div>
  <div class="bus py-5 mt-6 ml-24">
      <div class="bus-seats left">
          <div class="bus-row row-1" id="inside_bus">
              <div id="Left_window" class="col-md-2 col-sm-2" style="top:30px";>
                <?php 
                // Seat A
                  for($i=1 ; $i<=20; $i++){
                    if($i<10){
                      $numseat = "A0".$i;
                    } else {
                      $numseat = "A".$i;
                    }
  
                    if(in_array($numseat, $seats)){
                      echo '<div class="seat seat-disaple">'.$numseat.'</div>';
                    } else {
                      echo '<div class="seat">'.$numseat.'</div>';
                    }
                  }
  
                  // Seat B
                  for($i=1 ; $i<=20; $i++){
                    if($i<10){
                      $numseat = "B0".$i;
                    } else {
                      $numseat = "B".$i;
                    }
  
                    if(in_array($numseat, $seats)){
                      echo '<div class="seat seat-disaple">'.$numseat.'</div>';
                    } else {
                      echo '<div class="seat">'.$numseat.'</div>';
                    }
  
  
                  }
                ?>
                  
              </div>
  
          </div>
      </div>
  </div>


</div>



<style>
      .bus {
    display: flex;
    border: 3px solid;
    border-radius: 25px;
    border-color: #ffd707;
    width: 250px;
    height: 540px;
    transform: skew(-0deg);
    background: #4f4f4f;
    }

  .bus-seats {
    display: flex;
  }

  .bus-seats .seat {
    cursor: pointer;
  }

  .bus-seats .seat:hover:before {
    content: "";
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 7px;
  }

  .bus-seats .seat.active:before {
    content: "";
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.6);
    border-radius: 7px;
  }

  .left .cinema-row {
    transform: skew(0.5deg);
    margin: 0 6px;
  }

  .left .seat {
    width: 35px;
    height: 50px;
    border-radius: 7px;
    top: 10px;
    /*background: linear-gradient(to top, #761818, #761818, #761818, #761818, #761818, #B54041, #F3686A);*/
    background: linear-gradient(
      45deg,
      rgba(209, 174, 0, 1) 0%,
      rgba(209, 174, 0, 1) 50%,
      rgba(207, 207, 207, 1) 100%
    );
    margin-bottom: -5px;
    transform: skew(3deg);
    /*margin-top: -10px;*/
    margin-left: 15px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    display: inline-block;
    color: black;
  }

  #bus {
    font-size: 58px;
    position: relative;
    color: #fccc00;
    left: 250px;
  }

  #bus:after {
    display: block;
    content: "";
    position: absolute;
    background: #17120e;
    bottom: 5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    left: 58px;
    box-shadow: 64px 0 0 0 black;
  }

  .seat-disaple{
    background: rgb(156 163 175) !important;
    cursor: not-allowed !important;
  }

  .seat-disaple:hover{
    background: rgb(156 163 175) !important;

  }
  .seat-disaple:hover{
    color: black !important;
  }
</style>

<script>
    const MONTH_NAMES = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    const MONTH_SHORT_NAMES = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    const DAYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    function app() {
      return {
        showDatepicker: false,
        datepickerValue: "",
        selectedDate: "<?= $date?>",
        dateFormat: "DD-MM-YYYY",
        month: "",
        year: "",
        no_of_days: [],
        blankdays: [],
        initDate() {
          let today;
          if (this.selectedDate) {
            today = new Date(Date.parse(this.selectedDate));
          } else {
            today = new Date();
          }
          this.month = today.getMonth();
          this.year = today.getFullYear();
          this.datepickerValue = this.formatDateForDisplay(
            today
          );
        },
        formatDateForDisplay(date) {
          let formattedDay = DAYS[date.getDay()];
          let formattedDate = ("0" + date.getDate()).slice(
            -2
          ); // appends 0 (zero) in single digit date
          let formattedMonth = MONTH_NAMES[date.getMonth()];
          let formattedMonthShortName =
            MONTH_SHORT_NAMES[date.getMonth()];
          let formattedMonthInNumber = (
            "0" +
            (parseInt(date.getMonth()) + 1)
          ).slice(-2);
          let formattedYear = date.getFullYear();
          if (this.dateFormat === "DD-MM-YYYY") {
            return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`; // 02-04-2021
          }
          if (this.dateFormat === "YYYY-MM-DD") {
            return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`; // 2021-04-02
          }
          if (this.dateFormat === "D d M, Y") {
            return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`; // Tue 02 Mar 2021
          }
          return `${formattedDay} ${formattedDate} ${formattedMonth} ${formattedYear}`;
        },
        isSelectedDate(date) {
          const d = new Date(this.year, this.month, date);
          return this.datepickerValue ===
            this.formatDateForDisplay(d) ?
            true :
            false;
        },
        isToday(date) {
          const today = new Date();
          const d = new Date(this.year, this.month, date);
          return today.toDateString() === d.toDateString() ?
            true :
            false;
        },
        getDateValue(date) {
          let selectedDate = new Date(
            this.year,
            this.month,
            date
          );
          this.datepickerValue = this.formatDateForDisplay(
            selectedDate
          );
          // this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + formattedMonthInNumber).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);
          this.isSelectedDate(date);
          this.showDatepicker = false;
        },
        getNoOfDays() {
          let daysInMonth = new Date(
            this.year,
            this.month + 1,
            0
          ).getDate();
          // find where to start calendar day of week
          let dayOfWeek = new Date(
            this.year,
            this.month
          ).getDay();
          let blankdaysArray = [];
          for (var i = 1; i <= dayOfWeek; i++) {
            blankdaysArray.push(i);
          }
          let daysArray = [];
          for (var i = 1; i <= daysInMonth; i++) {
            daysArray.push(i);
          }
          this.blankdays = blankdaysArray;
          this.no_of_days = daysArray;
        },
      };
    }
  </script>