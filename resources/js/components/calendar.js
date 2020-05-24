$(() => {
    //曜日は0:日,1:月
    const date = new Date();
    //年を4桁の整数で取得
    var year = date.getFullYear();
    //getMonthの返り値は月を表す0から11の数値
    var month = date.getMonth() + 1;
    const todayDate = { year, month, date: date.getDate() };

    /**
     * 配列をChunkする関数をArray自体に追加する
     */
    Object.defineProperty(Array.prototype, 'chunk', {
        value: function (chunkSize) {
            var R = [];
            for (var i = 0; i < this.length; i += chunkSize)
                R.push(this.slice(i, i + chunkSize));
            return R;
        }
    });

    function createCalendar() {
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

        $('#year-month').text(`${year}年${month}月`);
        $('.non-display').removeClass('non-display');

        /**
         * このメソッドが知っていること
         * - セルはTDタグで表現すること
         * - 受け取った年月日によって異なるTDタグにする
         */
        const dateRenderer = (payload) => {
            if (payload.month === month - 1) {
                return `<td class="calendar-td not-this-month">${payload.date}</td>`
            }
            if (payload.month === month + 1) {
                return `<td class="calendar-td not-this-month">${payload.date}</td>`
            }
            if (dateEquals(payload, todayDate)) {
                return `<td class="calendar-td today">${payload.date}</td>`;
            }
            return `<td class="calendar-td">${payload.date}</td>`;
        };

        /**
         * このメソッドが知っていること
         * 受け取った年月日と今日の年月日があっていればtrueを返す
         */
        const dateEquals = (payload, todayDate) => {
            if (payload.year !== todayDate.year) {
                return false;
            }
            if (payload.month !== todayDate.month) {
                return false;
            }
            if (payload.date !== todayDate.date) {
                return false;
            }
            return true;
        }

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
         * @param {*} maxDate 
         * @param {*} startDay
         * @param {*} endDay
         * @param {*} prevMonthMaxDate
         */
        const makeDayNumberArray = (maxDate, startDay, endDay, prevMonthMaxDate) => {

            //今月のカレンダーに表示される先月の日数
            var numberOfDaysLeftInLastMonth = startDay;
            //今月のカレンダーに表示される来月の日数
            var numberOfDaysLeftInNextMonth = 6 - endDay;

            return Array.from(
                {
                    length: maxDate + numberOfDaysLeftInLastMonth + numberOfDaysLeftInNextMonth
                },
                (value, index) => {
                    //先月の年月日を入れる
                    if (index < startDay) {
                        return {
                            year,
                            month: month - 1,
                            date: prevMonthMaxDate - startDay + index + 1
                        };
                    }
                    //来月の年月日を入れる
                    if (index + 1 - startDay > maxDate) {
                        return {
                            year,
                            month: month + 1,
                            date: index - maxDate - startDay + 1
                        };
                    }
                    //今月の年月日を入れる
                    return {
                        year,
                        month,
                        date: index + 1 - startDay
                    };
                }
            );
        }

        var calendarHtml = makeDayNumberArray(endDayCount, startDay, endDay, prevMonthEndDayCount).map(dateRenderer).chunk(7).map(rowRenderer);

        $("#calendar").html(calendarHtml);

    };

    createCalendar();

    //先月ボタンが押されたら表示されている前月のカレンダーを作成する
    $('#prev-month').click(function () {
        month -= 1;
        if (month === 0) {
            year -= 1;
            month = 12;
        }
        createCalendar();
    });
    
    //来月ボタンが押されたら表示されている来月のカレンダーを作成する
    $('#next-month').click(function () {
        month += 1;
        if (month === 13) {
            year += 1;
            month = 1;
        }
        createCalendar();
    });

});