document.addEventListener('DOMContentLoaded', () => {
    const likeIcons = document.querySelectorAll('.like-icon');
    const retweetIcons = document.querySelectorAll('.retweet-icon');

    likeIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            if (icon.classList.contains('fas')) {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.textContent = parseInt(icon.textContent) - 1;
            } else {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.textContent = parseInt(icon.textContent) + 1;
            }
        });
    });

    retweetIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            icon.textContent = parseInt(icon.textContent) + 1;
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("commentModal");

    var commentIcons = document.querySelectorAll(".fa-comment.blue");

    var span = document.getElementsByClassName("close")[0];

    commentIcons.forEach(function(icon) {
        icon.addEventListener("click", function() {
            modal.style.display = "block";
        });
    });

    span.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});

function toggleDropdown() {
    var dropdown = document.getElementById("profile-dropdown");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.options-icon') && !event.target.matches('.options-icon *')) {
        var dropdown = document.getElementById("profile-dropdown");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        }
    }
}