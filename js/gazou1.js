$(function() {

  $('input[type=file]').after('<div class="hoge"></div>');
  // アップロードするファイルを複数選択
  $('input[type=file]').change(function() {
    $('.hoge').html('');
    var file = $(this).prop('files');

    var img_count = 1;
    $(file).each(function(i) {
      // 5枚まで
      if (img_count > 3) {
        return false;
      }

      if (! file[i].type.match('image.*')) {
        $(this).val('');
        $('.hoge').html('');
        return;
      }

      var reader = new FileReader();
      reader.onload = function(){
        var img_src = $('<img>').attr('src', reader.result);
        $('.hoge').append(img_src);
      }

      var new_w = 300;
      var new_h = 300;

      var reader = new FileReader();
      reader.onload = function(){
        var img_src = $('<img>').attr('src', reader.result);

        var org_img = new Image();
        org_img.src = reader.result;
        org_img.onload = function(){
          var org_w = this.width;
          var org_h = this.height;

          if (org_w < new_w && org_h < new_h) {
            new_w = org_w;
            new_h = org_h;
          } else {
            if (org_w > org_h) {
              var percent_w = new_w / org_w;
              new_h = Math.ceil(org_h * percent_w);
            } else if (org_w < org_h) {
              var percent_h = new_h / org_h;
              new_w = Math.ceil(org_w * percent_h);
            }
          }

          $('.hoge').append($('<canvas>').attr({
            'id' : 'canvas' + i,
            'width' : new_w,
            'height' : new_h
          }));
          var ctx = $('#canvas' + i)[0].getContext('2d');
          var resize_img = new Image();
          resize_img.src = reader.result;
          ctx.drawImage(resize_img, 0, 0, new_w, new_h);

          var dataURL = $('#canvas' + i)[0].toDataURL();
          $('#debug').html(dataURL);
          console.log(dataURL);
        };
      }
      reader.readAsDataURL(file[i]);

      img_count = img_count + 1;
    });
  });
});
