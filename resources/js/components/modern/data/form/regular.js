import { Datepicker, Timepicker, Input, Select, initTE } from "tw-elements";

initTE({ Datepicker, Timepicker, Input, Select });

const file_elms = document
  .querySelectorAll("#form input[type=file]")
  .forEach((elm) => {
    // const field = elm.parentElement.dataset.field;
    elm.addEventListener("change", (event) => {
      elm.parentElement.querySelector("input").value = elm.value;
    });
  });
const toggle_elms = document
  .querySelectorAll("#form [data-toggle=password]")
  .forEach((elm) => {
    elm.addEventListener("click", (event) => {
      event.preventDefault();
      const child_input = elm.querySelector("input");
      child_input.checked = !child_input.checked;
      const input = elm.parentElement.querySelector("input");
      if (input.type == "text") {
        input.type = "password";
      } else {
        input.type = "text";
      }
    });
  });
const checkbox_elms = document
  .querySelectorAll("#form input[type=checkbox]")
  .forEach((elm) => {
    elm.addEventListener("change", (event) => {
      if (elm.checked) {
        elm.previousElementSibling.value = "1";
      } else {
        elm.previousElementSibling.value = "0";
      }
    });
  });

const inputs = [];
document
  .querySelectorAll("#form [data-focus=true]")
  .forEach((elm) => inputs.unshift(elm));
for (const Input of inputs) {
  Input.focus();
}

// new Input(document.querySelector("[data-te-input-wrapper-init]"), {
//   inputFormWhite: true,
// }, {
//   notch: "group flex absolute left-0 top-0 w-full max-w-full h-full text-left pointer-events-none",
//   notchLeading: "pointer-events-none border border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none left-0 top-0 h-full w-2 border-r-0 rounded-l-[0.25rem] group-data-[te-input-focused]:border-r-0 group-data-[te-input-state-active]:border-r-0",
//   notchLeadingNormal: "border-neutral-300 dark:border-neutral-600 group-data-[te-input-focused]:shadow-[-1px_0_0_#3b71ca,_0_1px_0_0_#3b71ca,_0_-1px_0_0_#3b71ca] group-data-[te-input-focused]:border-primary",
//   notchLeadingWhite: "border-neutral-200 group-data-[te-input-focused]:shadow-[-1px_0_0_#ffffff,_0_1px_0_0_#ffffff,_0_-1px_0_0_#ffffff] group-data-[te-input-focused]:border-white",
//   notchMiddle: "pointer-events-none border border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow-0 shrink-0 basis-auto w-auto max-w-[calc(100%-1rem)] h-full border-r-0 border-l-0 group-data-[te-input-focused]:border-x-0 group-data-[te-input-state-active]:border-x-0 group-data-[te-input-focused]:border-t group-data-[te-input-state-active]:border-t group-data-[te-input-focused]:border-solid group-data-[te-input-state-active]:border-solid group-data-[te-input-focused]:border-t-transparent group-data-[te-input-state-active]:border-t-transparent",
//   notchMiddleNormal: "border-neutral-300 dark:border-neutral-600 group-data-[te-input-focused]:shadow-[0_1px_0_0_#3b71ca] group-data-[te-input-focused]:border-primary",
//   notchMiddleWhite: "border-neutral-200 group-data-[te-input-focused]:shadow-[0_1px_0_0_#ffffff] group-data-[te-input-focused]:border-white",
//   notchTrailing: "pointer-events-none border border-solid box-border bg-transparent transition-all duration-200 ease-linear motion-reduce:transition-none grow h-full border-l-0 rounded-r-[0.25rem] group-data-[te-input-focused]:border-l-0 group-data-[te-input-state-active]:border-l-0",
//   notchTrailingNormal: "border-neutral-300 dark:border-neutral-600 group-data-[te-input-focused]:shadow-[1px_0_0_#3b71ca,_0_-1px_0_0_#3b71ca,_0_1px_0_0_#3b71ca] group-data-[te-input-focused]:border-primary",
//   notchTrailingWhite: "border-neutral-200 group-data-[te-input-focused]:shadow-[1px_0_0_#ffffff,_0_-1px_0_0_#ffffff,_0_1px_0_0_#ffffff] group-data-[te-input-focused]:border-white",
// });

// for (const elm of document.querySelectorAll("#form input")) {
//   new Input(elm.parentElement, {

//   })
// }

// const datepicker = document.getElementById("datepicker");
// const datepicker_lib = new Datepicker(datepicker, { inline: true });
// document.getElementById('datepicker-toggle').addEventListener('click', () => {
//     datepicker_lib.open();
// })

// const picker = document.querySelector("#timepicker-format");
// const tpFormat24 = new Timepicker(picker, {
//     format24: true,
//     // inline: true,
//     increment: true,
// });
