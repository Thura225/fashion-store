const side_btn = document.getElementById("side-btn");
const side = document.getElementById("side");
const close_btn = document.getElementById("close");
const cards = document.querySelectorAll(".card");
const feedbacks = documents.querySelectorAll(".feedback");
const orders = document.querySelectorAll('.order');
const items = document.querySelectorAll('.cart-item');


side_btn.addEventListener("click", function () {
  side.classList.remove("d-none");
  side.classList.add("d-flex");
});

close_btn.addEventListener("click", function () {
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
items.forEach((el) => observer.observe(el));
feedbacks.forEach((el)=>observer.observe(el));
orders.forEach((el)=>observer.observe(el));
