const hourEl = document.querySelector(".hour");
const minuteEl = document.querySelector(".minute");
const secondEl = document.querySelector(".second");

function update(){
    const date = new Date();
    setTimeout(update, 1000);
    const hour = date.getHours();
    const minute = date.getMinutes();
    const second = date.getSeconds();
    console.log(hour,minute,second);
    const hourDeg = (hour / 12)*360;
    hourEl.style.transform = `rotate(${hourDeg}deg)`
    const minuteDeg = (minute / 60)*360;
    minuteEl.style.transform = `rotate(${minuteDeg}deg)`
    const secondDeg = (second / 60)*360;
    secondEl.style.transform = `rotate(${secondDeg}deg)`
}
update();
