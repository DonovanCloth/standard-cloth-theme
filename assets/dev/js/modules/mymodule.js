let hamburgerBtn = document.querySelector(".hamburger-btn");
let nav = document.querySelector(".nav");
let opacityLayer = document.querySelector(".opacity-layer");

console.log(hamburgerBtn, nav, opacityLayer);

hamburgerBtn.addEventListener("click", () => {
  hamburgerBtn.classList.toggle("hamburger-btn--active");
  nav.classList.toggle("nav--active");
  opacityLayer.classList.toggle("opacity-layer--active");
});

opacityLayer.addEventListener("click", (e) => {
  hamburgerBtn.classList.remove("hamburger-btn--active");
  nav.classList.remove("nav--active");
  opacityLayer.classList.remove("opacity-layer--active");
});
