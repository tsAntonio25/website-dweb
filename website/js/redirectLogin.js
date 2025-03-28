function redirectToLogin() {
    window.location.href = "login.php?message=" + encodeURIComponent("To rent, you must log in first.");
}

document.getElementById("editProfileButton").addEventListener("click", function() {
    const editSection = document.getElementById("editProfileSection");
    if (editSection.style.display === "none" || editSection.style.display === "") {
        editSection.style.display = "block";
    } else {
        editSection.style.display = "none";
    }
});