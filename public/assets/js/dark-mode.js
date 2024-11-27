// Terapkan tema langsung sebelum halaman selesai dimuat
(function () {
    const storedTheme = localStorage.getItem("preferred-theme");

    // Fungsi untuk menentukan tema berdasarkan waktu
    function getTimeBasedTheme() {
        const currentHour = new Date().getHours();
        // Mode malam dari jam 18:00 (6 PM) sampai 06:00 (6 AM)
        return currentHour >= 18 || currentHour < 6 ? "dark" : "light";
    }

    // Gunakan tema tersimpan, atau tentukan tema berdasarkan waktu
    const theme = storedTheme ? storedTheme : getTimeBasedTheme();

    if (theme === "dark") {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }
})();

$(document).ready(function () {
    // Fungsi untuk menentukan tema berdasarkan waktu
    function getTimeBasedTheme() {
        const currentHour = new Date().getHours();
        // Mode malam dari jam 18:00 (6 PM) sampai 06:00 (6 AM)
        return currentHour >= 18 || currentHour < 6 ? "dark" : "light";
    }

    // Fungsi untuk menerapkan tema
    function applyTheme(theme) {
        if (theme === "dark") {
            $("body").addClass("dark-mode");
            $("#theme-icon-a").show(); // Ikon matahari
            $("#theme-icon-b").hide(); // Ikon bulan
        } else {
            $("body").removeClass("dark-mode");
            $("#theme-icon-b").show(); // Ikon bulan
            $("#theme-icon-a").hide(); // Ikon matahari
        }

        // Simpan preferensi tema
        localStorage.setItem("preferred-theme", theme);
    }

    // Inisialisasi tema saat DOM siap
    function initTheme() {
        const storedTheme = localStorage.getItem("preferred-theme");

        if (storedTheme) {
            applyTheme(storedTheme);
        } else {
            // Gunakan tema berdasarkan waktu jika tidak ada tema tersimpan
            const theme = getTimeBasedTheme();
            applyTheme(theme);
        }
    }

    // Toggle manual tema
    $(".nav-link-style").on("click", function () {
        const currentTheme = $("body").hasClass("dark-mode") ? "light" : "dark";
        applyTheme(currentTheme);
    });

    // Event listener untuk memeriksa dan memperbarui tema setiap menit
    function checkAndUpdateTheme() {
        // Jika tidak ada tema tersimpan secara manual, gunakan tema berdasarkan waktu
        if (!localStorage.getItem("preferred-theme")) {
            const theme = getTimeBasedTheme();
            applyTheme(theme);
        }
    }

    // Periksa tema setiap menit
    setInterval(checkAndUpdateTheme, 60000);

    // Inisialisasi tema
    initTheme();
});
