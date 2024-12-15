
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();

recognition.lang = 'vi-VN';  // Cấu hình ngôn ngữ tìm kiếm bằng tiếng Việt
recognition.continuous = false;
recognition.interimResults = false;

let timeout; // Biến dùng để lưu trữ timeout

recognition.onstart = function() {
    console.log("Đang nghe...");
    // Đặt timeout khi mic bắt đầu nhận diện giọng nói
    timeout = setTimeout(function() {
        console.log("Không có âm thanh trong 4 giây, tắt mic.");
        recognition.stop(); // Dừng nhận diện giọng nói sau 4 giây
    }, 4000); // 4000ms = 4 giây
};

recognition.onresult = function(event) {
    // Xóa timeout khi có kết quả
    clearTimeout(timeout);

    const transcript = event.results[0][0].transcript;
    document.getElementById("searchInput").value = transcript;

    // Đặt lại timeout sau khi nhận diện được âm thanh
    timeout = setTimeout(function() {
        console.log("Không có âm thanh trong 5 giây, tắt mic.");
        recognition.stop(); // Dừng nhận diện giọng nói sau 5 giây
    }, 5000); // 5000ms = 5 giây
};

recognition.onerror = function(event) {
    console.log("Có lỗi xảy ra: " + event.error);
};

// Hàm bắt đầu nhận diện giọng nói
function startVoiceRecognition() {
    recognition.start();
}

// Hàm tìm kiếm
function search() {
    const query = document.getElementById("searchInput").value;
    if (query) {
        // Điều hướng đến trang tìm kiếm với từ khóa tìm kiếm
        window.location.href = "?search=" + encodeURIComponent(query);
    } else {
        document.getElementById("result").innerText = "Vui lòng nhập từ khóa.";
    }
}
