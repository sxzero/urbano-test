const api_version = "/v1";
const api_uri = "/api" + api_version;
const api_ed_clients = "/clients";
const api_ed_client_groups = "/client-groups";

/**
 * Show a success message alert.
 *
 * @return void
 */
function successAlert() {
  $("#success-alert")
    .fadeTo(4000, 500)
    .slideUp(500, function () {
      $("#success-alert").slideUp(500);
    });
}

/**
 * Show error message alert.
 *
 * @return void
 */
function errorAlert() {
  $("#error-alert")
    .fadeTo(4000, 500)
    .slideUp(500, function () {
      $("#error-alert").slideUp(500);
    });
}

/**
 * Convert a collection of objects from API response data to html td.
 *
 * @param {objects} items Collection of objects from response data API
 */
function objectToTableRows(items) {
  var html = "";

  items.sort(function (a, b) {
    return a.id - b.id || a.name.localeCompare(b.name);
  });

  $.each(items, function (index, item) {
    html += "<tr data-id='" + item.id + "'>";
    $.map(item, function (value, key) {
      if (key == "client_group_id") {
        return;
      }

      if (key == "client_group") {
        if (value) {
          html += "<td>" + value.name + "</td>";
          return;
        } else {
          html += "<td></td>";
          return;
        }
      }

      html += "<td>" + value + "</td>";
    });
    html += "<td>";
    html +=
      '<button type="button" class="close del-client-group" aria-label="Close" title="Eliminar">';
    html += '<span aria-hidden="true">&times;</span>';
    html += "</button>";
    html += "</td>";
    html += "</tr>";
  });

  return html;
}

/**
 * Convert json response data to html td.
 *
 * @param {object} item Single API response data object
 */
function objectToTableRow(item) {
  var html = "";

  html += "<tr data-id='" + item.id + "'>";
  $.map(item, function (value, key) {
    console.log(key);
    html += "<td>" + value + "</td>";
  });
  html += "<td>";
  html +=
    '<button type="button" class="close del-client-group" aria-label="Close" title="Eliminar">';
  html += '<span aria-hidden="true">&times;</span>';
  html += "</button>";
  html += "</td>";
  html += "</tr>";

  return html;
}

/**
 * Populate dropdown element.
 *
 * @param {object} e event handler
 * @param {HTMLSelect} dropdown HTML Select element
 */
function getGroupsAsOptions(e, dropdown, model) {
  requestApi(model)
    .promise()
    .done(function (result) {
      dropdown.find("option").remove();

      let data = result.data;

      data.sort(function (a, b) {
        return a.id - b.id || a.name.localeCompare(b.name);
      });

      dropdown.append(
        $("<option />")
          .text('Seleccionar')
      );

      for (var i = 0; i < data.length; i++) {
        dropdown.append(
          $("<option />")
            .val(data[i]["id"])
            .text(data[i]["id"] + ": " + data[i]["name"])
        );
      }
    });
}

/**
 * Simple Ajax request handler for API.
 *
 * @param {string} endpoint Endpoint path for the Model
 * @param {string} method Http request method
 * @param {string} dataContent x-www-form-urlencoded data
 */
function requestApi(endpoint, method = "GET", dataContent = "") {
  return $.ajax({
    type: method,
    url: api_uri + endpoint,
    // dataType: "JSON",
    data: dataContent,
    // async: false,
    success: function (response) {
      successAlert();

      return response;
    },
    error: function (response) {
      var message = response.status + ": " + response.statusText;

      errorAlert();
      console.error(message);

      return response;
    },
  });
}

/**
 * Wait until DOM is ready...
 */
