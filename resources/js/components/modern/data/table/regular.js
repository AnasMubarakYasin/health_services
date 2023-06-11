import { Input, Select, initTE } from "tw-elements";

initTE({ Input });

const select_style = {
    selectLabelWhite: "text-base-300",
    dropdown:
        "relative outline-none w-20 m-0 scale-[0.8] opacity-0 bg-base-100 shadow-[0_2px_5px_0_rgba(0,0,0,0.16),_0_2px_10px_0_rgba(0,0,0,0.12)] transition duration-200 motion-reduce:transition-none data-[te-select-open]:scale-100 data-[te-select-open]:opacity-100",
    selectOption:
        "flex flex-row items-center justify-between w-full px-4 truncate text-base-content bg-transparent select-none cursor-pointer data-[te-input-multiple-active]:bg-black/5 hover:[&:not([data-te-select-option-disabled])]:bg-black/5 data-[te-input-state-active]:bg-black/5 data-[te-select-option-selected]:data-[te-input-state-active]:bg-black/5 data-[te-select-selected]:data-[te-select-option-disabled]:cursor-default data-[te-select-selected]:data-[te-select-option-disabled]:text-base-300 data-[te-select-selected]:data-[te-select-option-disabled]:bg-transparent data-[te-select-option-selected]:bg-black/[0.02] data-[te-select-option-disabled]:text-base-300 data-[te-select-option-disabled]:cursor-default group-data-[te-select-option-group-ref]/opt:pl-7",
    selectInput:
        "peer block w-20 h-10 rounded border-0 bg-base-100 outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0 cursor-pointer data-[te-input-disabled]:bg-[#e9ecef] data-[te-input-disabled]:cursor-default group-data-[te-was-validated]/validation:mb-4",
    selectArrowDefault: "top-2.5",
};

const table_show_elm = document.getElementById("table_show");
const table_show_lib = new Select(table_show_elm, {}, select_style);
table_show_lib.setValue(10);
