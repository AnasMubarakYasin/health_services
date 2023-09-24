class Sequence {
  time = 0;
  progress = 0;
  timeout = 2000;

  startValue = 0;
  max = 100;

  interval = 16;
  delay = 16;
  percent = 0;
  id = 0;
  idEnd = 0;

  options;

  constructor(options) {
    const opts = Object.assign(
      {},
      {
        max: 100,
        time: 0,
        progress: 0,
        timeout: 2000,
        completion: 1000,
        alwaysReset: false,
      },
      options
    );
    this.max = opts.max;
    this.time = opts.time;
    this.timeout = opts.timeout;
    this.progress = opts.progress;
    this.percent = this.genPercent();
    this.options = opts;
  }

  start() {
    this.addStart();
    this.addFinish();
  }
  resume() {
    this.addStart();
    this.addFinish();
  }
  pause() {
    clearInterval(this.id);
    clearTimeout(this.idEnd);
  }
  finish() {
    this.pause();
    this.time = 0;
    this.timeout = this.options.completion;
    this.percent = this.genPercent();
    this.addStart();
    this.addFinish();
  }
  stop() {
    this.pause();
  }
  reset() {
    this.time = 0;
    this.timeout = this.options.timeout;
    this.percent = this.genPercent();
    this.progress = 0;
  }
  genPercent() {
    return this.max / this.timeout;
  }
  addStart() {
    const interval = this.interval;
    const percent = this.percent;

    this.onStart?.();

    this.id = setInterval(() => {
      this.onProgress?.(this.progress);

      this.time += interval;
      this.progress += percent * interval;
    }, interval);
  }
  addFinish() {
    this.idEnd = setTimeout(() => {
      clearInterval(this.id);

      this.onFinish?.();
      this.stop();

      if (this.options.alwaysReset) {
        this.reset();
      }
    }, this.timeout + this.delay - this.time);
  }
}
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
