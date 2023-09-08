import { Sequence } from "@/lib/helper";

const progressElm = document.getElementById("progress-bar");
const progressVal = progressElm.firstElementChild;
const resumeProgress = sessionStorage.getItem("sequence") ?? 0;
const sequence = new Sequence({
  progress: +resumeProgress,
  timeout: 5000,
  alwaysReset: true,
});
sequence.onStart = function () {
};
sequence.onProgress = function (value) {
  console.log('progress', value);
  progressVal.style.width = value + "%";
};
sequence.onFinish = function () {
  progressVal.style.width = "100%";
  setTimeout(() => {
    progressVal.style.opacity = '0';
    setTimeout(() => {
      progressVal.style.width = "0%";
      progressVal.style.opacity = '1';
    }, 300);
  }, 300);
};
sequence.start();
window.addEventListener("unload", (e) => {
  sessionStorage.setItem("sequence", 0);
  sequence.pause();
});
window.addEventListener("beforeunload", (e) => {
  sequence.start();
});
window.addEventListener("load", (e) => {
  sequence.finish();
});
