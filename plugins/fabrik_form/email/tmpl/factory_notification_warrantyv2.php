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


if ($isValidClaim): ?>

<p>
    Dear {tbl_warranty_claim_oct___factory_locations_db}
</p>
<p>
    A new mattress warranty claim has been filed to your factory.
    Please read through the information below for the customer’s contact info and the
    reason for their claim. They will be waiting to hear from you so please reach out
    quickly to let them know you’ve received their claim.
</p>

<p>
    <strong>Customer Information:</strong><br />
    First Name: {tbl_warranty_claim_oct___first_name}<br />
    Last name: {tbl_warranty_claim_oct___last_name}<br />
    Email Address: {tbl_warranty_claim_oct___email_address}<br />
    Phone Number: {tbl_warranty_claim_oct___phone}<br />
    Other Location: {tbl_warranty_claim_oct___other_location}<br />
    Contact Preference: {tbl_warranty_claim_oct___contact_preference}
</p>
<p>
    <strong>Address:</strong><br />
    Street: {tbl_warranty_claim_oct___street_address}<br />
    City: {tbl_warranty_claim_oct___city}<br />
    State: {tbl_warranty_claim_oct___state}<br />
    Zip: {tbl_warranty_claim_oct___zip}<br />
</p>

<p>
    <strong>Purchase Information</strong><br />
    Store Name: {tbl_warranty_claim_oct___store_name}<br />
    Purchase Date: {tbl_warranty_claim_oct___purchase_date}<br />
    Have Original Store Receipt? {tbl_warranty_claim_oct___original_receipt}<br />
</p>

<p>
    <strong>Mattress Information:</strong><br />
    Mattress Model Name: {tbl_warranty_claim_oct___mattress_model_name}<br />
    Mattress Model Number: {tbl_warranty_claim_oct___mattress_model_number}<br />
    Mattress Size: {tbl_warranty_claim_oct___mattress_size}<br />
    Purchased: {tbl_warranty_claim_oct___what_did_you_purchase}<br />
    Rigid Center Support: {tbl_warranty_claim_oct___rigid_center_support}<br />
    Free of Soil/Stains: {tbl_warranty_claim_oct___soils_stains}<br />
</p>

<p>
    <strong>Claim Explanation:</strong><br />
    {tbl_warranty_claim_oct___explain_claim}
</p>

<p>
    Sweet Dreams<br />
    Restonic Mattress Corporation
</p>

<?php else: ?>
    <p>
        Dear {tbl_warranty_claim_oct___factory_locations_db}
    </p>
    <p>
        A warranty claim is not valid for this submission.
    </p>
    <p>
        <strong>
            Customer Information
        </strong>
    </p>
    <p>
        First Name: {tbl_warranty_claim_oct___first_name} <br />
        Last Name: {tbl_warranty_claim_oct___last_name}<br />
        Phone Number: {tbl_warranty_claim_oct___phone}<br />
        Street Address: {tbl_warranty_claim_oct___street_address}<br />
        City: {tbl_warranty_claim_oct___city}<br />
        State: {tbl_warranty_claim_oct___state}<br />
        Zip: {tbl_warranty_claim_oct___zip}<br />
        Email Address: {tbl_warranty_claim_oct___email_address}<br />
        Contact Preference: {tbl_warranty_claim_oct___contact_preference}<br />
        Other Location: {tbl_warranty_claim_oct___other_location}<br />
    </p>
    <p>
        <strong>Purchase Information</strong>
    </p>
    <p>
        Mattress Model Number: {tbl_warranty_claim_oct___mattress_model_number}<br />
        Original Receipt: {tbl_warranty_claim_oct___original_receipt}<br />
        Soils or stains? {tbl_warranty_claim_oct___soils_stains}<br />
        Store Name: {tbl_warranty_claim_oct___store_name}<br />
        Mattress Model Name: {tbl_warranty_claim_oct___mattress_model_name} <br />
        Purchase Date: {tbl_warranty_claim_oct___purchase_date}<br />
        Purchased: {tbl_warranty_claim_oct___what_did_you_purchase}<br />
        Mattress Size: {tbl_warranty_claim_oct___mattress_size}<br />
        Rigid Center Support? {tbl_warranty_claim_oct___rigid_center_support}<br />
        Factory Location {tbl_warranty_claim_oct___factory_locations_db}<br />
    </p>

    <p>
        <strong>Claim Information</strong>
    </p>
    <p>
        {tbl_warranty_claim_oct___explain_claim}
    </p>
<?php endif; ?>