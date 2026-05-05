// ================== DATA STORAGE BOOKING ==================
let data = JSON.parse(localStorage.getItem("booking")) || []
let indexEdit = null

// ================== TRIP DATA ==================
let tripData = {
    banyuwangi: [
        { id: 1, nama: "Trip Ijen", harga: 350000, desc: "Mendaki Kawah Ijen dengan fenomena blue fire", fasilitas: ["Transportasi", "Tiket masuk", "Guide lokal", "Masker gas"], icon: "🌋", badge: "best" },
        { id: 2, nama: "Trip Ranti", harga: 300000, desc: "Eksplorasi alam pegunungan yang asri", fasilitas: ["Transportasi", "Tiket wisata", "Dokumentasi"], icon: "🌿", badge: "" },
        { id: 3, nama: "Pulau Tabuhan", harga: 450000, desc: "Pulau kecil dengan air super jernih", fasilitas: ["Perahu penyeberangan", "Alat snorkeling", "Dokumentasi"], icon: "🏝️", badge: "best" },
        { id: 4, nama: "Grand Island", harga: 400000, desc: "Wisata pantai eksklusif dengan spot foto instagramable", fasilitas: ["Transportasi", "Tiket masuk", "Spot foto"], icon: "🌊", badge: "best" },
        { id: 5, nama: "Keliling Banyuwangi", harga: 500000, desc: "Djawatan – Boom – Baluran – Pantai Merah", fasilitas: ["Transportasi full day", "Tiket semua destinasi", "Driver + BBM"], icon: "🚐", badge: "" }
    ],
    bali: [
        { id: 1, nama: "Paket 3 Hari 2 Malam", harga: 1500000, itinerary: ["Kuta & Tanah Lot", "Bedugul & Handara Gate", "Oleh-oleh & kembali"], fasilitas: ["Transportasi PP", "Hotel 2 malam", "Tiket wisata", "Driver"], icon: "🏝️", badge: "popular" },
        { id: 2, nama: "Paket 5 Hari 4 Malam", harga: 2500000, itinerary: ["Ketapang → Kuta & Legian", "Ubud & Tegenungan", "Bedugul & Danau Beratan", "Nusa Dua, Pandawa, GWK", "Oleh-oleh & kembali"], fasilitas: ["Transportasi PP", "Hotel 4 malam", "Tiket wisata", "Driver"], icon: "🗓️", badge: "premium" }
    ]
}

if (!localStorage.getItem("tripData")) {
    localStorage.setItem("tripData", JSON.stringify(tripData))
} else {
    tripData = JSON.parse(localStorage.getItem("tripData"))
}

// ================== HELPER FUNCTIONS ==================
const showToast = (message, type = 'success') => {
    const toast = document.createElement('div')
    toast.style.cssText = `
        position: fixed; bottom: 20px; right: 20px;
        background: ${type === 'success' ? '#10B981' : '#EF4444'};
        color: white; padding: 12px 24px; border-radius: 12px;
        z-index: 9999; animation: fadeIn 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `
    toast.textContent = message
    document.body.appendChild(toast)
    setTimeout(() => toast.remove(), 3000)
}

const toBase64 = (file) => new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onload = () => resolve(reader.result)
    reader.onerror = error => reject(error)
})

const getStatusClass = (status) => {
    if (status === "DP") return "dp"
    if (status === "Lunas") return "lunas"
    if (status === "Batal") return "batal"
    return ""
}

const escapeHtml = (str) => {
    if (!str) return ''
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;'
        if (m === '<') return '&lt;'
        if (m === '>') return '&gt;'
        return m
    })
}

// ================== RENDER TRIPS (Detail Page) ==================
function renderTrips() {
    renderBanyuwangiTrips()
    renderBaliTrips()
}

