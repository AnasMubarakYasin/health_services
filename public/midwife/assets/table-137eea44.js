import{a as c}from"./helper-b8faab3a.js";const t=document.getElementById("delete_any_btn");c("table",e=>{t&&(e.checked||e.indeterminate?t.classList.replace("hidden","flex"):t.classList.replace("flex","hidden"))});var n;(n=document.getElementById("perpage"))==null||n.addEventListener("change",e=>{const a=new URLSearchParams(location.search);a.append("perpage",e.target.value),location.assign("?"+a.toString())});
