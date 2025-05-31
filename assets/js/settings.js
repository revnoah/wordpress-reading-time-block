document.addEventListener("DOMContentLoaded", function () {
    const speedInput = document.getElementById("reading_time_speed");
    const options = document.querySelectorAll("#reading_speed_options a");

    options.forEach(option => {
        option.addEventListener("click", function (event) {
            event.preventDefault();
            const value = this.dataset.value;
            speedInput.value = value;
        });
    });
});
