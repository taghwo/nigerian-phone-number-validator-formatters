#Installation
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


##Available methods
```
setDigits() accepts single or range of digits(min_range, max_range). ('14') or ('11','14)
```
```
validateWithRange() will validate if phone number supplied falls within range and validateStrict() throws exception if phone number supplied is === single number in setDigits()
```
```
getCleanNumber() returns clean phone number
```
```
formatToIntPhoneNumber() prefixes 234 on phonenumber if it does not have it
```
```
getPrefix() fetches phonenumber prefix
```
```
splitPhoneNumber() splits phone number into chunks based on criterai supplied, (null, 4)
```
```
setPhoneNumber() Note only use when using the static call on use Taghwo\PhoneNumber\PhoneNumber;
```

#Usage
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