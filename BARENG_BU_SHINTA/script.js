console.log("Script eksternal berhasil diubah!");

// ── const: nilai TIDAK bisa diubah (gunakan sebagai default) ──
const namaAplikasi = 'SIAK Universitas';
const tahunAkademik = 2024;
const PI = 3.14159;
// namaAplikasi = 'Lain'; // ERROR! const tidak bisa diubah

// ── let: nilai BISA diubah (untuk variabel yang berubah) ──────
let namaUser = 'Andi Pratama';
let nilaiUjian = 85;
let statusLogin = false;
nilaiUjian = 90;        // OK, nilai bisa diubah

// ── var: cara lama, hindari penggunaan (scope berbeda) ────────
var umur = 20;          // function-scoped, bisa hoisted

// ── Naming conventions ──────────────────────────────────────
let namaLengkap  = 'Sari Dewi';    // camelCase (direkomendasikan)
let total_harga  = 150000;         // snake_case
const MAX_NILAI  = 100;            // UPPER_CASE untuk konstanta

// ── Template Literal (string modern) ───────────────────────
let nim = '21001';
let nama = 'Budi';
console.log(`Mahasiswa: ${nama}, NIM: ${nim}`);
// Output: Mahasiswa: Budi, NIM: 21001
