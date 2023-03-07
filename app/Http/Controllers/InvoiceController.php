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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
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
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Remove the specified resource from storage.
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
