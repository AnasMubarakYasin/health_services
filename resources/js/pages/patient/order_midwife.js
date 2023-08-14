import { create_element } from "@/lib/helper";
import {
  Stepper,
  Datepicker,
  Timepicker,
  Input,
  Select,
  initTE,
} from "tw-elements";

initTE({ /* Stepper, */ Datepicker, Timepicker, Input, Select });

console.debug(midwife, schedules);

schedules = schedules.filter((item) => item.active);

const date_elm = document.getElementById("date");
const day_in_ms = 1e3 * 60 * 60 * 24;
const now = new Date();
const tomorrow = new Date(now.getTime() + day_in_ms * 1);
const next_seven_day = new Date(now.getTime() + day_in_ms * 7);
new Datepicker(date_elm, {
  filter: (date) => {
    const is_this_month = date.getMonth() == now.getMonth();
    const is_this_year = date.getFullYear() == now.getFullYear();
    const is_less_than_tomorrow = date.getDate() < tomorrow.getDate();
    const has_midwife_schedule = schedules.find(
      (schedule) => date.getDay() == day_to_index(schedule.day)
    );
    const is_greater_than_next_seven_day =
      date.getDate() > next_seven_day.getDate();
    const is_saturday = date.getDay() == 6;
    const is_sunday = date.getDay() == 0;

    return (
      is_this_month &&
      is_this_year &&
      !is_less_than_tomorrow &&
      !!has_midwife_schedule &&
      !is_greater_than_next_seven_day &&
      !is_saturday &&
      !is_sunday
    );
  },
});
date_elm.addEventListener("dateChange.te.datepicker", (event) => {
  const selected_schedule = schedules.filter(
    (schedule) => day_to_index(schedule.day) == event.date.getDay()
  );
  const option_elm = document.createElement("option");
  option_elm.value = "";
  option_elm.hidden = true;
  option_elm.selected = true;
  time_elm.replaceChildren(option_elm);
  work_times.forEach((time) => {
    const option_elm = document.createElement("option");
    option_elm.value = time.value;
    option_elm.textContent = time.label;
    option_elm.disabled = !selected_schedule.some((schedule) =>
      between_timerange(
        time.value * 36e5,
        schedule.started_at,
        schedule.ended_at
      )
    );
    time_elm.append(option_elm);
  });
});

const time_elm = document.getElementById("time");
const start_time_work = 8;
const sum_time_work = 12;
const times = new Array(sum_time_work).fill(0).map((_, index) => {
  const time = index + start_time_work;
  const hour = time < 10 ? `0${time}` : time;
  return {
    label: `${hour}:00 - ${hour}:55`,
    value: time,
  };
});
const rest_times = ["12", "16", "17"];
const work_times = times.filter((work_time) => {
  const is_rest_time = rest_times.find(
    (rest_time) => rest_time == work_time.value
  );
  return !is_rest_time;
});
const time_comp = new Select(time_elm, {});
time_elm.addEventListener("valueChange.te.select", (event) => {});

const location_elm = document.getElementById("location");
const position_elm = document.getElementById("position");
const toggle_location_elm = document.getElementById("toggle_location");
toggle_location_elm.addEventListener("click", (event) => {
  navigator.geolocation.getCurrentPosition(
    (position) => {
      console.debug(position);
      location_elm.value = "Current Position";
      location_elm.focus();
      position_elm.value = `[${position.coords.longitude},${position.coords.latitude}]`;
    },
    (error) => {
      console.debug(error);
      throw error;
    },
    {
      enableHighAccuracy: true,
    }
  );
});

function day_to_index(day) {
  switch (day) {
    case "sunday":
      return 0;
    case "monday":
      return 1;
    case "tuesday":
      return 2;
    case "wednesday":
      return 3;
    case "thursday":
      return 4;
    case "friday":
      return 5;
    case "saturday":
      return 6;

    default:
      throw new Error("unknown day");
  }
}
function between_timerange(time, start, end) {
  const [start_ms, end_ms] = parse_timerange(start, end);
  return start_ms <= time && time <= end_ms;
}
function parse_timerange(start, end) {
  return [parse_timestring(start), parse_timestring(end)];
}
function parse_timestring(str) {
  const [h, m, s] = str.split(":");
  let ms = 0;
  ms += h * 36e5;
  ms += m * 6e4;
  ms += s * 1e3;
  return ms;
}
