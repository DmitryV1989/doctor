function countDownElTimer(countDown, digitEl = ".digit", hideEl = ".count-hide", speed = 1000) {
    let closeTimer,
        counterLabel = document.querySelector(digitEl);
    counterLabel.innerHTML = countDown--;
    closeTimer = setInterval(function() {
        if(countDown == 0) {
            document.querySelector(hideEl).style.display = "none";
            clearInterval(closeTimer);
        }
        counterLabel.innerHTML = countDown;
        countDown--;
    }, speed);
}