const form = document.querySelector("form");
const async = document.querySelector("#async");
const input = document.querySelector("#input");
const output = document.querySelector("#output");

form.addEventListener("submit", (event) => {
  async.checked && event.preventDefault();
  const es = new EventSource(async_url + "?input=" + input.value);
  es.addEventListener("message", (evt) => {
    output.value += evt.data.replaceAll("$n", "\n");
  });
  es.addEventListener("open", (evt) => {
    console.log("open", evt);
  });
  es.addEventListener("error", (evt) => {
    console.log("error", evt);
    es.close();
  });
});
