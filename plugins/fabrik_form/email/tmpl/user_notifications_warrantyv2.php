<?php
/**
 * @Author  Chad Windnagle
 * @Project restonic
 * Date: 10/17/14
 */

require_once(__DIR__ . '/claim-logic.php');


$warrantyLogic = new warrantyLogic($this->data);

// call to helper function file method
$isValidClaim = $warrantyLogic->isValidClaim();

// get form form data
$factoryName = $this->data['tbl_warranty_claim_oct___factory_locations_db'];

// form will return an array so knock it down to the first option
$factoryName = $factoryName[0];

// if we are the other option lets switch out for the other field from the form
if ($factoryName == 'Other')
{
    $factoryName = $this->data['tbl_warranty_claim_oct___other_location'];
}


?>
<p>Hi, {tbl_warranty_claim_oct___first_name}</p>
<?php if ($isValidClaim): ?>
    <p>
    Thank you for submitting a warranty claim with Restonic Mattress Company.
    Your claim has been submitted and someone will be in touch within two business days.
    </p>
    <p>
        Please remember that you’ll need:
        <ul>
            <li>Your original sales receipt</li>
            <li>The law tag located on the end of your mattress</li>
        </ul>
    </p>
    <p>
    While Restonic maintains the registry, the law label affords you warranty rights and
    the sales receipt validates you are the original purchaser.
    </p>
    <p>
    Thank you for contacting Restonic and allowing us to continue to serve you.
    </p>

<?php else: ?>
    <p>Thank you for submitting a warranty claim with Restonic Mattress Company.</p>

    <p>
        <?php echo $warrantyLogic->getAdvancedErrorMessage();?>
    </p>
    <p>
        While Restonic maintains the registry, the law label affords you warranty rights and the sales
        receipt validates you are the original purchaser. If you’d like to follow up with <?php echo $factoryName; ?>,
        please visit us online and choose the appropriate manufacturer to contact.
    </p>
    <p>
        Again, thank you for contacting Restonic and allowing us to continue to serve you.
    </p>
<?php endif; ?>
<p>
    Sweet Dreams, <br />
    Restonic Mattress Company
</p>
