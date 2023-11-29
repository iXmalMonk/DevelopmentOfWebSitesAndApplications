var position = 0
var isLoad = false

function start() {
    isLoad = true
    uploadBatch()
}

function stop() {
    isLoad = false
}

function load() {
    if (!isLoad) {
        return
    }
    var xhr = new XMLHttpRequest()
    xhr.open("POST", "load.php?position=" + position, true)
    xhr.onreadystatechange = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText)
            position = response.position
            if (position < 200000) {
                var progress = document.getElementById("myProgress")
                progress.value = ((position / 200000) * 100).toFixed(2)
                var label = document.getElementById("myLabel")
                label.textContent = progress.value + "%"
                load()
            } else {
                console.log("+")
            }
        }
    }
    xhr.send()
}

document.getElementById("startButton").addEventListener("click", start)
document.getElementById("stopButton").addEventListener("click", stop)