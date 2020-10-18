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

  $('ul.pagination').hide();
  $(function () {
    $(`.infinite-scroll`).jscroll({
      autoTrigger: true,
      loadingHtml: '<img class="center-block" src="/images/vendor/lightbox2/dist/loading.gif" alt="Loading..." />',
      padding: 0,
      nextSelector: `.pagination li.active + li a`,
      contentSelector: `div.infinite-scroll`,
      callback: function () {
        $(`ul.pagination`).remove();
      }
    });
  });
});
