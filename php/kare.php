
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" ></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript"></script>

<script>
    $( function() {
        var dates = jQuery( '#datepickerFrom, #datepickerTo' ) . datepicker( {
            showAnim: 'drop',
            changeMonth: true,
            numberOfMonths: 3,
            showCurrentAtPos: 1,
            dateFormat:"yy/mm/dd",
            onSelect: function( selectedDate ) {
                var option = this . id == 'datepickerFrom' ? 'minDate' : 'maxDate',
                    instance = $( this ) . data( 'datepicker' ),
                    date = $ . datepicker . parseDate(
                        instance . settings . dateFormat ||
                        $ . datepicker . _defaults . dateFormat,
                        selectedDate, instance . settings );
                dates . not( this ) . datepicker( 'option', option, date );
            }
        } );
    } );
</script>



</head>

<body>
	<form>
    <div></div>
		<input type="text" id="datepickerFrom" placeholder="クリックして下さい"/>

		<label >~</label>
		<input type="text" id="datepickerTo" placeholder="クリックして下さい"/>
	</form>
</body>
</html>
