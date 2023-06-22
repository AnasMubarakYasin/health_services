import { Input, Select, Modal, initTE } from "tw-elements";

initTE({ Input, Modal });

const select_style = {
  selectLabelWhite: "text-base-300",
  inputGroup:
    "flex items-center whitespace-nowrap p-2.5 text-center text-base font-normal leading-[1.6] text-base-content",
  formCheckInput:
    "relative float-left mt-[3px] mr-2 h-4 w-4 cursor-pointer appearance-none rounded-sm border border-base-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 motion-reduce:transition-none checked:border-primary checked:bg-blue-600 checked:after:absolute checked:after:ml-[5px] checked:after:mt-px checked:after:block checked:after:h-[9px] checked:after:w-[5px] checked:after:rotate-45 checked:after:border-2 checked:after:border-t-0 checked:after:border-l-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] focus:outline-none group-data-[te-select-option-text-ref]:mr-2.5",
  dropdown:
    "relative outline-none w-20 m-0 scale-[0.8] opacity-0 bg-base-100 shadow-[0_2px_5px_0_rgba(0,0,0,0.16),_0_2px_10px_0_rgba(0,0,0,0.12)] transition duration-200 motion-reduce:transition-none data-[te-select-open]:scale-100 data-[te-select-open]:opacity-100",
  selectOption:
    "flex flex-row items-center justify-between w-full px-4 truncate text-base-content bg-transparent select-none cursor-pointer data-[te-input-multiple-active]:bg-base-200 hover:[&:not([data-te-select-option-disabled])]:bg-base-200 data-[te-input-state-active]:bg-base-200 data-[te-select-option-selected]:data-[te-input-state-active]:bg-base-200 data-[te-select-selected]:data-[te-select-option-disabled]:cursor-default data-[te-select-selected]:data-[te-select-option-disabled]:text-base-300 data-[te-select-selected]:data-[te-select-option-disabled]:bg-transparent data-[te-select-option-selected]:bg-black/[0.02] data-[te-select-option-disabled]:text-base-300 data-[te-select-option-disabled]:cursor-default group-data-[te-select-option-group-ref]/opt:pl-7",
  selectInput:
    "peer block w-20 h-10 rounded border-0 bg-base-100 outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 cursor-pointer data-[te-input-disabled]:bg-[#e9ecef] data-[te-input-disabled]:cursor-default group-data-[te-was-validated]/validation:mb-4",
  selectArrowDefault: "top-2.5",
};

const table_show_elm = document.getElementById("table_show");
const table_show_lib = new Select(table_show_elm, {}, select_style);

table_show_elm.addEventListener("valueChange.te.select", () => {
  // console.log(table_show_elm.value);
  const query = new URLSearchParams(location.search);
  query.set("perpage", table_show_elm.value);
  location.search = query.toString();
});

const check_mode_elm = document.getElementById("check_mode");
const check_item_elms = document.querySelectorAll(".check_item");
let check_mode = check_mode_elm.checked;
if (check_mode_elm) {
  check_mode_elm.addEventListener('change', (ev) => {
    check_mode = check_mode_elm.checked;
    show_delete_any(check_mode);
    if (check_mode) {
      const row_old = document.querySelector("[data-row_active=true]");
      if (row_old) {
        row_deselect(row_old);
      }
      const col_old = document.querySelector("[data-col_active=true]");
      if (col_old) {
        col_deselect(col_old, col_old.dataset.col_index);
      }
      check_all();
    } else {
      uncheck_all();
    }
  })
  check_item_elms.forEach((elm) => {
    elm.addEventListener('change', (ev) => {
      if (elm.checked) {
        row_select(elm.parentElement.parentElement);
      } else {
        row_deselect(elm.parentElement.parentElement);
      }
      let count = 0;
      for (const elm of check_item_elms) {
        if (elm.checked) continue;
        count++;
      }
      if (!count) {
        check_mode_elm.checked = true;
        check_mode_elm.indeterminate = false;
        check_mode = true;
      } else if (count == check_item_elms.length) {
        check_mode_elm.checked = false;
        check_mode_elm.indeterminate = false;
        check_mode = false;
      } else {
        check_mode_elm.indeterminate = true;
        check_mode = true;
      }
      show_delete_any(check_mode);
    })
  })
}

document.querySelectorAll("[data-row=true]").forEach((elm) => {
  elm.addEventListener("click", (ev) => {
    if (check_mode) return
    if (elm.dataset.row_active == "true") {
      row_deselect(elm);
    } else {
      const elm_old = document.querySelector("[data-row_active=true]");
      if (elm_old) {
        row_deselect(elm_old);
      }
      row_select(elm);
    }
  });
});
document.querySelectorAll("[data-col=true]").forEach((elm) => {
  const index = elm.dataset.col_index;
  elm.addEventListener("click", (ev) => {
    if (check_mode) return
    if (elm.dataset.col_active == "true") {
      col_deselect(elm, index);
    } else {
      const elm_old = document.querySelector("[data-col_active=true]");
      if (elm_old) {
        col_deselect(elm_old, elm_old.dataset.col_index);
      }
      col_select(elm, index);
    }
  });
});
// const table_elm = document.querySelector('table')
const iteration_elm = document.querySelector('[data-iteration=true]')
document.querySelectorAll("table thead tr th.left-10").forEach((elm) => {
  elm.style.left = `${iteration_elm.clientWidth}px`;
})

const action_elm = document.getElementById('action');
action_elm.addEventListener('click', () => {
  document.querySelectorAll('[data-action=true]').forEach((elm) => {
    elm.classList.toggle('sticky');
  })
})

function show_delete_any(state = true) {
  document.getElementById('delete_any').dataset.show = state;
}
function check_all() {
  for (const elm of check_item_elms) {
    elm.checked = true;
    row_select(elm.parentElement.parentElement);
  }
}
function uncheck_all() {
  for (const elm of check_item_elms) {
    elm.checked = false;
    row_deselect(elm.parentElement.parentElement);
  }
}
function row_select(elm) {
  elm.dataset.row_active = true;
  for (const child of elm.parentElement.children) {
    child.dataset.cell_active = child.dataset.cell_active
      ? +child.dataset.cell_active + 1
      : 1;
    child.classList.add("bg-base-200");
  }
}
function row_deselect(elm) {
  elm.dataset.row_active = false;
  for (const child of elm.parentElement.children ?? []) {
    child.dataset.cell_active = +child.dataset.cell_active - 1;
    if (child.dataset.cell_active == "1") continue;
    child.classList.remove("bg-base-200");
  }
}
function col_select(elm, index) {
  elm.dataset.col_active = true;
  for (const child of document.querySelectorAll(
    `[data-col_index="${index}"]`
  )) {
    child.dataset.cell_active = child.dataset.cell_active
      ? +child.dataset.cell_active + 1
      : 1;
    child.classList.add("bg-base-200");
  }
}
function col_deselect(elm, index) {
  elm.dataset.col_active = false;
  for (const child of document.querySelectorAll(
    `[data-col_index="${index}"]`
  )) {
    child.dataset.cell_active = +child.dataset.cell_active - 1;
    if (child.dataset.cell_active == "1") continue;
    child.classList.remove("bg-base-200");
  }
}
