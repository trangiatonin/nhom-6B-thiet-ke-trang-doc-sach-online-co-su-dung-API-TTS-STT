//ebook
let isReading = false; // Trạng thái đang đọc
let isPaused = false; // Trạng thái tạm dừng
let currentSentenceIndex = 0; // Câu đang đọc
let currentWordIndex = 0; // Từ đang đọc
let sentences = []; // Mảng câu
let words = []; // Mảng từ của câu hiện tại
let subtitleElement = document.getElementById("subtitle");

function toggleReading() {
    if (isPaused) {
        isPaused = false; // Tiếp tục đọc
        continueReading();
    } else if (!isReading) {
        startReading(); // Bắt đầu đọc
    }
}

function startReading() {
    isReading = true;
    subtitleElement.style.display = "block";

    // Lấy nội dung
    var content = subtitleElement.textContent.trim();
    sentences = content.match(/[^\.!\?]+[\.!\?]+/g) || [content];

    // Reset chỉ số nếu bắt đầu lại
    currentSentenceIndex = 0;
    currentWordIndex = 0;

    readNextWord();
}

function continueReading() {
    readNextWord(); // Tiếp tục đọc từ vị trí tạm dừng
}

function readNextWord() {
    if (!isReading || isPaused || currentSentenceIndex >= sentences.length) return;

    words = sentences[currentSentenceIndex].trim().split(" ");
    if (currentWordIndex < words.length) {
        // Highlight từ hiện tại
        subtitleElement.innerHTML = words
            .map((w, i) =>
                i === currentWordIndex
                    ? `<span style="background-color: yellow;">${w}</span>`
                    : w
            )
            .join(" ");

        // Đọc từ hiện tại
        responsiveVoice.speak(words[currentWordIndex], "Vietnamese Female", {
            rate: 1.5, // Tốc độ giọng nói (tăng hoặc giảm giá trị này)
            onend: () => {
                currentWordIndex++; // Sang từ tiếp theo
                readNextWord(); // Đọc từ tiếp theo
            },
        });
    } else {
        // Sang câu tiếp theo
        currentWordIndex = 0;
        currentSentenceIndex++;
        setTimeout(readNextWord, 300); // Giảm thời gian giữa các câu
    }
}

function stopReading() {
    isPaused = true; // Đặt trạng thái tạm dừng
    responsiveVoice.cancel(); // Hủy đọc
}
// end ebook


//bookcase

// Cập nhật dropdown khi chọn giới tính
function updateDropdown(gender) {
    // Hiển thị giới tính trên nút dropdown
    document.getElementById('dropdownButton').textContent = gender;

    // Gán giá trị vào input hidden để gửi qua PHP
    document.getElementById('genderInput').value = gender;

    // Kích hoạt nút gửi
    document.getElementById('submitButton').disabled = false;
}
function updateDropdown(gender) {
    // Cập nhật button dropdown với lựa chọn giới tính
    document.getElementById('dropdownButton').textContent = gender;

    // Cập nhật giá trị vào trường ẩn 'genderInput'
    document.getElementById('genderInput').value = gender;
}

function resetForm() {
    // Reset lại dropdown button về giá trị mặc định
    document.getElementById('dropdownButton').textContent = 'Giới tính'; // Hoặc bạn có thể đặt thành giá trị mặc định khác

    // Reset lại giá trị trong trường ẩn 'genderInput'
    document.getElementById('genderInput').value = '';
}
//end bookcase

// reader
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("paginationContainer");
    const contentData = window.contentData || []; // Dữ liệu từ PHP
    const viewportHeight = window.innerHeight;

    // Tạo các trang
    let currentPage;
    let currentHeight = 0;

    contentData.forEach((content) => {
        const contentDiv = document.createElement("div");
        contentDiv.classList.add("content");
        contentDiv.style.marginBottom = "1rem";
        contentDiv.textContent = content;

        // Tạo trang mới nếu chiều cao vượt viewport
        if (!currentPage || currentHeight + contentDiv.offsetHeight > viewportHeight) {
            currentPage = document.createElement("div");
            currentPage.classList.add("page", "bg-light");
            container.appendChild(currentPage);
            currentHeight = 0;
        }

        currentPage.appendChild(contentDiv);
        currentHeight += contentDiv.offsetHeight;
    });
});
// end reader


// profile
// Cập nhật dropdown khi chọn giới tính
function updateDropdown(gender) {
    // Hiển thị giới tính trên nút dropdown
    document.getElementById('dropdownButton').textContent = gender;

    // Gán giá trị vào input hidden để gửi qua PHP
    document.getElementById('genderInput').value = gender;

    // Kích hoạt nút gửi
    document.getElementById('submitButton').disabled = false;
}
function updateDropdown(gender) {
    // Cập nhật button dropdown với lựa chọn giới tính
    document.getElementById('dropdownButton').textContent = gender;

    // Cập nhật giá trị vào trường ẩn 'genderInput'
    document.getElementById('genderInput').value = gender;
}

function resetForm() {
    // Reset lại dropdown button về giá trị mặc định
    document.getElementById('dropdownButton').textContent = 'Giới tính'; // Hoặc bạn có thể đặt thành giá trị mặc định khác

    // Reset lại giá trị trong trường ẩn 'genderInput'
    document.getElementById('genderInput').value = '';
}

// end profile