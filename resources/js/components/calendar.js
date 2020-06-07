class RenderCalendar {

    constructor() {
        // monthやyearの初期化
        const date = new Date();
        //年を4桁の整数で取得
        var year = date.getFullYear();
        this.year = year;
        
        //getMonthの返り値は月を表す0から11の数値
        var month = date.getMonth() + 1;
        this.month = month;

        const todayDate = { year, month, date: date.getDate() };
        this.todayDate = todayDate;

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

        // 表示する月の最初の日を取得
        const startDate = new Date(year, month - 1, 1);
        // 表示する月の最後の日を取得
        const endDate = new Date(year, month, 0);
        // 表示する月の最後の日の日にちを取得
        const endDayCount = endDate.getDate();
        this.endDayCount = endDayCount;
        // 表示する月の最初の曜日を取得
        const startDay = startDate.getDay();
        this.startDay = startDay;
        // 表示する月の末日の曜日を取得
        const endDay = endDate.getDay();
        this.endDay = endDay;
        // 表示する先月の最後の日を取得
        const prevMonthEndDate = new Date(year, month - 1, 0);
        this.prevMonthEndDayCount = prevMonthEndDayCount;
        // 表示する先月の最後の日の日にちを取得
        const prevMonthEndDayCount = prevMonthEndDate.getDate();

        this.bindEvent()
    }

    render() {
        $('#year-month').text(`${this.year}年${this.month}月`);
        $('.non-display').removeClass('non-display');

        var calendarHtml = this.privateMakeDayNumberArray(this.endDayCount, this.startDay, this.endDay, this.prevMonthEndDayCount).map(this.privateDateRenderer).chunk(7).map(this.privateRowRenderer);

        $("#calendar").html(calendarHtml);

    }

    /**
         * このメソッドが知っていること
         * - セルはTDタグで表現すること
         * - 受け取った年月日によって異なるTDタグにする
    */
    privateDateRenderer(payload) {
        if (payload.month === this.month - 1) {
            return `<td class="calendar-td not-this-month">${payload.date}</td>`
        }
        if (payload.month === this.month + 1) {
            return `<td class="calendar-td not-this-month">${payload.date}</td>`
        }
        if (this.privateDateEquals(payload, this.todayDate) === true) {
            return `<td class="calendar-td today">${payload.date}</td>`;
        }
        return `<td class="calendar-td">${payload.date}</td>`;
    }

    /**
         * このメソッドが知っていること
         * 受け取った年月日と今日の年月日があっていればtrueを返す
    */
    privateDateEquals(payload, todayDate) {
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
    privateRowRenderer(cellListPerWeek) {
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
    privateMakeDayNumberArray(maxDate, startDay, endDay, prevMonthMaxDate) {

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
                //今月の年月日を入れる
                return {
                    year: this.year,
                    month: this.month,
                    date: index + 1 - startDay
                };
            }
        );
    }

    // .. 以下関数を切り分けてthis.hogehogeでつかう
    bindEvent() {
        //先月ボタンが押されたら表示されている前月のカレンダーを作成する
        $('#prev-month').click(function () {
            this.month -= 1;
            if (this.month === 0) {
                this.year -= 1;
                this.month = 12;
            }
            createCalendar();
        });

        //来月ボタンが押されたら表示されている来月のカレンダーを作成する
        $('#next-month').click(function () {
            this.month += 1;
            if (this.month === 13) {
                this.year += 1;
                this.month = 1;
            }
            createCalendar();
        });
    }
};

const caredar = new RenderCalendar();
caredar.render();