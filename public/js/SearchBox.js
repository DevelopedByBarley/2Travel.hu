const searchBoxToggler = document.getElementById("search-box-toggler");
const searchBox = document.getElementById("search-box")
const guestCounter = document.getElementById("guestCounter");

function searchActiveToggle(event) {
    event.preventDefault();
    searchBox.classList.toggle("active");
}

function setCountOfPeoplesToggler(event) {
    event.preventDefault();
    console.log(event.target);
    guestCounter.classList.toggle("active");
}