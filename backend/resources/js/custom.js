$(function () {
  var hash = window.location.hash;
  hash && $('ul.nav.nav-tabs a[href="' + hash + '"]').tab('show');

  $('ul.nav.nav-tabs a').click(function () {
    window.location.hash = this.hash;
    hash = window.location.hash;
  });

  $('form.follow button').click(function () {
    $(this).siblings('input:last').val(hash);
  });

  $('form.like button').click(function () {
    $(this).siblings('input:last').val(hash);
  });
});
