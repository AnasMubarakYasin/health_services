const mode = localStorage.getItem("theme") ?? "light";
const elm = document.getElementById("theme_toggle");
elm.checked = mode == "light" ? false : true;
document.documentElement.dataset.theme = mode;
elm.addEventListener("change", (ev) => {
  const mode = elm.checked ? "dark" : "light";
  document.documentElement.dataset.theme = mode;
  localStorage.setItem("theme", mode);
});
