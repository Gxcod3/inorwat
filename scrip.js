function updateTime() {
  const now = new Date();
  document.getElementById("datetime").textContent = now.toLocaleString("id-ID", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit"
  });
}
setInterval(updateTime, 1000);
updateTime();

// Fungsi toggle
function toggleHeater() {
  const status = document.getElementById("heater").checked;
  alert(`Pemanas ${status ? "diaktifkan" : "dimatikan"} (simulasi)`);
}

function toggleSprayer() {
  const status = document.getElementById("sprayer").checked;
  alert(`Penyemprot ${status ? "diaktifkan" : "dimatikan"} (simulasi)`);
}

setInterval(() => {
  document.getElementById("temp").textContent = Math.floor(Math.random() * 20 + 40);
  document.getElementById("humidity").textContent = Math.floor(Math.random() * 50 + 30);
  document.getElementById("ph").textContent = (Math.random() * 2 + 5.5).toFixed(1);
  document.getElementById("ammonia").textContent = Math.floor(Math.random() * 20);
}, 3000);
