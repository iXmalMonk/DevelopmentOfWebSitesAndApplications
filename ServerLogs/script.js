
var isLoad = false

function start() {
    if (!isLoad) {
        isLoad = true
        load()
    }
}

function stop() {
    if (isLoad) {
        isLoad = false
    }
}

var position = localStorage.getItem('position') || 0

function savePosition() {
    localStorage.setItem('position', position)
}

var sessionTime = 20 * 60 * 1000
var sessionTimeout

function login() {
    var progress = document.getElementById("myProgress")
    progress.value = position / 2000
    var label = document.getElementById("myLabel")
    label.textContent = progress.value + "%"
    clearTimeout(sessionTimeout)
    sessionTimeout = setTimeout(logout, sessionTime)
}

function logout() {
    localStorage.removeItem('position')
}

function load() {
    if (!isLoad) {
        return
    }
    var xhr = new XMLHttpRequest()
    xhr.open("POST", "load.php?position=" + position, true)
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText)
            position = response.position
            if (position < 200000) {
                var progress = document.getElementById("myProgress")
                progress.value = position / 2000
                var label = document.getElementById("myLabel")
                label.textContent = progress.value + "%"
                savePosition()
                login()
                load()
            } else {
                console.log("+")
            }
        }
    }
    xhr.send()
}

var data = null

function unload() {
    var xhr = new XMLHttpRequest()
    xhr.open("GET", "unload.php", true)
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText)
            data = response
            if (document.getElementById("dataContainer")) {
                printPage(currentPage)
            }
            if (document.getElementById("reportContainer")) {
                report()
            }
            console.log(response)
        }
    }
    xhr.send()
}

var currentPage = 0
var itemsPerPage = 500

function printPage(page) {
    if (page > Math.ceil(data.length / itemsPerPage) - 1) {
        page = Math.ceil(data.length / itemsPerPage) - 1
        currentPage = Math.ceil(data.length / itemsPerPage) - 1
    }
    if (page < 0)
    {
        page = 0
    }
    var pageLabel = document.getElementById("pageLabel")
    currentPage = page
    pageLabel.textContent = currentPage + '/' + (Math.ceil(data.length / itemsPerPage) - 1)
    dataContainer.innerHTML = ""
    var start = page * itemsPerPage
    var end = Math.min(start + itemsPerPage, data.length)
    for (var i = start; i < end; i++) {
        var d = data[i]
        var container = document.createElement("div")
        container.classList.add("container")
        // n
        var n = document.createElement("p")
        n.classList.add("n")
        n.textContent = d.id
        container.appendChild(n)
        // ipAddress
        var ipAddress = document.createElement("p")
        ipAddress.classList.add("ip-address")
        ipAddress.textContent = d.ip_address
        container.appendChild(ipAddress)
        // date
        var date = document.createElement("p")
        date.classList.add("date")
        date.textContent = d.date
        container.appendChild(date)
        // method
        var method = document.createElement("p")
        method.classList.add("method")
        method.textContent = d.method
        container.appendChild(method)
        // path
        var path = document.createElement("p")
        path.classList.add("path")
        path.textContent = d.path
        container.appendChild(path)
        // version
        var version = document.createElement("p")
        version.classList.add("version")
        version.textContent = d.version
        container.appendChild(version)
        // code
        var code = document.createElement("p")
        code.classList.add("code")
        code.textContent = d.code
        container.appendChild(code)
        // size
        var size = document.createElement("p")
        size.classList.add("size")
        size.textContent = d.size
        container.appendChild(size)
        // url
        var url = document.createElement("p")
        url.classList.add("url")
        url.textContent = d.url
        container.appendChild(url)
        // browser
        var browser = document.createElement("p")
        browser.classList.add("browser")
        browser.textContent = d.browser
        container.appendChild(browser)
        //
        dataContainer.appendChild(container)
    }
}

function previous() {
    if (currentPage > 0) {
        currentPage--
        printPage(currentPage)
    }
}

function next() {
    if (currentPage < data.length / itemsPerPage) {
        currentPage++
        printPage(currentPage)
    }
}

var ipAddressSort = false

