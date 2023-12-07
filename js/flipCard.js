// document.addEventListener("DOMContentLoaded", function() {
//     console.log("DOMContentLoaded event fired");

//     const flipButtons = document.querySelectorAll(".flip-card");

//     flipButtons.forEach(function(button) {
//         button.addEventListener("click", function(event) {
//             console.log("Flip button clicked");

//             event.preventDefault();

//             const cardId = button.getAttribute("data-card-id");
//             console.log("Card ID:", cardId);

//             const h2Element = button.closest('.one-card').querySelector('h2');
//             console.log("H2 Element:", h2Element);

//             if (h2Element) {
//                 const firstLanguage = h2Element.dataset.firstLanguage;
//                 const secondLanguage = h2Element.dataset.secondLanguage;

      
//                 h2Element.dataset.firstLanguage = secondLanguage;
//                 h2Element.dataset.secondLanguage = firstLanguage;

//                 h2Element.textContent = `${secondLanguage} ${firstLanguage}`;
//             }
//         });
//     });
// });
