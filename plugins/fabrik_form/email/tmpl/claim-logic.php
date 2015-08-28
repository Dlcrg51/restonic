<?php
/**
 * @Author  Chad Windnagle
 * @Project restonic
 * Date: 10/17/14
 */

class warrantyLogic
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function isRigidCenter()
    {
        $isRigidCenter = $this->data['tbl_warranty_claim_oct___rigid_center_support_raw'];
        $isRigidCenter = filter_var($isRigidCenter[0], FILTER_VALIDATE_BOOLEAN);

        return $isRigidCenter;
    }

    public function isStainFree()
    {
        $isStainFree = $this->data['tbl_warranty_claim_oct___soils_stains_raw'];
        $isStainFree = filter_var($isStainFree[0], FILTER_VALIDATE_BOOLEAN);

        return $isStainFree;
    }

    public function hasReceipt()
    {
        $hasReceipt = $this->data['tbl_warranty_claim_oct___original_receipt_raw'];
        $hasReceipt = filter_var($hasReceipt[0], FILTER_VALIDATE_BOOLEAN);

        return $hasReceipt;
    }

    public function getMattressSize()
    {
        $mattressSize = $this->data['tbl_warranty_claim_oct___mattress_size_raw'];

        // get mattress size from list array
        $mattressSize = $mattressSize[0];

        return $mattressSize;
    }

    public function needsRigidSupport()
    {
        $needsRigidSupport = false;
        $mattressSize      = $this->getMattressSize();

        // biz rules: for mattress queen and larger must have rigid support
        if ($mattressSize == 'queen' ||
            $mattressSize == 'king' ||
            $mattressSize == 'california_king'
        ) {
            $needsRigidSupport = true;
        }

        return $needsRigidSupport;
    }


    public function isValidClaim()
    {
        // check first case
        if ($this->hasReceipt() // we are stain free
            && $this->isStainFree() // we have receipt
            && $this->isRigidCenter() // we have rigid center
            && $this->needsRigidSupport()) // mattress requires rigid support
        {
            return true;
        }

        // check second case
        if ($this->hasReceipt()  // we have receipt,
            && $this->isStainFree()   // we are stain free
            && ! $this->needsRigidSupport()) // we don't need rigid support
        {
            return true;
        }

        // most likely we needed rigid support and we didn't have it.
        // all other cases default false
        return false;
    }
        public function getAdvancedErrorMessage()
    {
    	$claimFormErrorMessage = '';
        // check for soiled or stained mattress
		if (! $this->isStainFree())
        {
            $claimFormErrorMessage .= 'Mattress must be free from soils and stains for a warranty claim to be processed. \n';
        }
        //	check for receipt
        if (! $this->hasRecept())
        {
            $claimFormErrorMessage .= 'If you do not have your original receipt, your claim will be received but cannot be processed.\n';
        }
		if (! $this->isRigidCenter() // we do not have rigid center
		   && $this->needsRigidSupport()) // mattress requires rigid support
		{
		   $claimFormErrorMessage .= 'This size of mattress requires rigid center support - at least a 5th leg in the center for support.\n';
		}
		return $claimFormErrorMessage;	
    }

}
