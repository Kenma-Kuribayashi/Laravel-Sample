<template>
  <div class="calendar">
    <div class="calendar-title-area">
      <button @click="onClickPrevButton" type="button" class="btn btn-primary">&larr;</button>
      <h3 class="calendar-title">{{ year }}年{{ month }}月</h3>
      <button @click="onClickNextButton" type="button" class="btn btn-primary">&rarr;</button>
    </div>

    <select v-model="lang">
      <option disabled value>選択してください</option>
      <option value="ja">日本語</option>
      <option value="en">英語</option>
    </select>

    <table>
      <tr>
        <td class="calendar-td" v-for="day in weeks" :key="day">{{ day }}</td>
      </tr>
      <tr v-for="(week, index) in calendarMake" :key="index">
        <date-cell
          v-bind:currentMonth="month"
          v-bind:day="dayObject"
          v-bind:todayDate="todayDate"
          v-for="dayObject in week"
          :key="dayObject.date"
        ></date-cell>
      </tr>
    </table>
  </div>
</template>
<script>
import DateCell from './DateCell';

export default {
  components: {
    DateCell
  },
  data() {
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const todayDate = {
      year: year,
      month: month,
      date: date.getDate()
    };

    return {
      days: [],
      date,
      year,
      month,
      todayDate,
      lang: 'ja'
    };
  },
  methods: {
    onClickNextButton() {
      this.month += 1;
      if (this.month === 13) {
        this.year += 1;
        this.month = 1;
      }
      this.days = [];
    },
    onClickPrevButton() {
      this.month -= 1;
      if (this.month === 0) {
        this.year -= 1;
        this.month = 12;
      }
      this.days = [];
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
      return this.days.push(payload);
    },
  },
  computed: {
    calendarMake() {
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

      this.makeDayNumberArray(
        this.endDayCount,
        this.startDay,
        this.endDay,
        this.prevMonthEndDayCount
      ).forEach(this.dateRenderer);

      return this.days.chunk(7);
    },
    // 他のthis.XXXXによって計算される変数はすべてcomputedに入れて良い
    _startDate() {
      return new Date(this.year, this.month - 1, 1);
    },
    weeks() {
      if (this.lang === 'en') {
        return ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      }
      return ['日', '月', '火', '水', '木', '金', '土'];
    }
  },
  mounted() {}
};

/**
 * 配列をChunkする関数をArray自体に追加する
 */
Object.defineProperty(Array.prototype, 'chunk', {
  value: function(chunkSize) {
    var R = [];
    for (var i = 0; i < this.length; i += chunkSize)
      R.push(this.slice(i, i + chunkSize));
    return R;
  }
});
</script>
<style scoped>
.calendar-title {
  margin-bottom: 0;
}
.gray {
  color: #808080;
}
.red {
  color: red;
}
.calendar-td {
  width: 40px;
  height: 20px;
  text-align: center;
}
.calendar-title-area {
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>