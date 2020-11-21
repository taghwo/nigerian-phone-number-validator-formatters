###Usage
```sh
    composer require taghwo/nigerian-phone-number-validator-formatter
```
```sh
 include package your PHP file`
 require_once "vendor/autoload.php"; 
 ```
## example using the class instance

```sh
use Taghwo\PhoneNumber\PhoneNumberRequest;
```

```sh
$phonenumber = new PhoneNumberRequest('/--dff/s07000000000');
         
          $phonenumber
            ->setDigits('11,14')
            ->validateWithRange() ✅
            ->getCleanNumber()//07000000000;✅
            ->formatToIntPhoneNumber()//2347000000000;✅
            ->getPrefix()//070
            ->splitPhoneNumber(null, 3);//[070,000,000,00];

```
## using statically
```sh
use Taghwo\PhoneNumber\PhoneNumber;
```
```sh
PhoneNumber::setDigits('14')
            ->setPhoneNumber('/--dff/s07000000000')
            ->validateStrict()//❌ must be 14 chars
            ->getCleanNumber()//0700000000;✅
            ->formatToIntPhoneNumber()//2347000000000;✅
            ->getPrefix()//070
            ->splitPhoneNumber(null, 3);//[070,000,000,00];

```