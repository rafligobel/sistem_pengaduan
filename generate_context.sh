#!/usr/bin/env bash

# ==============================================================================
# SCRIPT GENERATOR KONTEKS & PRD PROYEK LENGKAP UNTUK AI (GEMINI / CLAUDE / GPT)
# ==============================================================================
# Script ini membaca arsitektur proyek, skema database, relasi model, rute, 
# controllers, form validation, business logic, dan views untuk dirangkum 
# menjadi 1 file Markdown (rangkuman.md) sebagai Single Source of Truth bagi AI.
# ==============================================================================

set -e

OUTPUT_FILE="rangkuman.md"
PROJECT_NAME=$(basename "$PWD")
CURRENT_DATE=$(date +"%Y-%m-%d %H:%M:%S")
MAX_FILE_SIZE_BYTES=150000 # 150 KB limit per file untuk mencegah file minified/dump merusak context

echo "================================================================="
echo "  🚀 MEMULAI GENERASI PRD & KONTEKS PROYEK: $PROJECT_NAME"
echo "================================================================="
echo "Target output: $OUTPUT_FILE"

# Deteksi Teknologi / Framework
DETECTED_TECH=""
[ -f "artisan" ] && DETECTED_TECH="Laravel (PHP) $DETECTED_TECH"
[ -f "package.json" ] && DETECTED_TECH="Node.js / NPM $DETECTED_TECH"
[ -f "vite.config.js" ] || [ -f "vite.config.ts" ] && DETECTED_TECH="Vite $DETECTED_TECH"
[ -f "tailwind.config.js" ] || [ -f "tailwind.config.ts" ] && DETECTED_TECH="Tailwind CSS $DETECTED_TECH"
[ -f "prisma/schema.prisma" ] && DETECTED_TECH="Prisma ORM $DETECTED_TECH"
[ -f "requirements.txt" ] || [ -f "manage.py" ] && DETECTED_TECH="Python $DETECTED_TECH"
[ -z "$DETECTED_TECH" ] && DETECTED_TECH="General Web Application"

# 1. Header Dokumen & Prompting Guardrails untuk AI
cat << 'EOF' > "$OUTPUT_FILE"
# 📄 DOKUMEN KONTEKS TEKNIS & PRD PROYEK (SINGLE SOURCE OF TRUTH)

> **Catatan Penting untuk AI (Gemini / Claude / ChatGPT / Antigravity):**  
> Anda bertindak sebagai Senior Software Architect & Lead Fullstack Engineer.  
> Dokumen ini adalah acuan mutlak (*Single Source of Truth*) mengenai arsitektur, struktur tabel database, relasi entitas, rute endpoint, dan logika bisnis aplikasi.  
>  
> **ATURAN WAJIB BAGI AI AGAR JAWABAN TIDAK NGAWUR / HALUSINASI:**  
> 1. **DILARANG MENGARANG NAMA:** Jangan pernah mengasumsikan atau mengarang nama tabel, nama kolom, nama relasi, nama route, atau method controller yang tidak tertera pada dokumen ini.  
> 2. **PATUHI STRUKTUR DATABASE:** Seluruh query, mutasi data, dan relasi Eloquent/ORM harus 100% cocok dengan skema tabel di Seksi 3 & Seksi 4.  
> 3. **KEAMANAN & VALIDASI:** Setiap pembuatan fitur baru wajib menyertakan validasi request (Form Request) dan otorisasi role/permission yang konsisten dengan sistem saat ini.  
> 4. **KONSISTENSI GAYA KODE:** Ikuti pola arsitektur yang sudah berjalan pada controllers, services, dan views yang ada.

---

EOF

