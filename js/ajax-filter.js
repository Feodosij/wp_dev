jQuery(function ($) {
  $("#reset-filter").click(function () {
    // Находим все чекбоксы и снимаем галочки
    $('input[name="news_categories[]"]').prop("checked", false);

    // Отправляем AJAX-запрос для сброса фильтра
    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "filter_news", // Это должно соответствовать имени вашей функции обработки фильтрации
        news_categories: [], // Пустой массив для сброса фильтрации
      },
      success: function (response) {
        $(".news_holder").html(response);
      },
    });
  });

  $('input[name="news_categories[]"]').change(function () {
    var selected_categories = [];
    $('input[name="news_categories[]"]:checked').each(function () {
      selected_categories.push($(this).val());
    });

    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "filter_news",
        news_categories: selected_categories,
      },
      success: function (response) {
        console.log(response);
        $(".news_holder").html(response);
      },
    });
  });
});
