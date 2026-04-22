var resultBox = document.getElementById("result");

function appendChar(char) {
    if (resultBox.value == "Error") {
        resultBox.value = "";
    }

    // Prevent multiple signs
    if (char == "+" || char == "-" || char == "*" || char == "/") {
        // If empty and not minus, don't allow sign first
        if (resultBox.value == "") {
            if (char != "-") {
                return;
            }
        }

        var lastChar = resultBox.value.charAt(resultBox.value.length - 1);
        if (lastChar == "+" || lastChar == "-" || lastChar == "*" || lastChar == "/") {
            // Replace the last sign with the new sign
            resultBox.value = resultBox.value.slice(0, -1) + char;
            return;
        }
    }

    resultBox.value = resultBox.value + char;
}

function clearResult() {
    resultBox.value = "";
}

function deleteChar() {
    if (resultBox.value == "Error") {
        resultBox.value = "";
    } else {
        resultBox.value = resultBox.value.slice(0, -1);
    }
}

function calculateResult() {
    try {
        if (resultBox.value != "") {
            var answer = eval(resultBox.value);

            if (answer == Infinity || isNaN(answer)) {
                resultBox.value = "Error";
            } else {
                resultBox.value = answer;
            }
        }
    } catch (e) {
        resultBox.value = "Error";
    }
}
