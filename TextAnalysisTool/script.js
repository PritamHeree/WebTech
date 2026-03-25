let analyzeBtn = document.getElementById("analyzeBtn");

analyzeBtn.addEventListener("click", function() {
    let text = document.getElementById("inputText").value;
    
    // Count Total characters 
    let totalCharacters = text.length;

    // Count Total words
    let words = text.split(" ");
    let totalWords = 0;
    
    // Handle cases like multiple spaces 
    for (let i = 0; i < words.length; i++) {
        if (words[i] !== "") {
            totalWords++;
        }
    }

    // Handle empty input case
    if (text === "") {
        totalWords = 0;
    }

    // Reverse the entire text 
    let reversedText = text.split("").reverse().join("");

    // Display results
    document.getElementById("charCount").innerText = totalCharacters;
    document.getElementById("wordCount").innerText = totalWords;
    document.getElementById("reversedText").innerText = reversedText;

    document.getElementById("results").style.display = "block";
});
