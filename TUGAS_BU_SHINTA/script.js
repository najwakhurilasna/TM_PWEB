// ================== AMBIL DATA ==================
const form = document.getElementById("formBooking")
let data = JSON.parse(localStorage.getItem("booking")) || []

// ================== FUNCTION BASE64 ==================
const toBase64 = (file) => new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onload = () => resolve(reader.result)
    reader.onerror = error => reject(error)
})

// ================== TAMBAH DATA ==================
if (form) {
    form.addEventListener("submit", async (e) => {
        e.preventDefault()

        const ktpFile = document.getElementById("ktp").files[0]
        const buktiFile = document.getElementById("bukti").files[0]

        // 🔥 VALIDASI FILE SIZE
        if (ktpFile && ktpFile.size > 1000000) {
            alert("⚠️ File KTP terlalu besar (max 1MB)")
            return
        }

        if (buktiFile && buktiFile.size > 1000000) {
            alert("⚠️ File bukti terlalu besar (max 1MB)")
            return
        }

        // convert ke base64
        const ktpBase64 = ktpFile ? await toBase64(ktpFile) : ""
        const buktiBase64 = buktiFile ? await toBase64(buktiFile) : ""

        const item = {
            nama: document.getElementById("nama").value.trim(),
            telp: document.getElementById("telp").value.trim(),
            tujuan: document.getElementById("tujuan").value,
            paket: document.getElementById("paket").value,
            tanggal: document.getElementById("tanggal").value,
            peserta: document.getElementById("peserta").value,
            ktp: ktpBase64,
            bukti: buktiBase64,
            status: "DP"
        }

        // ================== VALIDASI ==================
        if (
            !item.nama ||
            !item.telp ||
            !item.tujuan ||
            !item.paket ||
            !item.tanggal ||
            !item.peserta
        ) {
            alert("⚠️ Semua data wajib diisi!")
            return
        }

        // ================== SIMPAN ==================
        data.push(item)
        localStorage.setItem("booking", JSON.stringify(data))

        alert("✅ Booking berhasil!")
        form.reset()
    })
}

// ================== RENDER TABEL ==================
const render = () => {
    const tabel = document.getElementById("dataTabel")
    const totalText = document.getElementById("totalPeserta")

    if (!tabel) return

    tabel.innerHTML = ""
    let total = 0

    data.forEach((item, index) => {
        total += Number(item.peserta)

        tabel.innerHTML += `
        <tr>
            <td>${item.nama}</td>
            <td>${item.telp}</td>
            <td>${item.tujuan}</td>
            <td>${item.paket}</td>
            <td>${item.tanggal}</td>
            <td>${item.peserta}</td>

            <!-- 🔥 KTP -->
            <td>
                ${
                    item.ktp
                        ? `<a href="${item.ktp}" target="_blank" class="table-btn">Lihat</a>`
                        : "-"
                }
            </td>

            <!-- 🔥 BUKTI -->
            <td>
                ${
                    item.bukti
                        ? `<a href="${item.bukti}" target="_blank" class="table-btn">Lihat</a>`
                        : "-"
                }
            </td>

            <td>
                <span class="status pending">${item.status}</span>
            </td>

            <td>
                <button class="btn" onclick="hapus(${index})">Hapus</button>
            </td>
        </tr>
        `
    })

    // ================== TOTAL ==================
    if (totalText) {
        totalText.innerText = "Total Peserta: " + total + " orang"
    }
}

// ================== HAPUS ==================
const hapus = (index) => {
    if (confirm("Yakin ingin menghapus data?")) {
        data.splice(index, 1)
        localStorage.setItem("booking", JSON.stringify(data))
        render()
    }
}

// ================== AUTO JALAN ==================
render()