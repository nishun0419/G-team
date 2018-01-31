function dispPdf(response){
	console.log(JSON.stringify(response));
	var docDefinition = {
   content: [
   	{
   		columns:[
   			{text:MyUserName + '　様'
   			},
   			{text: 'Chinook株式会社\n運営係',
   			 alignment: 'right'
   			}
   		]
   	},
   	{
   		text: '予約確認票',
   		alignment: 'center',
   		fontSize: 30
   	},
   	{
   		columns:[
   			{width:'*',text:''},
   			{
   				width:'auto',				
          margin:[0,20],
   				table:{
            width:'auto',
   					body:[
              [{text:'予約者情報', colSpan: 2, alignment:'center', fillColor: '#cccccc'},{}],
   				 		[{text:'予約者名', alignment: 'center'},{text:response.FamilyName +'　' + response.GivenName,alignment:'center'}],
   				 		[{text:'フリガナ', alignment: 'center'}, {text:response.FamilyNameKana + '　' + response.GivenNameKana, alignment:'center'}],
   				 		[{text:'住所', alignment: 'center'}, {text:'〒'+ response.UserPostNum + '　　' + response.UserPref + response.UserCity, alignment:'center'}],
   				 		[{text:'TEL', alignment: 'center'}, {text:response.UserTel,alignment: 'center'}],
   				 		[{text:'予約日', alignment: 'center'}, {text:response.orderdate,alignment:'center'}],
              [{text:'予約施設情報', colSpan: 2, alignment:'center', fillColor: '#cccccc'},{}],
              [{text:'施設名', alignment: 'center'},{text:response.FacName,alignment:'center'}],
              [{text:'住所', alignment: 'center'}, {text:'〒'+ response.PostNum + '　　' + response.Pref + response.Address, alignment:'center'}],
              [{text:'TEL', alignment: 'center'}, {text:response.Tel,alignment: 'center'}],
              [{text:'料金', alignment: 'center'},{text:separate(response.ResPrice),alignment: 'center'}]
   					]
   				}
   			},
   			{width:'*',text:''},
   		]

   	},
    {
      text:'支払い状況',
      alignment:'center',
      fontSize:20
    },
    {
      text:'支払い済み　・　未支払い',
      alignment:'center',
    }
   	]			
 };
//フォント
pdfMake.fonts = {
   	GenShin: {
      normal:      'GenShinGothic-Normal-Sub.ttf',
      bold:        'GenShinGothic-Normal-Sub.ttf',
      italics:     'GenShinGothic-Normal-Sub.ttf',
      bolditalics: 'GenShinGothic-Normal-Sub.ttf'
    }
}
  
 // ディフォルトフォントを指定
  if (!docDefinition['defaultStyle']) {
    docDefinition['defaultStyle'] = new Object();
  }
  docDefinition['defaultStyle']['font'] = 'GenShin';
  
// ブラウザ名を取得
  var name = getBrowser();
  
  // ブラウザことに処理を分岐
  // IEの場合
  if (name == 'ie') {
    pdfMake.createPdf(docDefinition).download('ordercheck.pdf');
  
  // IE以外
  } else {
    pdfMake.createPdf(docDefinition).open();
  }
}

//-------------------------
// ブラウザを判定する関数
//-------------------------
var getBrowser = function() {
  
  var name = 'unknown';
  
  // ユーザーエージェントを取得
  var ua = window.navigator.userAgent.toLowerCase();
  
  // ieをチェック
  if (ua.indexOf("msie") != -1 ||
      ua.indexOf('edge') != -1 ||
      ua.indexOf('trident/7') != -1) {
    name = 'ie';
  
  // ie以外
  } else if (ua.indexOf('chrome') != -1) {
    name = 'chrome';
    
  } else if (ua.indexOf('safari') != -1) {
    name = 'safari';
    
  } else if (ua.indexOf('opera') != -1) {
    name = 'opera';
    
  } else if (ua.indexOf('firefox') != -1) {
        name = 'firefox';
  }
  
  return name;
}