function ajax(url, method, data, json) {
    var xhr = new XMLHttpRequest()
    xhr.open(method, url, true)
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText
                json(response)
            }
        }
    }
    xhr.send(data)
}

if (document.getElementById("auth-form")) {
    document.getElementById("auth-form").addEventListener("submit", function(event) {
        event.preventDefault() 
        var login = document.getElementById("auth-login").value
        var password = document.getElementById("auth-password").value
        var formData = new FormData()
        formData.append("auth-login", login)
        formData.append("auth-password", password)
        ajax("php/auth.php", "POST", formData, function(json) {
            var response = JSON.parse(json)
            if (response.status === "success") {
                location.reload()
            } else if (response.status === "error") {
            }
        })
    })
}

if (document.getElementById("reg-form")) {
    document.getElementById("reg-form").addEventListener("submit", function(event) {
        event.preventDefault()
        var login = document.getElementById("reg-login").value
        var password = document.getElementById("reg-password").value
        var fullName = document.getElementById("reg-full-name").value
        var email = document.getElementById("reg-email").value
        var avatar = document.getElementById("reg-avatar").files[0];
        var formData = new FormData()
        formData.append("reg-login", login)
        formData.append("reg-password", password)
        formData.append("reg-full-name", fullName)
        formData.append("reg-email", email)
        formData.append("reg-avatar", avatar)
        ajax("php/reg.php", "POST", formData, function(json) {
            var response = JSON.parse(json)
            if (response.status === "success") {
                location.reload()
            } else if (response.status === "error") {
            }
        })
    })
}

function blockModal(modal) {
    modal.style.display = "block"
}

function noneModal(modal) {
    modal.style.display = "none"
}

if (document.getElementById("auth")) {
    var auth = document.getElementById("auth")
    var authModal = document.getElementById("auth-modal")
    auth.addEventListener("click", function() {
        blockModal(authModal)
    })
}

if (document.getElementById("reg")) {
    var reg = document.getElementById("reg")
    var regModal = document.getElementById("reg-modal")
    reg.addEventListener("click", function() {
        blockModal(regModal)
    })
}

if (document.getElementById("fyp")) {
    var fyp = document.getElementById("fyp")
    var fypModal = document.getElementById("fyp-modal")
    fyp.addEventListener("click", function() {
        blockModal(fypModal)
    })
}

if (document.getElementById("exit")) {
    var exit = document.getElementById("exit")
    exit.addEventListener("click", function() {
        document.cookie = "auth_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"
        location.reload()
    })
}

if (document.getElementById("auth-exit")) {
    var authExit = document.getElementById("auth-exit")
    authExit.addEventListener("click", function() {
        noneModal(authModal)
    })
}

if (document.getElementById("reg-exit")) {
    var regExit = document.getElementById("reg-exit")
    regExit.addEventListener("click", function() {
        noneModal(regModal)
    })
}

if (document.getElementById("fyp-exit")) {
    var fypExit = document.getElementById("fyp-exit")
    fypExit.addEventListener("click", function() {
        noneModal(fypModal)
    })
}

const checkboxNames = {
    color: 'Color',
    frame_size: 'Frame size',
    wheel_size: 'Wheel size'
}

const checkboxesData = {
    color: ['White', 'Yellow', 'Brown'],
    frame_size: ['18', '20', '22'],
    wheel_size: ['26', '27.5', '29']
}

//  html
//  <div id="checkboxes"></div>
//  css
//  .smart-filter-div {
//      font-family: "Roboto-Bold";
//      font-size: 14px;
//  }
//  .space-between {
//      display: flex;
//      justify-content: space-between;
//  }
function createCheckboxesInHtml() {
    for (let checkboxName in checkboxNames) {
        let paragraph = document.createElement('p')
        paragraph.textContent = checkboxNames[checkboxName]
        let container = document.createElement('div')
        container.classList.add('smart-filter-div') //
        container.id = checkboxName
        container.appendChild(paragraph)
        for (let checkboxData of checkboxesData[checkboxName]) {
            let input = document.createElement('input')
            input.id = checkboxName
            input.type = 'checkbox'
            input.value = checkboxData
            let label = document.createElement('label')
            label.classList.add('space-between') //
            label.textContent = checkboxData
            label.appendChild(input)
            container.appendChild(label)
        }
        let checkboxesContainer = document.querySelector('div[id="checkboxes"]')
        checkboxesContainer.appendChild(container)
    }
}   

//  html
//  <ul id="checkboxes_result">
//  css
//  smart-filter-h4 {
//      font-family: "Roboto-Bold";
//      font-size: 15px;
//  }
//  list-style-type {
//      list-style-type: none;
//  }
//  p-b-20 {
//      padding-bottom: 20px;
//  }
function createResultsOfSmartFilterInHtml(result) {
    let ul = document.querySelector('ul[id="checkboxes_result"]')
    ul.innerHTML = ''
    result.forEach(r => {
        let h4 = document.createElement('h4')
        h4.classList.add('smart-filter-h4') //
        h4.textContent = `Name: ${r.name} Color: ${r.color} Frame size: ${r.frame_size} Wheel size: ${r.wheel_size}`
        let img = document.createElement('img')
        img.src = r.img
        let li = document.createElement('li')
        li.classList.add('list-style-type') //
        li.classList.add('p-b-20') //
        li.appendChild(img)
        li.appendChild(h4)
        ul.appendChild(li)
    })
}

