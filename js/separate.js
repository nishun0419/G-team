// 再帰関数でセパレート
function separate(num){
    // 文字列にする
    num = String(num);

    var len = num.length;

    // 再帰的に呼び出すよ
    if(len > 3){
        // 前半を引数に再帰呼び出し + 後半3桁
        return separate(num.substring(0,len-3))+','+num.substring(len-3);
    } else {
        return num;
    }
}