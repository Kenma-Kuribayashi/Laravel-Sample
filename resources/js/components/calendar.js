$(() => {
const WEEK_DAYS = 7;
const date = new Date();
//年を4桁の整数で取得
const year = date.getFullYear();
//getMonthの返り値は月を表す0から11の数値
const month = date.getMonth() + 1;
const todayDate = date.getDate();
const startDate = new Date(year, month - 1, 1); // 月の最初の日を取得
const endDate = new Date(year, month, 0); // 月の最後の日を取得
const endDayCount = endDate.getDate(); // 月の末日
const startDay = startDate.getDay(); // 月の最初の曜日を取得

$('#year-month').text(`${year}年${month}月`);
$('.non-display').removeClass('non-display');

/**
 * このメソッドが知っていること
 * - セルはTDタグで表現すること
 * - 受け取った番号が0以下だったら空っぽのセルにすること
 * - なんならカレンダーに使われることすら知らない
 */
const positiveNumberCellRenderer = (number) => {
    const emptyCell = '<td class="calendar-td"></td>';
    if (number <= 0) {
        return emptyCell;
    }
    if (number == todayDate) {
        return `<td class="calendar-td today">${number}</td>`;
    }
    return `<td class="calendar-td">${number}</td>`;
};

/**
 * このメソッドが知っていること
 * 行はTRタグで挟むこと
 * 1行分のセルが配列で渡されること
 */
const rowRenderer = (cellListPerWeek) => {
    return "<tr>" + cellListPerWeek.join("") + "</tr>";
}

/**
 * このメソッドが知っていること
 * 当月の日付が格納された配列の作り方
 * 月の範囲外の日付の場合は0を返すこと（cellRendererとのお約束）
 * @param {*} maxDate 
 * @param {*} startDay 
 */
const makeDayNumberArray = (maxDate, startDay) => {
    return Array.from(
        {
            length: maxDate + startDay + ((maxDate + startDay) % WEEK_DAYS)
        },
        (value, index) => {
            if (index + 1 - startDay > maxDate) {
                return 0;
            }
            return index + 1 - startDay;
        }
    );
}

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

var calendarHtml = makeDayNumberArray(endDayCount, startDay).map(positiveNumberCellRenderer).chunk(7).map(rowRenderer);

$("#calendar").html(contents);

});