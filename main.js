const url = document.location.origin + "/api";

function Update(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $(data).siblings(".message").text();
    $.ajax({
      url,
      data: { type, status: "update", data: formData },
    }).then(({ body }) => {
      $(data).siblings(".message").text(body);
      $(data).siblings(".message").css("display", "block");
    });
  });
}

function AddNegativePoints(data) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $.ajax({
      url,
      data: { type: "users", status: "negative", data: formData },
    });
  });
}

function UpdateService(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $(data).siblings(".message").empty();
    $.ajax({
      url,
      data: { type, status: "connservice", data: formData },
    }).then(({ body }) => {
      $(data).siblings(".message").text(body);
      $(data).siblings(".message").css("display", "block");
    });
  });
}

function Book(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $(data).siblings(".message").empty();
    $.ajax({
      url,
      data: { type, status: "book", data: formData },
    }).then(({ body }) => {
      $(data).siblings(".message").text(body);
      $(data).siblings(".message").css("display", "block");
    });
  });
}

function AddService() {
  $(function () {
    $(".services").append(`
      <div>
          <form>
          <h4 style='text-align:center;'>Service Name</h4>
          <div style='display:flex; gap:25px; justify-content:center;'>
              <div style='display:none;'>
                  <input class='form-control' type='text' name='id'>
              </div>
              <div>
                  <label for='name'>Name</label>
                  <input class='form-control' type='text' name='name'>
              </div>
              <div>
                  <label for='length'>Duration in minutes</label>
                  <input class='form-control' type='text' name='length' >
              </div>
              <div>
                  <label for='price'>Price</label>
                  <div style='display:flex; align-items:center; gap:15px;'>
                      <input class='form-control' type='text' name='price'>
                      <span>€</span>
                  </div>
              </div>
              <div>
                <button type='button' onclick=\"CreateNew(this,'service')\" class='btn btn-primary' style='margin-top:15px;'>Save</button>
                <div class='message alert'></div>
              </div>
              </div>
          </form>
      </div>
    `);
  });
}

function AddThreatment(button, service) {
  $(function () {
    const id = $(button).siblings("select").val();
    const serviceArray = service.split(",");
    $(".threatment").append(`
      <div>
          <form>
          <h4>Threatment</h4>
          <div style='display:flex; gap:25px; justify-content:center;'>
              <input name='id' value='${id}' style='display:none;'>
              <div>
                  <label for='name'>Threatment</label>
                  <select class='form-control' name='threatment'>
                  ${serviceArray.map((el) => `<option>${el}</option>`)}
                  </select>
              </div>
              <div>
                  <label for='price'>Price</label>
                  <div style='display:flex; align-items:center; gap:15px;'>
                      <input class='form-control' type='text' name='price'>
                      <span>€</span>
                  </div>
              </div>
              <div>
                <label for='price'>Picture</label>
                <div style='display:flex; align-items:center; gap:15px;'>
                    <input class='form-control' type='file' id='photo' name='picture'>
                </div>
              </div>
              </div>
          <div>
              <button type='button' onclick=\"CreateNewThreatment(this)\" class='btn btn-primary' style='margin-top:15px;'>Save</button>
              <div class='message alert'></div>
          </div>
          </form>
      </div>
    `);
  });
}

function getThreatments(select) {
  $(function () {
    $(".threatment").empty();
    const formData = $(select).closest("form").serialize();
    $.ajax({
      url,
      data: { type: "threatment", status: "get", data: formData },
    }).then(({ body }) => {
      body.forEach((el) => {
        $(".threatment").append(`
          <div>
              <h4>${el.threatment}</h4>
              <div style='display:flex; gap:25px; justify-content:center;'>
                  <div>
                      <label for='price'>Price</label>
                      <div style='display:flex; align-items:center; gap:15px;'>
                          <input class='form-control' type='text' disabled name='price' value='${
                            el.price
                          }'>
                          <span>€</span>
                      </div>
                  </div>
                  <div>
                  ${
                    el.picture
                      ? `<label for='price'>Image</label>
                          <div>
                            <img
                              style="width:100px;"
                              src="../uploads/${el.picture}"
                            />
                          </div>`
                      : ""
                  }
                  </div>
              </div>
          </div>
        `);
      });
    });
  });
}

