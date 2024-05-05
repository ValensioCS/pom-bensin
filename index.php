<?php
class Shell {
    protected $jenis_bensin;
    protected $harga_per_liter;

    public function __construct($jenis_bensin, $harga_per_liter) {
        $this->jenis_bensin = $jenis_bensin;
        $this->harga_per_liter = $harga_per_liter;
    }

    public function getJenisBensin() {
        return $this->jenis_bensin;
    }

    public function getHargaPerLiter() {
        return $this->harga_per_liter;
    }
}

class Beli extends Shell {
    protected $jumlah_bensin;

    public function __construct($jenis_bensin, $harga_per_liter, $jumlah_bensin) {
        parent::__construct($jenis_bensin, $harga_per_liter);
        $this->jumlah_bensin = $jumlah_bensin;
    }

    public function getTotalHarga() {
        return $this->getHargaPerLiter() * $this->jumlah_bensin;
    }

    public function strukPembelian() {
        echo "<p>------------------------------------------------------------------------------------------------</p>";
        echo "<p>Anda Membeli Bahan Bakar Minyak Tipe " . ucfirst(str_replace('_', ' ', $this->getJenisBensin())) . "</p>";
        echo "<p>Dengan Jumlah: " . $this->jumlah_bensin . " Liter</p>";
        echo "<p>Total Yang Anda Harus Bayar: Rp " . number_format($this->getTotalHarga(), 0, ',', '.') . "</p>";
        echo "<p>------------------------------------------------------------------------------------------------</p>";
    }
}

$harga_bensin = array(
    "Shell_Super" => 15420 + 15420 * 0.10,
    "Shell_V_Power" => 16130 + 16130 * 0.10,
    "Shell_V_Power_Diesel" => 18130 + 18130 * 0.10,
    "Shell_V_Power_Nitro" => 16510 + 16510 * 0.10
);

if (isset($_POST['submit'])) {
    $jenis_bensin = $_POST['jenis_bensin'];
    $jumlah_bensin = $_POST['jumlah_bensin'];

    $harga_per_liter = $harga_bensin[$jenis_bensin];

    $pembelian = new Beli($jenis_bensin, $harga_per_liter, $jumlah_bensin);

    $pembelian->strukPembelian();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pom Bensin</title>
</head>
<body>
    <h2>Pom Bensin</h2>
    <form method="post" action="">
        <label for="jumlah_bensin">Jumlah (Liter):</label>
        <input type="number" name="jumlah_bensin" id="jumlah_bensin" min="1" required>
        <br><br>
        <label for="jenis_bensin">Jenis Bensin:</label>
        <select name="jenis_bensin" id="jenis_bensin">
            <?php foreach($harga_bensin as $jenis => $harga) { ?>
                <option value="<?php echo $jenis; ?>"><?php echo ucfirst(str_replace('_', ' ', $jenis)); ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="submit" value="Beli">
    </form>
</body>
</html>
