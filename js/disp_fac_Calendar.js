function dispCalendar(response){
    // var flag = true;
    // var work;
    var orderdate = response.orderdate;
    var StartDate = toDate(response.StartDate);
    var StopDate = toDate(response.StopDate);
var opt = {
     timeOnlyTitle: '時間を選択',
     timeText: '時間',
        hourText: '時',
        minuteText: '分',
        secondText: '秒',
        millisecText: 'ミリ秒',
        timezoneText: 'タイムゾーン',
        currentText: '現在時刻',
        closeText: '閉じる',
        timeFormat: 'HH:mm',
        amNames: ['午前', 'AM', 'A'],
        pmNames: ['午後', 'PM', 'P'],
        isRTL: false,
        prevText: '&#x3C;前',
        nextText: '次&#x3E;',
        monthNames: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
        dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
        dayNamesShort: ['日','月','火','水','木','金','土'],
        dayNamesMin: ['日','月','火','水','木','金','土'],
        weekHeader: '週',
        dateFormat: 'yy-mm-dd',
        firstDay: 0,
        showMonthAfterYear: true,
        yearSuffix: '年',
        minDate: StartDate,
        maxDate: StopDate,
        beforeShowDay: function(date){
            // var disabledate = $.datepicker.formatDate(date, 'yyyy-mm-dd');
            // if(( orderdate.indexOf(disabledate) == -1)){
            // return [true, "", "予約済"];
            // }
            // else{
            //     return [false, "", "予約済"];
            // }
            //予約済みか確認するための処理
            if(orderdate !== null){
            for (var i = 0; i < orderdate.length; i++){
                var ordertime = Date.parse(orderdate[i]);
                var holiday = new Date();
                holiday.setTime(ordertime);
                if (holiday.getYear() == date.getYear() &&
                    holiday.getMonth() == date.getMonth() &&
                    holiday.getDate() == date.getDate()) {
                    return [false,"inorder","予約済み" ];
                }
            }
            }
                return [true, ""];
        },
        onSelect: function(dataText, inst){
            $(".calendarVal").text(dataText);
            $("#reservation").val(dataText);
            $('#orderModal').modal(
                {
                    backdrop: "true",
                }
            );
               
        },
    };
    $("#calendar").datepicker(opt);
    // $(".inorder > span").append("");
}
function toDate (str) {
  var arr = str.split('-')
  return new Date(arr[0], arr[1] - 1, arr[2]);
};