function ipAddress() {
    data.sort(function(a, b) {
        var firstIp = a.ip_address.split(".")
        var secondIp = b.ip_address.split(".")
        for (var i = 0; i < 4; i++)
        {
            var firstNumber = parseInt(firstIp[i])
            var secondNumber = parseInt(secondIp[i])
            if (firstNumber < secondNumber) {
                return ipAddressSort ? -1 : 1
            }
            if (firstNumber > secondNumber) {
                return ipAddressSort ? 1 : -1
            }
        }
        return 0
    })
    ipAddressSort = !ipAddressSort
    printPage(currentPage)
}

var dateSort = false

function date() {
    data.sort(function(a, b) {
        if (a.date < b.date) {
            return dateSort ? -1 : 1
        }
        if (a.date > b.date) {
            return dateSort ? 1 : -1
        }
        return 0
    })
    dateSort = !dateSort
    printPage(currentPage)
}

var methodSort = false

function method() {
    data.sort(function(a, b) {
        if (a.method < b.method) {
            return methodSort ? -1 : 1
        }
        if (a.method > b.method) {
            return methodSort ? 1 : -1
        }
        return 0
    })
    methodSort = !methodSort
    printPage(currentPage)
}

var pathSort = false

function path() {
    data.sort(function(a, b) {
        if (a.path < b.path) {
            return pathSort ? -1 : 1
        }
        if (a.path > b.path) {
            return pathSort ? 1 : -1
        }
        return 0
    })
    pathSort = !pathSort
    printPage(currentPage)
}

var versionSort = false

function version() {
    data.sort(function(a, b) {
        if (a.version < b.version) {
            return versionSort ? -1 : 1
        }
        if (a.version > b.version) {
            return versionSort ? 1 : -1
        }
        return 0
    })
    versionSort = !versionSort
    printPage(currentPage)
}

var codeSort = false

function code() {
    data.sort(function(a, b) {
        if (a.code < b.code) {
            return codeSort ? -1 : 1
        }
        if (a.code > b.code) {
            return codeSort ? 1 : -1
        }
        return 0
    })
    codeSort = !codeSort
    printPage(currentPage)
}

var sizeSort = false

function size() {
    data.sort(function(a, b) {
        if (a.size < b.size) {
            return sizeSort ? -1 : 1
        }
        if (a.size > b.size) {
            return sizeSort ? 1 : -1
        }
        return 0
    })
    sizeSort = !sizeSort
    printPage(currentPage)
}

var urlSort = false

function url() {
    data.sort(function(a, b) {
        if (a.url < b.url) {
            return urlSort ? -1 : 1
        }
        if (a.url > b.url) {
            return urlSort ? 1 : -1
        }
        return 0
    })
    urlSort = !urlSort
    printPage(currentPage)
}

var browserSort = false

function browser() {
    data.sort(function(a, b) {
        if (a.browser < b.browser) {
            return browserSort ? -1 : 1
        }
        if (a.browser > b.browser) {
            return browserSort ? 1 : -1
        }
        return 0
    })
    browserSort = !browserSort
    printPage(currentPage)
}

var urls = {}
var totalSize = 0
var totalVisit = 0
function report() {
    data.forEach(function(d) {
        if (d.url !== "-") {
            if (!urls[d.url]) {
                urls[d.url] = {
                    size: d.size,
                    visit: 1
                }
            } else {
                urls[d.url].size += d.size
                urls[d.url].visit++
            }
            totalSize += d.size
            totalVisit++
        }
    })
    printReport()
}

function printReport() {
    var urlLabel = document.getElementById("urlReport")
    urlLabel.textContent = "Url (Total " + Object.keys(urls).length + ")"
    var sizeLabel = document.getElementById("sizeReport")
    sizeLabel.textContent = "Size (Total: " + totalSize + ")"
    var visitLabel = document.getElementById("visitReport")
    visitLabel.textContent = "Visit (Total: " + totalVisit + ")"
    reportContainer.innerHTML = ""
    for (var url in urls) {
        var container = document.createElement("div")
        container.classList.add("container")
        var u = document.createElement("p")
        u.classList.add("url")
        u.style.width = "70%"
        u.textContent = url
        container.appendChild(u)
        var size = document.createElement("p")
        size.style.width = "15%"
        size.textContent = urls[url].size
        container.appendChild(size)
        var visit = document.createElement("p")
        visit.style.width = "15%"
        visit.textContent = urls[url].visit
        container.appendChild(visit)
        reportContainer.appendChild(container)
    }
}