function getAppointment(select) {
  $(function () {
    $(".appointment").empty();
    $(select).siblings(".message").empty();
    $(select).siblings(".message").css("display", "none");
    const formData = $(select).closest("form").serialize();
    $.ajax({
      url,
      data: { type: "appointment", status: "get", data: formData },
    }).then(({ body }) => {
      if (body.length) {
        body.forEach((el) => {
          $(".appointment").append(`
            <div>
                <h4>${el.lastname} ${el.firstname}</h4>
                <label>Phone:</label>
                <h6>${el.phone}</h6>
                <div style='display:flex; gap:25px; justify-content:center;'>
                    <div>
                        <label>Appointment:</label>
                        <div style='display:flex; align-items:center; gap:15px;'>
                            <input class='form-control' disabled type='date' value='${el.date}'>
                            <input class='form-control' disabled type='time' value='${el.time}'>
                        </div>
                    </div>
                </div>
            </div>
          `);
        });
      } else {
        $(select)
          .siblings(".message")
          .text("There is no appointment on that date.");

        $(select).siblings(".message").css("display", "block");
      }
    });
  });
}

function CreateNew(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $(data).siblings(".message").empty();
    $.ajax({
      url,
      data: { type, status: "create", data: formData },
    }).then(({ body }) => {
      $(data).siblings(".message").text(body);
      $(data).siblings(".message").css("display", "block");
    });
  });
}
function CreateNewThreatment(data) {
  $(function () {
    const formData = $(data).closest("form").serialize();

    const property = document.getElementById("photo").files[0];

    const form_data = new FormData();
    form_data.append("file", property);

    if (property) {
      $.ajax({
        url: "../uploads/uploads.php",
        data: form_data,
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
      }).then((res) => {
        let response;
        if (res) {
          response = JSON.parse(res);
        }

        $.ajax({
          url,
          data: {
            type: "threatment",
            status: "create",
            data: formData + `&picture=${response?.name}`,
          },
        }).then(({ body }) => {
          $(data).siblings(".message").text(body);
          $(data).siblings(".message").css("display", "block");
        });
      });
    } else {
      $.ajax({
        url,
        data: {
          type: "threatment",
          status: "create",
          data: formData + `&picture=`,
        },
      }).then(({ body }) => {
        $(data).siblings(".message").text(body);
        $(data).siblings(".message").css("display", "block");
      });
    }
  });
}

function OpenDialog(data) {
  $(function () {
    $(data).siblings(".book").toggleClass("modal");
    $(data).closest(".book").toggleClass("modal");
  });
}

function toggleTabs(data) {
  $(function () {
    const buttons = ["first", "second", "third", "fourth", "fifth"];
    buttons.forEach((el) => {
      if ($(data).hasClass(el)) {
        buttons.filter((ele) => {
          if (ele != el) {
            $(`.${ele}`).removeClass("active");
          }
        });
      }
    });
    $(data).addClass("active");
  });
}

function Cancel(data, type, endDate) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    const date = new Date();
    const end_Date = new Date(endDate);
    const isoDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000)
      .toISOString()
      .split(".")[0];
    const isoEndDate = new Date(
      end_Date.getTime() - end_Date.getTimezoneOffset() * 60000
    ).setUTCHours(end_Date.getHours() - 4);

    if (new Date(isoEndDate).toISOString().split(".")[0] > isoDate) {
      $.ajax({
        url,
        data: { type, status: "cancel", data: formData },
      }).then(({ message }) => {
        $(data).siblings(".message").text(body);
        $(data).siblings(".message").css("display", "block");
        $(data).closest(".form").css("background-color", "rgba(255,0,0,0.1)");
      });
    } else {
      $(data).siblings(".message").text("You can not cancel this appointment.");
      $(data).siblings(".message").css("display", "block");
    }
  });
}

function DeleteEntry(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $.ajax({
      url,
      data: { type, status: "delete", data: formData },
    }).then(() => {
      $(data).closest("form").remove();
    });
  });
}

function CancelUser(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    $.ajax({
      url,
      data: { type, status: "block", data: formData },
    }).then(({ body }) => {
      $(data).siblings(".message").text(body);
      $(data).siblings(".message").css("display", "block");
    });
  });
}