const bikesData = [
    { img: 'images/gallery/first-photo-g.png', id: 1, name: 'Bike 1', color: 'White', frame_size: '18', wheel_size: '29' },
    { img: 'images/gallery/second-photo-g.png', id: 2, name: 'Bike 2', color: 'Yellow', frame_size: '18', wheel_size: '29' },
    { img: 'images/gallery/third-photo-g.png', id: 3, name: 'Bike 3', color: 'Brown', frame_size: '20', wheel_size: '27.5' },
    { img: 'images/gallery/third-photo-g.png', id: 4, name: 'Bike 4', color: 'Brown', frame_size: '20', wheel_size: '27.5' },
    { img: 'images/gallery/second-photo-g.png', id: 5, name: 'Bike 5', color: 'Yellow', frame_size: '22', wheel_size: '26' },
    { img: 'images/gallery/first-photo-g.png', id: 6, name: 'Bike 6', color: 'White', frame_size: '22', wheel_size: '26' },
    { img: 'images/gallery/first-photo-g.png', id: 7, name: 'Bike 7', color: 'White', frame_size: '18', wheel_size: '29' },
    { img: 'images/gallery/second-photo-g.png', id: 8, name: 'Bike 8', color: 'Yellow', frame_size: '18', wheel_size: '29' },
    { img: 'images/gallery/third-photo-g.png', id: 9, name: 'Bike 9', color: 'Brown', frame_size: '20', wheel_size: '27.5' },
    { img: 'images/gallery/third-photo-g.png', id: 10, name: 'Bike 10', color: 'Brown', frame_size: '20', wheel_size: '27.5' },
    { img: 'images/gallery/second-photo-g.png', id: 11, name: 'Bike 11', color: 'Yellow', frame_size: '22', wheel_size: '26' },
    { img: 'images/gallery/first-photo-g.png', id: 12, name: 'Bike 12', color: 'White', frame_size: '22', wheel_size: '26' },
    { img: 'images/gallery/first-photo-g.png', id: 13, name: 'Bike 13', color: 'White', frame_size: '18', wheel_size: '26' }
]

function smartFilterWithArgument(filter) {
    return bikesData.filter(bike => {
        return Object.keys(filter).every(key => {
            if (filter[key].length === 0) {
                return true
            }
            return filter[key].includes(bike[key])
        })
    })
}

function disableCheckboxesIfResultMaybeEmptyOrOther(filter, length) {
    for (let checkbox in checkboxesData) {
        for (let chckbx of checkboxesData[checkbox]) {
            if (!filter[checkbox].includes(chckbx)) {
                filter[checkbox].push(chckbx)
                let result = smartFilterWithArgument(filter)
                c = document.querySelector(`input[id="${checkbox}"][value="${chckbx}"]`)
                if (result.length == length || result.length == 0) {
                    c.disabled = true
                } else {
                    c.disabled = false
                }
                filter[checkbox].splice(filter[checkbox].indexOf(chckbx), 1)
            }
        }
    }
}

function smartFilter() {
    let filter = {}
    Object.keys(checkboxesData).forEach(key => {
        let checkboxes = document.querySelectorAll(`input[id="${key}"]:checked`)
        let values = Array.from(checkboxes).map(checkbox => checkbox.value)
        filter[key] = values
    })
    let result = bikesData.filter(bike => {
        return Object.keys(filter).every(key => {
            if (filter[key].length === 0) {
                return true
            }
            return filter[key].includes(bike[key])
        })
    })
    createResultsOfSmartFilterInHtml(result)
    disableCheckboxesIfResultMaybeEmptyOrOther(filter, result.length)
}

if (document.querySelector('div[id="checkboxes"]')) {
    createCheckboxesInHtml()
    smartFilter()
}

const checkboxes = document.querySelectorAll('input[type="checkbox"]')

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', smartFilter)
    checkbox.addEventListener('change', function(event) {
        if (!event.target.checked) {
            let filter = {}
            Object.keys(checkboxesData).forEach(key => {
                let checkboxes = document.querySelectorAll(`input[id="${key}"]:checked`)
                let values = Array.from(checkboxes).map(checkbox => checkbox.value)
                filter[key] = values
            })
            let result = bikesData.filter(bike => {
                return Object.keys(filter).every(key => {
                    if (filter[key].length === 0) {
                        return true
                    }
                    return filter[key].includes(bike[key])
                })
            })
            if (result.length == 0) {
                alert('This action will result in an empty list in the filter')
                checkbox.checked = true
                smartFilter()
            }
        }
    })
})