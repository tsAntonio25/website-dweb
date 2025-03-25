document.addEventListener("DOMContentLoaded", function () {
    const paymentMethods = document.querySelectorAll('input[name="payment-method"]');
    const cardDetails = document.getElementById("card-details");

    function toggleCardDetails() {
        if (document.querySelector('input[name="payment-method"]:checked').value === "cash") {
            cardDetails.style.display = "none";
            document.querySelectorAll("#card-details input").forEach(input => input.required = false);
        } else {
            cardDetails.style.display = "block";
            document.querySelectorAll("#card-details input").forEach(input => input.required = true);
        }
    }

    paymentMethods.forEach(method => {
        method.addEventListener("change", toggleCardDetails);
    });

    toggleCardDetails();
});
