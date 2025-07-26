#!/bin/bash

echo "🚀 Mulai build di Vercel..."

# Buat folder public/storage jika belum ada
mkdir -p public/storage

# Copy isi dari storage/app/public ke public/storage
cp -r storage/app/public/* public/storage/ 2>/dev/null || true

echo "✅ Berhasil copy storage/app/public ke public/storage"
