###Usage
# composer require taghwo/nigerian-phone-number-validator-formatter

# require_once "vendor/autoload.php"; in your php file

# example using the class instance

use Taghwo\PhoneNumber\PhoneNumberRequest;

$phonenumber = new PhoneNumberRequest('/--dff/s07000000000');

$phonenumber
            ->setDigits('11,14')
            ->validateWithRange() ✅
            ->getCleanNumber()//07000000000;✅
            ->formatToIntPhoneNumber()//2347000000000;✅
            ->getPrefix()//070
            ->splitPhoneNumber(null, 3);//[070,000,000,00];


# using statically
use Taghwo\PhoneNumber\PhoneNumber;

PhoneNumber::setDigits('14')
            ->setPhoneNumber('/--dff/s07000000000')
            ->validateStrict()//❌ must be 14 chars
            ->getCleanNumber()//0700000000;✅
            ->formatToIntPhoneNumber()//2347000000000;✅
            ->getPrefix()//070
            ->splitPhoneNumber(null, 3);//[070,000,000,00];