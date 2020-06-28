<template>
  <div class="calendar">
    <div>
      <h3 clsss="calendar-title">{{ year }}年{{ month }}月</h3>
    </div>
    <button type="button" class="btn btn-primary">&larr;</button>
    <button @click="onClickButton" type="button" class="btn btn-primary">&rarr;</button>
    <table>
      <tr>
        <td class="calendar-td" v-for="day in weeks" :key="day">{{ day }}</td>
      </tr>
      <tr v-for="week in calendarMake" :key="week">
        <td v-for="day in week" :key="day" class="calendar-td">{{ day }}</td>
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
    const todayDate = { year, month, date: date.getDate() };
    // 表示する月の最初の日を取得
    const startDate = new Date(year, month - 1, 1);
    // 表示する月の最後の日を取得
    const endDate = new Date(year, month, 0);
    // 表示する月の最後の日の日にちを取得
    const endDayCount = endDate.getDate();
    // 表示する月の最初の曜日を取得
    const startDay = startDate.getDay();
    // 表示する月の末日の曜日を取得
    const endDay = endDate.getDay();
    // 表示する先月の最後の日を取得
    const prevMonthEndDate = new Date(year, month - 1, 0);
    // 表示する先月の最後の日の日にちを取得
    const prevMonthEndDayCount = prevMonthEndDate.getDate();

    return {
      weeks: ["日", "月", "火", "水", "木", "金", "土"],
      days: [],
      date,
      year,
      month,
      todayDate,
      startDate,
      endDate,
      endDayCount,
      startDay,
      endDay,
      prevMonthEndDate,
      prevMonthEndDayCount
    };
  },
  methods: {
    onClickButton() {
      this.day = 1000;
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
      return this.days.push(payload.date);
    }
  },
  computed: {
    calendarMake() {
      this.makeDayNumberArray(
        this.endDayCount,
        this.startDay,
        this.endDay,
        this.prevMonthEndDayCount
      ).map(this.dateRenderer);
      
      return this.days.chunk(7);
    }
  },
  mounted() {}
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


//         this.bindEvent();
//     }

//     render() {
//         $('#year-month').text(`${this.year}年${this.month}月`);
//         $('.non-display').removeClass('non-display');
//         var calendarHtml = this.privateMakeDayNumberArray(endDayCount, startDay, endDay, prevMonthEndDayCount).map(this.privateDateRenderer.bind(this)).chunk(7).map(this.privateRowRenderer);

//         $("#calendar").html(calendarHtml);
//     }

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

//     bindEvent() {
//         //先月ボタンが押されたら表示されている前月のカレンダーを作成する
//         $('#prev-month').click(function () {
//             this.month -= 1;
//             if (this.month === 0) {
//                 this.year -= 1;
//                 this.month = 12;
//             }
//             this.render();
//         }.bind(this));

//         //来月ボタンが押されたら表示されている来月のカレンダーを作成する
//         $('#next-month').click(function () {
//             this.month += 1;
//             if (this.month === 13) {
//                 this.year += 1;
//                 this.month = 1;
//             }
//             this.render();
//         }.bind(this));
//     }
// };
</script>
