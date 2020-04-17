## <center>Un-Official Gojek API Wrapper</center>
Repository berikut ini merupakan porting dari Gojek untuk PHP

| Method  | Result  |
|---|---|
| `loginPhone`  | Ok |
| `loginGojek`  | In Progress |
| `checkBalance`  | In Progress |
| `checkWalletCode`  | In Progress |
| `transferGopay`  | In Progress |

### Dokumentasi
#### Menjalankan GojekID
##### Mengambil Library Sesuai Kebutuhan
```php
composer install
```
##### Jalankan
```php
require 'vendor/autoload.php';
use Maulana20\GojekID;

$gojek = new GojekID();
```

#### Login GOJEK
##### Langkah Pertama
```php
echo $gojek->loginPhone('<mobilePhone>')->getLoginToken();
```
##### Langkah Kedua
```php
echo $gojek->loginGojek('<loginToken>', '<OTP>')->getAuthToken();
```

### Mendapatkan Balance
```php
$gojek->setToken = '<authToken>';
echo $gojek->checkBalance()->getBalance();
```

### Transfer GOPAY
#### Mendapatkan Check Wallet Code
```php
$gojek->setToken = '<authToken>';
echo $gojek->checkWalletCode('<mobilePhoneTo>')->getQrId();
```

#### Kirim Saldo
```php
$gojek->setToken = '<authToken>';
echo $gojek->transferGopay('<QrId>', '<PIN>', '<amount>', '<description>');
```

### Author

[Maulana Saputra](mailto:maulanasaputra11091082@gmail.com)
