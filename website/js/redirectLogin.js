function redirectToLogin() {
    window.location.href = "login.php?message=" + encodeURIComponent("To rent, you must log in first.");
}
