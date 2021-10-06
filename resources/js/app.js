require('./bootstrap');

$(function(){
  $("[name='bg_img_path']").on('change', function (e) {

    var reader = new FileReader();

    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }

    reader.readAsDataURL(e.target.files[0]);

  });
});

$(function(){
  $("[name='avatar_path']").on('change', function (e) {

    var reader = new FileReader();

    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }

    reader.readAsDataURL(e.target.files[0]);

  });
});