function renderBanyuwangiTrips() {
    const container = document.getElementById("banyuwangi-container")
    if (!container) return

    container.innerHTML = ""
    tripData.banyuwangi.forEach(trip => {
        container.innerHTML += `
            <div class="card detail-card">
                ${trip.badge ? `<div class="card-badge ${trip.badge}">${trip.badge === 'best' ? 'Best Seller' : trip.badge === 'popular' ? 'Populer' : 'Premium'}</div>` : ''}
                <div class="card-icon">${trip.icon}</div>
                <h4>${escapeHtml(trip.nama)}</h4>
                <div class="price">Rp ${trip.harga.toLocaleString('id-ID')} <span>/ orang</span></div>
                <p class="desc">${escapeHtml(trip.desc || '')}</p>
                <div class="feature-list">
                    <div class="feature-title">Fasilitas:</div>
                    <ul>
                        ${trip.fasilitas.map(f => `<li><i class="fas fa-check-circle"></i> ${escapeHtml(f)}</li>`).join('')}
                    </ul>
                </div>
                <div style="display: flex; gap: 8px; margin-top: 15px;">
                    <button class="btn-edit-trip" onclick="editTrip('banyuwangi', ${trip.id})"><i class="fas fa-edit"></i> Edit</button>
                    <button class="btn-delete-trip" onclick="deleteTrip('banyuwangi', ${trip.id})"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
        `
    })
}

function renderBaliTrips() {
    const container = document.getElementById("bali-container")
    if (!container) return

    container.innerHTML = ""
    tripData.bali.forEach(trip => {
        container.innerHTML += `
            <div class="card detail-card">
                ${trip.badge ? `<div class="card-badge ${trip.badge}">${trip.badge === 'best' ? 'Best Seller' : trip.badge === 'popular' ? 'Populer' : 'Premium'}</div>` : ''}
                <div class="card-icon">${trip.icon}</div>
                <h4>${escapeHtml(trip.nama)}</h4>
                <div class="price">Rp ${trip.harga.toLocaleString('id-ID')} <span>/ orang</span></div>
                <div class="feature-list">
                    <div class="feature-title">📅 Itinerary:</div>
                    <ul>
                        ${trip.itinerary ? trip.itinerary.map((i, idx) => `<li><i class="fas fa-calendar-day"></i> Hari ${idx+1}: ${escapeHtml(i)}</li>`).join('') : ''}
                    </ul>
                </div>
                <div class="feature-list">
                    <div class="feature-title">Fasilitas:</div>
                    <ul>
                        ${trip.fasilitas.map(f => `<li><i class="fas fa-check-circle"></i> ${escapeHtml(f)}</li>`).join('')}
                    </ul>
                </div>
                <div style="display: flex; gap: 8px; margin-top: 15px;">
                    <button class="btn-edit-trip" onclick="editTrip('bali', ${trip.id})"><i class="fas fa-edit"></i> Edit</button>
                    <button class="btn-delete-trip" onclick="deleteTrip('bali', ${trip.id})"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
        `
    })
}

// ================== EDIT TRIP ==================
function editTrip(daerah, id) {
    const trip = tripData[daerah].find(t => t.id === id)
    if (!trip) return

    document.getElementById("editDaerah").value = daerah
    document.getElementById("editId").value = id
    document.getElementById("editNama").value = trip.nama
    document.getElementById("editHarga").value = trip.harga
    document.getElementById("editFasilitas").value = trip.fasilitas.join(", ")
    document.getElementById("editIcon").value = trip.icon
    document.getElementById("editBadge").value = trip.badge || ""

    if (daerah === "banyuwangi") {
        document.getElementById("editDescGroup").style.display = "block"
        document.getElementById("editItineraryGroup").style.display = "none"
        document.getElementById("editDesc").value = trip.desc || ""
    } else {
        document.getElementById("editDescGroup").style.display = "none"
        document.getElementById("editItineraryGroup").style.display = "block"
        document.getElementById("editItinerary").value = trip.itinerary ? trip.itinerary.join(", ") : ""
    }

    document.getElementById("popupEditTrip").style.display = "flex"
}

function tutupPopupEditTrip() {
    document.getElementById("popupEditTrip").style.display = "none"
}

