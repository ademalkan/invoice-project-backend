<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{


    protected $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Brings all invoice records
     */
    public function index()
    {
        try {
            return $this->invoiceRepository->getInvoices();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new invoice records
     * @params request params
     */
    public function createInvoice(Request $request)
    {
        try {
            return $this->invoiceRepository->createInvoice($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Show a invoice record
     * @params invoiceId
     */
    public function show($invoiceId)
    {
        try {
            return $this->invoiceRepository->showInvoice($invoiceId);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Edit a invoice record
     * @params invoiceId, request
     */
    public function editInvoice($invoiceId, Request $request)
    {
        try {
            return $this->invoiceRepository->editInvoice($invoiceId, $request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }



    /**
     * Destroy a invoice record
     * @params invoiceId
     */
    public function destroy($invoiceId)
    {
        try {
            return $this->invoiceRepository->destroyInvoice($invoiceId);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Set invoice status the paid.
     */
    public function setInvoicePaid($invoiceId)
    {
        try {
            return $this->invoiceRepository->setInvoicePaid($invoiceId);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
