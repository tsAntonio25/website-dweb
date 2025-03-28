function redirectToLogin() {
    window.location.href = "login.php?message=" + encodeURIComponent("To rent, you must log in first.");
}

function goBack(fromRent2) {
    if (fromRent2) {
        window.location.href = 'carlisting.php';
    } else {
        history.go(-1);
    }
}