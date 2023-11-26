import { create_element, wait } from "@/lib/helper";
import { Datepicker, Timepicker, Input, Select, initTE } from "tw-elements";
import { latLng, latLngBounds } from "leaflet";

initTE({ Datepicker, Timepicker, Input, Select });

const data = {
  midwife: null,
  schedules: [],
  orders: [],
};
const value = {};

if (!location_limit?.address) {
  throw new Error("location limit not setup yet");
}
if (history.state) {
  Object.assign(value, history.state.data);
  value.address = history.state.result.address;
  value.coordinates = history.state.result.coordinates;
}

location_limit = {
  coordinates: JSON.parse(location_limit.coordinates),
  address: location_limit.address,
  distance: location_limit.distance * 1e3,
  bounds: JSON.parse(location_limit.bounds),
};

// console.log(value, location_limit);

const service_elm = document.getElementById("service");
const service_lib = Select.getInstance(service_elm);
service_elm.addEventListener("change", (ev) => {
  value.service = service_elm.value;
  // console.log(value);
});

const midwife_elm = document.getElementById("midwife");
const midwife_lib = new Select(midwife_elm, {});
midwife_elm.addEventListener("valueChange.te.select", (event) => {
  value.midwife = event.value;
  // console.log(value);

  const midwife = midwifes.find((midwife) => midwife.id == event.value);
  if (!midwife) return;
  data.midwife = midwife;
  data.schedules = schedules.filter(
    (schedule) => schedule.midwife_id == midwife.id
  );
  data.orders = orders.filter((order) => order.midwife_id == midwife.id);
  const input = date_elm.querySelector("input");
  input.value = "";
  input.focus();
  time_lib.setValue("");
});

