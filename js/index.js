const side_btn = document.getElementById("side-btn");
const side = document.getElementById("side");
const close_btn = document.getElementById("close");
const cards = document.querySelectorAll(".card");


side_btn.addEventListener("click", function () {
  side.classList.remove("d-none");
  side.classList.add("d-flex");
});

close_btn.addEventListener("click", function () {
  side.classList.remove("d-flex");
  side.classList.add("d-none");
});

side.addEventListener("click", function () {
  side.classList.remove("d-flex");
  side.classList.add("d-none");
});

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("slide-fwd");
    }
  });
});

let delay_time = 0;

for (let i = 0; i < cards.length; i++) {
  cards[i].style.transisitionDelay = `${delay_time}`;
  delay_time += 0.2;
  console.log(cards[i].style.transisitionDelay);
}

cards.forEach((el) => observer.observe(el));