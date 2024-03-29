$(document).ready(function () {
  var items = $(".carousel-item");
  var totalItems = items.length;
  var itemsPerPage = 3;
  var totalPages = Math.ceil(totalItems / itemsPerPage);
  var currentPage = 1;

  function showPage(page) {
    items.hide();
    var startIndex = (page - 1) * itemsPerPage;
    var endIndex = startIndex + itemsPerPage;
    items.slice(startIndex, endIndex).show();
  }

  $(".next-button").click(function () {
    if (currentPage < totalPages) {
      items.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage).hide();
      currentPage++;
      showPage(currentPage);
    }
  });

  $(".prev-button").click(function () {
    if (currentPage > 1) {
      items.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage).hide();
      currentPage--;
      showPage(currentPage);
    }
  });

  showPage(currentPage);
});