$(document).ready(function () {
  const link = $(".nav-link");
  const render = $("#app");

  /**
   * Handler http navigation request for SPA.
   */
  link.on("click", function (e) {
    e.preventDefault();

    let load = $(this).data("load");
    let route = $(this).attr("href");

    $.get(route, function (data) {
      render.html(data);
    }).then(function () {
      if (load != "none") {
        let autoLoad = requestApi(load);

        autoLoad.promise().done(function (response) {
          rows = objectToTableRows(response.data);
          $(".table").append(rows);
        });
      }
    });
  });

  // ======================================

  /**
   * Create a Client Group
   */
  $(document).on("submit", "#frm_client_group", function (e) {
    e.preventDefault();

    var form = $(this);
    var serializedData = form.serialize();

    requestApi(api_ed_client_groups, "POST", serializedData)
      .promise()
      .done(function () {
        $("[data-load='/client-groups']").trigger("click");
      });
  });

  /**
   * Update a Client Group
   */
  $(document).on("submit", "#frm_client_group_edit", function (e) {
    e.preventDefault();

    var form = $(this);
    var id = form.find("#group_id").val();
    var serializedData = form.serialize();

    requestApi(api_ed_client_groups + "/" + id, "POST", serializedData)
      .promise()
      .done(function () {
        $("[data-load='/client-groups']").trigger("click");
      });
  });

  /**
   * Delete a Client Group
   */
  $(document).on("click", "#tbl_client_group .del-client-group", function () {
    var client_group = $(this).closest("tr");
    var id = client_group.data("id");
    requestApi(api_ed_client_groups + "/" + id, "DELETE")
      .promise()
      .done(function (response) {
        successAlert();

        client_group.hide("slow");
      });
  });

  /**
   * Populate dropdown element with Client Groups
   */
  $(document).on("click", ".client_group #btn_edit", function (e) {
    var dropdown = $(document).find("#update_client_group #group_id");
    getGroupsAsOptions(e, dropdown, api_ed_client_groups);
  });

  /**
   * Search Client Groups
   */
  $(document).on("submit", ".client_group #search_form", function (e) {
    e.preventDefault();

    var form = $(this);
    var name = form.find("input").val();

    if (name) {
      requestApi(api_ed_client_groups + "/search?name=" + name)
        .promise()
        .done(function (response) {
          row = objectToTableRows(response.data);
          $(".table tbody").html(row);
        });
    } else {
      $("[data-load='/client-groups']").trigger("click");
    }
  });

  // ======================================

  /**
   * Create a Client
   */
  $(document).on("submit", "#frm_client", function (e) {
    e.preventDefault();

    var form = $(this);
    var serializedData = form.serialize();

    requestApi(api_ed_clients, "POST", serializedData)
      .promise()
      .done(function () {
        $("[data-load='/clients']").trigger("click");
      });
  });

  /**
   * Update a Client Group
   */
  $(document).on("submit", "#frm_client_edit", function (e) {
    e.preventDefault();

    var form = $(this);
    var id = form.find("#client_id").val();
    var serializedData = form.serialize();

    requestApi(api_ed_clients + "/" + id, "POST", serializedData)
      .promise()
      .done(function () {
        $("[data-load='/clients']").trigger("click");
      });
  });

  /**
   * Delete a Client Group
   */
  $(document).on("click", "#tbl_client .del-client-group", function () {
    var client = $(this).closest("tr");
    var id = client.data("id");
    requestApi(api_ed_clients + "/" + id, "DELETE")
      .promise()
      .done(function (response) {
        successAlert();

        client.hide("slow");
      });
  });

  /**
   * Populate dropdown elements
   */
  $(document).on("click", ".client #btn_new", function (e) {
    var dropdown = $(document).find("#new_client #client_group_id");
    getGroupsAsOptions(e, dropdown, api_ed_client_groups);
  });
  $(document).on("click", ".client #btn_edit", function (e) {
    var dropdown = $(document).find("#update_client #client_group_id");
    getGroupsAsOptions(e, dropdown, api_ed_client_groups);
  });
  $(document).on("click", ".client #btn_edit", function (e) {
    var dropdown = $(document).find("#update_client #client_id");
    getGroupsAsOptions(e, dropdown, api_ed_clients);
  });
  $(document).on("click", "[data-load='/clients']", function (e) {
    var waitForEl = function(selector, callback) {
      if (jQuery(selector).length) {
        callback();
      } else {
        setTimeout(function() {
          waitForEl(selector, callback);
        }, 100);
      }
    };
    
    waitForEl('#client_search_group_id', function() {
      var dropdown = $(document).find("#client_search_group_id");
      getGroupsAsOptions(e, dropdown, api_ed_client_groups);
    });
  });

  /**
   * Search Client Groups
   */
  $(document).on("submit", ".client #search_form", function (e) {
    e.preventDefault();

    var form = $(this);
    var serializedData = form.serialize();

    if (serializedData) {
      requestApi(api_ed_clients + "/search", 'GET', serializedData)
        .promise()
        .done(function (response) {
          row = objectToTableRows(response.data);
          $(".table tbody").html(row);
        });
    } else {
      $("[data-load='/clients']").trigger("click");
    }
  });
});
