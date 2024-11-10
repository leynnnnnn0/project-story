<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'transactionheader';

    protected $attributes = [
        'TransactionType' => 'transaction_type',
        'OrderDate' => 'order_date',
        'ReceivingDate' => 'receiving_date',
        'Total_Item' => 'total_item',
        'TOTALQUANTITY' => 'total_quantity',
        'Encoder_ID' => 'encoder_id',
        'Supplier' => 'supplier',
        'Status' => 'status',
        'IsApproved' => 'is_approved',
        'ApprovedById' => 'approved_by_id',
        'ReceivedById' => 'received_by_id',
        'LastUpdateByID' => 'last_update_by_id',
        'CreatedDate' => 'created_at',
        'LastUpdateDate' => 'updated_at',
        'DeliverReceiptNo' => 'deliver_receipt_no',
        'DRLink' => 'dr_link',
        'POReceiptNo' => 'po_receipt_no',
        'BranchID' => 'branch_id',
        'CounterNumber' => 'counter_number',
        'TransactionCode' => 'transaction_code',
        'SONumber' => 'so_number',
        'FromUpload' => 'from_upload',
        'UploadByUserId' => 'upload_by_user_id',
        'UploadFileName' => 'upload_file_name',
        'SODate' => 'so_date',
        'SourceSODuplicate' => 'source_so_duplicate',
        'isDuplicate' => 'is_duplicate',
        'Remarks' => 'remarks',
        'IsNoSO' => 'is_no_so',
        'DRAttachment' => 'dr_attachment',
        'SOApproved' => 'so_approved',
        'SOApprovedByID' => 'so_approved_by_id',
        'SOApprovedDate' => 'so_approved_date',
        'ApprovedDate' => 'approved_date'
    ];

    protected $casts = [
        'OrderDate' => 'datetime',
        'ReceivingDate' => 'date',
        'CreatedDate' => 'datetime',
        'LastUpdateDate' => 'datetime',
        'SODate' => 'date',
        'SOApprovedDate' => 'datetime',
        'ApprovedDate' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
