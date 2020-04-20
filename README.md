## <center>Un-Official Gojek API Wrapper</center>
Repository berikut ini merupakan porting dari Gojek untuk PHP

| Method  | Result  |
|---|---|
| `loginPhone`  | Ok |
| `loginGojek`  | Ok |
| `checkBalance`  | Ok |
| `checkWalletCode`  | In Progress |
| `transferGopay`  | In Progress |

### Dokumentasi
#### Menjalankan GojekID
##### Ambil Paket Pada Composer
```php
composer require maulana20/gojekid
```
##### Jika Di Jalankan Dengan Laravel Tinker

[![tinker](./screen/tinker.PNG)](./../../)

##### Jika Di Jalankan Dengan Native
```php
require 'vendor/autoload.php';
use Maulana20\GojekID;

$gojek = new GojekID();
```

#### Login GOJEK
##### Langkah Pertama
```php
$loginToken = $gojek->loginPhone('<mobilePhone>')->getLoginToken();
```
##### Langkah Kedua
```php
$authToken = $gojek->loginGojek('<loginToken>', '<OTP>')->getAuthToken();
```

#### Mendapatkan Balance
```php
$gojek->authToken = '<authToken>';
$balance = $gojek->checkBalance()->getBalance();
```

#### Transfer GOPAY
##### Mendapatkan Check Wallet Code
```php
$gojek->authToken = '<authToken>';
$QrId = $gojek->checkWalletCode('<mobilePhoneTo>')->getQrId();
```

##### Kirim Saldo
```php
$gojek->authToken = '<authToken>';
$result = $gojek->transferGopay('<QrId>', '<PIN>', '<amount>', '<description>');
```

### PHP Unit Test

[![php-test](./screen/php-test.PNG)](./../../)

### Author

[Maulana Saputra](mailto:maulanasaputra11091082@gmail.com)
