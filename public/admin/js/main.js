ClassicEditor.create(document.querySelector("#description"))
    .then((editor) => {
        console.log(editor);
    })
    .catch((error) => {
        console.error(error);
    });

let currentSection = 0;
const sections = document.querySelectorAll(".section");


//Form 
function showSection(index) {
    sections.forEach((section, i) => {
        section.style.display = i === index ? "block" : "none";
    });
}

document.getElementById("nextBtn").addEventListener("click", function () {
    currentSection++;
    if (currentSection >= sections.length) {
        currentSection = sections.length - 1;
        document.getElementById("submitBtn").style.display = "block";
    }
    showSection(currentSection);
});

document.getElementById("prevBtn").addEventListener("click", function () {
    currentSection--;
    if (currentSection < 0) {
        currentSection = 0;
    }
    showSection(currentSection);
    document.getElementById("submitBtn").style.display = "none";
});

// Initial section display
showSection(currentSection);


