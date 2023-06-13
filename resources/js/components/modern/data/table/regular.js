import { Input, Select, initTE } from "tw-elements";

initTE({ Input });

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
