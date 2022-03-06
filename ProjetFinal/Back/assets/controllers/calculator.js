export default function () {
  const $showResult = $(".result");
  const baseUrl = window.location.origin + window.location.pathname;

  const setValue = (value) => {
    $showResult.text(value);
  };

  const sendToApi = (endpoint, data) => {
    $.post({
      url: `${baseUrl}api/calculator/${endpoint}`,
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json; charset=utf-8",
    }).done((result) => {
      setValue(result["value"]);
    });
  };

  const prepareSendToApi = () => {
    const currentValue = $showResult.text();
    if (currentValue === "") return;

    if (currentValue.includes("+")) {
      const values = currentValue.split("+");
      const value1 = values[0];
      const value2 = values[1];
      sendToApi("addition", {
        value1,
        value2,
      });
    } else if (currentValue.includes("-")) {
      const values = currentValue.split("-");
      const value1 = values[0];
      const value2 = values[1];
      sendToApi("substraction", {
        value1,
        value2,
      });
    } else if (currentValue.includes("/")) {
      const values = currentValue.split("/");
      const value1 = values[0];
      const value2 = values[1];
      sendToApi("division", {
        value1,
        value2,
      });
    } else if (currentValue.includes("%")) {
      const values = currentValue.split("%");
      const value1 = values[0];
      const value2 = values[1];
      sendToApi("modulo", {
        value1,
        value2,
      });
    } else if (currentValue.includes("√x")) {
      const values = currentValue.split("√x");
      const value1 = values[0];
      const value2 = values[1];
      sendToApi("square", {
        value1,
        value2,
      });
    }
  };

  const init = () => {
    $(".touch").click((e) => {
      const currentValue = $showResult.text();
      const touch = $(e.target);
      const value = touch.data("value");
      if (value === "C") {
        setValue("");
      } else if (value === "=") {
        prepareSendToApi();
      } else if (
        (currentValue.includes("+") ||
          currentValue.includes("-") ||
          currentValue.includes("/") ||
          currentValue.includes("%") ||
          currentValue.includes("√x")) &&
        Number.isNaN(Number(value))
      ) {
      } else {
        setValue(`${currentValue}${value}`);
      }
    });
  };
  return {
    init,
  };
}