const date_elm = document.getElementById("date");
const day_in_ms = 1e3 * 60 * 60 * 24;
const now = new Date();
const tomorrow = new Date(now.getTime() + day_in_ms * 1);
tomorrow.setHours(0, 0, 0, 0);
const next_seven_day = new Date(tomorrow.getTime() + day_in_ms * 6);
next_seven_day.setHours(0, 0, 0, 0);
const date_lib = new Datepicker(date_elm, {
  filter: (date) => {
    date.setHours(0, 0, 0, 0);
    const is_less_than_tomorrow = date.getTime() < tomorrow.getTime();
    const is_greater_than_next_seven_day =
      date.getTime() > next_seven_day.getTime();
    const has_midwife_schedule = data.schedules.find(
      (schedule) => date.getDay() == day_to_index(schedule.day)
    );
    const is_saturday = date.getDay() == 6;
    const is_sunday = date.getDay() == 0;

    return (
      !is_less_than_tomorrow &&
      !is_greater_than_next_seven_day &&
      !!has_midwife_schedule &&
      !is_saturday &&
      !is_sunday
    );
  },
});
date_elm.addEventListener("dateChange.te.datepicker", (event) => {
  value.date = event.date;
  // console.log(value);

  const selected_schedule = data.schedules.filter(
    (schedule) => day_to_index(schedule.day) == event.date.getDay()
  );
  const selected_order = data.orders.filter(
    (order) => new Date(order.schedule).getDate() == event.date.getDate()
  );
  const option_elm = document.createElement("option");
  option_elm.value = "";
  option_elm.hidden = true;
  option_elm.selected = true;
  time_elm.replaceChildren(option_elm);
  work_times.forEach((time) => {
    const hour = time.value * 36e5;
    const option_elm = document.createElement("option");
    option_elm.value = time.value;
    option_elm.textContent = time.label;
    option_elm.disabled = !selected_schedule.some((schedule) =>
      between_timerange(hour, schedule.started_at, schedule.ended_at)
    );
    !option_elm.disabled &&
      (option_elm.disabled = selected_order.some((order) =>
        between_timerange(hour, order.schedule_start, order.schedule_end)
      ));
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
const time_lib = new Select(time_elm, {});
time_elm.addEventListener("valueChange.te.select", (event) => {
  value.time = event.value;
  // console.log(value);
});

const location_elm = document.getElementById("location");
const position_elm = document.getElementById("position");
const location_btn_elm = document.getElementById("location_btn");
const location_list_elm = document.getElementById("location_list");
const toggle_location_elm = document.getElementById("toggle_location");
function search(address) {
  fetch(`https://geocode.maps.co/search?q=${address}`, {
    mode: "cors",
  })
    .then((res) => res.json())
    .then((body) => {
      const options = [];
      for (const item of body) {
        const elm = create_element(`
        <li>
          <button type="button" class="block w-full text-left whitespace-nowrap px-4 py-2 text-sm font-normal text-base-content hover:bg-base-200"
              data-te-dropdown-item-ref>${item.display_name}</button>
        </li>`);
        elm.addEventListener("click", () => {
          position_elm.value = `[${item.lon},${item.lat}]`;
          location_elm.value = item.display_name;
          location_elm.focus();
        });
        options.push(elm);
      }
      if (!body.length) {
        const elm = create_element(`
        <li>
          <div class="block w-full px-4 py-2 text-sm text-center font-normal bg-base-200 text-base-content/70">
            Empty
          </div>
        </li>`);
        options.push(elm);
      }
      location_list_elm.replaceChildren(...options);
      location_btn_elm.click();
    });
}
location_elm.addEventListener("input", (event) => {
  wait({
    delay: 2000,
    timeout: 0,
    arg: event.target.value,
    callback: search,
  });
});
toggle_location_elm.addEventListener("click", (event) => {
  navigator.geolocation.getCurrentPosition(
    (position) => {
      position_elm.value = `[${position.coords.longitude},${position.coords.latitude}]`;
      fetch(
        `https://geocode.maps.co/reverse?lat=${position.coords.latitude}&lon=${position.coords.longitude}`,
        {
          mode: "cors",
        }
      )
        .then((res) => res.json())
        .then((body) => {
          location_elm.value = body.display_name;
          location_elm.focus();
        });
    },
    (error) => {
      throw error;
    }
  );
});

const orders_elm = document.getElementById("orders");

if (value.service) {
  setTimeout(() => {
    service_lib.setValue(value.service);
  }, 250);
}
if (value.midwife) {
  setTimeout(() => {
    midwife_lib.open();
    midwife_lib.setValue(value.midwife);
    midwife_elm.dispatchEvent(
      Object.assign(new CustomEvent("valueChange.te.select"), {
        value: value.midwife,
      })
    );
    midwife_lib.close();
  }, 250);
}
if (value.date) {
  setTimeout(() => {
    date_lib.open();
    document
      .querySelector(
        `[data-te-date="${value.date.getFullYear()}-${value.date.getMonth()}-${value.date.getDate()}"]`
      )
      .click();
    date_lib.close();
  }, 250);
}
if (value.midwife) {
  setTimeout(() => {
    time_lib.open();
    time_lib.setValue(value.time);
    time_elm.dispatchEvent(
      Object.assign(new CustomEvent("valueChange.te.select"), {
        value: value.time,
      })
    );
    time_lib.close();
  }, 250);
}
if (value.address) {
  setTimeout(() => {
    location_elm.value = value.address;
    position_elm.value = JSON.stringify(value.coordinates);
    location_elm.click();
    location_elm.focus();
    if (
      !latLngBounds(
        latLng(location_limit.bounds._southWest),
        latLng(location_limit.bounds._northEast)
      ).contains(latLng(value.coordinates))
    ) {
      const div = create_element(
        `<div id="location-error" class="w-full text-sm text-error" data-te-input-helper-ref>lokasi diluar jangkauan</div>`
      );
      location_elm.parentElement.parentElement.append(div);
      orders_elm.disabled = true;
    }
  }, 250);
}
const toggle_map_elm = document.getElementById("toggle_map");
toggle_map_elm.addEventListener("click", (ev) => {
  history.pushState(
    {
      request: "select",
      source: location + "",
      data: value,
    },
    "",
    toggle_map_elm.dataset.href
  );
  location.assign(toggle_map_elm.dataset.href);
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
