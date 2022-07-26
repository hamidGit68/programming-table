let titleDefault = "Work program template";
let titleH1 = "";

function changeTitle(e) {
    e = e || window.event;
    let target = e.target || e.srcElement;
    
    /* changes in button */
    target.classList.add("btn-outline-info");
    target.classList.remove("btn-primary");
    target.innerText = "Save title";
    target.removeAttribute("onclick");
    target.setAttribute("onclick", "saveTitle(event)");
    console.log(target);
    
    let titleVar = document.getElementById("myTitle");
    let inputVar = document.getElementById("inputTitle");
    titleVar.classList.add("d-none");
    titleVar.style.opacity = "0";
    inputVar.classList.remove("d-none");
    setTimeout(function() {
        inputVar.style.opacity = "1";
    }, 500);
    inputVar.value = "";
    
//    localStorage.setItem("lastname", "Smith");
//    localStorage.getItem("lastname");
}

function saveTitle(e) {
    e = e || window.event;
    let target = e.target || e.srcElement;
    /* change styles of "save title btn" and come back to "chane title btn" */
    target.classList.remove("btn-outline-info");
    target.classList.add("btn-primary");
    target.innerText = "Change title";
    target.removeAttribute("onclick");
    target.setAttribute("onclick", "changeTitle(event)");
    
    let inputVar = document.getElementById("inputTitle");
    let titleVar = document.getElementById("myTitle");
    /* get input value and save it in local storage */
    let finalInput = inputVar.value.trim();
    if(finalInput.length > 0) {
        localStorage.setItem("title", finalInput);
    }
    loadTitle();
    
    /* disapear input and show title h1 tag */
    titleVar.classList.remove("d-none");
    inputVar.classList.add("d-none");
    inputVar.style.opacity = "0";
    setTimeout(function() {
        titleVar.style.opacity = "1"
    }, 500);
}

function loadTitle() {
    /* This function loads title of the page (if title is on local-storage it gets title from that). */
    if ( localStorage.getItem("title") ) {
        titleH1 = localStorage.getItem("title");
    } else {
        titleH1 = titleDefault;
    }
    let tagH1 = document.getElementById("myTitle");
    tagH1.innerText = titleH1;
}

loadTitle();

let dataVar = {}; /* empty object that must be fill with table data. */
let dataLength = 0;

function changeFunc(e) {
    e = e || window.event;
    let target = e.target || e.srcElement;
    let parentVar = target.parentElement;
    let grandParent = parentVar.parentElement;
    let dataLengthHere = grandParent.children.length;
    console.log(grandParent.children);
    
    for(let i = 1; i<(dataLengthHere - 1); i++) {
        grandParent.children[i].children[0].classList.remove("d-none");
        grandParent.children[i].children[1].classList.add("d-none");
    }
    
    if (target.innerText == "Edit") {
        /* Adding Cancel btn */
        parentVar.appendChild(createBtn());
        /* Change appearance and text of "Edit" btn */
        target.classList.add("btn-success");
        target.innerText = "Save";
        target.classList.remove("btn-primary");
    } else if (target.innerText == "Save") {
        /* save button clicked */
        let dataArr = [];
        /* Building data according to user inputs */
        for(let i = 0; i<(dataLengthHere - 1); i++) {
            if ( grandParent.children[i].children[0] !== undefined ) {
                // console.log(grandParent.children[i].children[0].value);
                dataArr.push(grandParent.children[i].children[0].value);
            } else {
                // console.log(grandParent.children[i].innerText);
                dataArr.push(grandParent.children[i].innerText);
            }
        }
//        console.log(dataArr);
        if (dataLength === dataLengthHere - 1) {
            let count = 0;
            for (let index in dataVar) {
                /* putting data in input feilds to dataVar object */
                dataVar[index] = dataArr[count];
                count++;
            }
//           console.log(dataVar);  
        } else {
            console.log("consistency error");
        }
        /* ------------------------- */
        /* Sending data to database */
        /* ------------------------- */
        
        sendData('/php-files/sendData.php', dataVar)
            .then(data => {
                console.log(data); // JSON data parsed by `data.json()` call
                if(data) {
                    location.reload();
                } else {
                    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                    myModal.show();
                }
            }).catch(error => {
                    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                    myModal.show();
            });

    } else {
        /* cancel button clicked */
        location.reload();
    }
}

function createBtn() {
    let btn = document.createElement('button');
    btn.innerText = "Cancel";
    btn.classList.add("btn", "btn-danger", "my-2");
    btn.setAttribute("onclick", "changeFunc(event)");
    return btn;
}

async function getTableColumns() {
    let url = '/php-files/getData.php';
    try {
        let res = await fetch(url);
        let columns = await res.json();
//        console.log(columns);
        columns.forEach((item) => {
            dataVar[item] = item
        });
        dataLength = columns.length;
        console.log(dataLength);
    } catch (error) {
        console.log(error);
    }
}

getTableColumns();


async function sendData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

/* adding rows in table */
function addData() {
    sendData('/php-files/addRow.php')
        .then(data => {
            console.log(data); // JSON data parsed by `data.json()` call
            if(data) {
                location.reload();
            } else {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();
            }
        }).catch(error => {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();
        });
}

function confirmClear() {
    var myModal = new bootstrap.Modal(document.getElementById('cleanModal'));
    myModal.show();
}

/* clean table */
function cleanTable() {
    sendData('/php-files/deleteData.php')
        .then(data => {
            console.log(data); // JSON data parsed by `data.json()` call
            if(data) {
                location.reload();
            } else {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();
            }
        }).catch(error => {
                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();
        });
}

/* converting table to pdf */
function convertTableToPDF() {
	const { jsPDF } = window.jspdf;

	var doc = new jsPDF("l", "px", [1536, 648], hotfixes = ["px_scaling"]);
	var pdfjs = document.querySelector('#mainContainer');

	doc.html(pdfjs, {
		callback: function(doc) {
			doc.save("output.pdf");
		},
		x: 10,
		y: 10
	});
}