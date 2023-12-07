const input = document.querySelector(".filter-input");
const allOneCards = document.querySelectorAll(".one-card");
const allOneCardsArray = Array.from(allOneCards);
const allCardsDiv = document.querySelector(".all-cards");

const cardsObjects = allOneCardsArray.map((oneCard, index) => {
    const firstLanguage = oneCard.querySelector(".names h2:first-child").textContent;
    const secondLanguage = oneCard.querySelector(".names h2:last-child").textContent;

    return {
        id: index,
        firstLanguage: firstLanguage,
        secondLanguage: secondLanguage,
        cardLink: oneCard.querySelector("a").href
    };
});

input.addEventListener("input", () => {
    const inputText = input.value.toLowerCase();

    const filteredCards = cardsObjects.filter((oneCard) => {
        return oneCard.firstLanguage.toLowerCase().includes(inputText) || oneCard.secondLanguage.toLowerCase().includes(inputText);
    });

    allCardsDiv.textContent = "";

    filteredCards.forEach((oneFilteredCard) => {
        const newDiv = document.createElement("div");
        newDiv.classList.add("one-card");

        const newLink = document.createElement("a");
        newLink.href = oneFilteredCard.cardLink;
        newLink.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
        newDiv.append(newLink);

        const newNamesDiv = document.createElement("div");
        newNamesDiv.classList.add("names");

        const newH2First = document.createElement("h2");
        newH2First.textContent = oneFilteredCard.firstLanguage;
        newNamesDiv.append(newH2First);

        const newH2Second = document.createElement("h2");
        newH2Second.textContent = oneFilteredCard.secondLanguage;
        newNamesDiv.append(newH2Second);

        newDiv.append(newNamesDiv);
        allCardsDiv.append(newDiv);
    });
});