document.getElementById("editTripForm")?.addEventListener("submit", (e) => {
    e.preventDefault()
    const daerah = document.getElementById("editDaerah").value
    const id = parseInt(document.getElementById("editId").value)
    const index = tripData[daerah].findIndex(t => t.id === id)

    if (index !== -1) {
        const updatedTrip = {
            id: id,
            nama: document.getElementById("editNama").value,
            harga: parseInt(document.getElementById("editHarga").value),
            fasilitas: document.getElementById("editFasilitas").value.split(",").map(f => f.trim()),
            icon: document.getElementById("editIcon").value,
            badge: document.getElementById("editBadge").value
        }

        if (daerah === "banyuwangi") {
            updatedTrip.desc = document.getElementById("editDesc").value
        } else {
            const itineraryInput = document.getElementById("editItinerary").value
            updatedTrip.itinerary = itineraryInput ? itineraryInput.split(",").map(i => i.trim()) : []
        }

        tripData[daerah][index] = updatedTrip
        localStorage.setItem("tripData", JSON.stringify(tripData))
        renderTrips()
        tutupPopupEditTrip()
        showToast("Trip berhasil diupdate!", "success")
    }
})

// ================== DELETE TRIP ==================
function deleteTrip(daerah, id) {
    if (confirm("Yakin ingin menghapus trip ini?")) {
        tripData[daerah] = tripData[daerah].filter(t => t.id !== id)
        localStorage.setItem("tripData", JSON.stringify(tripData))
        renderTrips()
        showToast("Trip berhasil dihapus!", "success")
    }
}

// ================== ADD TRIP ==================
let addTripDaerah = null

function showAddTripForm(daerah) {
    addTripDaerah = daerah
    document.getElementById("addDaerah").value = daerah
    document.getElementById("addNama").value = ""
    document.getElementById("addHarga").value = ""
    document.getElementById("addFasilitas").value = ""
    document.getElementById("addIcon").value = ""
    document.getElementById("addBadge").value = ""

    if (daerah === "banyuwangi") {
        document.getElementById("addDescGroup").style.display = "block"
        document.getElementById("addItineraryGroup").style.display = "none"
        document.getElementById("addDesc").value = ""
    } else {
        document.getElementById("addDescGroup").style.display = "none"
        document.getElementById("addItineraryGroup").style.display = "block"
        document.getElementById("addItinerary").value = ""
    }

    document.getElementById("popupAddTrip").style.display = "flex"
}

function tutupPopupAddTrip() {
    document.getElementById("popupAddTrip").style.display = "none"
    addTripDaerah = null
}

document.getElementById("addTripForm")?.addEventListener("submit", (e) => {
    e.preventDefault()
    const daerah = document.getElementById("addDaerah").value
    const newId = Date.now()

    const newTrip = {
        id: newId,
        nama: document.getElementById("addNama").value,
        harga: parseInt(document.getElementById("addHarga").value),
        fasilitas: document.getElementById("addFasilitas").value.split(",").map(f => f.trim()),
        icon: document.getElementById("addIcon").value,
        badge: document.getElementById("addBadge").value
    }

    if (daerah === "banyuwangi") {
        newTrip.desc = document.getElementById("addDesc").value
        tripData.banyuwangi.push(newTrip)
    } else {
        const itineraryInput = document.getElementById("addItinerary").value
        newTrip.itinerary = itineraryInput ? itineraryInput.split(",").map(i => i.trim()) : []
        tripData.bali.push(newTrip)
    }

    localStorage.setItem("tripData", JSON.stringify(tripData))
    renderTrips()
    tutupPopupAddTrip()
    showToast("Trip baru berhasil ditambahkan!", "success")
})