var urlReportSort = false

function urlReport() {
    urlsA = Object.entries(urls)
    urlsA.sort(function(a, b) {
        if (a[0] < b[0]) {
            return urlReportSort ? -1 : 1
        }
        if (a[0] > b[0]) {
            return urlReportSort ? 1 : -1
        }
        return 0
    })
    urls = Object.fromEntries(urlsA)
    urlReportSort = !urlReportSort
    printReport()
}

var sizeReportSort = false

function sizeReport() {
    urlsA = Object.entries(urls)
    urlsA.sort(function(a, b) {
        if (a[1].size < b[1].size) {
            return sizeReportSort ? -1 : 1
        }
        if (a[1].size > b[1].size) {
            return sizeReportSort ? 1 : -1
        }
        return 0
    })
    urls = Object.fromEntries(urlsA)
    sizeReportSort = !sizeReportSort
    printReport()
}

var visitReportSort = false

function visitReport() {
    urlsA = Object.entries(urls)
    urlsA.sort(function(a, b) {
        if (a[1].visit < b[1].visit) {
            return visitReportSort ? -1 : 1
        }
        if (a[1].visit > b[1].visit) {
            return visitReportSort ? 1 : -1
        }
        return 0
    })
    urls = Object.fromEntries(urlsA)
    visitReportSort = !visitReportSort
    printReport()
}

if (document.getElementById("startButton")) {
    document.getElementById("startButton").addEventListener("click", start)
}

if (document.getElementById("stopButton")) {
    document.getElementById("stopButton").addEventListener("click", stop)
}

if (document.getElementById("previousButton")) {
    document.getElementById("previousButton").addEventListener("click", previous)
}

if (document.getElementById("nextButton")) {
    document.getElementById("nextButton").addEventListener("click", next)
}

var pageInput = null

if (document.getElementById("pageInput")) {
    pageInput = document.getElementById("pageInput")
}

if (document.getElementById("pageButton")) {
    document.getElementById("pageButton").addEventListener("click", function() {
        if (data != null && pageInput.value) {
            printPage(pageInput.value)
        }
    })
}

if (document.getElementById("ip-addressButton")) {
    document.getElementById("ip-addressButton").addEventListener("click", ipAddress)
}

if (document.getElementById("dateButton")) {
    document.getElementById("dateButton").addEventListener("click", date)
}

if (document.getElementById("methodButton")) {
    document.getElementById("methodButton").addEventListener("click", method)
}

if (document.getElementById("pathButton")) {
    document.getElementById("pathButton").addEventListener("click", path)
}

if (document.getElementById("versionButton")) {
    document.getElementById("versionButton").addEventListener("click", version)
}

if (document.getElementById("codeButton")) {
    document.getElementById("codeButton").addEventListener("click", code)
}

if (document.getElementById("sizeButton")) {
    document.getElementById("sizeButton").addEventListener("click", size)
}

if (document.getElementById("urlButton")) {
    document.getElementById("urlButton").addEventListener("click", url)
}

if (document.getElementById("browserButton")) {
    document.getElementById("browserButton").addEventListener("click", browser)
}

var dataContainer = null

if (document.getElementById("dataContainer")) {
    dataContainer = document.getElementById("dataContainer")
    unload()
}

var reportContainer = null

if (document.getElementById("reportContainer")) {
    reportContainer = document.getElementById("reportContainer")
    unload()
}

if (document.getElementById("urlReportButton")) {
    document.getElementById("urlReportButton").addEventListener("click", urlReport)
}

if (document.getElementById("sizeReportButton")) {
    document.getElementById("sizeReportButton").addEventListener("click", sizeReport)
}

if (document.getElementById("visitReportButton")) {
    document.getElementById("visitReportButton").addEventListener("click", visitReport)
}

login()