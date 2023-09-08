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
  // progressVal.style.width = "0%";
};
sequence.onProgress = function (value) {
  progressVal.style.width = value + "%";
};
sequence.onFinish = function () {
  progressVal.style.width = "0%";
};
sequence.start();
window.addEventListener("unload", (e) => {
  sessionStorage.setItem("sequence", sequence.progress);
  sequence.pause();
});
window.addEventListener("beforeunload", (e) => {
  sequence.start();
});
window.addEventListener("load", (e) => {
  sequence.finish();
});
