// Terapkan tema langsung sebelum halaman selesai dimuat
(function () {
    const storedTheme = localStorage.getItem("preferred-theme");
    const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const isNight = new Date().getHours() >= 18 || new Date().getHours() < 6;

    // Gunakan tema tersimpan, atau deteksi dari preferensi sistem dan waktu
    const theme = storedTheme
        ? storedTheme
        : prefersDark
        ? "dark"
        : isNight
        ? "dark"
        : "light";

    if (theme === "dark") {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }
})();

$(document).ready(function () {
    // Fungsi untuk mendeteksi tema sistem
    function detectColorScheme() {
        return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
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
            const systemPreference = detectColorScheme();
            const timeBasedTheme =
                new Date().getHours() >= 18 || new Date().getHours() < 6
                    ? "dark"
                    : "light";
            const theme = systemPreference === "dark" ? "dark" : timeBasedTheme;
            applyTheme(theme);
        }
    }

    // Toggle manual tema
    $(".nav-link-style").on("click", function () {
        const currentTheme = $("body").hasClass("dark-mode") ? "light" : "dark";
        applyTheme(currentTheme);
    });

    // Event listener untuk perubahan tema sistem
    window.matchMedia("(prefers-color-scheme: dark)").addListener(function (e) {
        if (!localStorage.getItem("preferred-theme")) {
            applyTheme(e.matches ? "dark" : "light");
        }
    });

    // Inisialisasi tema
    initTheme();
});
