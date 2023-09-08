import { Sequence } from "@/lib/helper";

const progressElm = document.getElementById("progress-bar");
const progressVal = progressElm.firstElementChild;
const resumeProgress = sessionStorage.getItem("sequence.progress") ?? 0;
const resumeTime = sessionStorage.getItem("sequence.time") ?? 0;
const sequence = new Sequence({
  progress: +resumeProgress,
  time: +resumeTime,
  timeout: 10000,
  completion: 1500,
  alwaysReset: true,
});
window.progress = sequence;
sequence.onStart = function () {};
sequence.onProgress = function (value) {
  progressVal.style.width = value + "%";
};
sequence.onFinish = function () {
  progressVal.style.width = "100%";
  requestAnimationFrame(() => {
    setTimeout(() => {
      progressVal.style.opacity = "0";
    }, 500);
    setTimeout(() => {
      progressVal.style.width = "0%";
      progressVal.style.opacity = "1";
    }, 1000);
  });
  sessionStorage.setItem("sequence", 0);
};
sequence.start();
window.addEventListener("unload", (e) => {
  sessionStorage.setItem("sequence.progress", sequence.progress);
  sessionStorage.setItem("sequence.time", sequence.time);
});
window.addEventListener("beforeunload", (e) => {
  sequence.start();
});
window.addEventListener("load", (e) => {
  requestIdleCallback(() => {
    sequence.finish();
  });
});