cat << EOF >> "$OUTPUT_FILE"
## 📌 INFORMASI PROYEK
- **Nama Aplikasi / Folder:** \`$PROJECT_NAME\`
- **Waktu Ekstraksi:** \`$CURRENT_DATE\`
- **Teknologi Terdeteksi:** \`$DETECTED_TECH\`

---

## 📑 DAFTAR ISI
1. [Ikhtisar Struktur Direktori](#1-ikhtisar-struktur-direktori)
2. [Konfigurasi & Dependensi Sistem](#2-konfigurasi--dependensi-sistem)
3. [Skema Database, Migrasi & Seeders](#3-skema-database-migrasi--seeders)
4. [Data Models & Relasi Database (ORM / Eloquent)](#4-data-models--relasi-database-orm--eloquent)
5. [Rute & Endpoint Aplikasi (Routing)](#5-rute--endpoint-aplikasi-routing)
6. [Validasi Data & Form Requests](#6-validasi-data--form-requests)
7. [Logika Bisnis & Controllers](#7-logika-bisnis--controllers)
8. [Services, Middlewares & Providers](#8-services-middlewares--providers)
9. [Tampilan Antarmuka (Views, Layouts & Components)](#9-tampilan-antarmuka-views-layouts--components)

---

EOF

# Helper function untuk menambahkan konten file secara aman
append_file_content() {
    local file_path="$1"
    local lang="$2"
    local heading_level="$3"

    [ -z "$heading_level" ] && heading_level="###"

    if [ -f "$file_path" ] && [ -s "$file_path" ]; then
        # Cek ukuran file agar file raksasa/minified tidak merusak token AI
        local fsize
        fsize=$(wc -c < "$file_path" 2>/dev/null || echo 0)

        echo "$heading_level File: \`$file_path\`" >> "$OUTPUT_FILE"

        if [ "$fsize" -gt "$MAX_FILE_SIZE_BYTES" ]; then
            echo "> ⚠️ *Catatan: File ini terlalu besar ($fsize bytes), hanya 150 baris pertama yang dicantumkan.*" >> "$OUTPUT_FILE"
            echo "\`\`\`$lang" >> "$OUTPUT_FILE"
            head -n 150 "$file_path" >> "$OUTPUT_FILE"
            echo -e "\n// ... [Dipangkas untuk efisiensi token AI] ..." >> "$OUTPUT_FILE"
            echo "\`\`\`" >> "$OUTPUT_FILE"
            echo "" >> "$OUTPUT_FILE"
        else
            echo "\`\`\`$lang" >> "$OUTPUT_FILE"
            cat "$file_path" >> "$OUTPUT_FILE"
            echo "" >> "$OUTPUT_FILE"
            echo "\`\`\`" >> "$OUTPUT_FILE"
            echo "" >> "$OUTPUT_FILE"
        fi
    fi
}

# ==============================================================================
# SEKSI 1: STRUKTUR DIREKTORI
# ==============================================================================
echo "📁 [1/8] Memindai struktur folder proyek..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 1. IKHTISAR STRUKTUR DIREKTORI

Struktur folder dan file aplikasi (mengabaikan folder vendor, node_modules, storage/cache, build artifacts, dan temporary):

```text
EOF

if command -v tree &> /dev/null; then
    tree -I 'node_modules|vendor|.git|storage|dist|build|.next|.nuxt|coverage|public/storage|.idea|.vscode' >> "$OUTPUT_FILE"
else
    find . -maxdepth 4 \
        -not -path '*/.*' \
        -not -path './node_modules*' \
        -not -path './vendor*' \
        -not -path './storage*' \
        -not -path './dist*' \
        -not -path './build*' \
        -not -path './public/storage*' \
        | sort | sed -e 's/[^-][^\/]*\//|/g' -e 's/|\([^|-]\)/|-- \1/' >> "$OUTPUT_FILE"
fi

