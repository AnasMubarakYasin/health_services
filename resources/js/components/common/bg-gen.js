const div = document.createElement("div");
div.classList.add(
  "fixed",
  "top-0",
  "w-screen",
  "h-screen",
  "overflow-hidden"
);
document.body.prepend(div);
const rect = div.getBoundingClientRect();
gen_rects(20, div);

function gen_rects(limit, parent) {
  const colors = [];
  for (let index = 0; index < limit; index++) {
    let box = document.createElement("div");
    box.classList.add("box");
    box.style.position = "absolute";
    box.style.width = `${getRandomArbitrary(10, 100)}px`;
    box.style.height = `${getRandomArbitrary(10, 100)}px`;
    box.style.left = `${getRandomArbitrary(10, 100)}%`;
    box.style.top = `${getRandomArbitrary(10, 100)}%`;
    box.style.backgroundColor = "transparent";
    box.style.border = "2px solid hsl(var(--b3))";
    box.style.borderRadius = "8px";
    // box.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
    parent.appendChild(box);
  }
}
function getRandomArbitrary(min, max) {
  return Math.random() * (max - min) + min;
}
