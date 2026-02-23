document.addEventListener("DOMContentLoaded", function () {

    /* =========================
   AUTH (SIMULASI)
========================= */

function register(e) {
  e.preventDefault();

  const user = {
    name: document.getElementById("regName").value,
    email: document.getElementById("regEmail").value,
    password: document.getElementById("regPassword").value,
    role: "pegawai"
  };

  localStorage.setItem("user", JSON.stringify(user));
  alert("Registrasi berhasil, silakan login.");
  window.location.href = "login.php";
}

function login(e) {
  e.preventDefault();

  const email = document.getElementById("loginEmail").value;
  const password = document.getElementById("loginPassword").value;

  const user = JSON.parse(localStorage.getItem("user"));

  if (!user) {
    alert("Akun belum terdaftar.");
    return;
  }

  if (user.email === email && user.password === password) {
    localStorage.setItem("loggedIn", "true");
    window.location.href = "index.php";
  } else {
    alert("Email atau password salah.");
  }
}

/* PROTEKSI HALAMAN */
function checkLogin() {
  if (!localStorage.getItem("loggedIn")) {
    window.location.href = "login.php";
  }
}

    // =========================
    // HALAMAN INSTRUKSI
    // =========================
    const agreeCheckbox = document.getElementById("agree");
    const startBtn = document.getElementById("startBtn");

    if (agreeCheckbox && startBtn) {
        agreeCheckbox.addEventListener("change", function () {
            startBtn.disabled = !this.checked;
        });

        startBtn.addEventListener("click", function () {
            window.location.href = "dashboard.php";
        });
    }

    // =========================
    // HALAMAN BERANDA
    // =========================
    const statusEl = document.querySelector(".status");
    const actionBtn = document.querySelector(".btn-primary");

    if (statusEl && actionBtn) {
        const statusTes = "belum"; // nanti dari backend

        if (statusTes === "selesai") {
            statusEl.textContent = "SUDAH SELESAI";
            statusEl.classList.remove("belum");
            statusEl.classList.add("selesai");
            actionBtn.textContent = "Lihat Hasil";
        }
    }

});

// =========================
// HALAMAN SOAL TES
// =========================
const questionText = document.getElementById("questionText");
const currentNumber = document.getElementById("currentNumber");
const totalNumber = document.getElementById("totalNumber");
const progressFill = document.getElementById("progressFill");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const answerForm = document.getElementById("answerForm");