cat << 'EOF' >> "$OUTPUT_FILE"
```

---

EOF

# ==============================================================================
# SEKSI 2: KONFIGURASI & DEPENDENSI
# ==============================================================================
echo "⚙️  [2/8] Mengumpulkan konfigurasi & dependensi..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 2. KONFIGURASI & DEPENDENSI SISTEM

EOF

# Mengambil file konfigurasi umum tanpa membocorkan .env asli
append_file_content ".env.example" "ini" "###"
append_file_content "composer.json" "json" "###"
append_file_content "package.json" "json" "###"
append_file_content "vite.config.js" "javascript" "###"
append_file_content "vite.config.ts" "typescript" "###"
append_file_content "tailwind.config.js" "javascript" "###"
append_file_content "Dockerfile" "dockerfile" "###"
append_file_content "docker-compose.yml" "yaml" "###"

cat << 'EOF' >> "$OUTPUT_FILE"
---

EOF

# ==============================================================================
# SEKSI 3: DATABASE MIGRATIONS & SEEDERS
# ==============================================================================
echo "🗄️  [3/8] Mengekstrak skema database, migrasi & seeders..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 3. SKEMA DATABASE, MIGRASI & SEEDERS

Mendefinisikan nama tabel, tipe kolom, foreign key, index, dan constraint basis data.

EOF

# Laravel migrations
if [ -d "database/migrations" ]; then
    for file in $(find database/migrations -maxdepth 2 -type f \( -name "*.php" -o -name "*.sql" \) | sort); do
        append_file_content "$file" "php" "####"
    done
fi

# Prisma schema
append_file_content "prisma/schema.prisma" "prisma" "####"

# SQL dump file jika ada di database/ atau root
for file in $(find . -maxdepth 2 -type f -name "*.sql" -not -path "*/vendor/*" -not -path "*/node_modules/*" | sort); do
    append_file_content "$file" "sql" "####"
done

# Seeders
if [ -d "database/seeders" ]; then
    for file in $(find database/seeders -maxdepth 2 -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

EOF

# ==============================================================================
# SEKSI 4: MODELS & RELASI
# ==============================================================================
echo "🔗 [4/8] Mengekstrak data model & relasi..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 4. DATA MODELS & RELASI DATABASE (ORM / ELOQUENT)

Definisi model, fillable attributes, casting tipe data, dan relasi (hasMany, belongsTo, dsb).

EOF

# Laravel Models
if [ -d "app/Models" ]; then
    for file in $(find app/Models -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
elif [ -d "app" ]; then
    for file in $(find app -maxdepth 1 -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

# Node / TS Models jika ada
if [ -d "src/models" ]; then
    for file in $(find src/models -type f \( -name "*.ts" -o -name "*.js" \) | sort); do
        append_file_content "$file" "typescript" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

EOF

# ==============================================================================
# SEKSI 5: ROUTES & ENDPOINTS
# ==============================================================================
echo "🛣️  [5/8] Mengekstrak rute aplikasi..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 5. RUTE & ENDPOINT APLIKASI (ROUTING)

Daftar URL endpoint web, API, otorisasi, dan middleware yang melindungi setiap rute.

EOF

if [ -d "routes" ]; then
    for file in $(find routes -maxdepth 2 -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

if [ -d "src/routes" ]; then
    for file in $(find src/routes -type f \( -name "*.ts" -o -name "*.js" \) | sort); do
        append_file_content "$file" "typescript" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

EOF

# ==============================================================================
# SEKSI 6: FORM REQUESTS & VALIDATION
# ==============================================================================
echo "🛡️  [6/8] Mengekstrak Form Requests & aturan validasi..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 6. VALIDASI DATA & FORM REQUESTS

Aturan validasi input (validation rules), pesan error, dan autorisasi form pengguna.

EOF

if [ -d "app/Http/Requests" ]; then
    for file in $(find app/Http/Requests -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

EOF

# ==============================================================================
# SEKSI 7: CONTROLLERS & LOGIKA BISNIS
# ==============================================================================
echo "🎮 [7/8] Mengekstrak Controllers..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 7. LOGIKA BISNIS & CONTROLLERS

Mengatur alur proses permintaan, kalkulasi status, manipulasi data, dan respon.

EOF

if [ -d "app/Http/Controllers" ]; then
    for file in $(find app/Http/Controllers -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

if [ -d "src/controllers" ]; then
    for file in $(find src/controllers -type f \( -name "*.ts" -o -name "*.js" \) | sort); do
        append_file_content "$file" "typescript" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

EOF

# ==============================================================================
# SEKSI 8: SERVICES, MIDDLEWARE, PROVIDERS & VIEWS
# ==============================================================================
echo "🎨 [8/8] Mengekstrak Services, Middlewares, Providers, dan Views UI..."
cat << 'EOF' >> "$OUTPUT_FILE"
## 8. SERVICES, MIDDLEWARES & PROVIDERS

Layer business service independen, middleware security, dan service provider registri.

EOF

if [ -d "app/Services" ]; then
    for file in $(find app/Services -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

if [ -d "app/Http/Middleware" ]; then
    for file in $(find app/Http/Middleware -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

if [ -d "app/Providers" ]; then
    for file in $(find app/Providers -type f -name "*.php" | sort); do
        append_file_content "$file" "php" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

## 9. TAMPILAN ANTARMUKA (VIEWS, LAYOUTS & COMPONENTS)

Struktur antarmuka pengguna, komponen formulir pengaduan, dan tata letak utama aplikasi.

EOF

if [ -d "resources/views" ]; then
    for file in $(find resources/views -type f \( -name "*.blade.php" -o -name "*.php" \) | sort); do
        append_file_content "$file" "html" "####"
    done
fi

cat << 'EOF' >> "$OUTPUT_FILE"
---

## 🏁 CHECKLIST & PANDUAN PENGEMBANGAN UNTUK AI
Ketika pengguna meminta Anda menambahkan kode, fitur baru, atau memperbaiki bug:
1. **Periksa Skema Database (Seksi 3):** Pastikan field database yang digunakan benar-benar ada. Jangan gunakan field yang belum dimigrasi.
2. **Gunakan Relasi Model yang Ada (Seksi 4):** Jangan membuat query manual kompleks jika sudah ada relasi Eloquent yang terdefinisi.
3. **Patuhi Hak Akses & Role (Seksi 5):** Pasang middleware atau permission yang tepat sesuai Spatie / gate yang ada.
4. **Validasi Request (Seksi 6):** Jangan validasi mentah di controller jika format proyek menggunakan custom Form Request (`php artisan make:request`).
EOF

echo "================================================================="
echo "  ✅ SELESAI! Dokumen PRD Konteks telah dibuat: $OUTPUT_FILE"
echo "  📊 Ukuran Dokumen: $(wc -c < "$OUTPUT_FILE" 2>/dev/null || echo '0') bytes (~$(wc -l < "$OUTPUT_FILE" 2>/dev/null || echo '0') baris)"
echo "================================================================="