// ================== FORM HANDLER ==================
const form = document.getElementById("formBooking")
if (form) {
    form.addEventListener("submit", async (e) => {
        e.preventDefault()

        const ktpFile = document.getElementById("ktp").files[0]
        const buktiFile = document.getElementById("bukti").files[0]

        if (!ktpFile) {
            showToast("⚠️ Wajib upload identitas (KTP/KK)!", 'error')
            return
        }
        if (!buktiFile) {
            showToast("⚠️ Wajib upload bukti pembayaran DP!", 'error')
            return
        }

        if (ktpFile && ktpFile.size > 1000000) {
            showToast("File KTP terlalu besar (max 1MB)", 'error')
            return
        }
        if (buktiFile && buktiFile.size > 1000000) {
            showToast("File bukti terlalu besar (max 1MB)", 'error')
            return
        }
        if (ktpFile && !ktpFile.type.startsWith("image/")) {
            showToast("File KTP harus berupa gambar!", 'error')
            return
        }
        if (buktiFile && !buktiFile.type.startsWith("image/")) {
            showToast("File bukti harus berupa gambar!", 'error')
            return
        }

        const ktpBase64 = ktpFile ? await toBase64(ktpFile) : ""
        const buktiBase64 = buktiFile ? await toBase64(buktiFile) : ""

        const item = {
            id: Date.now(),
            nama: document.getElementById("nama").value.trim(),
            telp: document.getElementById("telp").value.trim(),
            tujuan: document.getElementById("tujuan").value,
            paket: document.getElementById("paket").value,
            tanggal: document.getElementById("tanggal").value,
            peserta: document.getElementById("peserta").value,
            ktp: ktpBase64,
            bukti: buktiBase64,
            status: "DP",
            createdAt: new Date().toISOString()
        }

        if (!item.nama || !item.telp || !item.tujuan || !item.paket || !item.tanggal || !item.peserta) {
            showToast("Semua data wajib diisi!", 'error')
            return
        }

        data.push(item)
        localStorage.setItem("booking", JSON.stringify(data))

        showToast("Booking berhasil!", 'success')
        form.reset()

        setTimeout(() => {
            window.location.href = "hal2.html"
        }, 1000)
    })
}

// ================== DYNAMIC PAKET (Ambil dari tripData) ==================
const tujuanSelect = document.getElementById("tujuan")
const paketSelect = document.getElementById("paket")

function updatePaketOptions() {
    if (!tujuanSelect || !paketSelect) return
    const tujuan = tujuanSelect.value
    paketSelect.innerHTML = '<option value="">-- Pilih Paket --</option>'

    if (tujuan === "Banyuwangi") {
        tripData.banyuwangi.forEach(paket => {
            const option = document.createElement("option")
            option.value = paket.nama
            option.textContent = paket.nama
            paketSelect.appendChild(option)
        })
    } else if (tujuan === "Bali") {
        tripData.bali.forEach(paket => {
            const option = document.createElement("option")
            option.value = paket.nama
            option.textContent = paket.nama
            paketSelect.appendChild(option)
        })
    }
}

if (tujuanSelect && paketSelect) {
    tujuanSelect.addEventListener("change", updatePaketOptions)
}

// ================== EDIT STATUS POPUP ==================
const editStatus = (index) => {
    indexEdit = index
    const popup = document.getElementById("popupEdit")
    const select = document.getElementById("editStatus")
    if (popup && select) {
        select.value = data[index].status
        popup.style.display = "flex"
    }
}

const simpanEdit = () => {
    const statusBaru = document.getElementById("editStatus").value
    if (indexEdit !== null) {
        data[indexEdit].status = statusBaru
        localStorage.setItem("booking", JSON.stringify(data))
        filterData()
        tutupPopup()
        showToast("Status berhasil diupdate!", 'success')
    }
}

const tutupPopup = () => {
    const popup = document.getElementById("popupEdit")
    if (popup) popup.style.display = "none"
    indexEdit = null
}

// ================== DELETE DATA BOOKING ==================
const hapus = (index) => {
    if (confirm("Yakin ingin menghapus data ini?")) {
        data.splice(index, 1)
        localStorage.setItem("booking", JSON.stringify(data))
        filterData()
        updateStatistics()
        showToast("Data berhasil dihapus!", 'success')
    }
}

