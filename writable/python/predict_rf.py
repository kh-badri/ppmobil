import sys
import pandas as pd
import pymysql
from sklearn.ensemble import RandomForestRegressor
import numpy as np
import json

def main():
    try:
        # ===== 1. Ambil Argumen dari PHP =====
        # Arg 1-4: Kredensial Database
        db_host = sys.argv[1]
        db_user = sys.argv[2]
        db_pass = sys.argv[3]
        db_name = sys.argv[4]

        # Arg 5-10: Input Fitur dari User (6 Fitur)
        input_pendapatan_per_kapita = float(sys.argv[5])
        input_tingkat_inflasi = float(sys.argv[6])
        input_suku_bunga_kredit = float(sys.argv[7])
        input_jumlah_penduduk = float(sys.argv[8])
        input_usia_produktif = float(sys.argv[9])
        input_tingkat_urbanisasi = float(sys.argv[10])

        # ===== 2. Koneksi & Ambil Data Training =====
        conn = pymysql.connect(host=db_host, user=db_user, password=db_pass, db=db_name)
        df = pd.read_sql("SELECT * FROM dataset_mobil", conn)
        conn.close()

        # Tentukan Fitur (X) dan Target (y)
        # 'bulan_tahun' DIHAPUS dari daftar fitur
        features = [
            'pendapatan_per_kapita', 
            'tingkat_inflasi', 
            'suku_bunga_kredit', 
            'jumlah_penduduk', 
            'usia_produktif', 
            'tingkat_urbanisasi'
        ]
        target = 'permintaan_mobil'
        
        X_train = df[features]
        y_train = df[target]

        # ===== 3. Preprocessing (TIDAK DIPERLUKAN) =====
        # Karena semua fitur sekarang numerik, kita tidak perlu 
        # OneHotEncoder atau ColumnTransformer. Model bisa langsung dilatih.

        # ===== 4. Training Model (On-the-fly) =====
        model = RandomForestRegressor(n_estimators=100, random_state=42, n_jobs=-1)
        # Langsung fit menggunakan X_train (DataFrame numerik)
        model.fit(X_train, y_train)

        # ===== 5. Buat Prediksi =====
        # Siapkan data input baru dari user
        input_data = pd.DataFrame({
            'pendapatan_per_kapita': [input_pendapatan_per_kapita],
            'tingkat_inflasi': [input_tingkat_inflasi],
            'suku_bunga_kredit': [input_suku_bunga_kredit],
            'jumlah_penduduk': [input_jumlah_penduduk],
            'usia_produktif': [input_usia_produktif],
            'tingkat_urbanisasi': [input_tingkat_urbanisasi]
        })

        # Langsung prediksi menggunakan input_data
        prediction = model.predict(input_data)

        # ===== 6. Kembalikan Hasil ke PHP =====
        hasil_prediksi = round(prediction[0])
        
        result = {'prediksi': hasil_prediksi}
        print(json.dumps(result))

    except Exception as e:
        error = {'error': str(e)}
        print(json.dumps(error))

if __name__ == "__main__":
    main()