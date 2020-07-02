<template>
  <div class="calendar">
    <div>
      <h3 clsss="calendar-title">{{ year }}年{{ month }}月</h3>
    </div>
    <button @click="onClickPrevButton" type="button" class="btn btn-primary">&larr;</button>
    <button @click="onClickNextButton" type="button" class="btn btn-primary">&rarr;</button>
    <table>
      <tr>
        <td class="calendar-td" v-for="day in weeks" :key="day">{{ day }}</td>
      </tr>
      <tr v-for="(week, index) in calendarMake" :key="index">
        <!-- <td v-for="day in week" :key="day" class="calendar-td">{{ day }}</td> -->
        <td v-for="dayObject in week" :key="dayObject.date" :class="`calendar-td ${dayObject.month !== month ? 'gray' : ''} ${dayObject.year === todayDate.year && dayObject.month === todayDate.month && dayObject.date === todayDate.date ? 'red' : ''}`">{{ dayObject.date }}</td>
      </tr>
    </table>
  </div>
</template>
<script>
export default {
  components: {},
  data() {
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;

    return {
      weeks: ["日", "月", "火", "水", "木", "金", "土"],
      days: [],
      date,
      year,
      month,
      todayDate: null
      // startDate: date,
      // endDate: date,
      // endDayCount: 0,
      // startDay: 0,
      // endDay: 0,
      // prevMonthEndDate: 30,
      // prevMonthEndDayCount: 30
    };
  },
  // initialize
  methods: {
    initialize() {
      this.todayDate = {
        year: this.year,
        month: this.month,
        date: this.date.getDate()
      };
      // 表示する月の最初の日を取得
      this.startDate = new Date(this.year, this.month - 1, 1);
      // 表示する月の最後の日を取得
      this.endDate = new Date(this.year, this.month, 0);
      // 表示する月の最後の日の日にちを取得
      this.endDayCount = this.endDate.getDate();
      // 表示する月の最初の曜日を取得
      this.startDay = this.startDate.getDay();
      // 表示する月の末日の曜日を取得
      this.endDay = this.endDate.getDay();
      // 表示する先月の最後の日を取得
      this.prevMonthEndDate = new Date(this.year, this.month - 1, 0);
      // 表示する先月の最後の日の日にちを取得
      this.prevMonthEndDayCount = this.prevMonthEndDate.getDate();
    },
    onClickNextButton() {
      this.month += 1;
      if (this.month === 13) {
        this.year += 1;
        this.month = 1;
      }
      this.days = [];
      this.initialize();
    },
    onClickPrevButton() {
      this.month -= 1;
      if (this.month === 0) {
        this.year -= 1;
        this.month = 12;
      }
      this.days = [];
      this.initialize();
    },
    makeDayNumberArray(maxDate, startDay, endDay, prevMonthMaxDate) {
      //今月のカレンダーに表示される先月の日数
      var numberOfDaysLeftInLastMonth = startDay;
      //今月のカレンダーに表示される来月の日数
      var numberOfDaysLeftInNextMonth = 6 - endDay;

      return Array.from(
        {
          length:
            maxDate + numberOfDaysLeftInLastMonth + numberOfDaysLeftInNextMonth
        },
        (value, index) => {
          //先月の年月日を入れる
          if (index < startDay) {
            return {
              year: this.year,
              month: this.month - 1,
              date: prevMonthMaxDate - startDay + index + 1
            };
          }
          //来月の年月日を入れる
          if (index + 1 - startDay > maxDate) {
            return {
              year: this.year,
              month: this.month + 1,
              date: index - maxDate - startDay + 1
            };
          }
          return {
            year: this.year,
            month: this.month,
            date: index + 1 - startDay
          };
        }
      );
    },
    dateRenderer(payload) {
        console.log(payload);
      return this.days.push(payload);
    }
  },
  computed: {
    calendarMake() {
      // initializeの実行前にはカレンダーを作らない
      if (this.todayDate === null) {
        return [];
      }
      this.makeDayNumberArray(
        this.endDayCount,
        this.startDay,
        this.endDay,
        this.prevMonthEndDayCount
      ).map(this.dateRenderer);

      return this.days.chunk(7);
    },
    // 他のthis.XXXXによって計算される変数はすべてcomputedに入れて良い
    _startDate() {
      return new Date(this.year, this.month - 1, 1)
    }
  },
  mounted() {
    this.initialize();
  }
};

/**
 * 配列をChunkする関数をArray自体に追加する
 */
Object.defineProperty(Array.prototype, "chunk", {
  value: function(chunkSize) {
    var R = [];
    for (var i = 0; i < this.length; i += chunkSize)
      R.push(this.slice(i, i + chunkSize));
    return R;
  }
});


//     /**
//      * このメソッドが知っていること
//      * - セルはTDタグで表現すること
//      * - 受け取った年月日によって異なるTDタグにする
//     */
// const dateRenderer = (payload) => {
// if (payload.month === this.month - 1) {
//     console.log(payload);
//     return this.days.push(payload.date);
//     //return `<td class="calendar-td not-this-month">${payload.date}</td>`;
// }
// if (payload.month === this.month + 1) {
//     return this.days.push(payload.date);
//     //return `<td class="calendar-td not-this-month">${payload.date}</td>`;
// }
// if (this.dateEquals(payload, this.todayDate) === true) {
//     return this.days.push(payload.date);
//     // return `<td class="calendar-td today">${payload.date}</td>`;
// }
//return this.days.push(payload.date);
//return `<td class="calendar-td">${payload.date}</td>`;
// };

//     /**
//          * このメソッドが知っていること
//          * 受け取った年月日と今日の年月日があっていればtrueを返す
//     */
// const dateEquals = (payload, todayDate) => {
//   if (payload.year !== todayDate.year) {
//     return false;
//   }
//   if (payload.month !== todayDate.month) {
//     return false;
//   }
//   if (payload.date !== todayDate.date) {
//     return false;
//   }
//   return true;
// };

</script>
<style scoped>
.gray {
    color: #808080;
}
.red {
    color: red;
}
</style>