// ================== VIEW FILE (Preview) ==================
const lihatFile = (dataUrl) => {
    if (!dataUrl) {
        showToast("File tidak tersedia", 'error')
        return
    }
    const win = window.open()
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head><title>Preview File</title>
        <style>
            body { margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f0f0f0; }
            img { max-width: 90%; max-height: 90vh; box-shadow: 0 4px 20px rgba(0,0,0,0.2); border-radius: 8px; }
            button { position: fixed; top: 20px; right: 20px; padding: 10px 20px; background: #0F2B4D; color: white; border: none; border-radius: 8px; cursor: pointer; }
        </style>
        </head>
        <body><button onclick="window.close()">Tutup</button><img src="${dataUrl}" alt="Preview"></body>
        </html>
    `)
}

// ================== UPDATE STATISTICS ==================
const updateStatistics = () => {
    const totalBooking = data.length

    const getHargaPaket = (namaPaket) => {
        let trip = tripData.banyuwangi.find(t => t.nama === namaPaket)
        if (trip) return trip.harga

        trip = tripData.bali.find(t => t.nama === namaPaket)
        if (trip) return trip.harga

        return 0
    }

    let totalPendapatan = 0
    let totalBanyuwangi = 0
    let totalBali = 0

    data.forEach(item => {
        const harga = getHargaPaket(item.paket)
        const peserta = Number(item.peserta) || 0
        totalPendapatan += harga * peserta

        if (item.tujuan === "Banyuwangi") {
            totalBanyuwangi += peserta
        } else if (item.tujuan === "Bali") {
            totalBali += peserta
        }
    })

    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka)
    }

    const totalBookingEl = document.getElementById("totalBooking")
    const totalBanyuwangiEl = document.getElementById("totalBanyuwangi")
    const totalBaliEl = document.getElementById("totalBali")
    const totalPendapatanEl = document.getElementById("totalPendapatan")

    if (totalBookingEl) totalBookingEl.innerText = totalBooking
    if (totalBanyuwangiEl) totalBanyuwangiEl.innerText = totalBanyuwangi
    if (totalBaliEl) totalBaliEl.innerText = totalBali
    if (totalPendapatanEl) totalPendapatanEl.innerText = formatRupiah(totalPendapatan)
}

// ================== FILTER DATA (Tabel Booking) ==================
const filterData = () => {
    const tabel = document.getElementById("dataTabel")
    if (!tabel) return

    const checked = document.querySelectorAll('.checkbox input:checked')
    const kategoriDipilih = Array.from(checked).map(item => item.value)

    tabel.innerHTML = ""
    let totalPeserta = 0

    data.forEach((item, index) => {
        if (kategoriDipilih.length === 0 || kategoriDipilih.includes(item.tujuan)) {
            totalPeserta += Number(item.peserta)
            tabel.innerHTML += `
                <tr>
                    <td data-label="Nama">${escapeHtml(item.nama)}</td>
                    <td data-label="Telepon">${escapeHtml(item.telp)}</td>
                    <td data-label="Tujuan">${escapeHtml(item.tujuan)}</td>
                    <td data-label="Paket">${escapeHtml(item.paket)}</td>
                    <td data-label="Tanggal">${escapeHtml(item.tanggal)}</td>
                    <td data-label="Peserta">${escapeHtml(item.peserta)}</td>
                    <td data-label="KTP">${item.ktp ? `<button class="table-btn" onclick="lihatFile('${item.ktp}')">Lihat</button>` : '-'}</td>
                    <td data-label="Bukti">${item.bukti ? `<button class="table-btn" onclick="lihatFile('${item.bukti}')">Lihat</button>` : '-'}</td>
                    <td data-label="Status"><span class="status ${getStatusClass(item.status)}">${escapeHtml(item.status)}</span><button class="edit-status-btn" onclick="editStatus(${index})">Edit</button></td>
                    <td data-label="Aksi"><button class="table-btn" onclick="hapus(${index})">Hapus</button></td>
                </tr>
            `
        }
    })

    updateStatistics()
}

// ================== SEARCH INDEX (Dashboard) ==================
const searchIndex = document.getElementById("searchIndex")
if (searchIndex) {
    const cards = document.querySelectorAll(".wisata-card")
    const noResult = document.getElementById("noResultIndex")

    searchIndex.addEventListener("input", () => {
        const keyword = searchIndex.value.toLowerCase().trim()

        if (keyword === "") {
            cards.forEach(card => card.style.display = "block")
            if (noResult) noResult.style.display = "none"
            return
        }

        let adaHasil = false

        cards.forEach(card => {
            const text = card.innerText.toLowerCase()
            const kategori = card.getAttribute("data-kategori") || ""

            let cocok = false

            if (keyword === "banyuwangi") {
                cocok = (kategori === "banyuwangi")
            } else if (keyword === "bali") {
                cocok = (kategori === "bali")
            } else {
                cocok = (text.includes(keyword) || kategori.includes(keyword))
            }

            if (cocok) {
                card.style.display = "block"
                adaHasil = true
            } else {
                card.style.display = "none"
            }
        })

        if (noResult) {
            noResult.style.display = (!adaHasil && keyword !== "") ? "block" : "none"
        }
    })
}

// ================== SEARCH DETAIL (Halaman Detail) ==================
const searchDetail = document.getElementById("searchDetail")

function performSearch(keyword) {
    const sectionBanyuwangi = document.getElementById("banyuwangi")
    const sectionBali = document.getElementById("bali")
    const sectionInformasi = document.getElementById("informasi")
    const noResult = document.getElementById("noResult")

    const cardsBanyuwangi = sectionBanyuwangi ? sectionBanyuwangi.querySelectorAll(".detail-card") : []
    const cardsBali = sectionBali ? sectionBali.querySelectorAll(".detail-card") : []

    if (keyword === "") {
        if (sectionBanyuwangi) sectionBanyuwangi.style.display = "block"
        if (sectionBali) sectionBali.style.display = "block"
        if (sectionInformasi) sectionInformasi.style.display = "block"
        cardsBanyuwangi.forEach(card => card.style.display = "block")
        cardsBali.forEach(card => card.style.display = "block")
        if (noResult) noResult.style.display = "none"
        return
    }

    let found = false

    if (keyword === "banyuwangi") {
        if (sectionBanyuwangi) sectionBanyuwangi.style.display = "block"
        if (sectionBali) sectionBali.style.display = "none"
        if (sectionInformasi) sectionInformasi.style.display = "none"
        cardsBanyuwangi.forEach(card => card.style.display = "block")
        cardsBali.forEach(card => card.style.display = "none")
        found = true
    } else if (keyword === "bali") {
        if (sectionBanyuwangi) sectionBanyuwangi.style.display = "none"
        if (sectionBali) sectionBali.style.display = "block"
        if (sectionInformasi) sectionInformasi.style.display = "none"
        cardsBanyuwangi.forEach(card => card.style.display = "none")
        cardsBali.forEach(card => card.style.display = "block")
        found = true
    } else if (keyword === "informasi") {
        if (sectionBanyuwangi) sectionBanyuwangi.style.display = "none"
        if (sectionBali) sectionBali.style.display = "none"
        if (sectionInformasi) sectionInformasi.style.display = "block"
        found = true
    } else {
        let adaDiBanyuwangi = false
        let adaDiBali = false

        cardsBanyuwangi.forEach(card => {
            const text = card.innerText.toLowerCase()
            if (text.includes(keyword)) {
                card.style.display = "block"
                adaDiBanyuwangi = true
                found = true
            } else {
                card.style.display = "none"
            }
        })

        cardsBali.forEach(card => {
            const text = card.innerText.toLowerCase()
            if (text.includes(keyword)) {
                card.style.display = "block"
                adaDiBali = true
                found = true
            } else {
                card.style.display = "none"
            }
        })

        if (sectionBanyuwangi) sectionBanyuwangi.style.display = adaDiBanyuwangi ? "block" : "none"
        if (sectionBali) sectionBali.style.display = adaDiBali ? "block" : "none"
        if (sectionInformasi) sectionInformasi.style.display = "none"
    }

    if (noResult) {
        if (!found && keyword !== "") {
            noResult.style.display = "block"
            if (sectionBanyuwangi) sectionBanyuwangi.style.display = "none"
            if (sectionBali) sectionBali.style.display = "none"
            if (sectionInformasi) sectionInformasi.style.display = "none"
        } else {
            noResult.style.display = "none"
        }
    }
}

if (searchDetail) {
    searchDetail.addEventListener("input", () => {
        const keyword = searchDetail.value.toLowerCase().trim()
        performSearch(keyword)
    })
}

function resetSearch() {
    const searchInput = document.getElementById("searchDetail")
    if (searchInput) {
        searchInput.value = ""
        performSearch("")
    }
}

// ================== TAG CLICK SEARCH ==================
document.querySelectorAll('.tag').forEach(tag => {
    tag.addEventListener('click', () => {
        const searchValue = tag.getAttribute('data-search')
        const searchInput = document.getElementById("searchDetail")
        if (searchInput && searchValue) {
            searchInput.value = searchValue
            performSearch(searchValue)
        }
    })
})

// ================== TAB SYSTEM (Detail Page) ==================
const tabBtns = document.querySelectorAll('.tab-btn')
const tabContents = document.querySelectorAll('.tab-content')

if (tabBtns.length > 0) {
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabId = btn.getAttribute('data-tab')
            tabBtns.forEach(b => b.classList.remove('active'))
            tabContents.forEach(c => c.classList.remove('active'))
            btn.classList.add('active')
            const targetTab = document.getElementById(`tab-${tabId}`)
            if (targetTab) targetTab.classList.add('active')
        })
    })
}

// ================== FAQ ACCORDION (Detail Page) ==================
const faqItems = document.querySelectorAll('.faq-item')
if (faqItems.length > 0) {
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question')
        if (question) {
            question.addEventListener('click', () => {
                item.classList.toggle('active')
            })
        }
    })
}

// ================== ABOUT US BUTTON ==================
const aboutButtons = document.querySelectorAll('.about-btn')
aboutButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        alert("✨ NajaTrip ✨\n\nLayanan Open Trip Profesional\nBanyuwangi - Bali\n\nKontak: 082340188130\nInstagram: @Waaa.ril\nTikTok: @Gemini05")
    })
})

// ================== CLOSE POPUP ON OUTSIDE CLICK ==================
window.onclick = (event) => {
    const popup = document.getElementById("popupEdit")
    if (event.target === popup) {
        tutupPopup()
    }
    const popupEditTrip = document.getElementById("popupEditTrip")
    if (event.target === popupEditTrip) {
        tutupPopupEditTrip()
    }
    const popupAddTrip = document.getElementById("popupAddTrip")
    if (event.target === popupAddTrip) {
        tutupPopupAddTrip()
    }
}

// ================== INITIAL RENDER ==================
if (document.getElementById("dataTabel")) {
    filterData()
}

if (document.getElementById("banyuwangi-container")) {
    renderTrips()
}

// ================== EXPOSE GLOBAL FUNCTIONS ==================
window.editStatus = editStatus
window.simpanEdit = simpanEdit
window.tutupPopup = tutupPopup
window.hapus = hapus
window.lihatFile = lihatFile
window.filterData = filterData
window.resetSearch = resetSearch
window.performSearch = performSearch
window.editTrip = editTrip
window.deleteTrip = deleteTrip
window.showAddTripForm = showAddTripForm
window.tutupPopupEditTrip = tutupPopupEditTrip
window.tutupPopupAddTrip = tutupPopupAddTrip
